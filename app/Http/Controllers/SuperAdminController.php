<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Student;
use App\User;
use App\lecturer;
use App\File;
use App\Seminar;
use App\Support;
use PDF;

class SuperAdminController extends Controller
{
    public function index(){
        $users = User::orderBy('role','ASC')->get();
        $students = Student::all();
        $lecturers = Lecturer::all();
        $pending = File::where('letter_1',NULL)->count();
        return view('dashboards.super_admin.index',compact(['users','students','lecturers','pending']));
    }
    
    public function students(){
        $students = Student::orderBy('npm','ASC')->get();
        return view('dashboards.super_admin.students',compact(['students']));
    }
    
    public function lecturers(){
        $lecturers = Lecturer::all();
        return view('dashboards.super_admin.lecturers',compact(['lecturers']));
    }
    
    public function documents(){
        $files = File::orderBy('letter_1','ASC')->get();
        // $files = File::where('letter_1','!=',NULL)->get();
        return view('dashboards.super_admin.documents',compact(['files']));
    }

    public function profile(){
        $user = User::find(auth()->user()->id);
        return view('dashboards.super_admin.profile',compact(['user']));
    }

    public function addAdmin(){
        return view('dashboards.super_admin.add-admin');
    }

    public function addStudent(){
        return view('dashboards.super_admin.add-student');
    }

    public function addLecturer(){
        return view('dashboards.super_admin.add-lecturer');
    }

    public function postregisteradmin(Request $request){
        $modemail = strtolower(trim($request->email));
        $modfirst_name = ucwords(strtolower(trim($request->first_name)));
        $modlast_name = ucwords(strtolower(trim($request->last_name)));
        $request->merge([
            'email' => $modemail,
            'first_name' => $modfirst_name,
            'last_name' => $modlast_name,
        ]);
        $this->validate($request,[
            'email' => 'unique:users',
        ]);
        $user = new User;
        $user->role = 'Admin';
        $user->name = $request->first_name.' '.$request->last_name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->password = bcrypt('EuclidGeometry');
        $user->remember_token = Str::random(60);
        $user->save();
        return redirect('/super_admin/dashboard/data_overview')->with('created','Add New Admin Success !!');
    }

    public function postregisterstudent(Request $request){
        $modemail = strtolower(trim($request->email));
        $modfirst_name = ucwords(strtolower(trim($request->first_name)));
        $modlast_name = ucwords(strtolower(trim($request->last_name)));
        $request->merge([
            'email' => $modemail,
            'first_name' => $modfirst_name,
            'last_name' => $modlast_name,
        ]);
        $this->validate($request,[
            'npm' => 'unique:students',
            'email' => 'unique:users',
        ]);
        $user = new User;
        $user->role = 'Student';
        $user->name = $request->first_name.' '.$request->last_name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->password = bcrypt('TimeSeries');
        $user->remember_token = Str::random(60);
        $user->save();
        $request->request->add(['user_id'=>$user->id]);
        $buffer = substr($request->npm,6,2);
        $buffer = '20'.$buffer;
        $request->request->add(['angkatan'=>$buffer]);
        $student = Student::create($request->all());
        return redirect('/super_admin/dashboard/students')->with('created','Add New Student Success !!');
    }

    public function postregisterlecturer(Request $request){
        $modemail = strtolower(trim($request->email));
        $modfirst_name = ucwords(strtolower(trim($request->first_name)));
        $modlast_name = ucwords(strtolower(trim($request->last_name)));
        $request->merge([
            'email' => $modemail,
            'first_name' => $modfirst_name,
            'last_name' => $modlast_name,
        ]);
        $this->validate($request,[
            'nip' => 'unique:lecturers',
            'email' => 'unique:users',
        ]);
        $user = new User;
        $user->role = 'Lecturer';
        $user->name = $request->first_name.' '.$request->last_name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->password = bcrypt('DeltaDiract');
        $user->remember_token = Str::random(60);
        $user->save();
        $request->request->add(['user_id'=>$user->id,'slot'=>10]);
        $lecturer = Lecturer::create($request->all());
        return redirect('/super_admin/dashboard/lecturers')->with('created','Add New Student Success !!');
    }

    public function update(Request $request){
        $user = User::find(auth()->user()->id);
        $modname = ucwords(strtolower(trim($request->name)));
        $request->merge(['name'=>$modname]);
        $user->phone = $request->phone;
        $user->name = $request->name;
        $user->avatar = $request->avatar;
        if (Hash::check($request->password_old, $user->password)) {
            if($request->password!=NULL){
                $user->password = bcrypt($request->password);
            }
            $user->save();
        }
        else{
            return back()->with('fail','wrong passsword');
        }
        return redirect('/super_admin/dashboard/profile')->with('updated','success');
    }

    public function postUpload1(Student $student){
        $file = FIle::find($student->file->id);
        $file->letter_1 = '1';
        $file->letter_1_date = Carbon::now();
        $file->save();
        // $request->request->add(['letter_1_date'=>Carbon::now()]);
        // $file->update($request->all());
        return redirect('/request/upload/'.$student->id)->with('sent','uploaded');
    }

    public function requestSupervisor(){
        $students = Student::orderBy('npm','ASC')->get();
        $tooltip = [
            'red',
            'blue',
            'cyan',
            'green',
        ];
        $status = [
            'Menunggu Persetujuan Dosen',
            'Menunggu Surat Tugas dari TU',
            'Dalam tahap bimbingan',
            'Selesai'
        ];
        $count1 = 0;
        $count2 = 0;
        return view('dashboards.super_admin.request-supervisor',compact(['students','status','tooltip','count1','count2']));
    }

    public function acceptRequest(Student $student, $id_lecturer){
        $student->lecturers()->updateExistingPivot($id_lecturer, ['progress' => 2]);
        return redirect('/super_admin/dashboard/request')->with('accepted','Success');
    }

    public function rejectRequest(Student $student, $id_lecturer){
        if($student->lecturers()->where('lecturers.id',$id_lecturer)->first()->pivot->order==1){
            if($student->lecturers()->wherePivot('order',2)->first()){
                if($student->lecturers()->wherePivot('order',2)->first()->pivot->progress>2){
                    $student->lecturers()->updateExistingPivot($student->lecturers()->wherePivot('order',2)->first()->id, ['progress' => 2]);
                }
            }
            if($student->lecturers()->where('lecturers.id',$id_lecturer)->first()->pivot->progress >= 2 && $student->lecturers()->where('lecturers.id',$id_lecturer)->first()->pivot->progress < 4){
                $lecturer = Lecturer::find($id_lecturer);
                $lecturer->slot++;
                $lecturer->save();
            }
        }
        if($student->lecturers()->where('lecturers.id',$id_lecturer)->first()->pivot->order==2){
            if($student->lecturers()->wherePivot('order',1)->first()){
                if($student->lecturers()->wherePivot('order',1)->first()->pivot->progress>2){
                    $student->lecturers()->updateExistingPivot($student->lecturers()->wherePivot('order',1)->first()->id, ['progress' => 2]);
                }
            }
        }
        if($student->file->letter_2){
            $student->file->update([
                'letter_2'=>NULL,
                'letter_2_date'=>NULL
            ]);
        }
        if($student->seminar){
            if($student->seminar->seminarfiles()->first()){
                $student->seminar->seminarfiles()->delete();
            }
            $student->seminar->delete();
        }
        if($student->attendances()){
            $student->attendances()->delete();
        }
        $student->lecturers()->detach($id_lecturer);
        return redirect('/super_admin/dashboard/request')->with('rejected','fail');
    }

    public function destroyDocuments(File $file){
        if($file->student->lecturers()->wherePivot('order',1)->first() || $file->student->lecturers()->wherePivot('order',2)->first()){
            if($file->student->lecturers()->wherePivot('order',1)->first()){
                if($file->student->lecturers()->wherePivot('order',1)->first()->pivot->progress >= 2 && $file->student->lecturers()->wherePivot('order',1)->first()->pivot->progress < 4){
                    $lecturer = Lecturer::find($file->student->lecturers()->wherePivot('order',1)->first()->id);
                    $lecturer->slot++;
                    $lecturer->save();
                }
            }
            $file->student->lecturers()->detach();
        }
        if($file->student->seminar){
            if($file->student->seminar->seminarfiles()->first()){
                $file->student->seminar->seminarfiles()->delete();
            }
            $file->student->seminar->delete();
        }
        if($file->student->attendances()){
            $file->student->attendances()->delete();
        }
        $file->delete();
        return redirect('/super_admin/dashboard/documents')->with('deleted','success');
    }

    public function slotUpdate(Request $request){
        $lecturer = Lecturer::find($request->id);
        $lecturer->slot = $request->slot;
        $lecturer->save();
        return redirect('/super_admin/dashboard/lecturers')->with('edited','success');
    }

    public function seminar(){
        $seminars = Seminar::orderBy('confirm','ASC')->get();
        return view('dashboards.super_admin.seminar',compact(['seminars']));
    }

    public function seminarInfo(Seminar $seminar){
        return view('dashboards.super_admin.seminar-info',compact(['seminar']));
    }

    public function acceptSeminar(Seminar $seminar){
        $seminar->confirm = 1;
        $seminar->save();
        return redirect('/seminar/info/'.$seminar->id)->with('accepted','success');
    }

    public function rejectSeminar(Seminar $seminar){
        $seminar->seminarfiles()->delete();
        $seminar->delete();
        return redirect('/super_admin/dashboard/seminar')->with('deleted','success');
    }

    public function editSeminar(Request $request){
        $seminar = Seminar::find($request->id);
        $seminar->date_time = $request->date_time.':00';
        $seminar->save();
        return redirect('/seminar/info/'.$request->id)->with('updated','success');
    }

    public function exportLetter1(Student $student){
        $kaprodi = User::find(1);
        $date = Carbon::createFromFormat('Y-m-d H:i:s', $student->file->letter_1_date); 
        $pdf = PDF::loadView('export.approval_sa',compact(['date','kaprodi','student']));
        return $pdf->download('Surat Persetujuan.pdf');
    }

    public function support(){
        $supports = Support::all();
        return view('dashboards.super_admin.support',compact(['supports']));
    }

    public function destroySupport(Support $support){
        $support->delete();
        return redirect('/super_admin/dashboard/support')->with('deleted','success');
    }
}

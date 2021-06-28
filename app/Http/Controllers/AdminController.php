<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\User;
use App\Student;
use App\File;

class AdminController extends Controller
{
    public function profile(){
        $admin = User::find(auth()->user()->id);
        return view('dashboards.admin.profile',compact(['admin']));
    }

    public function update(Request $request){
        $user = User::find(auth()->user()->id);
        $modname = ucwords(strtolower(trim($request->name)));
        $request->merge(['name'=>$modname]);
        $user->phone = $request->phone;
        $user->name = $request->name;
        if (Hash::check($request->password_old, $user->password)) {
            if($request->password!=NULL){
                $user->password = bcrypt($request->password);
            }
            $user->avatar = $request->avatar;
            $user->save();
        }
        else{
            return back()->with('fail','wrong passsword');
        }
        return redirect('/admin/dashboard/admin_profile')->with('updated','success');
    }
    
    public function requestSupervisor(){
        $students = Student::all();
        $students_id = [];
        foreach($students as $student){
            if($student->lecturers()->wherePivot('order',1)->first() && $student->lecturers()->wherePivot('order',2)->first()){
                if($student->lecturers()->wherePivot('order',1)->first()->pivot->progress>=2 && $student->lecturers()->wherePivot('order',2)->first()->pivot->progress>=2 && $student->lecturers()->wherePivot('order',1)->first()->pivot->progress<4 && $student->lecturers()->wherePivot('order',2)->first()->pivot->progress<4){
                    $students_id[] = $student->id; 
                }
            }
        }
        // $students = Student::whereIn('id',$students_id)->orderBy(File::select('letter_2')->whereColumn('files.student_id','students.id'))->get();
        $students = Student::whereIn('id',$students_id)->get();
        $tooltip = [
            'red',
            'blue',
            'cyan',
            'green',
        ];
        $status = [
            'Menunggu Persetujuan Dosen',
            'Menunggu Surat Tugas dari TU',
            'Dalam Tahap Bimbingan',
            'Selesai'
        ];
        return view('dashboards.admin.request-supervisor',compact(['students','status','tooltip']));
    }

    public function upload(Student $student){
        // $student = $student->first();
        return view('dashboards.admin.upload',compact(['student']));
    }

    public function postUpload2(Student $student, Request $request){
        $file = FIle::find($student->file->id);
        $request->request->add(['letter_2_date'=>Carbon::now()]);
        $file->update($request->all());
        $id_lecturer = $student->lecturers()->wherePivot('order',1)->first()->id;
        $student->lecturers()->updateExistingPivot($id_lecturer, ['progress' => 3]);
        $id_lecturer = $student->lecturers()->wherePivot('order',2)->first()->id;
        $student->lecturers()->updateExistingPivot($id_lecturer, ['progress' => 3]);
        return redirect('/request/upload/'.$student->id)->with('sent','success');
    }
}

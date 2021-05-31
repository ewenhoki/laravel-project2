<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Student;
use App\User;
use App\File;
use App\lecturer;

class StudentController extends Controller
{
    public function profile(){
        $student = Student::where('user_id','=',auth()->user()->id)->first();
        return view('dashboards.student.profile',compact(['student']));
    }

    public function destroy(Student $student){
        $student->user->delete();
        if($student->file!=NULL){
            $student->file->delete();
        }
        $student->lecturers()->detach();
        $student->delete();
        return redirect('/super_admin/dashboard/students')->with('success','Delete Success');
    }

    public function update(Request $request){
        $user = User::find(auth()->user()->id);
        $modfirst_name = ucwords(strtolower(trim($request->first_name)));
        $modlast_name = ucwords(strtolower(trim($request->last_name)));
        $request->merge([
            'first_name' => $modfirst_name,
            'last_name' => $modlast_name,
        ]);
        $user->student->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'gpa' => $request->gpa
        ]);
        $user->name = $request->first_name.' '.$request->last_name;
        $user->phone = $request->phone;
        if($request->password!=NULL){
            $user->password = bcrypt($request->password);
        }
        $user->save();
        return redirect('/student/dashboard/student_profile')->with('updated','success');
    }

    public function addProposal(){
        $student = Student::find(auth()->user()->student->id);
        return view('dashboards.student.add-proposal',compact(['student']));
    }

    public function createProposal(Request $request){
        $file = new File;
        $file->student_id = auth()->user()->student->id;
        $file->title = $request->title;
        $file->krs = $request->krs;
        $file->kss = $request->kss;
        $file->proposal = $request->proposal;
        $file->paper = $request->paper;
        $file->upload_date = Carbon::now()->toDateTimeString();
        $file->save();
        return redirect('/student/dashboard/proposal_submission');
    }

    public function updateProposal(File $file,Request $request){
        $file->update($request->all());
        return redirect('/student/dashboard/proposal_submission');
    }

    public function addSupervisor(){
        $lecturers_all = Lecturer::all();
        $lecturers = array();
        foreach($lecturers_all as $lec){
            if($lec->students()->count()<10){
                $lecturers[] = $lec->id;
            }
        }
        $lecturer = Lecturer::whereIn('lecturers.id',$lecturers)
            ->join('users','users.id','=','lecturers.user_id')
            ->orderBy('users.name')
            ->pluck('users.name','lecturers.id');
        $lecturer->prepend('Pilih Dosen', 0);
        $status = [
            'Menunggu Persetujuan Kaprodi',
            'Menunggu Persetujuan Dosen',
            'Menunggu Surat Tugas dari TU',
            'Permohonan Disetujui',
            'Dalam tahap bimbingan',
            'Selesai'
        ];
        return view('dashboards.student.add-supervisor',compact(['lecturer','status']));
    }

    public function postSupervisor1(Request $request){
        if(auth()->user()->student->lecturers!=NULL){
            if(auth()->user()->student->lecturers()->wherePivot('order',1)->first()){
                return back()->with('exists','Already Exists');
            }
        }
        if($request->lecturer_id==0){
            return back()->with('fail','Add Fail');
        }
        if(auth()->user()->student->lecturers()->wherePivot('order',2)->first()){
            if(auth()->user()->student->lecturers()->wherePivot('order',2)->first()->id == $request->lecturer_id){
                return back()->with('already','fail');
            }
        }
        $student = Student::find(auth()->user()->student->id);
        $student->lecturers()->attach($request->lecturer_id,['progress'=>1,'order'=>1]);
        return redirect('/add/supervisor')->with('success','Add Success');
    }

    public function postSupervisor2(Request $request){
        if(auth()->user()->student->lecturers!=NULL){
            if(auth()->user()->student->lecturers()->wherePivot('order',2)->first()){
                return back()->with('exists','Already Exists');
            }
        }
        if($request->lecturer_id==0){
            return back()->with('fail','Add Fail');
        }
        if(auth()->user()->student->lecturers()->wherePivot('order',1)->first()){
            if(auth()->user()->student->lecturers()->wherePivot('order',1)->first()->id == $request->lecturer_id){
                return back()->with('already','fail');
            }
        }
        $student = Student::find(auth()->user()->student->id);
        $student->lecturers()->attach($request->lecturer_id,['progress'=>1,'order'=>2]);
        return redirect('/add/supervisor')->with('success','Add Success');
    }

    public function cancelSupervisor(Student $student, $lecturer_id){
        auth()->user()->student->lecturers()->detach($lecturer_id);
        return redirect('/add/supervisor')->with('deleted','success');
    }
}

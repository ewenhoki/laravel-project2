<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        return redirect('/student/dashboard/student_profile');
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
        return view('dashboards.student.add-supervisor',compact(['lecturer']));
    }
}

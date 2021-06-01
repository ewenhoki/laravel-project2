<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\lecturer;
use App\Student;
use App\User;

class LecturerController extends Controller
{
    public function profile(){
        $lecturer = Lecturer::where('user_id','=',auth()->user()->id)->first();
        return view('dashboards.lecturer.profile',compact(['lecturer']));
    }

    public function destroy(Lecturer $lecturer){
        $lecturer->user->delete();
        $lecturer->students()->detach();
        $lecturer->delete();
        return redirect('/super_admin/dashboard/lecturers')->with('success','Delete Success');
    }

    public function update(Request $request){
        $user = User::find(auth()->user()->id);
        $modfirst_name = ucwords(strtolower(trim($request->first_name)));
        $modlast_name = ucwords(strtolower(trim($request->last_name)));
        $request->merge([
            'first_name' => $modfirst_name,
            'last_name' => $modlast_name,
        ]);
        $user->lecturer->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
        ]);
        $user->name = $request->first_name.' '.$request->last_name;
        $user->phone = $request->phone;
        if($request->password!=NULL){
            $user->password = bcrypt($request->password);
        }
        $user->save();
        return redirect('/lecturer/dashboard/lecturer_profile')->with('updated','success');
    }

    public function studentRequest(){
        $students = auth()->user()->lecturer->students()->get();
        $tooltip = [
            'red',
            'purple',
            'orange',
            'blue',
            'cyan',
            'green',
        ];
        $status = [
            'Menunggu Persetujuan Kaprodi',
            'Menunggu Persetujuan Dosen',
            'Menunggu Surat Tugas dari TU',
            'Permohonan Disetujui',
            'Dalam tahap bimbingan',
            'Selesai'
        ];
        return view('dashboards.lecturer.student-request',compact(['students','status','tooltip']));
    }

    public function studentAccept(Student $student){
        $student->lecturers()->updateExistingPivot(auth()->user()->lecturer->id, ['progress' => 3]);
        return redirect('/lecturer/dashboard/student_request')->with('accepted','Success');
    }

    public function studentReject(Student $student){
        auth()->user()->lecturer->students()->detach($student->id);
        return redirect('/lecturer/dashboard/student_request')->with('rejected','fail');
    }
}

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
            $user->save();
        }
        else{
            return back()->with('fail','wrong passsword');
        }
        return redirect('/admin/dashboard/admin_profile')->with('updated','success');
    }
    
    public function requestSupervisor(){
        $students = Student::all();
        $tooltip = [
            'red',
            'orange',
            'blue',
            'cyan',
            'green',
        ];
        $status = [
            'Menunggu Persetujuan Kaprodi',
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

    public function postUpload1(Student $student, Request $request){
        $file = FIle::find($student->file->id);
        $request->request->add(['letter_1_date'=>Carbon::now()]);
        $file->update($request->all());
        $id_lecturer = $student->lecturers()->wherePivot('order',1)->first()->id;
        $student->lecturers()->updateExistingPivot($id_lecturer, ['progress' => 4]);
        return redirect('/request/upload/'.$student->id);
    }

    public function postUpload2(Student $student, Request $request){
        $file = FIle::find($student->file->id);
        $request->request->add(['letter_2_date'=>Carbon::now()]);
        $file->update($request->all());
        $id_lecturer = $student->lecturers()->wherePivot('order',2)->first()->id;
        $student->lecturers()->updateExistingPivot($id_lecturer, ['progress' => 4]);
        return redirect('/request/upload/'.$student->id);
    }
}

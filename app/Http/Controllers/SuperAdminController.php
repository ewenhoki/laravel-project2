<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Student;
use App\User;
use App\lecturer;

class SuperAdminController extends Controller
{
    public function index(){
        $users = User::all();
        $students = Student::all();
        $lecturers = Lecturer::all();
        $pending = DB::table('lecturer_student')->where('progress',1)->count();
        return view('dashboards.super_admin.index',compact(['users','students','lecturers','pending']));
    }
    
    public function students(){
        $students = Student::all();
        return view('dashboards.super_admin.students',compact(['students']));
    }

    public function lecturers(){
        $lecturers = Lecturer::all();
        return view('dashboards.super_admin.lecturers',compact(['lecturers']));
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
        $request->request->add(['user_id'=>$user->id]);
        $lecturer = Lecturer::create($request->all());
        return redirect('/super_admin/dashboard/lecturers')->with('created','Add New Student Success !!');
    }

    public function update(Request $request){
        $user = User::find(auth()->user()->id);
        $modname = ucwords(strtolower(trim($request->name)));
        $request->merge(['name'=>$modname]);
        $user->phone = $request->phone;
        $user->name = $request->name;
        if($request->password!=NULL){
            $user->password = bcrypt($request->password);
        }
        $user->save();
        return redirect('/super_admin/dashboard/profile')->with('updated','success');
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
            'Dalam tahap bimbingan',
            'Selesai'
        ];
        return view('dashboards.super_admin.request-supervisor',compact(['students','status','tooltip']));
    }

    public function acceptRequest(Student $student, $id_lecturer){
        $student->lecturers()->updateExistingPivot($id_lecturer, ['progress' => 2]);
        return redirect('/super_admin/dashboard/request')->with('accepted','Success');
    }

    public function rejectRequest(Student $student, $id_lecturer){
        $student->lecturers()->detach($id_lecturer);
        return redirect('/super_admin/dashboard/request')->with('rejected','fail');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use App\Student;
use App\User;
use App\Support;

class SiteController extends Controller
{
    public function landing(){
        return view('landing.index');
    }

    public function register(){
        return view('auth.register');
    }
    
    public function postregister(Request $request){
        $modemail = strtolower(trim($request->email));
        $modfirst_name = ucwords(strtolower(trim($request->first_name)));
        $modlast_name = ucwords(strtolower(trim($request->last_name)));
        $request->merge([
            'email' => $modemail,
            'first_name' => $modfirst_name,
            'last_name' => $modlast_name,
        ]);
        $this->validate($request,[
            'npm' => 'required|numeric|digits:12|unique:students',
            'first_name' => 'required|min:3',
            'gpa' => 'required|numeric|min:1|max:4',
            'phone' => 'required|numeric|digits_between:10,12',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);
        $user = new User;
        $user->role = 'Student';
        $user->name = $request->first_name.' '.$request->last_name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->remember_token = Str::random(60);
        $user->save();
        $request->request->add(['user_id'=>$user->id]);
        $buffer = substr($request->npm,6,2);
        $buffer = '20'.$buffer;
        $request->request->add(['angkatan'=>$buffer]);
        $student = Student::create($request->all());
        return redirect('/login')->with('berhasil','Register Success !!');
    }

    public function check(){
        if(auth()->user()->role=='Super Admin'){
            return redirect('/super_admin/dashboard/data_overview');
        }
        else if(auth()->user()->role=='Student'){
            return redirect('/student/dashboard/student_profile');
        }
        else if(auth()->user()->role=='Admin'){
            return redirect('/admin/dashboard/admin_profile');
        }
        else if(auth()->user()->role=='Lecturer'){
            return redirect('/lecturer/dashboard/lecturer_profile');
        }
    }

    public function support(Request $request){
        $this->validate($request,[
            'first_name' => 'required|min:3',
            'phone' => 'required|numeric|digits_between:10,12',
            'email' => 'required|email',
            'message' => 'required',
        ]);
        $modfirst_name = ucwords(strtolower(trim($request->first_name)));
        $modlast_name = ucwords(strtolower(trim($request->last_name)));
        $name = $modfirst_name.' '.$modlast_name;
        $modemail = strtolower(trim($request->email));
        $request->request->add(['name' => $name]);
        $request->merge(['email' => $modemail]);
        $support = Support::create($request->all());
        return redirect('/')->with('sent','success');
    }
}

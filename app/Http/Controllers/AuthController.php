<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }
    public function postlogin(Request $request){
        if(Auth::attempt($request->only('email','password'))){
            if(auth()->user()->role == 'Super Admin'){
                return redirect('/super_admin/dashboard/data_overview');
            }
            else if(auth()->user()->role == 'Student'){
                return redirect('/student/dashboard/student_profile');
            }
            else if(auth()->user()->role == 'Admin'){
                return redirect('/admin/dashboard/admin_profile');
            }
            else if(auth()->user()->role == 'Lecturer'){
                return redirect('/lecturer/dashboard/lecturer_profile');
            }
        }
        else{
            return redirect('/login')->with('gagal','Login Failed !!');
        }
    }
    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}

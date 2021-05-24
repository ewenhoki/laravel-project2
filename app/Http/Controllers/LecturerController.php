<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\lecturer;
use App\User;

class LecturerController extends Controller
{
    public function profile(){
        $lecturer = Lecturer::where('user_id','=',auth()->user()->id)->first();
        return view('dashboards.lecturer.profile',compact(['lecturer']));
    }

    public function destroy(Lecturer $lecturer){
        $lecturer->user->delete();
        $lecturer->delete();
        return redirect('/super_admin/dashboard/lecturers')->with('success','Delete Success');
    }
}

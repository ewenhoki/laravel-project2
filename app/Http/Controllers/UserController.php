<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Student;
use App\User;

class UserController extends Controller
{
    public function destroy(User $user){
        // $user = User::find($id);
        if($user->role=='Lecturer'){
            $user->lecturer->delete();
        }
        else if($user->role=='Student'){
            $user->student->delete();
        }
        $user->delete();
        return redirect('/super_admin/dashboard/data_overview')->with('success','Delete Success');
    }
    public function verif(User $user){
        // $user = User::find($id);
        $user->email_verified_at = Carbon::now()->toDateTimeString();
        $user->save();
        return redirect('/super_admin/dashboard/data_overview');
    }
}

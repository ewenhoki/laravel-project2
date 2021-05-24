<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AdminController extends Controller
{
    public function profile(){
        $admin = User::find(auth()->user()->id);
        return view('dashboards.admin.profile',compact(['admin']));
    }
}

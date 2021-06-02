<?php

use Illuminate\Support\Facades\URL;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

if (App::environment('production')) {
    URL::forceScheme('https');
}

// Route::get('/', function () {
//     return redirect('/login');
// });
Route::get('/', 'SiteController@landing');

Auth::routes(['verify' => true]);

Route::get('/register', 'SiteController@register');

Route::post('/postregister', 'SiteController@postregister');
Route::get('/login', 'AuthController@login')->name('login');
Route::post('/postlogin', 'AuthController@postlogin');
Route::get('/dashboard', 'SiteController@check');
Route::get('/logout', 'AuthController@logout');

Route::group(['middleware' => ['auth','verified','checkrole:Super Admin']], function(){
    Route::get('/super_admin/dashboard/data_overview', 'SuperAdminController@index');
    Route::get('/users/verifbyadmin/{user}', 'UserController@verif');
    Route::get('/users/delete/{user}', 'UserController@destroy');
    Route::get('/students/delete/{student}', 'StudentController@destroy');
    Route::get('/lecturers/delete/{lecturer}', 'LecturerController@destroy');
    Route::get('/users/add', 'SuperAdminController@addAdmin');
    Route::get('/studentuser/add', 'SuperAdminController@addStudent');
    Route::get('/lectureruser/add', 'SuperAdminController@addLecturer');
    Route::post('/postregisteradmin', 'SuperAdminController@postregisteradmin');
    Route::post('/postregisterstudent', 'SuperAdminController@postregisterstudent');
    Route::post('/postregisterlecturer', 'SuperAdminController@postregisterlecturer');
    Route::get('/super_admin/dashboard/students', 'SuperAdminController@students');
    Route::get('/super_admin/dashboard/lecturers', 'SuperAdminController@lecturers');
    Route::get('/super_admin/dashboard/profile', 'SuperAdminController@profile');
    Route::post('/postadminprofile', 'SuperAdminController@update');
    Route::get('/super_admin/dashboard/request', 'SuperAdminController@requestSupervisor');
    Route::get('/request/accept/{student}/{id_lecturer}', 'SuperAdminController@acceptRequest');
    Route::get('/request/reject/{student}/{id_lecturer}', 'SuperAdminController@rejectRequest');
});

Route::group(['middleware' => ['auth','verified','checkrole:Admin']], function(){
    Route::get('/admin/dashboard/admin_profile', 'AdminController@profile');
    Route::post('/postadminliteprofile', 'AdminController@update');
    Route::get('/admin/dashboard/request', 'AdminController@requestSupervisor');
    Route::get('/request/upload/{student}', 'AdminController@upload');
    Route::post('/postuploadletter1/{student}', 'AdminController@postUpload1');
    Route::post('/postuploadletter2/{student}', 'AdminController@postUpload2');
});

Route::group(['middleware' => ['auth','verified','checkrole:Student']], function(){
    Route::get('/student/dashboard/student_profile', 'StudentController@profile');
    Route::post('/poststudentprofile', 'StudentController@update');
    Route::get('/student/dashboard/proposal_submission', 'StudentController@addProposal');
    Route::post('/proposal/create', 'StudentController@createProposal');
    Route::post('/proposal/update/{file}', 'StudentController@updateProposal');
    Route::get('/add/supervisor', 'StudentController@addSupervisor');
    Route::post('/postsupervisor/1', 'StudentController@postSupervisor1');
    Route::post('/postsupervisor/2', 'StudentController@postSupervisor2');
    Route::get('/request/cancel/{student}/{lecturer_id}', 'StudentController@cancelSupervisor');
});

Route::group(['middleware' => ['auth','verified','checkrole:Lecturer']], function(){
    Route::get('/lecturer/dashboard/lecturer_profile', 'LecturerController@profile');
    Route::post('/postlecturerprofile', 'LecturerController@update');
    Route::get('/lecturer/dashboard/student_request', 'LecturerController@studentRequest');
    Route::get('/request/accept_by_lecturer/{student}', 'LecturerController@studentAccept');
    Route::get('/request/reject_by_lecturer/{student}', 'LecturerController@studentReject');
});

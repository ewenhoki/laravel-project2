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
Route::post('/support', 'SiteController@support');

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
    Route::get('/super_admin/dashboard/documents', 'SuperAdminController@documents');
    Route::get('/documents/reject/{file}', 'SuperAdminController@destroyDocuments');
    Route::post('/slot/update', 'SuperAdminController@slotUpdate');
    Route::get('/super_admin/dashboard/seminar', 'SuperAdminController@seminar');
    Route::get('/seminar/info/{seminar}', 'SuperAdminController@seminarInfo');
    Route::get('/seminar/accept/{seminar}', 'SuperAdminController@acceptSeminar');
    Route::get('/seminar/reject/{seminar}', 'SuperAdminController@rejectSeminar');
    Route::post('/seminar/edit_time', 'SuperAdminController@editSeminar');
    Route::get('/postuploadletter1/{student}', 'SuperAdminController@postUpload1');
    Route::get('/super_admin/letter_1/export/{student}', 'SuperAdminController@exportLetter1');
    Route::get('/super_admin/dashboard/support', 'SuperAdminController@support');
    Route::get('/support/delete/{support}', 'SuperAdminController@destroySupport');
});

Route::group(['middleware' => ['auth','verified','checkrole:Super Admin,Admin']], function(){
    Route::get('/request/upload/{student}', 'AdminController@upload');
    // Route::post('/postuploadletter1/{student}', 'SuperAdminController@postUpload1');
    Route::post('/postuploadletter2/{student}', 'AdminController@postUpload2');
});

Route::group(['middleware' => ['auth','verified','checkrole:Admin']], function(){
    Route::get('/admin/dashboard/admin_profile', 'AdminController@profile');
    Route::post('/postadminliteprofile', 'AdminController@update');
    Route::get('/admin/dashboard/request', 'AdminController@requestSupervisor');
    Route::get('/admin/letter_1/export/{student}', 'SuperAdminController@exportLetter1');
    // Route::get('/request/upload/{student}', 'AdminController@upload');
    // Route::post('/postuploadletter1/{student}', 'AdminController@postUpload1');
    // Route::post('/postuploadletter2/{student}', 'AdminController@postUpload2');
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
    Route::get('/student/dashboard/attendance', 'StudentController@attendance');
    Route::post('/student/new_attendance', 'StudentController@newAttendance');
    Route::get('/student/attend/{attendance}', 'StudentController@attend');
    Route::post('/student/edit_attendance', 'StudentController@editAttendance');
    Route::get('/student/delete_attendance/{attendance}', 'StudentController@destroyAttendance');
    Route::get('/student/attendance/export1', 'StudentController@exportPdf1');
    Route::get('/student/attendance/export2', 'StudentController@exportPdf2');
    Route::get('/student/dashboard/seminar', 'StudentController@seminar');
    Route::post('/student/addSeminar', 'StudentController@addSeminar');
    Route::post('/seminar/document/upload', 'StudentController@addDocument');
    Route::get('/seminar/document/delete/{seminarfile}', 'StudentController@destroyDocument');
    Route::get('/student/letter_1/export', 'StudentController@exportLetter1');
});

Route::group(['middleware' => ['auth','verified','checkrole:Lecturer']], function(){
    Route::get('/lecturer/dashboard/lecturer_profile', 'LecturerController@profile');
    Route::post('/postlecturerprofile', 'LecturerController@update');
    Route::get('/lecturer/dashboard/student_request', 'LecturerController@studentRequest');
    Route::get('/request/accept_by_lecturer/{student}', 'LecturerController@studentAccept');
    Route::get('/request/reject_by_lecturer/{student}', 'LecturerController@studentReject');
    Route::get('/lecturer/dashboard/attendance', 'LecturerController@attendance');
    Route::get('/lecturer/student_attendance/{student}', 'LecturerController@studentAttendance');
    Route::post('/lecturer/new_attendance', 'LecturerController@newAttendance');
    Route::get('/lecturer/attend/{attendance}', 'LecturerController@attend');
    Route::post('/lecturer/edit_attendance', 'LecturerController@editAttendance');
    Route::get('/lecturer/delete_attendance/{attendance}', 'LecturerController@destroyAttendance');
    Route::get('/lecturer/dashboard/seminar', 'LecturerController@seminar');
    Route::get('/seminar/detail/{seminar}', 'LecturerController@seminarInfo');
    Route::get('/lecturer/letter_1/export/{student}', 'SuperAdminController@exportLetter1');
});

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Student;
use App\User;
use App\Lecturer;

class UserController extends Controller
{
    public function destroy(User $user){
        // $user = User::find($id);
        if($user->role=='Lecturer'){
            $students = $user->lecturer->students()->get();
            foreach($students as $student){
                $student->file->update(['letter_2'=>NULL]);
                if($student->seminar){
                    if($student->seminar->seminarfiles()->first()){
                        $student->seminar->seminarfiles()->delete();
                    }
                    $student->seminar->delete();
                }
                if($student->colloquium){
                    if($student->colloquium->colloquiumfiles()->first()){
                        $student->colloquium->colloquiumfiles()->delete();
                    }
                    if($student->colloquium->colloquiumlecturers()->first()){
                        $student->colloquium->colloquiumlecturers()->delete();
                    }
                    $student->colloquium->delete();
                }
            }
            $user->lecturer->students()->detach();
            $user->lecturer->attendances()->delete();
            if($user->lecturer->colloquiumlecturers()->first()){
                $user->lecturer->colloquiumlecturers()->delete();
            }
            $user->lecturer->delete();
        }
        else if($user->role=='Student'){
            if($user->student->file!=NULL){
                $user->student->file->delete();
            }
            if($user->student->lecturers()->wherePivot('order',1)->first()){
                if($user->student->lecturers()->wherePivot('order',1)->first()->pivot->progress >= 2 && $user->student->lecturers()->wherePivot('order',1)->first()->pivot->progress < 4){
                    $lecturer = Lecturer::find($user->student->lecturers()->wherePivot('order',1)->first()->id);
                    $lecturer->slot++;
                    $lecturer->save();
                }
            }
            if($user->student->seminar){
                if($user->student->seminar->seminarfiles()){
                    $user->student->seminar->seminarfiles()->delete();
                }
                $user->student->seminar->delete();
            }
            if($user->student->colloquium){
                if($user->student->colloquium->colloquiumfiles()->first()){
                    $user->student->colloquium->colloquiumfiles()->delete();
                }
                if($user->student->colloquium->colloquiumlecturers()->first()){
                    $user->student->colloquium->colloquiumlecturers()->delete();
                }
                $user->student->colloquium->delete();
            }
            $user->student->lecturers()->detach();
            $user->student->attendances()->delete();
            $user->student->delete();
        }
        $user->delete();
        return redirect('/super_admin/dashboard/data_overview')->with('success','Delete Success');
    }
    public function verif(User $user){
        // $user = User::find($id);
        $user->email_verified_at = Carbon::now()->toDateTimeString();
        $user->save();
        return redirect('/super_admin/dashboard/data_overview')->with('verif','Success');
    }
}

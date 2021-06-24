<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\lecturer;
use App\Student;
use App\User;
use App\Seminar;
use App\Attendance;

class LecturerController extends Controller
{
    public function profile(){
        $lecturer = Lecturer::where('user_id','=',auth()->user()->id)->first();
        return view('dashboards.lecturer.profile',compact(['lecturer']));
    }

    public function destroy(Lecturer $lecturer){
        $lecturer->user->delete();
        $lecturer->students()->detach();
        $lecturer->attendances()->delete();
        $lecturer->delete();
        return redirect('/super_admin/dashboard/lecturers')->with('success','Delete Success');
    }

    public function update(Request $request){
        $user = User::find(auth()->user()->id);
        $modfirst_name = ucwords(strtolower(trim($request->first_name)));
        $modlast_name = ucwords(strtolower(trim($request->last_name)));
        if (Hash::check($request->password_old, $user->password)) {
            $request->merge([
                'first_name' => $modfirst_name,
                'last_name' => $modlast_name,
            ]);
            $user->lecturer->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
            ]);
            $user->name = $request->first_name.' '.$request->last_name;
            $user->phone = $request->phone;
            if($request->password!=NULL){
                $user->password = bcrypt($request->password);
            }
            $user->avatar = $request->avatar;
            $user->save();
        }
        else{
            return back()->with('fail','wrong passsword');
        }
        return redirect('/lecturer/dashboard/lecturer_profile')->with('updated','success');
    }

    public function studentRequest(){
        $students = auth()->user()->lecturer->students()->orderBy('lecturer_student.progress','ASC')->get();
        $tooltip = [
            'red',
            'blue',
            'cyan',
            'green',
        ];
        $status = [
            'Menunggu Persetujuan Dosen',
            'Menunggu Surat Tugas dari TU',
            'Dalam tahap bimbingan',
            'Selesai'
        ];
        return view('dashboards.lecturer.student-request',compact(['students','status','tooltip']));
    }

    public function studentAccept(Student $student){
        $student->lecturers()->updateExistingPivot(auth()->user()->lecturer->id, ['progress' => 2]);
        return redirect('/lecturer/dashboard/student_request')->with('accepted','Success');
    }

    public function studentReject(Student $student){
        if(auth()->user()->lecturer->students()->where('students.id',$student->id)->first()->pivot->order==1){
            $lecturer = Lecturer::find(auth()->user()->lecturer->id);
            $lecturer->slot++;
            $lecturer->save();
            if($student->lecturers()->wherePivot('order',2)->first()){
                if($student->lecturers()->wherePivot('order',2)->first()->pivot->progress>2){
                    $student->lecturers()->updateExistingPivot($student->lecturers()->wherePivot('order',2)->first()->id, ['progress' => 2]);
                }
            }
        }
        if(auth()->user()->lecturer->students()->where('students.id',$student->id)->first()->pivot->order==2){
            if($student->lecturers()->wherePivot('order',1)->first()){
                if($student->lecturers()->wherePivot('order',1)->first()->pivot->progress>2){
                    $student->lecturers()->updateExistingPivot($student->lecturers()->wherePivot('order',1)->first()->id, ['progress' => 2]);
                }
            }
        }
        if($student->file->letter_2){
            $student->file->update([
                'letter_2'=>NULL,
                'letter_2_date'=>NULL
            ]);
        }
        auth()->user()->lecturer->students()->detach($student->id);
        return redirect('/lecturer/dashboard/student_request')->with('rejected','fail');
    }

    public function attendance(){
        $students = auth()->user()->lecturer->students()->wherePivot('progress',3)->get();
        return view('dashboards.lecturer.attendance',compact(['students']));
    }

    public function studentAttendance(Student $student){
        $attendance = Attendance::where('lecturer_id',auth()->user()->lecturer->id)->where('student_id',$student->id)->orderBy('date_time','ASC')->get();
        return view('dashboards.lecturer.attendance_detail',compact(['attendance','student']));
    }

    public function newAttendance(Request $request){
        $modtime = $request->date_time.':00';
        $request->merge(['date_time' => $modtime]);
        $request->request->add([
            'lecturer_id'=>auth()->user()->lecturer->id,
            'confirm_lecturer'=>1,
            'confirm_student'=>0,
        ]);
        $attendance = Attendance::create($request->all());
        return redirect('/lecturer/student_attendance/'.$request->student_id)->with('created','success');
    }

    public function attend(Attendance $attendance){
        $attendance->confirm_lecturer = 1;
        $attendance->save();
        return redirect('/lecturer/student_attendance/'.$attendance->student->id)->with('attend','success');
    }

    public function editAttendance(Request $request){
        $attendance = Attendance::find($request->id);
        $modtime = $request->date_time.':00';
        $request->merge(['date_time' => $modtime]);
        $attendance->update($request->all());
        return redirect('/lecturer/student_attendance/'.$attendance->student->id)->with('updated','success');
    }

    public function destroyAttendance(Attendance $attendance){
        $attendance->delete();
        return redirect('/lecturer/student_attendance/'.$attendance->student->id)->with('deleted','success');
    }

    public function seminar(){
        $students = auth()->user()->lecturer->students()->wherePivot('progress','>=',3)->get();
        return view('dashboards.lecturer.seminar',compact(['students']));
    }

    public function seminarInfo(Seminar $seminar){
        return view('dashboards.lecturer.seminar-info',compact(['seminar']));
    }
}

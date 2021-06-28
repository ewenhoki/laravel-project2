<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\lecturer;
use App\Student;
use App\User;
use App\Seminar;
use App\Attendance;
use App\Colloquium;
use App\Colloquiumlecturer;

class LecturerController extends Controller
{
    public function profile(){
        $lecturer = Lecturer::where('user_id','=',auth()->user()->id)->first();
        return view('dashboards.lecturer.profile',compact(['lecturer']));
    }

    public function destroy(Lecturer $lecturer){
        $students = $lecturer->students()->get();
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
        if($student->lecturers()->where('lecturer_id',auth()->user()->lecturer->id)->first()->pivot->order == 1){
            // $lecturer = Lecturer::find(auth()->user()->lecturer->id);
            // $lecturer->slot--;
            // $lecturer->save();
            auth()->user()->lecturer->slot--;
            auth()->user()->lecturer->save();
            $student->lecturers()->updateExistingPivot(auth()->user()->lecturer->id, ['progress' => 2]);
            if(auth()->user()->lecturer->slot == 0){
                auth()->user()->lecturer->students()->wherePivot('progress','<',2)->wherePivot('order',1)->detach();
            }
        }
        else{
            $student->lecturers()->updateExistingPivot(auth()->user()->lecturer->id, ['progress' => 2]);
        }
        return redirect('/lecturer/dashboard/student_request')->with('accepted','Success');
    }

    public function studentReject(Student $student){
        if(auth()->user()->lecturer->students()->where('students.id',$student->id)->first()->pivot->order==1){
            if(auth()->user()->lecturer->students()->where('students.id',$student->id)->first()->pivot->progress >= 2 && auth()->user()->lecturer->students()->where('students.id',$student->id)->first()->pivot->progress < 4){
                $lecturer = Lecturer::find(auth()->user()->lecturer->id);
                $lecturer->slot++;
                $lecturer->save();
            }
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
        if($student->attendances()->where('lecturer_id',auth()->user()->lecturer->id)){
            $student->attendances()->where('lecturer_id',auth()->user()->lecturer->id)->delete();
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

    public function colloquium(){
        $colloquiumlecturers = auth()->user()->lecturer->colloquiumlecturers()->get();
        return view('dashboards.lecturer.colloquium',compact(['colloquiumlecturers']));
    }

    public function colloquiumInfo(Colloquium $colloquium){
        return view('dashboards.lecturer.colloquium-info',compact(['colloquium']));
    }

    public function acceptColloquium(Colloquium $colloquium){
        $colloquiumlecturer = Colloquiumlecturer::where('colloquium_id',$colloquium->id)->where('lecturer_id',auth()->user()->lecturer->id)->first();
        $colloquiumlecturer->confirm = 1;
        $colloquiumlecturer->save();
        return redirect('/colloquium/detail/'.$colloquium->id)->with('accepted','success');
    }

    public function rejectColloquium(Colloquium $colloquium){
        auth()->user()->lecturer->colloquiumlecturers()->where('colloquium_id',$colloquium->id)->first()->delete();
        return redirect('/lecturer/dashboard/colloquium')->with('deleted','success');
    }

    public function finish(Request $request){
        if(strtolower(trim($request->confirm)) == 'dengan ini saya menyatakan bahwa mahasiswa terkait telah menyelesaikan masa bimbingannya.'){
            $student = Student::find($request->id);
            $student->lecturers()->updateExistingPivot(auth()->user()->lecturer->id, ['progress' => 4]);
            if(auth()->user()->lecturer->students()->where('student_id',$student->id)->first()->pivot->order == 1){
                auth()->user()->lecturer->slot++;
                auth()->user()->lecturer->save();
            }
            return redirect('/lecturer/dashboard/student_request')->with('finished','success');
        }
        else{
            return back()->with('wrong','fail');
        }
    }
}

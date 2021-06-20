<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = ['lecturer_id','student_id','title','description','confirm_lecturer','confirm_student','date_time'];

    public function lecturer(){
        return $this->belongsTo(Lecturer::class);
    }

    public function student(){
        return $this->belongsTo(Student::class);
    }
}

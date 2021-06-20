<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['npm','user_id','first_name','last_name','gpa','angkatan'];
    
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function file(){
        return $this->hasOne(File::class);
    }

    public function lecturers(){
        return $this->belongsToMany(Lecturer::class)->withPivot(['progress','order'])->withTimestamps();
    }

    public function attendances(){
        return $this->hasMany(Attendance::class);
    }
}

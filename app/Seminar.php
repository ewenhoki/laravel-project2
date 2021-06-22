<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seminar extends Model
{
    protected $fillable = ['student_id','confirm','note','date_time'];

    public function student(){
        return $this->belongsTo(Student::class);
    }

    public function seminarfiles(){
        return $this->hasMany(Seminarfile::class);
    }
}

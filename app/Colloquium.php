<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Colloquium extends Model
{
    protected $table = 'colloquiums';
    protected $fillable = ['student_id','confirm','note','date_time'];

    public function student(){
        return $this->belongsTo(Student::class);
    }

    public function colloquiumfiles(){
        return $this->hasMany(Colloquiumfile::class);
    }

    public function colloquiumlecturers(){
        return $this->hasMany(Colloquiumlecturer::class);
    }
}

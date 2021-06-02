<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = ['student_id','title','krs','kss','proposal','paper','letter_1','letter_2','upload_date','letter_1_date','letter_2_date'];

    public function student(){
        return $this->belongsTo(Student::class);
    }
}

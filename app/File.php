<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = ['student_id','title','krs','kss','proposal','paper','letter','upload_date','letter_date'];

    public function student(){
        return $this->belongsTo(Student::class);
    }
}

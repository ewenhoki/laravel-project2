<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Colloquiumlecturer extends Model
{
    protected $fillable = ['colloquium_id','lecturer_id','confirm'];

    public function colloquium(){
        return $this->belongsTo(Colloquium::class);
    }

    public function lecturer(){
        return $this->belongsTo(Lecturer::class);
    }
}

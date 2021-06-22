<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seminarfile extends Model
{
    protected $fillable = ['seminar_id','file'];

    public function seminar(){
        return $this->belongsTo(Seminar::class);
    }
}

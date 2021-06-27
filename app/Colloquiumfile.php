<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Colloquiumfile extends Model
{
    protected $fillable = ['colloquium_id','file'];

    public function colloquium(){
        return $this->belongsTo(Colloquium::class);
    }
}

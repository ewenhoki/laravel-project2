<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class lecturer extends Model
{
    protected $fillable = ['nip','user_id','first_name','last_name','slot'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function students(){
        return $this->belongsToMany(Student::class)->withPivot(['progress','order'])->withTimestamps();
    }

    public function attendances(){
        return $this->hasMany(Attendance::class);
    }
}

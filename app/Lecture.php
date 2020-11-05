<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    protected $fillable = ['name'];




    public function batches(){
    	return $this->belongsToMany('App\Batch');
    }

    public function subjects(){
    	return $this->belongsToMany('App\Subject');
    }

    public function attendances(){
    	return $this->belongsToMany('App\Attendance');
    }
}

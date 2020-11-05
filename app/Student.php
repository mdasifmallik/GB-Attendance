<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['name','roll'];



    public function batch(){
    	return $this->belongsToMany('App\Batch');
    }

    public function attendances(){
        return $this->belongsToMany('App\Attendance');
    }
}

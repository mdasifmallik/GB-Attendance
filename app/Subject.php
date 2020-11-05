<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
	protected $fillable = ['name'];


    public function department(){
    	return $this->belongsToMany('App\Department');
    }

    public function users(){
    	return $this->belongsToMany('App\User');
    }

    public function semesters(){
    	return $this->belongsToMany('App\Semester');
    }

		public function attendances(){
        return $this->belongsToMany('App\Attendance');
    }

		public function lectures(){
        return $this->belongsToMany('App\Lecture');
    }
}

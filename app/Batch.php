<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
	protected $fillable = ['name'];


    public function department(){
    	return $this->belongsToMany('App\Department');
    }

    public function students(){
    	return $this->belongsToMany('App\Student');
    }

    public function semester(){
        return $this->belongsToMany('App\Semester');
    }

		public function lectures(){
        return $this->belongsToMany('App\Lecture');
    }
}

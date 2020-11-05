<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    public function batches(){
        return $this->belongsToMany('App\Batch');
    }

    public function subjects(){
    	return $this->belongsToMany('App\Subject');
    }
}

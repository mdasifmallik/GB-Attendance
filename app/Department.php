<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Role;

class Department extends Model
{
    protected $fillable = ['name'];




    public function users(){
    	return $this->belongsToMany('App\User');
    }

    public function subjects(){
    	return $this->belongsToMany('App\Subject');
    }

    public function batches(){
        return $this->belongsToMany('App\Batch');
    }
    
}

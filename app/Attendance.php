<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
  protected $fillable = ['attendance'];



  public function students(){
      return $this->belongsToMany('App\Student');
  }

  public function subjects(){
      return $this->belongsToMany('App\Subject');
  }

  public function lectures(){
      return $this->belongsToMany('App\Lecture');
  }
}

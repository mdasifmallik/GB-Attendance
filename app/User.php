<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    public function roles(){
        return $this->belongsToMany('App\Role');
    }

    public function departments(){
        return $this->belongsToMany('App\Department');
    }

    public function subjects(){
        return $this->belongsToMany('App\Subject');
    }



    public function ismasteradmin(){
        $roles= $this->roles;

        foreach ($roles as $role) {
            $array= $role;
            $name= $role->role;
        }

        if (empty($array)) {
            return false;
        }

        if ($name=='master-admin') {
            return true;
        }
        return false;
    }

    public function isadmin(){
        $roles= $this->roles;

        foreach ($roles as $role) {
            $array= $role;
            $name= $role->role;
        }

        if (empty($array)) {
            return false;
        }

        if ($name=='admin' || $name=='master-admin') {
            return true;
        }
        return false;
    }

    public function islecturer(){
        $roles= $this->roles;

        foreach ($roles as $role) {
            $array= $role;
            $name= $role->role;
        }

        if (empty($array)) {
            return false;
        }

        if ($name=='admin' || $name=='master-admin') {
            return false;
        }
        return true;
    }


}

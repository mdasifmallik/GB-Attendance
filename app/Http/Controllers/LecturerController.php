<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
use App\User;
use App\Role;

class LecturerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isadmin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments= Auth::user()->departments;
        $dep= null;
        foreach ($departments as $department) {
            $dep= $department;
        }


        return view('adminpanel.lecturer.lecturers',compact('dep'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adminpanel.lecturer.add_new_lecturer');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:users|max:255',
        ]);


        $pass= Hash::make('12345678');
        $role= Role::findOrFail(3);
        $user= new User;
        $user->name= $request->name;
        $user->email= $request->email;
        $user->password= $pass;
        $role->users()->save($user);
        $dep= Auth::user()->departments;
        foreach ($dep as $d) {
            $d->users()->attach($user->id);
        }

        $users= $role->users;
        return redirect('/lecturer');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user= User::findOrFail($id);
        echo "<a href=\"lecturer/".$user->id."/edit\">Yes</a>";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user= User::findOrFail($id);
        $user->roles()->detach();
        $user->departments()->detach();
        $user->delete();

        return redirect('/lecturer');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Mail;
use Hash;
use App\User;
use App\Role;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('ismasteradmin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles= Role::where('role','admin')->orderBy('id','desc')->take(1)->get();

        foreach ($roles as $role) {
            $users= $role->users;
        }

        return view('adminpanel.admin.admins',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adminpanel.admin.add_new_admin');
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

        $role= Role::findOrFail(2);

        $num=12345678;
        
        // $num= rand(10000,99999);
        // $name= $request->name;
        // $email= $request->email;
        // $data= [
        //     'user_name'=>$request->name,
        //     'user_pass'=>$num,
        //     'user_role'=>$role->role
        // ];
        // Mail::send('email_templates.add_user', $data, function ($message) use($name,$email) {
        //     $message->to($email, $name)->subject('Login to GB Attendance');
        // });


        $pass= Hash::make($num);
        $user= new User;
        $user->name= $request->name;
        $user->email= $request->email;
        $user->password= $pass;
        $role->users()->save($user);

        $users= $role->users;
        return view('adminpanel.admin.admins',compact('users'));
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
        echo "<a href=\"admin/".$user->id."/edit\">Yes</a>";
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

        return redirect('/admin');
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

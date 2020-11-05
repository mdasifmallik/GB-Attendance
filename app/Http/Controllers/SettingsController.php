<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Rules\CheckPassword;
use Hash;
use Redirect;

class SettingsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user= Auth::user();
        return view('adminpanel.settings.settings',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
          'old_pass' => ['required', new CheckPassword],
          'new_pass' => ['required', 'min:5'],
          're_pass' => ['required', 'min:5']
        ]);

        $user= Auth::user();
        $n_pass= $request->new_pass;
        $r_pass= $request->re_pass;

        if ($n_pass==$r_pass) {
            $user->password = Hash::make($r_pass);
            $user->save();
            return Redirect::back()->with('msg', 'Password changed Successfully!!');
        }else{
            return Redirect::back()->with('msg2', 'Password hasn\'t matched!!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $user= User::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:users,email,'.$user->id,
        ]);

        $user->name= $request->name;
        $user->email= $request->email;
        $user->save();

        return back();
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

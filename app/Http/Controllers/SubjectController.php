<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Department;
use App\Subject;
use App\Semester;
use App\User;

class SubjectController extends Controller
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

        return view('adminpanel.subject.subjects', compact('dep'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $semesters= Semester::all();
        $dep= Auth::user()->departments;
        $users= array();
        foreach ($dep as $d) {
            $users= $d->users;
        }
        return view('adminpanel.subject.add_new_subject',compact('semesters','users'));
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
            'name' => 'required|max:255'
        ]);

        $dep= Auth::user()->departments;
        foreach ($dep as $d) {
            $department= $d;
        }

        $subject= new Subject;
        $subject->name= $request->name;
        $department->subjects()->save($subject);

        $subject->semesters()->attach($request->semester);
        $subject->users()->attach($request->lecturer);

        return redirect('/subject');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $i=1;
        $a_sem=null;
        $a2_sem=null;
        $a_lec= null;
        $subject= Subject::findOrFail($id);
        foreach ($subject->semesters as $semester) {
            if ($i==1) {
                $a_sem= $semester->id;
            }else{
                $a2_sem= $semester->id;
            }
            $i++;
        }
        foreach ($subject->users as $user) {
            $a_lec= $user->id;
        }
        $semesters= Semester::all();
        $dep= Auth::user()->departments;
        foreach ($dep as $d) {
            $users= $d->users;
        }
        return view('adminpanel.subject.edit_subject',compact('subject','semesters','users','a_sem','a2_sem','a_lec'));
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
        $validatedData = $request->validate([
            'name' => 'required|max:255'
        ]);

        $subject= Subject::findOrFail($id);
        $subject->name=$request->name;
        $subject->save();

        $subject->semesters()->detach();
        $subject->users()->detach();
        $subject->semesters()->attach($request->semester);
        $subject->semesters()->attach($request->semester2);
        $subject->users()->attach($request->lecturer);

        return redirect('/subject');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subject= Subject::findOrFail($id);
        $subject->semesters()->detach();
        $subject->users()->detach();
        $subject->department()->detach();
        $subject->delete();

        return redirect('/subject');
    }
}

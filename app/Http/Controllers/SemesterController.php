<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Semester;
use App\Department;

class SemesterController extends Controller
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
        $semesters= Semester::all();
        $departments= Auth::user()->departments;
        $dep= null;
        foreach ($departments as $department) {
            $dep= $department;
        }

        return view('adminpanel.semester.semesters',compact('semesters','dep'));
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
        $i=1;
        $dep= Auth::user()->departments;
        foreach ($dep as $d) {
            $department= $d;
        }
        $semesters= Semester::all();
        foreach ($semesters as $semester) {
            $batch_id= "sem".$i;
            foreach ($semester->batches as $batch) {
                foreach ($batch->department as $bdep) {
                    if ($bdep->name==$department->name) {
                        $semester->batches()->detach($batch->id);
                    }
                }
            }
            $semester->batches()->attach($request->$batch_id);
            $i++;
        }

        return redirect('/semester');
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

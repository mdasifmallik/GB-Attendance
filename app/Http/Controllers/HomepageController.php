<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use App\Subject;
use App\Semester;

class HomepageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments= Department::all();
        $semesters= Semester::all();
        return view('index',compact('departments','semesters'));
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
            'department' => 'required',
            'subject' => 'required',
            'semester' => 'required'
        ]);


        $department= Department::findOrFail($request->department);
        $subject= Subject::findOrFail($request->subject);
        $semester= Semester::findOrFail($request->semester);

        $batch= null;
        foreach ($semester->batches as $batches) {
            foreach ($batches->department as $dep) {
                if ($dep->id == $department->id) {
                    $batch= $batches;
                }
            }
        }

        return view('attendancesheet',compact('department','subject','batch'));
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


    public function ajax_select($id)
    {
        $department= Department::findOrFail($id);

        echo "<label>Subject: </label>";
        echo "<select name=\"subject\" id=\"mySem\" onchange=\"ajax_sem()\">";
        echo "<option value=\"\">Choose Subject</option>";
        foreach ($department->subjects as $subject) {
            echo "<option value=\"".$subject->id."\">".$subject->name."</option>";
        }
        echo "</select>";
    }


    public function ajax_sem($id)
    {
        $subject= Subject::findOrFail($id);

        echo "<label>Semester: </label>";
        echo "<select name=\"semester\">";
        foreach ($subject->semesters as $semester) {
            echo "<option value=\"".$semester->id."\">".$semester->name."</option>";
        }
        echo "</select>";
    }


    public function attendance_info(Request $request)
    {
        $request->validate([
            'department' => 'required',
            'semester' => 'required',
            'roll' => 'required | max: 10'
        ]);

        $department= Department::findOrFail($request->department);
        $semester= Semester::findOrFail($request->semester);
        $roll= $request->roll;

        $batch= null;
        $student= null;
        foreach ($semester->batches as $ba) {
            foreach ($ba->department as $dep) {
                if ($department->id == $dep->id) {
                    $batch= $ba;
                    foreach ($ba->students as $stu) {
                        if ($stu->roll == $roll) {
                            $student = $stu;
                        }
                    }
                }
            }
        }

        return view('attendanceinfo',compact('department','batch','student'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Department;
use App\Batch;
use App\Student;

class BatchController extends Controller
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

        return view('adminpanel.batch.batch',compact('dep'));
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
        $batch= new Batch;
        $batch->name= $request->batch_name;
        $dep= Auth::user()->departments;
        foreach ($dep as $d) {
            $d->batches()->save($batch);
        }

        $num_of_students= (count($request->all())/2)-1;
        for ($i=1; $i <= $num_of_students ; $i++) {
            $name= "name".$i;
            $roll= "roll".$i;
            $student= new Student;
            $student->name= $request->$name;
            $student->roll= $request->$roll;
            $batch->students()->save($student);
        }

        return redirect('/batch');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $batch= Batch::findOrFail($id);
        $students= $batch->students;
        return view('adminpanel.batch.edit_batch',compact('batch','students'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student= Student::findOrFail($id);
        $student->batch()->detach();
        $student->attendances()->detach();
        foreach ($student->attendances as $attendance) {
            $attendance->delete();
        }
        $student->delete();

        return back();
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
        $batch= Batch::findOrFail($id);
        $batch->name= $request->batch_name;
        $batch->save();

        $i=1;
        foreach ($batch->students as $student) {
            $name= "name".$i;
            $roll= "roll".$i;
            $student->name= $request->$name;
            $student->roll= $request->$roll;
            $student->save();
            $i++;
        }

        return redirect('/batch');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $batch= Batch::findOrFail($id);
        foreach ($batch->students as $student) {
            foreach ($student->attendances as $attendance) {
                $attendance->lectures()->detach();
                $attendance->subjects()->detach();
                $attendance->delete();
            }
            $student->attendances()->detach();
            $student->delete();
        }
        $batch->students()->detach();
        foreach ($batch->lectures as $lecture) {
            $lecture->subjects()->detach();
            $lecture->delete();
        }
        $batch->lectures()->delete();
        $dep= Auth::user()->departments;
        foreach ($dep as $d) {
            $d->batches()->detach($batch);
        }
        $batch->semester()->detach();
        $batch->delete();

        return redirect('/batch');
    }





    public function addbatch(Request $request)
    {
        $request->validate([
            'students' => 'required|max:3',
        ]);

        $num_of_students= $request->students;

        return view('adminpanel.batch.add_new_batch',compact('num_of_students'));
    }

    public function addstudent(Request $request,$id)
    {
        $batch= Batch::findOrFail($id);

        $student= new Student;
        $student->name= $request->name;
        $student->roll= $request->roll;

        $batch->students()->save($student);


        return back();
    }
}

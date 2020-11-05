<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Semester;
use App\Subject;
use App\Batch;
use App\Attendance;
use App\Lecture;
use App\Rules\CheckSemester;
use Carbon\Carbon;

class AttendanceController extends Controller
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
      $semesters= Semester::all();

      return view('adminpanel.attendance.new_attendance',compact('semesters'));
  }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $semesters= Semester::all();

        return view('adminpanel.attendance.edit_attendance',compact('semesters'));
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
          'semester' => ['required', new CheckSemester],
          'class_id' => ['required']
        ]);

        $semester= Semester::findOrFail($request->semester);
        $user= Auth::user();
        foreach ($user->departments as $department) {
            foreach ($semester->batches as $batches) {
                foreach ($batches->department as $dep) {
                    if ($dep->id == $department->id) {
                        $batch= $batches;
                        $depar= $department;
                    }
                }
            }
        }

        $lec=null;
        foreach ($batch->lectures as $lecture) {
            if ($lecture->name == $request->class_id) {
                $lec= $lecture;
            }
        }


        return view('adminpanel.attendance.update_attendance',compact('semester','batch','depar','lec','user'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        echo "<a href=\"/attendance/".$id."/edit\">Yes</a>";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lecture= Lecture::findOrFail($id);
        foreach ($lecture->attendances as $attendance) {
            $attendance->students()->detach();
            $attendance->subjects()->detach();
            $attendance->lectures()->detach();
            $attendance->delete();
        }
        $lecture->batches()->detach();
        $lecture->subjects()->detach();
        $lecture->delete();

        return redirect('/attendance');
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
        $lecture= Lecture::findOrFail($id);
        $lecture->subjects()->sync($request->subject);
        $period= $request->period;

        foreach ($lecture->attendances as $attendance) {
            foreach ($attendance->students as $student) {
                $absent= "a".$student->id;
                if ($request->$absent == null) {
                    $attendance->attendance = 1*$period;
                    $attendance->save();
                    $attendance->subjects()->sync($request->subject);
                }else{
                    $attendance->attendance = 0;
                    $attendance->save();
                    $attendance->subjects()->sync($request->subject);
                }
            }
        }

        return redirect('/attendance');
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





    public function take_attendance(Request $request)
    {
        $request->validate([
          'semester' => ['required', new CheckSemester]
        ]);

        $semester= Semester::findOrFail($request->semester);
        $user= Auth::user();
        foreach ($user->departments as $department) {
            foreach ($semester->batches as $batches) {
                foreach ($batches->department as $dep) {
                    if ($dep->id == $department->id) {
                        $batch= $batches;
                        $depar= $department;
                    }
                }
            }
        }
        $date= Carbon::now()->format('d, M, Y');

        return view('adminpanel.attendance.take_attendance',compact('semester','batch','date','depar','user'));
    }


    public function save_attendance(Request $request, $id)
    {
        $batch= Batch::findOrFail($id);
        $subject= Subject::findOrFail($request->subject);
        $period= $request->period;

        $temp=0;
        foreach ($batch->lectures as $lecture) {
            $temp= $lecture->name;
        }
        $lecture= new Lecture;
        $lecture->name= 1+$temp;
        $batch->lectures()->save($lecture);
        $subject->lectures()->attach($lecture);

        foreach ($batch->students as $student) {
            $attendance= new Attendance;
            $absent= "a".$student->id;
            if ($request->$absent == null) {
                $attendance->attendance= 1*$period;
            }else{
                $attendance->attendance= 0;
            }
            $student->attendances()->save($attendance);
            $subject->attendances()->attach($attendance->id);
            $lecture->attendances()->attach($attendance->id);
        }

        return redirect('/attendance');

    }


}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Department;

class DepartmentController extends Controller
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
        $dep= Department::all();

        return view('adminpanel.department.department', compact('dep'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $admin= Role::findOrFail(2);
        $master_admin= Role::findOrFail(1);

        return view('adminpanel.department.add_new_department',compact('admin','master_admin'));
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
            'name' => 'required|unique:departments,name|max:255'
        ]);

        $department= new Department;

        if (empty($request->admin)) {
            $department->name= $request->name;
            $department->save();
        }else{
            $user= User::findOrFail($request->admin);       
            $department->name= $request->name;
            $user->departments()->save($department);
        }

        $dep= Department::all();
        return view('adminpanel.department.department', compact('dep'));        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $department= Department::findOrFail($id);
        $dep_admin= null;
        $department_admin= null;
        foreach ($department->users as $user) {
            foreach ($user->roles as $role) {
                if ($role->role=="admin" || $role->role=="master-admin") {
                    $department_admin= $user;
                    $dep_admin= $user->id;
                }
            }
        }

        $admin= Role::findOrFail(2);
        $master_admin= Role::findOrFail(1);

        return view('adminpanel.department.edit_department',compact('department','dep_admin','department_admin','admin','master_admin'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
        $department= Department::findOrFail($id);

         $validatedData = $request->validate([
            'name' => 'required|unique:departments,name,'.$department->id,
        ]);
        
        $department->name= $request->name;
        $department->save();

        if (empty($request->admin)) {
            foreach ($department->users as $user) {
                foreach ($user->roles as $role) {
                    if ($role->role=="admin"||$role->role=="master-admin") {
                        $department->users()->detach($user->id);
                    }
                }
            }           
        }else{
            foreach ($department->users as $user) {
                foreach ($user->roles as $role) {
                    if ($role->role=="admin"||$role->role=="master-admin") {
                        $department->users()->detach($user->id);                        
                    }
                }
            }  
            $department->users()->attach([$request->admin]);          
        }

        $dep= Department::all();
        return view('adminpanel.department.department', compact('dep'));
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





    public function ajax($id)
    {
        $dep= Department::findOrFail($id);
        echo "<a href=\"/depdel/".$dep->id."\">Yes</a>";
    }

    public function mydel($id)
    {
        $dep= Department::findOrFail($id);

        foreach ($dep->users as $user) {
            foreach ($user->roles as $role) {
                if ($role->id==3) {
                    $user->departments()->detach();
                    $user->delete();
                }
            }
        }
        foreach ($dep->batches as $batch) {
            foreach ($batch->lectures as $lecture) {
                $lecture->attendances()->delete();
                $lecture->attendances()->detach();
                $lecture->delete();
            }
            foreach ($batch->students as $student) {
                $student->attendances()->detach();
                $student->delete();
            }
            $batch->semester()->detach();
            $batch->students()->detach();
            $batch->delete();
        }
        foreach ($dep->subjects as $subject) {
            $subject->attendances()->detach();
            $subject->lectures()->detach();
            $subject->semesters()->detach();
            $subject->users()->detach();
            $subject->delete();
        }

        $dep->batches()->detach();
        $dep->subjects()->detach();
        $dep->delete();

        return redirect('/department');
    }

    public function mydeladmin($id,$adminid)
    {
        $dep= Department::findOrFail($id);
        $dep->users()->detach($adminid);

        return redirect('/department');
    }
}

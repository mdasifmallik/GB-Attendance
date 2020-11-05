<?php

use App\User;
use App\Role;
use App\Department;
use App\Batch;
use App\Semester;
use App\Lecture;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::get('/register', function () {
    return redirect('/');
});
Route::get('/home', 'HomepageController@index');

// Route::get('/newadmin', function () {
//     return view('auth.register');
// });




Route::resources([
    '/' => 'HomepageController',
    'attendance' => 'AttendanceController',
    'settings' => 'SettingsController',
    'admin' => 'AdminController',
    'department' => 'DepartmentController',
    'subject' => 'SubjectController',
    'lecturer' => 'LecturerController',
    'semester' => 'SemesterController',
    'batch' => 'BatchController'
]);

Route::post('/takeattendance', 'AttendanceController@take_attendance');
Route::post('/saveattendance/{id}', 'AttendanceController@save_attendance');
Route::get('/ajax/{id}', 'DepartmentController@ajax');
Route::get('/depdel/{id}', 'DepartmentController@mydel');
Route::get('/depadmindel/{id}/{adminid}', 'DepartmentController@mydeladmin');
Route::post('/addbatch', 'BatchController@addbatch');
Route::post('/addstudent/{id}', 'BatchController@addstudent');
Route::get('/ajax_select/{id}', 'HomepageController@ajax_select');
Route::get('/ajax_sem/{id}', 'HomepageController@ajax_sem');
Route::post('/attendance_info', 'HomepageController@attendance_info');




Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
});



Route::get('/test', function () {

    $data= [
        'user_name'=>'Asif',
        'user_pass'=>'12345678',
        'user_role'=>'Admin'
    ];

    Mail::send('email_templates.add_user', $data, function ($message) {
        $message->to('mdasifmallik2@gmail.com', 'Asif Mallik')->subject('Hi Asif');
    });
});
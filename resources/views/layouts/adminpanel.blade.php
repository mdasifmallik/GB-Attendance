@php
    namespace App;
    use Auth;

    $user= Auth::user();
    $dep=null;
    if (count($user->departments)>0) {
        foreach ($user->departments as $department) {
            $dep= $department;
        }
    }
    foreach ($user->roles as $ro) {
        $role= $ro->role;
    }
@endphp


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GB ATTENDANCE</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/adminpanel.css">
    <link rel="stylesheet" href="../assets/css/adminpanel_respnsive.css">
</head>

<body>
    <!-- Header Area -->
    <header class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                   <div class="side-bar-button">
                       <i class="fas fa-bars"></i>
                   </div>
                    <div class="logo">
                        <h1><a href="/">GB Attendance</a></h1>
                    </div>
                    <div class="home-button">
                        <a href="/"><i class="fas fa-home"></i>Home</a>
                    </div>
                </div>
            </div>
        </div>
    </header>





    <!-- Content area -->
    <div class="admin-panel-content">


        <!-- Sidebar Area -->
        <div class="admin-panel-side-bar">
            <h4>{{$user->name}}</h4>
            @if($dep)
                <p>Dept of {{$dep->name}}.</p>
            @else
                <p>No Department Assigned.</p>
            @endif
            <nav>
                <ul>
                    <li><button class="side-attendance-button side-bar-open"><i class="fas fa-clipboard-check"></i>Attendance<i class="fas fa-angle-down last-icon"></i></button>
                        <nav class="sub-attendance-button">
                            <ul>
                                <li><a class="side-bar-new-attendance" href="/attendance">New Attendance</a></li>
                                <li><a class="side-bar-edit-attendance" href="/attendance/create">Edit Attendance</a></li>
                            </ul>
                        </nav>
                    </li>
                    @if($role == "master-admin")
                    <li><a class="side-bar-department" href="/department"><i class="fas fa-building"></i>Department</a></li>
                    <li><a class="side-bar-admin" href="/admin"><i class="fas fa-user"></i>Admins</a></li>
                    @endif
                    @if($role=="master-admin" || $role=="admin")
                    <li><a class="side-bar-subject" href="/subject"><i class="fas fa-book"></i>Subjects</a></li>
                    <li><a class="side-bar-lecturer" href="/lecturer"><i class="fas fa-user-tie"></i>Lecturer</a></li>
                    <li><a class="side-bar-semester" href="/semester"><i class="fas fa-door-open"></i>Semesters</a></li>
                    <li><a class="side-bar-batch" href="/batch"><i class="fas fa-users"></i>Batch</a></li>
                    @endif
                    <li><a class="side-bar-setting" href="/settings"><i class="fas fa-cogs"></i>Settings</a></li>
                </ul>
            </nav>
        </div>





        <!-- Main Content area -->
        <div class="admin-panel-main">
            <div class="container-fluid">
                <!-- Main sub-content area -->

                <!-- Particular sub-content area-->


                @yield('content')






                <footer class="footer">
                    <p><a href="">GB Attendance</a> is for managing & using the attendance system of <a href="https://www.gonouniversity.edu.bd/">Gono Bishwabidyalay</a>. This web application is made by the team <a href="">Storm Riders</a>, Batch 21 of Department of CSE, <a href="https://www.gonouniversity.edu.bd/">Gono Bishwabidyalay</a>. While using this site make sure you have read & accepted the <a href="">terms of use</a> and <a href="">privacy policy</a>. </p>
                    <p><a href="">Copyright 2019-2019</a> by Gono Bishwabidyalay. All Rights Reserved.</p>
                </footer>
            </div>
        </div>
    </div>


@yield('modal')



<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/6437382604.js" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="../assets/js/adminpanel.js"></script>




@yield('script')



</body>

</html>

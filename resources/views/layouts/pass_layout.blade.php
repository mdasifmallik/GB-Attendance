<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GB ATTENDANCE</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/login.css">
    <link rel="stylesheet" href="../../assets/css/login_responsive.css">
</head>

<body>
    <header class="header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="logo">
                        <h1><a href="/">GB Attendance</a></h1>
                    </div>
                    <div class="admin-panel-button">
                        <a href="/newattendance"><i class="fas fa-user"></i>Admin Panel</a>
                    </div>
                </div>
            </div>
        </div>
    </header>


    <div class="content">
        <div class="container">
            <div class="attendance-search-area">
                <div class="error">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="searching-options">



                    @yield('form')        



                </div>
            </div>
        </div>
    </div>



    <footer class="footer">
        <div class="container">
            <p><a href="">GB Attendance</a> is for managing & using the attendance system of <a href="">Gono Bishwabidyalay</a>. This web application is made by the team <a href="">Storm Riders</a>, Batch 21 of Department of CSE, <a href="">Gono Bishwabidyalay</a>. While using this site make sure you have read & accepted the <a href="">terms of use</a> and <a href="">privacy policy</a>. </p>
            <p><a href="">Copyright 2019-2019</a> by Gono Bishwabidyalay. All Rights Reserved.</p>
        </div>
    </footer>





    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/6437382604.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="assets/js/init.js"></script>
</body>

</html>

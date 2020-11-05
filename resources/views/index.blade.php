@extends('layouts.home')



@section('content')

            <h5>Welcome to GB Attendance! Use <span class="pink">Search By Student</span> to check attendance of all the running subjects of a student. Or use <span class="green">Search Attendance Sheet</span> to view full attendance sheet of a particular subject of a batch.</h5>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="attendance-search-area">
                <div class="row">
                    <div class="col-md-6">
                        <div class="searching-options">
                            <h4 class="pink">Search By Student</h4>
                            <form method="post" action="/attendance_info">
                                @csrf

                                <div class="searching-item">
                                    <label for="">Department: </label>
                                    <select name="department" id="">
                                        <option value="">Choose Department</option>
                                        @foreach($departments as $department)
                                            <option value="{{$department->id}}">{{$department->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="searching-item">
                                    <label for="">Semester: </label>
                                    <select name="semester" id="">
                                        <option value="">Choose Semester</option>
                                        @foreach($semesters as $semester)
                                            <option value="{{$semester->id}}">{{$semester->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="searching-item">
                                    <label for="">Exam Roll: </label>
                                    <input type="text" name="roll" placeholder="Roll" required>
                                </div>
                                <div class="searching-item search-button">
                                    <input class="student-button" type="submit" value="Search">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="searching-options">
                            <h4 class="green">Search Attendance Sheet</h4>
                            <form method="post" action="/">
                                @csrf
                                <div class="searching-item">
                                    <label for="">Department: </label>
                                    <select name="department" id="mySelect" onchange="ajax_select()">
                                        <option value="">Choose Department</option>
                                        @foreach($departments as $department)
                                            <option value="{{$department->id}}">{{$department->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="searching-item" id="ajax_select">
                                    <label for="">Subject: </label>
                                    <select name="subject" id="">
                                        <option value="">Choose Subject</option>
                                    </select>
                                </div>
                                <div class="searching-item" id="ajax_sem">
                                    <label for="">Semester: </label>
                                    <select name="semester">
                                        <option value="">Choose Semester</option>
                                        @foreach($semesters as $semester)
                                            <option value="{{$semester->id}}">{{$semester->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="searching-item search-button">
                                    <input class="attendance-button" type="submit" value="Search">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection



@section('script')

<script>
    function ajax_select(){
        var x = document.getElementById("mySelect").value;
        var xhttp;
          xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              document.getElementById("ajax_select").innerHTML = this.responseText;
            }
          };
          xhttp.open("GET", "/ajax_select/"+x, true);
          xhttp.send();
    }


    function ajax_sem(){
        var x = document.getElementById("mySem").value;
        var xhttp;
          xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              document.getElementById("ajax_sem").innerHTML = this.responseText;
            }
          };
          xhttp.open("GET", "/ajax_sem/"+x, true);
          xhttp.send();
    }
</script>

@endsection


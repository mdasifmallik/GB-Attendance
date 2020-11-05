@extends('layouts.adminpanel')



@section('content')

<!-- Particular sub-content area for new-attendance-->
<div class="admin-panel-sub-content" id="new-attendance">
    <div class="admin-sub-heading">
        <h3>Take Attendance</h3>
        <p>Please don't forget to click save button after taking an attendance.</p>
    </div>
    <div class="attendance-info">
        <div class="row">
            <div class="col-md-12">
                <p><b>Attendance Info: </b><span>Batch: {{$batch->name}} | Date: {{$date}}</span></p>
            </div>
        </div>
    </div>
    <div class="admin-attendance">
        <form method="post" action="/saveattendance/{{$batch->id}}">
            @csrf
            <div class="select-option">
                <label for="">Subject: </label>
                <select name="subject" id="">
                    @foreach($user->subjects as $sub)
                        @foreach($semester->subjects as $subject)
                            @foreach($subject->department as $departments)
                                @if($departments->id == $depar->id && $sub->id == $subject->id)
                                    <option value="{{$subject->id}}">{{$subject->name}}</option>
                                @endif
                            @endforeach
                        @endforeach
                    @endforeach
                </select>
            </div>
            <div class="select-option">
                <label for="">Period: </label>
                <select name="period" id="">
                    <option value="1">Single Period</option>
                    <option value="2">Double Period</option>
                </select>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Roll</th>
                        <th scope="col">Absent</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($batch->students as $student)
                        @php
                            $absent= "a".$student->id;
                        @endphp
                        <tr>
                          <th scope="row">{{$student->name}}</th>
                          <td>{{$student->roll}}</td>
                          <td><input type="checkbox" name="{{$absent}}" value="absent"></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <input class="default-button" type="submit" value="Save">
        </form>
    </div>
</div>

@endsection





@section('script')

<script>
    $(document).ready(function() {
        $(".side-bar-new-attendance").addClass("side-bar-active");
    });

</script>

@endsection

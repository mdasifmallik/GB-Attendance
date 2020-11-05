@extends('layouts.adminpanel')



@section('content')

<!-- Particular sub-content area for new-attendance-->
<div class="admin-panel-sub-content" id="new-attendance">
    <div class="admin-sub-heading">
        <h3>Edit Attendance</h3>
        <p>Please don't forget to click save button after editing an attendance.</p>
    </div>

    @if($lec)
        <div class="attendance-info">
            <div class="row">
                <div class="col-md-12">
                    <p><b>Attendance Info: </b><span>Batch: {{$batch->name}} | Class ID: {{$lec->name}} | Date: {{$lec->created_at->format('d/M/Y')}}</span></p>
                </div>
            </div>
        </div>

        <div class="admin-attendance">
            <form method="post" action="/attendance/{{$lec->id}}">
                @csrf
                <input type="hidden" name="_method" value="PUT">

                <div class="select-option">
                    <label for="">Subject: </label>
                    <select name="subject" id="">
                        @foreach($user->subjects as $sub)
                            @foreach($semester->subjects as $subject)
                                @foreach($subject->department as $departments)
                                    @if($departments->id == $depar->id && $sub->id == $subject->id)
                                        @php
                                            $selected= "";
                                            foreach ($lec->subjects as $sub) {
                                                if ($sub->id == $subject->id) {
                                                    $selected= "selected";
                                                }
                                            }
                                        @endphp
                                        <option value="{{$subject->id}}" {{$selected}}>{{$subject->name}}</option>
                                    @endif
                                @endforeach
                            @endforeach
                        @endforeach
                    </select>
                </div>
                <div class="select-option">
                    <label for="">Period: </label>
                    <select name="period" id="">
                        @php
                            $sel_per= "";
                        @endphp
                        @foreach($lec->attendances as $attendance)
                            @php
                                if($attendance->attendance == 2){
                                    $sel_per= "selected";
                                }
                            @endphp
                        @endforeach
                        <option value="1">Single Period</option>
                        <option value="2" {{$sel_per}}>Double Period</option>
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
                        @foreach($lec->attendances as $attendance)
                            @foreach($attendance->students as $student)
                                @php
                                    $absent= "a".$student->id;
                                    $mark= "";
                                    if ($attendance->attendance < 1) {
                                        $mark= "checked";
                                    }
                                @endphp
                                <tr>
                                  <th scope="row">{{$student->name}}</th>
                                  <td>{{$student->roll}}</td>
                                  <td><input type="checkbox" name="{{$absent}}" value="absent" {{$mark}}></td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
                <input class="default-button" type="submit" value="Save">
            </form>
        </div>
        <div class="del_att">
            <button class="delete" onclick="modal({{$lec->id}})">Delete this attendance</button>
        </div>
    @else
        <div class="alert alert-danger">
            <h3>Class ID not matched.</h3>
        </div>
    @endif
</div>
@endsection


@section('modal')

<div id="mymodal">
</div>
<div id="mymodal-content">
    <h4>Are you sure, you want to delete this attendance?</h4>
    <div class="mymodal-buttons">
        <div class="mm_button_items" id="ajax_modal">

        </div>
        <div class="mm_button_items">
            <button class="modal-out">No</button>
        </div>
    </div>
</div>

@endsection






@section('script')

<script>
    function modal(id){
        var xhttp;
          xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              document.getElementById("ajax_modal").innerHTML = this.responseText;
            }
          };
          xhttp.open("GET", "/attendance/"+id, true);
          xhttp.send();
    }
</script>

<script>
    $(document).ready(function() {
        $(".side-bar-edit-attendance").addClass("side-bar-active");

        $(".delete").click(function(){
            $("#mymodal").show();
            $("#mymodal-content").show();
        });
        $(".modal-out").click(function(){
            $("#mymodal").fadeOut();
            $("#mymodal-content").fadeOut();
        });
        $("#mymodal").click(function(){
            $("#mymodal").fadeOut();
            $("#mymodal-content").fadeOut();
        });
    });

</script>

@endsection

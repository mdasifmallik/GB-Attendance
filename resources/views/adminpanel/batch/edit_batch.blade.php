@extends('layouts.adminpanel')



@section('content')

<!-- Particular sub-content area for Edit batch-->
<div class="admin-panel-sub-content" id="edit-batch">
    <a class="back-button" href="batch.html"><i class="fas fa-angle-left"></i>Back to Batch</a>
    <div class="admin-sub-heading sub-sub-heading">
        <h3>Edit {{$batch->name}} batch</h3>
        <p>Edit batch info and click on save.</p>
    </div>
    <div class="editing-area">
        <form method="post" action="/batch/{{$batch->id}}">
            @csrf
            <input type="hidden" name="_method" value="PUT">

            <div class="editing-option">
                <label for="">Batch Name: </label>
                <input style="width: 100px;" type="text" name="batch_name" value="{{$batch->name}}" required>
            </div>

            <div class="add-student-table table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Roll</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i=1;
                        @endphp
                        @foreach($students as $student)
                            <tr>
                                <th>{{$i}}</th>
                                <td>
                                    <input type="text" name="name{{$i}}" value="{{$student->name}}" required>
                                </td>
                                <td>
                                    <input type="text" name="roll{{$i}}" value="{{$student->roll}}" required>
                                </td>
                                <td>
                                    <a style="color: red" href="/batch/{{$student->id}}/edit"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                            @php
                                $i++;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
            <input class="default-button" type="submit" value="Save">
        </form>
        <button class="addstudent add_button">Add a new student to this batch.</button>
        <button style="margin-top: 30px" class="delete">Delete this batch</button>
    </div>
</div>
@endsection



@section('modal')

<div id="mymodal">
</div>


<div id="mymodal-content">
    <h4>Are you sure, you want to delete this batch?</h4>
    <div class="mymodal-buttons">
        <div class="mm_button_items" id="ajax_modal">
            <form method="post" action="/batch/{{$batch->id}}">
                @csrf
                <input type="hidden" name="_method" value="DELETE">
                <input class="delete" type="submit" value="Yes">
            </form>
        </div>
        <div class="mm_button_items">
            <button class="modal-out">No</button>
        </div>
    </div>
</div>

<div id="add_student_modal-content">
    <form method="post" action="/addstudent/{{$batch->id}}">
        @csrf

        <div class="modal_input">
            <div class="modal_input_field">
                <label for="">Name: </label>
                <input type="text" name="name" required>
            </div>
            <div class="modal_input_field">
                <label for="">Roll: </label>
                <input type="text" name="roll" required>
            </div>
        </div>
        <div class="mymodal-buttons">
            <div class="mm_button_items" id="ajax_modal">
                <input class="add_button" type="submit" value="Add">
            </div>
    </form>
            <div class="mm_button_items">
                <button class="modal-out">Cancel</button>
            </div>
        </div>
</div>

@endsection





@section('script')

<script>
    $(document).ready(function() {
        $(".side-bar-batch").addClass("side-bar-active");

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



        $(".addstudent").click(function(){
            $("#mymodal").show();
            $("#add_student_modal-content").show();
        });
        $(".modal-out").click(function(){
            $("#add_student_modal-content").fadeOut();
        });
        $("#mymodal").click(function(){
            $("#add_student_modal-content").fadeOut();
        });
    });
</script>

@endsection

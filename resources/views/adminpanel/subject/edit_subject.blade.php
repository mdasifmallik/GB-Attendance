@extends('layouts.adminpanel')



@section('content')

<!-- Particular sub-content area for Edit Subject-->
<div class="admin-panel-sub-content" id="edit-subject">
    <a class="back-button" href="subjects.html"><i class="fas fa-angle-left"></i>Back to Subjects</a>
    <div class="admin-sub-heading sub-sub-heading">
        <h3>Edit {{$subject->name}}</h3>
        <p>Edit subject name or edit semester and lecturer assign info of that subject.</p>
    </div>
    <div class="editing-area">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="post" action="/subject/{{$subject->id}}">
            @csrf
            <input type="hidden" name="_method" value="PUT">

            <div class="editing-option">
                <label for="">Subject Name: </label>
                <input type="text" name="name" value="{{$subject->name}}">
            </div>
            <div class="editing-option">
                <label for="">Assign Semester: </label>
                    <select name="semester" id="">
                        <option value="">Choose Semester</option>
                        @foreach($semesters as $semester)
                            @php  
                                $temp=null;                         
                                if ($semester->id==$a_sem) {
                                    $temp= "selected";
                                }
                            @endphp
                            <option value="{{$semester->id}}" {{$temp}}>{{$semester->name}}</option>
                            @php
                                $temp=null;
                            @endphp
                        @endforeach
                    </select>
            </div>
            <div class="editing-option">
                <label for="">Assign Semester 2: </label>
                <select name="semester2" id="">
                        <option value="">Choose Semester</option>
                        @foreach($semesters as $semester)
                            @php  
                                $temp=null;                         
                                if ($semester->id==$a2_sem) {
                                    $temp= "selected";
                                }
                            @endphp
                            <option value="{{$semester->id}}" {{$temp}}>{{$semester->name}}</option>
                            @php
                                $temp=null;
                            @endphp
                        @endforeach
                    </select>
            </div>
            <div class="editing-option">
                <label for="">Assign Lecturer: </label>
                    <select name="lecturer" id="">
                        <option value="">Choose Lecturer</option>
                        @foreach($users as $user)
                            @php  
                                $temp=null;                         
                                if ($user->id==$a_lec) {
                                    $temp= "selected";
                                }
                            @endphp
                            <option value="{{$user->id}}" {{$temp}}>{{$user->name}}</option>
                            @php
                                $temp=null;
                            @endphp
                        @endforeach
                    </select>
            </div>
            <input class="default-button" type="submit" value="Save">
        </form>
        <div class="editing-option">
            <button class="delete">Delete this Subject</button>
        </div>
    </div>
</div>

@endsection



@section('modal')

<div id="mymodal">
</div>
<div id="mymodal-content">
    <h4>Are you sure, you want to delete this subject?</h4>
    <div class="mymodal-buttons">
        <div class="mm_button_items" id="ajax_modal">
            <form method="post" action="/subject/{{$subject->id}}">
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

@endsection







@section('script')

<script>
    $(document).ready(function() {
        $(".side-bar-subject").addClass("side-bar-active");

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

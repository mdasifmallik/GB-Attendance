@extends('layouts.adminpanel')



@section('content')

<!-- Particular sub-content area for Add New Subject-->
<div class="admin-panel-sub-content" id="add-new-subject">
    <a class="back-button" href="subjects.html"><i class="fas fa-angle-left"></i>Back to Subjects</a>
    <div class="admin-sub-heading sub-sub-heading">
        <h3>Add New Subject</h3>
        <p>Type the subject name and assign a semester and lecturer to this subject.</p>
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
        <form method="post" action="/subject">
            @csrf

            <div class="editing-option">
                <label for="">Subject Name: </label>
                <input type="text" name="name">
            </div>
            <div class="editing-option">
                <label for="">Assign Semester: </label>
                <select name="semester" id="">
                    <option value="">Choose Semester</option>
                    @foreach($semesters as $semester)
                        <option value="{{$semester->id}}">{{$semester->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="editing-option">
                <label for="">Assign Lecturer: </label>
                <select name="lecturer" id="">
                    <option value="">Choose Lecturer</option>
                    @foreach($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>
            </div>
            <input class="default-button" type="submit" value="Save">
        </form>
    </div>
</div>

@endsection





@section('script')

<script>
    $(document).ready(function() {
        $(".side-bar-subject").addClass("side-bar-active");
    });

</script>

@endsection

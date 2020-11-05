@extends('layouts.adminpanel')



@section('content')

<!-- Particular sub-content area for Add New Lecturer-->
<div class="admin-panel-sub-content" id="add-new-lecturer">
    <a class="back-button" href="/lecturer"><i class="fas fa-angle-left"></i>Back to Lecturers</a>
    <div class="admin-sub-heading sub-sub-heading">
        <h3>Add New Lecturer</h3>
        <p>Just type the name and email address of the lecturer you want to add and press "Add". The new lecturer will recieve an email with an auto generated password and can login through his/her email and that password.</p>
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
        <form method="post" action="/lecturer">
            @csrf

            <div class="editing-option">
                <label for="">Name: </label>
                <input type="text" name="name" required>
            </div>
            <div class="editing-option">
                <label for="">Email: </label>
                <input type="email" name="email" required>
            </div>
            <input class="default-button" type="submit" value="Save">
        </form>

        
    </div>
</div>

@endsection





@section('script')

<script>
    $(document).ready(function() {
        $(".side-bar-lecturer").addClass("side-bar-active");
    });

</script>

@endsection

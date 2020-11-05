@extends('layouts.adminpanel')



@section('content')

<!-- Particular sub-content area for Add New Admin-->
<div class="admin-panel-sub-content" id="add-new-admin">
    <a class="back-button" href="/admin"><i class="fas fa-angle-left"></i>Back to Admins</a>
    <div class="admin-sub-heading sub-sub-heading">
        <h3>Add New Admin</h3>
        <p>Just type the name and email address of the department admin you want to add and press "Add". The new admin will recieve an email with an auto generated password and can login through his/her email and that password.</p>
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
        <form method="post" action="/admin">
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
        $(".side-bar-admin").addClass("side-bar-active");
    });

</script>

@endsection

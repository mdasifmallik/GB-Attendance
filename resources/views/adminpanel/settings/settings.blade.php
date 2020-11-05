@extends('layouts.adminpanel')



@section('content')

<!-- Particular sub-content area for Settings-->
<div class="admin-panel-sub-content" id="settings">
    <div class="admin-sub-heading">
        <h3>Settings</h3>
        <p>Don't forget to click "Save" after update an info.</p>
    </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (\Session::has('msg'))
            <div class="alert alert-success">
                <ul>
                    <li>{!! \Session::get('msg') !!}</li>
                </ul>
            </div>
        @endif
        @if (\Session::has('msg2'))
            <div class="alert alert-danger">
                <ul>
                    <li>{!! \Session::get('msg2') !!}</li>
                </ul>
            </div>
        @endif
    <div class="settings-editing-area">
        <div class="row">
            <div class="col-md-12">
                <h4>Change Basic Info</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form method="post" action="/settings/{{$user->id}}">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">

                    <div class="settings-option">
                        <label for="">Change Name:</label>
                        <input type="text" value="{{$user->name}}" name="name">
                    </div>
                    <div class="settings-option">
                        <label for="">Change Email:</label>
                        <input type="email" value="{{$user->email}}" name="email">
                    </div>
                    <div class="settings-option">
                        <button class="default-button">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="settings-editing-area">
        <div class="row">
            <div class="col-md-12">
                <h4>Change Password</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form method="post" action="/settings">
                    @csrf
                    <div class="settings-option">
                        <label for="">Old Pasword:</label>
                        <input type="password" name="old_pass">
                    </div>
                    <div class="settings-option">
                        <label for="">New Password:</label>
                        <input type="password" name="new_pass">
                    </div>
                    <div class="settings-option">
                        <label for="">Retype New Password:</label>
                        <input type="password" name="re_pass">
                    </div>
                    <div class="settings-option">
                        <button class="default-button">Save</button>
                    </div>
                </form> 
            </div>
        </div>
    </div>
    <a class="default-button" href="/logout">Logout</a>
</div>

@endsection





@section('script')

<script>
    $(document).ready(function() {
        $(".side-bar-setting").addClass("side-bar-active");
    });

</script>

@endsection

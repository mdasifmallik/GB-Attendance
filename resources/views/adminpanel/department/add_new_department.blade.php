@extends('layouts.adminpanel')



@section('content')

<!-- Particular sub-content area for Add New Department-->
<div class="admin-panel-sub-content" id="add-new-department">
    <a class="back-button" href="/department"><i class="fas fa-angle-left"></i>Back to Department</a>
    <div class="admin-sub-heading sub-sub-heading">
        <h3>Add New Department</h3>
        <p>type the new departmnet name and assign a free admin to that departmnet.</p>
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

        <form method="post" action="/department">
            @csrf

            <div class="editing-option">
                <label for="">Name: </label>
                <input type="text" name="name">
            </div>
            <div class="editing-option">
                <label for="">Choose Admin: </label>
                <select name="admin" id="">
                    <option value="">Choose Admin</option>
                    @foreach($master_admin->users as $user)
                        @if(1>count($user->departments))
                            <option value="{{$user->id}}">{{$user->name}}</option>
                        @endif
                    @endforeach
                    @foreach($admin->users as $user)
                        @if(1>count($user->departments))
                            <option value="{{$user->id}}">{{$user->name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <input class="default-button extra-margin" type="submit" value="Save">
        </form>


    </div>
</div>

@endsection





@section('script')

<script>
    $(document).ready(function() {
        $(".side-bar-department").addClass("side-bar-active");
    });

</script>

@endsection

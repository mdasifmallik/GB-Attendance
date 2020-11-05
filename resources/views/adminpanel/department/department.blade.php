@extends('layouts.adminpanel')



@section('content')

<!-- Particular sub-content area for Departments-->
<div class="admin-panel-sub-content" id="department">
    <div class="admin-sub-heading">
        <h3>Departments</h3>
        <p>To edit a department info please click the edit button on the right side of the department.</p>
    </div>
    <div class="new-department-button">
        <a class="default-button" href="/department/create">Add New Department</a>
    </div>
    <div class="department-list">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Department Name</th>
                    <th scope="col">Admin</th>
                    <th scope="col">Edit</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dep as $d)

                    <tr>
                        <th scope="row">{{$d->name}}</th>
                        @foreach($d->users as $user)
                            @foreach($user->roles as $role)
                                @if($role->role=="admin" || $role->role=="master-admin")
                                    <td>{{$user->name}}</td>
                                @endif
                            @endforeach               
                        @endforeach  
                        @if(count($d->users)==0)
                            <td></td>
                        @endif  
                        <td><a href="/department/{{$d->id}}">Edit</a></td>
                    </tr>

                @endforeach
            </tbody>
        </table>
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

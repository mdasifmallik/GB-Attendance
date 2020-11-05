@extends('layouts.adminpanel')



@section('content')

<!-- Particular sub-content area for Subjects-->
<div class="admin-panel-sub-content" id="subjects">
    <div class="admin-sub-heading">
        <h3>Subjects of Dept of CSE</h3>
        <p>Click "Add New Subject" to add a new subject or click the "Manage" button from the right side of the subject, to manage that subject.</p>
    </div>

    @if($dep)
    <div class="new-subject-button">
        <a class="default-button" href="/subject/create">Add New Subject</a>
    </div>
    <div class="subject-list table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Subject Name</th>
                    <th scope="col">Semester</th>
                    <th scope="col">Lecturer</th>
                    <th scope="col">Edit</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dep->subjects as $s)

                    <tr>
                        <th scope="row">{{$s->name}}</th>
                        <td>
                            @foreach($s->semesters as $semester)
                                {{$semester->name}}
                            @endforeach
                        </td>
                        <td>
                            @foreach($s->users as $user)
                                {{$user->name}}
                            @endforeach
                        </td>
                        <td><a href="/subject/{{$s->id}}">Edit</a></td>
                    </tr>

                @endforeach
            </tbody>
        </table>
    </div>
    @else
        <div class="alert alert-danger">
            <h4>You are not assigned with any department!! Ask your master-admin to assign with you one.</h4>
        </div>
    @endif
</div>

@endsection





@section('script')

<script>
    $(document).ready(function() {
        $(".side-bar-subject").addClass("side-bar-active");
    });

</script>

@endsection
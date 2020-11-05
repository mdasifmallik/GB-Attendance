@extends('layouts.adminpanel')



@section('content')

<!-- Particular sub-content area for Batch-->
<div class="admin-panel-sub-content" id="batch">
    <div class="admin-sub-heading">
        <h3>Batch</h3>
        <p>Click "Add New batch" to add a new batch or click the "Edit" button from the right side of the batch, to edit that batch.</p>
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

    @if($dep)
    <div class="new-batch-section">
        <form method="post" action="/addbatch">
            @csrf

            <div class="nbinput">
                <label for="">Number of students:</label>
                <input type="number" name="students" required>
            </div>
            <input class="default-button" type="submit" value="Add New Batch">
        </form>
    </div>

    <div class="admin-list table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Batch</th>
                    <th scope="col">Students</th>
                    <th scope="col">Edit</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dep->batches as $batch)
                    @php
                        $num_of_students= count($batch->students);
                    @endphp
                    <tr>
                        <th scope="row">{{$batch->name}}</th>
                        <td>{{$num_of_students}}</td>
                        <td><a href="/batch/{{$batch->id}}">Edit</a></td>
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
        $(".side-bar-batch").addClass("side-bar-active");
    });

</script>

@endsection

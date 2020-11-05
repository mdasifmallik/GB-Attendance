@extends('layouts.adminpanel')



@section('content')

<!-- Particular sub-content area for Add New batch-->
<div class="admin-panel-sub-content" id="add-new-batch">
    <a class="back-button" href="/batch"><i class="fas fa-angle-left"></i>Back to Batch</a>
    <div class="admin-sub-heading sub-sub-heading">
        <h3>Add new batch</h3>
        <p>Just type the nuber of students you want to add in the new batch and click "Enter". A form will appear with inputs according to the number of students. Fill up the form and save it.</p>
    </div>
    <div class="editing-area">
        <form method="post" action="/batch">
            @csrf
            
            <div class="editing-option">
                <label for="">Batch Name: </label>
                <input style="width: 100px;" type="text" name="batch_name" required>
            </div>

            <div class="add-student-table table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Roll</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for($i=1; $i<=$num_of_students; $i++)
                            <tr>
                                <th>{{$i}}</th>
                                <td>
                                    <input type="text" name="name{{$i}}" required>
                                </td>
                                <td>
                                    <input type="text" name="roll{{$i}}" required>
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
            <input class="default-button" type="submit" value="Save">
        </form>
    </div>
</div>
@endsection





@section('script')

<script>
    $(document).ready(function() {
        $(".side-bar-batch").addClass("side-bar-active");
    });

</script>

@endsection

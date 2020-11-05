@extends('layouts.adminpanel')



@section('content')

<!-- Particular sub-content area for new-attendance-->
<div class="admin-panel-sub-content" id="new-attendance">
    <div class="admin-sub-heading">
        <h3>Edit Attendance</h3>
        <p>Select Subject, Batch, Period and then click take attendance, to edit an attendance.</p>
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
    <div class="admin-sub-selection">
        <div class="row">
            <div class="col-md-12">
                <div class="selection-area">
                    <div class="selection-heading">
                        <h4>Edit Attendance For</h4>
                    </div>
                    <form method="post" action="/attendance" class="selection-input">
                        @csrf
                        <div class="select-option">
                            <label for="">Semester: </label>
                            <select name="semester">
                                @foreach($semesters as $semester)
                                    <option value="{{$semester->id}}">{{$semester->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="select-option">
                            <label for="">Class ID: </label>
                            <input type="text" name="class_id">
                        </div>
                        <div class="select-option attendance-button">
                            <input class="default-button" type="submit" value="Edit Attendance">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection





@section('script')

<script>
    $(document).ready(function() {
        $(".side-bar-edit-attendance").addClass("side-bar-active");
    });

</script>

@endsection

@extends('layouts.adminpanel')



@section('content')

<!-- Particular sub-content area for Add New Semesters-->
<div class="admin-panel-sub-content" id="semesters">
    <div class="admin-sub-heading">
        <h3>Semesters</h3>
        <p>Assign batch to the semesters.</p>
    </div>
    @if($dep)
    <form method="post" action="/semester">
        @csrf

        <div class="subject-list">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Semester</th>
                        <th scope="col">Batch</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i=1;
                    @endphp
                    @foreach($semesters as $semester)
                        <tr>
                            <th scope="row">{{$semester->name}}</th>
                            <td>
                                <select name="sem{{$i}}" id="">
                                    <option value="">Choose Batch</option>
                                    @foreach($dep->batches as $batch)
                                        @php
                                            $check= null;
                                            foreach ($batch->semester as $bsem) {
                                                if ($semester->id==$bsem->id) {
                                                    $check= "selected";
                                                }
                                            }
                                        @endphp
                                        <option value="{{$batch->id}}" {{$check}}>{{$batch->name}}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        @php
                            $i++;
                        @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
        <input class="default-button" type="submit" value="Save">
    </form>
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
        $(".side-bar-semester").addClass("side-bar-active");
    });

</script>

@endsection

@extends('layouts.adminpanel')



@section('content')

<!-- Particular sub-content area for Edit Department-->
<div class="admin-panel-sub-content" id="edit-department">
    <a class="back-button" href="/department"><i class="fas fa-angle-left"></i>Back to Department</a>
    <div class="admin-sub-heading sub-sub-heading">
        <h3>Department of {{$department->name}}</h3>
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

        <form method="post" action="/department/{{$department->id}}">
            @csrf

            <input type="hidden" name="_method" value="PUT">

            <div class="editing-option">
                <label for="">Edit Name: </label>
                <input type="text" name="name" value="{{$department->name}}">
            </div>
            <div class="editing-option">
                <label for="">Choose Admin: </label>
                <select name="admin" value="" id="s2">
                    @if($dep_admin)
                        <option value="{{$department_admin->id}}">{{$department_admin->name}}</option>
                    @endif
                    <option value="">Choose Admin</option>
                    @foreach($master_admin->users as $user)
                        @php
                            $temp=null;
                            if ($dep_admin==$user->id) {
                                $temp= "selected";
                            }
                        @endphp
                        @if(1>count($user->departments))
                            <option value="{{$user->id}}" {{$temp}}>{{$user->name}}</option>
                        @endif
                        @php
                            $temp=null;
                        @endphp
                    @endforeach
                    @foreach($admin->users as $user)
                        @php
                            $temp=null;
                            if ($dep_admin==$user->id) {
                                $temp= "selected";
                            }
                        @endphp
                        @if(1>count($user->departments))
                            <option value="{{$user->id}}" {{$temp}}>{{$user->name}}</option>
                        @endif
                        @php
                            $temp=null;
                        @endphp
                    @endforeach
                </select>
            </div>
            <input class="default-button extra-margin" type="submit" value="Save">
        </form>


        @if(!$dep_admin==null)
            <div class="editing-option unassign">
                <a href="/depadmindel/{{$department->id}}/{{$dep_admin}}">Unassign the admin from this department.</a>
            </div>
        @endif
        <div class="editing-option">
            <button class="delete" onclick="modal({{$department->id}})">Delete this Department</button>
        </div>
    </div>
</div>

@endsection


@section('modal')

<div id="mymodal">
</div>
<div id="mymodal-content">
    <h4>Are you sure, you want to delete this department? Think twice all the data associated with this department will permanently gone...</h4>
    <div class="mymodal-buttons">
        <div class="mm_button_items" id="ajax_modal">

        </div>
        <div class="mm_button_items">
            <button class="modal-out">No</button>
        </div>
    </div>
</div>

@endsection





@section('script')

<script>
    function modal(id){
        var xhttp;
          xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              document.getElementById("ajax_modal").innerHTML = this.responseText;
            }
          };
          xhttp.open("GET", "/ajax/"+id, true);
          xhttp.send();
    }
</script>

<script>
    $(document).ready(function() {
        $(".side-bar-department").addClass("side-bar-active");

        $(".delete").click(function(){
            $("#mymodal").show();
            $("#mymodal-content").show();
        });
        $(".modal-out").click(function(){
            $("#mymodal").fadeOut();
            $("#mymodal-content").fadeOut();
        });
        $("#mymodal").click(function(){
            $("#mymodal").fadeOut();
            $("#mymodal-content").fadeOut();
        });
    });

</script>

@endsection

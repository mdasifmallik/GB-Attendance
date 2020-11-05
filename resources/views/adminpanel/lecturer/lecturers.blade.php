@extends('layouts.adminpanel')


@section('content')

<!-- Particular sub-content area for Lecturers-->
<div class="admin-panel-sub-content" id="lecturers">
    <div class="admin-sub-heading">
        <h3>Lecturers</h3>
        <p>Click "Add New lecturer" to add a new lecturer or click the "Delete" button from the right side of the lecturer, to delete that lecturer.</p>
    </div>
    @if($dep)
    <div class="new-lecturer-button">
        <a class="default-button" href="/lecturer/create">Add New Lecturer</a>
    </div>
    <div class="admin-list table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dep->users as $user)

                    @if($user->islecturer())
                        <tr>
                            <th scope="row">{{$user->name}}</th>
                            <td>{{$user->email}}</td>
                            <td><button class="delete" onclick="modal({{$user->id}})"><i class="fas fa-trash-alt"></i></button></td>
                        </tr>
                    @endif

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


@section('modal')

<div id="mymodal">
</div>
<div id="mymodal-content">
    <h4>Are you sure, you want to delete this lecturer?</h4>
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
          xhttp.open("GET", "/lecturer/"+id, true);
          xhttp.send();
    }
</script>

<script>
    $(document).ready(function() {
        $(".side-bar-lecturer").addClass("side-bar-active");

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

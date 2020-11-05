@extends('layouts.adminpanel')



@section('content')

<!-- Particular sub-content area for Admins-->
<div class="admin-panel-sub-content" id="admins">
    <div class="admin-sub-heading">
        <h3>Department Admins</h3>
        <p>Click "Add New Admin" to add a new admin or click the "Delete" button from the right side of the admin, to delete those admin.</p>
    </div>
    <div class="new-admin-button">
        <a class="default-button" href="/admin/create">Add New Admin</a>
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
                @foreach($users as $user)                    
                    <tr>
                        <th scope="row">{{$user->name}}</th>
                        <td>{{$user->email}}</td>
                        <td><button class="delete" onclick="modal({{$user->id}})"><i class="fas fa-trash-alt"></i></button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection


@section('modal')

<div id="mymodal">
</div>
<div id="mymodal-content">
    <h4>Are you sure, you want to delete this admin?</h4>
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
          xhttp.open("GET", "/admin/"+id, true);
          xhttp.send();
    }
</script>

<script>
    $(document).ready(function() {
        $(".side-bar-admin").addClass("side-bar-active");

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

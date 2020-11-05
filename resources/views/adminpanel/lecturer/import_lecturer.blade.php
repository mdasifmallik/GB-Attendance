@extends('layouts.adminpanel')



@section('content')

<!-- Particular sub-content area for Add New Lecturer-->
<div class="admin-panel-sub-content" id="add-new-lecturer">
    <a class="back-button" href="lecturers.html"><i class="fas fa-angle-left"></i>Back to Lecturers</a>
    <div class="admin-sub-heading sub-sub-heading">
        <h3>Import Lecturer</h3>
        <p>Choose Department, you want to import a lecturer from & select the lecurer. You can also choose free lecturers.</p>
    </div>
    <div class="editing-area">

        <div class="editing-option">
            <form action="">
                <label for="">Department: </label>
                <select name="" id="">
                    <option value="">Free Lecturer</option>
                    <option value="">CSE</option>
                    <option value="">EEE</option>
                </select>
                <div class="search-button">
                    <input class="default-button" type="submit" value="Search">
                </div>
            </form>
        </div>
        <div class="admin-list table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Import</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">MD Karam Newaj</th>
                        <td><a href="">Import</a></td>
                    </tr>
                    <tr>
                        <th scope="row">MD Karam Newaj</th>
                        <td><a href="">Import</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection





@section('script')

<script>
    $(document).ready(function() {
        $(".side-bar-lecturer").addClass("side-bar-active");
    });

</script>

@endsection

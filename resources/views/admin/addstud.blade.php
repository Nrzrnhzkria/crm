@extends('layouts.app')

@section('title')
    Student
@endsection


@section('content')
@include('layouts.sidebar')

<div class="row pb-5">
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Add Details</h1>
        </div>

        <!-- Add student form --------------------------------------------------->
        <form action="{{ url('student/details') }}" method="POST"> 
        @csrf
            <div class="row py-3" style="padding-left: 8%">
                <div class='col-md-8'>         
                    <div class="form-group">
                        <label for="name">Name</label>
                    <input name="name" type="text" class="form-control" required>
                    </div>
                </div>

                <div class='col-md-8'>         
                    <div class="form-group">
                        <label for="name">IC No.</label>
                        <input name="ic" type="text" class="form-control" required>
                    </div>
                </div>

                <div class='col-md-8'>         
                    <div class="form-group">
                        <label for="name">Address</label>
                        <textarea name="address" type="text" class="form-control" required></textarea>
                    </div>
                </div>

                <div class='col-md-8'>         
                    <div class="form-group">
                        <label for="name">Phone No.</label>
                        <input name="phoneno" type="text" class="form-control" required>
                    </div>
                </div>

                <div class='col-md-8'>         
                    <div class="form-group">
                        <label for="name">Date of Birth</label>
                        <input name="birthdate" type="text" class="form-control" required>
                    </div>
                </div>

                <div class='col-md-8'>         
                    <div class="form-group">
                        <label for="name">Gender</label>
                        <input name="gender" type="text" class="form-control" required>
                    </div>
                </div>

                <div class='col-md-8'>         
                    <div class="form-group">
                        <label for="name">Company Name</label>
                        <input name="company" type="text" class="form-control" required>
                    </div>
                </div>

                <div class='col-md-8'>         
                    <div class="form-group">
                        <label for="name">Position</label>
                        <input name="position" type="text" class="form-control" required>
                    </div>
                </div>

                <div class='col-md-8'>         
                    <div class="form-group">
                        <label for="name">Salary</label>
                        <input name="salary" type="text" class="form-control" required>
                    </div>
                </div>
            </div>
                    
            <div class='col-md-8'>
                <button type='submit' class='btn btn-primary float-right'> Submit </button>
            </div>
        </form>

    </main>
</div>
@endsection
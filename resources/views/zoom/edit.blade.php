@extends('layouts.app')

@section('title')
    Zoom Webinar 
@endsection
@section('content')

    <div class="col-md-12 pt-3">
        <div class="card-header py-2" style="border: 1px solid rgb(233, 233, 233); border-radius: 5px;">
            <a href="/emailtemplate"><i class="bi bi-arrow-left"></i></a> &nbsp; <a href="dashboard">Dashboard</a> / <a href="/zoom">Zom Webinar</a> / <b>Create Zoom Webinar</b>
        </div>
    

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h2 class="h2">Create Zoom Webinar</h2>
        </div>
        <!-- Add package form ---------------------------------------------------->
        <form class="row g-3 px-3" action="/zoom/edit/{{$zoom->id}}" method="POST" id="dynamic_form" enctype="multipart/form-data"> 
            @method('PUT')
            @csrf
            <div class='row my-3'>
                <div class='col-md-6'>         
                    <div class="form-group">
                        <label for="name">Topic</label>
                        <input name="topic" type="text" value="{{$zoom->topic}}" class="form-control" required>
                    </div>
                </div>
        
                <div class='col-md-6'>
                    <div class="form-group">
                        <label for="name">Set password webinar</label>
                        <input name="password" type="text" class="form-control" value="{{$zoom->password}}" placeholder="Maximum 10 characters" required>
                    </div>
                </div>
            </div>
            
            <div class='row my-3'>
                <div class='col-md-6'>
                    <div class="form-group">
                        <label for="name">Start Time</label>
                        <input name="start" type="date" value="{{$zoom->start_time}}" class="form-control" required>
                    </div>
                </div>

                <div class='col-md-6'>
                    <div class="form-group">
                        <label for="name">End Time</label>
                        <input name="end" type="date" value="{{$zoom->end_time}}" class="form-control" required>
                    </div>
                </div>
            </div>
                
            <div class='col-md-8 pt-3'>
                <button type='submit' class='btn btn-primary'> <i class="fas fa-save pr-1"></i> Update</button>
            </div>
            
        </form>
        
    </div>
@endsection
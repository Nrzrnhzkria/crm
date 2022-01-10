@extends('layouts.app')

@section('title')
    Package 
@endsection
@section('content')
    <div class="col-md-12 pt-3">
        
        <div class="card-header py-2" style="border: 1px solid rgb(233, 233, 233); border-radius: 5px;">
        <a href="/emailtemplate"><i class="bi bi-arrow-left"></i></a> &nbsp; <a href="dashboard">Dashboard</a> / <a href="/emailtemplate">Email Template</a> / <b>Edit Email Template</b>
        </div>

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h2 class="h2">Edit Email Template</h2>
        </div>
        <!-- Add package form ---------------------------------------------------->
            <div class='row my-3'>
                <div class='col-md-6'>         
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input name="name" type="text" value="{{$emailTemplate->name}}" class="form-control" disabled>
                    </div>
                </div>
        
                <div class='col-md-6'>
                    <div class="form-group">
                        <label for="name">Title</label>
                        <input name="title" type="text" value="{{$emailTemplate -> title}}" class="form-control" disabled>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class='col-md-6'>
                    <div class="form-group">
                        <label for="name">Content</label>
                        <textarea name="content" class="ckeditor form-control" id="exampleFormControlTextarea1" rows="3">{{$emailTemplate -> content}}</textarea>
                    </div>
                </div>

                <div class='col-md-6'>
                    <div class="form-group">
                        <label for="name">Date</label>
                        <input name="date" type="date" value="{{$emailTemplate -> date}}" class="form-control" disabled>
                    </div>
                </div>
            </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            $('.ckeditor').ckeditor();
        });
    </script>
    
@endsection
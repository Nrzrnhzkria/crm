@extends('layouts.app')

@section('title')
  Zoom
@endsection


@section('content')
    <div class="col-md-12 px-4 py-4">   
        
        <div class="card-header py-2" style="border: 1px solid rgb(233, 233, 233); border-radius: 5px;">
            <a href="/dashboard"><i class="bi bi-arrow-left"></i></a> &nbsp; <a href="/dashboard">Dashboard</a> / <b>Zoom Webinar</b>
        </div> 
        
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Participants</h1>
        </div>
            
        <form action="{{ route('participantSearch', ['zoom' => $zoom->id, 'webinar' => $webinarId]) }}" class="input-group" method="GET">
            @csrf

            @if(isset($query))
            <input type="text" class="form-control" name="search" value="{{$query}}" placeholder="Search email">
            @else
            <input type="text" class="form-control" name="search" value="" placeholder="Search email">
            @endif
        </form>
        <br>       

        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-bs-dismiss="alert">×</button>	
                <strong>{{ $message }}</strong>
            </div>
        @endif
        
        @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-bs-dismiss="alert">×</button>	
                <strong>{{ $message }}</strong>
            </div>
        @endif
                
        <!-- View event details in table ----------------------------------------->
        <div class="table-responsive">
            <table class="table table-hover" id="myTable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col" class="text-center">Name</th>
                        <th scope="col" class="text-center">Email</th>
                        <th scope="col" class="text-right"><i class="fas fa-cogs"></i></th>
                    </tr>
                </thead>

                <tbody> 
                @foreach ($students as $key => $student)
                    <tr>
                        <td>{{( ($students->currentPage() - 1) * 10) + $key + 1}}</td>
                        <td class="text-center">{{$student -> first_name.' '.$student -> last_name}}</td>
                        <td class="text-center">{{$student -> email}}</td>
                        <td class="text-right">
                            <a class="btn btn-primary" href="/zoom/"><i class="bi bi-eye"></i></a>
                            <a class="btn btn-dark" href="/zoom/edit/"><i class="bi bi-pencil"></i></a>
                            <a class="btn btn-danger" href="/zoom/delete/"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>   
            @if(isset($query))
                {{ $students->appends(['search' => $query])->links() }} 
            @else
                {{ $students->links() }} 
            @endif
        </div> 
         

    </div>

    <script>
        $(document).ready(function () {
            setTimeout(function () {
                location.reload(true);
            }, 30000);
        });
    </script>

    

@endsection
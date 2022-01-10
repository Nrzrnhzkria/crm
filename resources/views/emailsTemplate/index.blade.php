@extends('layouts.app')

@section('title')
  Sales Report
@endsection


@section('content')
    <div class="col-md-12 px-4 py-4">   
        
        <div class="card-header py-2" style="border: 1px solid rgb(233, 233, 233); border-radius: 5px;">
            <a href="/dashboard"><i class="bi bi-arrow-left"></i></a> &nbsp; <a href="/dashboard">Dashboard</a> / <b>Email Template</b>
        </div> 
        
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Email Template</h1>
            
            <div class="btn-toolbar mb-2 mb-md-0">
                <a href="/emailtemplate/add" class="btn btn-outline-dark">
                    <i class="bi bi-plus-lg pr-2"></i> New Email Template
                </a>
            </div>
        </div>
            
        <form action="{{ route('emailSearch') }}" class="input-group" method="GET">
            @csrf

            @if(isset($query))
            <input type="text" class="form-control" name="search" value="{{$query}}" placeholder="Search name">
            @else
            <input type="text" class="form-control" name="search" value="" placeholder="Search name">
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
                        <th scope="col" class="text-center">Title </th>
                        <th scope="col" class="text-center">Name</th>
                        <th scope="col" class="text-right"><i class="fas fa-cogs"></i></th>
                    </tr>
                </thead>

                <tbody> 
                @foreach ($emailsTemplate as $key => $emailTemplate)
                    <tr>
                        <td>{{( ($emailsTemplate->currentPage() -1) * 10) + $key + 1}}</td>
                        <td class="text-center">{{$emailTemplate -> title}}</td>
                        <td class="text-center">{{$emailTemplate -> name}}</td>
                        <td class="text-right">
                            <a class="btn btn-primary" href="/emailtemplate/show/{{$emailTemplate->id}}"><i class="bi bi-eye"></i></i></a>
                            <a class="btn btn-dark" href="/emailtemplate/edit/{{$emailTemplate->id}}"><i class="bi bi-pencil"></i></i></a>
                            <a class="btn btn-danger" href="/emailtemplate/delete/{{$emailTemplate->id}}"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>  
            @if(isset($query))
                {{ $emailsTemplate->appends(['search' => $query])->links() }} 
            @else
                {{ $emailsTemplate->links() }} 
            @endif
        </div>  

    </div>

    

@endsection
@extends('layouts.app')

@section('title')
    Sales Tracking
@endsection


@section('content')

<div class="col-md-12 pt-3">
        
    <div class="card-header py-2" style="border: 1px solid rgb(233, 233, 233); border-radius: 5px;">
        <a href="{{ url('view/participant') }}/{{ $product->product_id }}/{{ $package->package_id }}"><i class="fas fa-arrow-left"></i></a> &nbsp; 
        <a href="/trackprogram">...</a> / <a href="{{ url('trackpackage') }}/{{ $product->product_id }}"> {{ $product->name }} </a> 
        / <a href="{{ url('view/participant') }}/{{ $product->product_id }}/{{ $package->package_id }}">{{ $package->name }}</a> / <b>Import Participant</b>
    </div>


    @if ($message = Session::get('failed'))
    <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-bs-dismiss="alert">×</button>	
        <strong>{{ $message }}</strong>
    </div>
    @endif

    <form action="{{ url('import/store-participant') }}/{{ $product->product_id }}/{{ $package->package_id }}" class="row" method="POST" enctype="multipart/form-data">
        @csrf

        <h5 class="pt-3">Import Participant</h5>

        <div class="input-group p-3">
            <input type="file" name="file" class="form-control" required>
            <button class="btn btn-dark"><i class="fas fa-upload pt-1"></i></button>
        </div>
        <em class="pl-3">Maximum upload file size: 8MB</em>

    </form>
        
    <div class="panel panel-default">

        <h5 class="pt-3 pb-2">How To Import ?</h5>

        <p>1) Please download this format before import to database.</p>
        <div class="row">
            <div class="col-md-12">
                {{-- <div class="card bg-light"> --}}
                    <div class="table-responsive">
                        <!-- Show details in table ----------------------------------------------->
                        <table class="table table-bordered table-sm" id="myTable">
                            <tr class="table-active">
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>IC No.</th>
                                <th>Email</th>
                                <th>Phone No</th>
                                <th>Ticket Type</th>
                            </tr>
                            <tr>
                                <td>John</td>
                                <td>Doe</td>
                                <td>900101014321</td>
                                <td>example@gmail.com</td>
                                <td>+60123456789</td>
                                <td>free</td>
                            </tr>
                        </table>
                    </div>
                {{-- </div> --}}

                <div class="row-fluid float-right pt-1">
                    <a class="btn btn-warning" href="{{ url('participant-format') }}/{{ $product->product_id }}/{{ $package->package_id }}"><i class="fas fa-download pr-2"></i>Download</a>
                </div>
            </div>
            
        </div>
        
    </div>
</div>
@endsection
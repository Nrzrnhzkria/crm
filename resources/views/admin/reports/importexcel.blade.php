@extends('layouts.app')

@section('title')
Sales Report
@endsection


@section('content')
<div class="col-md-12 pt-3">        
    <div class="card-header py-2" style="border: 1px solid rgb(233, 233, 233); border-radius: 5px;">
        <a href="{{ url('view/buyer') }}/{{ $product->product_id }}/{{ $package->package_id }}"><i class="bi bi-arrow-left"></i></a> &nbsp; <a href="/trackprogram">...</a>
        / <a href="{{ url('trackpackage') }}/{{ $product->product_id }}">{{ $product->name }}</a> 
        / <a href="{{ url('view/buyer') }}/{{ $product->product_id }}/{{ $package->package_id }}">{{ $package->name }}</a> / <b>Import Customer</b>
    </div>

    @if ($message = Session::get('failed'))
    <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-bs-dismiss="alert">×</button>	
        <strong>{{ $message }}</strong>
    </div>
    @endif

    <form action="{{ url('importExcel') }}/{{ $product->product_id }}/{{ $package->package_id }}" class="row" method="POST" enctype="multipart/form-data">
        @csrf

        <h5 class="py-3">Import Customer</h5>

        {{-- <div class="row-fluid"> --}}
            
            <div class="col-md-12">
                <div class="input-group">
                    <input type="file" name="file" class="form-control" required>
                </div>
                <em class="pl-3">Maximum upload file size: 8MB</em>
            </div>

            <div class="col-md-12">
                <div class="row-fluid float-right">
                    <button type="submit" class="btn btn-small btn-dark"><i class="bi bi-upload pr-2"></i>Upload</button>
                </div>
            </div>
            
        {{-- </div> --}}
    </form>
        
    <div class="panel panel-default">

        <h5 class="pt-3 pb-2">How To Import ?</h5>

        <p>1) Please download this format before import to database.</p>
        <div class="row pb-3">
            <div class="col-md-12">
                <div class="table-responsive">
                    <!-- Show details in table ----------------------------------------------->
                    <table class="table table-bordered table-sm" id="myTable">
                        <tr class="table-active">
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>IC No.</th>
                            <th>Email</th>
                            <th>Phone No</th>
                            <th>Price (RM)</th>
                            <th>Quantity</th>
                            <th>Total Payment</th>
                            <th>Pay Method</th>
                            {{-- <th>Ticket Type</th> --}}
                            <th>Offer ID</th>
                        </tr>
                        <tr>
                            <td>John</td>
                            <td>Doe</td>
                            <td>900101014321</td>
                            <td>example@gmail.com</td>
                            <td>+60123456789</td>
                            <td>199</td>
                            <td>1</td>
                            <td>199</td>
                            <td>FPX</td>
                            {{-- <td>free</td> --}}
                            <td>OFF001</td>
                        </tr>
                    </table>
                </div>

                <div class="row-fluid float-right">
                    <a class="btn btn-warning" href="{{ url('exportExcel') }}/{{ $product->product_id }}/{{ $package->package_id }}"><i class="bi bi-download pr-2"></i>Download</a>
                </div>
            </div>
            
        </div>
        
        <p>2) Just refer to this table for Offer ID column.</p>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <!-- Show details in table ----------------------------------------------->
                    <table class="table table-bordered table-sm">
                        <tr class="table-active">
                            <th>#</th>
                            <th>Offer ID</th>
                            <th>Description</th>
                        </tr>
						 @foreach ($offer as $offers)
                        <tr>
                            <td>{{ $count++ }}</td>
                            <td>{{ $offers->offer_id }}</td>
                            <td>{{ $offers->name }}</td>
                        </tr>
						@endforeach
                    </table>
                </div>
            </div>  
        </div>
    </div>
</div>

@endsection
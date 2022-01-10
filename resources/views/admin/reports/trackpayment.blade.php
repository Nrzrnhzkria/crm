@extends('layouts.app')

@section('title')
Sales Report
@endsection
  
@section('content')
<div class="col-md-12 pt-3"> 
        
    <div class="card-header py-2" style="border: 1px solid rgb(233, 233, 233); border-radius: 5px;">
        <a href="{{ url('view/buyer') }}/{{ $product->product_id }}/{{ $package->package_id }}"><i class="bi bi-arrow-left"></i></a> &nbsp; <a href="/trackprogram">...</a>
        / <a href="{{ url('trackpackage') }}/{{ $product->product_id }}">{{ $product->name }}</a> 
        / <a href="{{ url('view/buyer') }}/{{ $product->product_id }}/{{ $package->package_id }}">{{ $package->name }}</a> / <b>{{ $student->first_name }}</b>
    </div>
            
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Customer Information</h1>

        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group">
            <a class="btn btn-sm btn-outline-warning" href="{{ url('exportInvoice')}}/{{$product->product_id}}/{{$package->package_id}}/{{$student->stud_id}}/{{$payment->payment_id}}"><i class="bi bi-download pr-2"></i>Invoice</a>
            <a class="btn btn-sm btn-outline-warning" href="{{ url('exportReceipt')}}/{{$product->product_id}}/{{$package->package_id}}/{{$student->stud_id}}/{{$payment->payment_id}}"><i class="bi bi-download pr-2"></i>Receipt</a>
          </div>
        </div>
    </div>  

    <div class="row">      

        <div class="col-md-12">

            @if ($message = Session::get('purchased-sent'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-bs-dismiss="alert">×</button>	
                <strong>{{ $message }}</strong>
            </div>
            @endif 
            
            @if ($message = Session::get('updated-sent'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-bs-dismiss="alert">×</button>	
                <strong>{{ $message }}</strong>
            </div>
            @endif

            <form action="{{ url('updatepayment') }}/{{ $product->product_id }}/{{ $package->package_id }}/{{ $payment->payment_id }}/{{ $payment->stud_id }}" method="post">
                @csrf
            
                <div class="card mb-4">
                    <div class="card-header">
                    <b>Personal Details</b>
                    </div>
                    <div class="pt-3 px-4">

                        <div class="mb-3 row">
                            <label class="col-sm-2">IC No.</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="ic" value="{{ $student->ic }}">
                            </div>

                            <label class="col-sm-2">Phone No.</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="phoneno" value="{{ $student->phoneno }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-2">Name</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="first_name" value="{{ ucwords(strtolower($student->first_name)) }}" placeholder="First Name">
                                <input type="text" class="form-control" name="last_name" value="{{ ucwords(strtolower($student->last_name)) }}" placeholder="Last Name">
                            </div>

                            <label class="col-sm-2">Email Address</label>
                            <div class="col-sm-4">
                                
                                <input type="text" class="form-control" name="email" value="{{ $student->email }}">
                                
                                <br>
                                                
                                <!-- Purchased Modal Button -->
                                <button type="button" class="btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#purchaseModal"><i class="bi bi-envelope pr-2"></i>Purchased Email </button>
                                <!-- Purchased Modal Triggered -->
                                <div class="modal fade" id="purchaseModal" tabindex="-1" aria-labelledby="purchaseModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Sending Confirmation</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to send '<b>Pengesahan Pembelian Tiket</b>' to this customer?</p>
                                            <p>Example: </p>
                                            <div class="text-center">
                                                <img src="{{ asset('assets/images/pengesahan_tiket.jpg') }}" style="max-width:300px">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <a class="btn btn-sm btn-dark" href="{{ url('purchased-mail') }}/{{ $product->product_id }}/{{ $package->package_id }}/{{ $payment->payment_id }}/{{ $student->stud_id }}">
                                                Send
                                            </a>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                    <b>Payment Details</b>
                    </div>
                    <div class="pt-3 px-4">

                        <div class="mb-3 row">
                            <label class="col-sm-2">Package Name</label>
                            <div class="col-sm-4">
                                <p>: &nbsp;&nbsp;&nbsp; {{ $package->name }}</p>
                            </div>

                            <label class="col-sm-2">Date Purchase</label>
                            <div class="col-sm-4">
                                <p>: &nbsp;&nbsp;&nbsp; {{ date('d/m/Y', strtotime($payment->created_at)) }}</p>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-2">Quantity</label>
                            <div class="col-sm-4">
                                <p>: &nbsp;&nbsp;&nbsp; {{ $payment->quantity }}</p>
                            </div>

                            <label class="col-sm-2">Payment</label>
                            <div class="col-sm-4">
                                <p>: &nbsp;&nbsp;&nbsp; 
                                    RM {{ $payment->totalprice }}.00 &nbsp;
                                    @if ($payment->status == 'paid')
                                        <span class="badge rounded-pill bg-success"> &nbsp;{{ $payment->status }}&nbsp; </span>
                                    @elseif ($payment->status == 'due')
                                        <span class="badge rounded-pill bg-danger"> &nbsp;{{ $payment->status }}&nbsp; </span>
                                    @else
                                        <p>NULL</p>
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-2">Offer ID</label>
                            <div class="col-sm-4">
                                <select class="form-select form-control-sm" name="offer_id">
                                    <option value="{{ $payment->offer_id }}" readonly selected>-- {{ $payment->offer_id }} --</option>
                                    <option value="OFF001">OFF001</option>
                                    <option value="OFF002">OFF002</option>                                        
                                    <option value="OFF003">OFF003</option>
                                </select>
                            </div>

                            <label class="col-sm-2">Payment Status</label>
                            <div class="col-sm-4">
                                <select class="form-select form-control-sm" name="status">
                                    <option value="{{ $payment->status }}" readonly selected>-- {{ $payment->status }} --</option>
                                    <option value="paid">paid</option>
                                    <option value="due">due</option>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row-fluid text-right">                        
                    @if(Auth::user()->role_id == 'ROD003' || Auth::user()->role_id == 'ROD004')
                    @else
                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $payment->payment_id }}"><i class="bi bi-trash pr-2"></i>Delete</button>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal{{ $payment->payment_id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-start">
                                <p>This action will remove the details from the table :</p>
                                <ul>
                                  <li>Payment</li>
                                </ul>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <a class="btn btn-danger" href="{{ url('delete') }}/{{ $payment->payment_id }}/{{ $product->product_id }}/{{ $payment->package_id }}">Delete</a>
                            </div>
                        </div>
                        </div>
                    </div>
                    @endif
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save pr-2"></i>Save Changes</button>
                </div>

            </form>
            
        </div>

    </div>
</div>

@endsection
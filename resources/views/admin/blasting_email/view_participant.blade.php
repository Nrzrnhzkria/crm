@extends('layouts.app')

@section('title')
Email Blasting
@endsection
  

@section('content')

<div class="col-md-12 pt-3">
        
    <div class="card-header py-2" style="border: 1px solid rgb(233, 233, 233); border-radius: 5px;">
        <a href="{{ url('blast-participant')}}/{{ $product->product_id }}/{{ $package->package_id }}"><i class="bi bi-arrow-left"></i></a> &nbsp; <a href="/emailblast">...</a> 
        / <a href="{{ url('view')}}/{{ $product->product_id }}"> {{ $product->name }} </a> / <a href="{{ url('blast-participant')}}/{{ $product->product_id }}/{{ $package->package_id }}">{{ $package->name }}</a>
        / <b> {{ $student->first_name }} </b>
    </div>
            
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Customer Information</h1>
    </div> 

    <div class="row">            
                
        <div class="col-md-12">
            
            @if ($message = Session::get('update-mail'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-bs-dismiss="alert">×</button>	
                <strong>{{ $message }}</strong>
            </div>
            @endif

            <form action="{{ url('update-participant-mail') }}/{{ $product->product_id }}/{{ $package->package_id }}/{{ $ticket->ticket_id }}/{{ $student->stud_id }}" method="post">
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
                                <input type="text" class="form-control" name="first_name" value="{{ $student->first_name }}" placeholder="First Name">
                                <input type="text" class="form-control" name="last_name" value="{{ $student->last_name }}" placeholder="Last Name">
                            </div>

                            <label class="col-sm-2">Email Address</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="email" value="{{ $student->email }}">
                                
                                <br>
                                                
                                <!-- Purchased Modal Button -->
                                <button type="button" class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#purchaseModal"><i class="bi bi-envelope pr-2"></i> Participant Email </button>
                                <!-- Purchased Modal Triggered -->
                                <div class="modal fade" id="purchaseModal" tabindex="-1" aria-labelledby="purchaseModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Sending Confirmation</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to send '<b>Pengesahan Pendaftaran Peserta</b>' to this customer?</p>
                                            <p>Example: </p>
                                            <div class="text-center">
                                                <img src="{{ asset('assets/images/pengesahan_peserta.jpg') }}" style="max-width:300px">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <a class="btn btn-sm btn-dark" href="{{ url('participant-mail') }}/{{ $product->product_id }}/{{ $package->package_id }}/{{ $ticket->ticket_id }}/{{ $student->stud_id }}">
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
                    <b>Ticket Details</b>
                    </div>
                    <div class="pt-3 px-4">

                        <div class="mb-3 row">
                            <label class="col-sm-2">Package Name</label>
                            <div class="col-sm-4">
                                <p>: &nbsp;&nbsp;&nbsp; {{ $package->name }}</p>
                            </div>

                            <label class="col-sm-2">Date Registered</label>
                            <div class="col-sm-4">
                                <p>: &nbsp;&nbsp;&nbsp; {{ date('d/m/Y', strtotime($ticket->created_at)) }}</p>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-2">Ticket Type</label>
                            <div class="col-sm-4">
                                <p>: &nbsp;&nbsp;&nbsp; {{ $ticket->ticket_type }}</p>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-sm btn-outline-primary"><i class="bi bi-save pr-1"></i> Save Changes</button>
                </div>

                
            </form>

        </div>
    </div>
</div>

@endsection
@extends('layouts.app')

@section('title')
    Sales Report
@endsection
  

@section('content')

<div class="col-md-12 pt-3">        
    <div class="card-header py-2" style="border: 1px solid rgb(233, 233, 233); border-radius: 5px;">
        <a href="{{ url('view/participant') }}/{{ $product->product_id }}/{{ $package->package_id }}"><i class="bi bi-arrow-left"></i></a> &nbsp; 
        <a href="/trackprogram">...</a> / <a href="{{ url('trackpackage') }}/{{ $product->product_id }}">{{ $product->name }}</a> 
        / <a href="{{ url('view/participant') }}/{{ $product->product_id }}/{{ $package->package_id }}"> Participant </a> / <b>{{ $student->first_name }}</b>
    </div>
            
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Customer Information</h1>
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

            <form action="{{ url('ticket/update') }}/{{ $product->product_id }}/{{ $package->package_id }}/{{ $ticket->ticket_id }}/{{ $student->stud_id }}" method="post">
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
                                    
                                <!-- Participant Modal Button -->
                                <button type="button" class="btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#participantModal"><i class="bi bi-envelope pr-2"></i>Participant Email </button>
                                <!-- Participant Modal Triggered -->
                                <div class="modal fade" id="participantModal" tabindex="-1" aria-labelledby="participantModalLabel" aria-hidden="true">
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
                                            <a class="btn btn-sm btn-dark" href="{{ url('updated-mail') }}/{{ $product->product_id }}/{{ $package->package_id }}/{{ $ticket->ticket_id }}/{{ $student->stud_id }}">
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

                    </div>
                </div>

                <div class="row-fluid text-right">                        
                    @if(Auth::user()->role_id == 'ROD003' || Auth::user()->role_id == 'ROD004')
                    @else
                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $ticket->ticket_id }}"><i class="bi bi-trash pr-2"></i>Delete</button>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal{{ $ticket->ticket_id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-start">
                                <p>This action will remove the details from the table :</p>
                                <ul>
                                  <li>Ticket</li>
                                </ul>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <a class="btn btn-danger" href="{{ url('delete/ticket') }}/{{ $ticket->ticket_id }}/{{ $product->product_id }}/{{ $package->package_id }}">Delete</a>
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
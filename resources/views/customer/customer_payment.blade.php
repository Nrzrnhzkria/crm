@extends('layouts.app')

@section('title')
Customer Payments
@endsection

<style>
    .card {
      overflow: hidden;
    }
  
    .card-block .rotate {
      z-index: 8;
      float: right;
      height: 100%;
    }
  
    .card-block .rotate i {
      color: rgba(20, 20, 20, 0.15);
      position: absolute;
      left: 0;
      left: auto;
      right: -10px;
      bottom: 0;
      display: block;
      -webkit-transform: rotate(-44deg);
      -moz-transform: rotate(-44deg);
      -o-transform: rotate(-44deg);
      -ms-transform: rotate(-44deg);
      transform: rotate(-44deg);
    }
  </style>

  @section('content')
      <div class="col-md-12 pt-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url('customer_profiles') }}">Customer Profiles</a></li>
                <li class="breadcrumb-item"><a href="{{ url('customer_profiles') }}/{{ Request::segment(2) }}">Profile</a></li>
                <li class="breadcrumb-item active" aria-current="page">Customer Payment</li>
            </ol>
        </nav>

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Customer Payment</h1>
        </div>

        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6 pt-3">
                    <div class="card">
                        <div class="card-header">
                            <strong>Payment Details</strong>
                        </div>
                        @forelse ($payment as $key => $p)
                            <div class="card-body">
                                <form>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="event">Event Name</label>
                                            <input type="text" class="form-control" value="{{ $product->name }}" disabled>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="quantity">Quantity</label>
                                            <input type="text" class="form-control" value="{{ $p->quantity }}" disabled>
                                        </div>
                                    </div>
                
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="price">Price</label>
                                            <input type="text" class="form-control" value="RM {{ $p->totalprice }}.00" disabled>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="paid">Total Paid</label>
                                            <input type="text" class="form-control" value="RM {{ $p->pay_price }}.00" disabled>
                                            {{-- <input type="text" class="form-control" value="{{ date('d/m/Y', strtotime($p->created_at)) }}" disabled> --}}
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="Date paid">Date Paid</label>
                                            <input type="text" class="form-control" value="{{ date('d/m/Y', strtotime($p->created_at)) }}" disabled>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="Phone Number">Payment Status</label>
                                            @if (is_null($p->status))
                                                <input type="text" class="form-control" value="NULL" disabled>
                                            @else
                                                <input type="text" class="form-control" value="{{$p->status}}" disabled>
                                            @endif
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @empty
                        <div class="card-body">
                            <div class="col-md-12 text-center">
                                <p>No data found</p>
                            </div>
                        </div>
                        @endforelse
                    </div>
                </div>

                <div class="col-md-6 pt-3">
                    <div class="card">
                        <div class="card-header">
                            <strong>Ticket Details</strong>
                        </div>
                        @forelse ($ticket as $key => $t)
                            <div class="card-body">
                                <form>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="event">Event Name</label>
                                            <input type="text" class="form-control" value="{{ $product->name }}" disabled>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="quantity">Ticket Type</label>
                                            <input type="text" class="form-control" value="{{ $t->ticket_type }}" disabled>
                                        </div>
                                    </div>
                
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="price">Total Paid</label>
                                            <input type="text" class="form-control" value="RM {{ $t->pay_price }}.00" disabled>
                                        </div>
                                        {{-- <div class="form-group col-md-6">
                                            <label for="paid">Total Paid</label>
                                            <input type="text" class="form-control" value="RM {{ $t->pay_price }}.00" disabled>
                                        </div> --}}
                                    </div>

                                    {{-- <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="Date paid">Date Paid</label>
                                            <input type="text" class="form-control" value="{{ date('d/m/Y', strtotime($p->created_at)) }}" disabled>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="Phone Number">Payment Status</label>
                                            @if (is_null($p->status))
                                                <input type="text" class="form-control" value="NULL" disabled>
                                            @else
                                                <input type="text" class="form-control" value="{{$p->status}}" disabled>
                                            @endif
                                        </div>
                                    </div> --}}
                                </form>
                            </div>
                        @empty
                        <div class="card-body">
                            <div class="col-md-12 text-center">
                                <p>No data found</p>
                            </div>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
      </div>
  @endsection
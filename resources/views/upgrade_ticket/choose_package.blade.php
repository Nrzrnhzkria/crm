@extends('layouts.temp')

@section('title')
Upgrade Pakej
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 pt-5 pb-3 text-center">
            <img src="/assets/images/logo.png" style="max-width:150px">
            <h1 class="display-5 text-dark px-3 pt-4">{{ $product->name }}</h1>
        
            <h6>Hai {{ $student->first_name }}! Sila buat pilihan di bawah untuk naik taraf pakej.</h6>
        </div>

        <div class="col-md-12 py-3">
            <form action="{{ url('store-upgrade') }}/{{ $product->product_id }}/{{ $current_package->package_id }}/{{ $ticket->ticket_id }}" method="POST">
            @csrf
  
                <div class="container text-center">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-10 pb-4 d-block mx-auto">
                            <div class="pricing-item bg-white shadow rounded-3 py-4 px-2">
                                <div class="pb-2" style="letter-spacing: 2px">
                                    <h4>{{ $current_package->name }}</h4>
                                </div>
                                <div class="text-success" style="font-size: 75px">
                                    <i class="fa fa-check-circle"></i>
                                </div>
                                <div class="pricing-description">
                                    <ul class="list-unstyled mt-3 mb-1 py-2 px-1">
                                        @foreach($feature as $features)
                                        @if($current_package->package_id == $features->package_id)
                                            <li class="text-break">{{ $features->name }}</li>
                                            <hr class="my-1 mx-3">
                                        @endif
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="pricing-price pb-1 text-dark color-dark-text mb-3">
                                    <h1 style="font-weight: 1000; font-size: 3.5em;">
                                        <span style="font-size: 20px;">RM</span>{{ $ticket->pay_price }}
                                    </h1>
                                </div>
                                <div class="pricing-button pt-1 pb-1">
                                    <button type="button" class="btn btn-lg btn-outline-dark w-75" disabled>Pakej Semasa</button>
                                </div>
                            </div>
                        </div>
                        @foreach($package as $packages)
                        @if($current_package->price >= $packages->price)
                        @else
                        <div class="col-lg-4 col-md-6 col-sm-10 pb-4 d-block mx-auto">
                            <div class="pricing-item py-4 border border-secondary rounded-3">
                                <input type="hidden" value="{{ $product->product_id }}" class="form-control" name="product_id" readonly/>
                                
                                <div class="pb-2" style="letter-spacing: 2px">
                                    <h4>{{ $packages->name }}</h4>
                                </div>
                                <div class="text-success" style="font-size: 75px">
                                    <i class="fa fa-check-circle"></i>
                                </div>
                                <div class="pricing-description">
                                    <ul class="list-unstyled mt-3 mb-1 py-2 px-1">
                                        @foreach($feature as $features)
                                        @if($packages->package_id == $features->package_id)
                                        <li class="text-break">{{ $features->name }}</li>
                                        <hr class="m-1 mx-3">
                                        @endif
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="pricing-price pb-1 text-dark color-dark-text mb-3">
                                    <h1 style="font-weight: 1000; font-size: 3.5em;">
                                        <span style="font-size: 20px;">RM</span><span>{{ $packages->price }}</span>
                                    </h1>
                                </div>
                                <div class="pricing-button pt-1 pb-1">
                                    <button type="submit" class="btn btn-circle btn-lg btn-dark" name="package_id" value="{{ $packages->package_id }}"><i class="fas fa-arrow-right py-1"></i></button>
                                </div>
                            </div>
                        </div>
                        
                        @endif
                        @endforeach
                    </div>
                </div>
                
                    
            </form>
        </div>
    </div>
</div>
@endsection
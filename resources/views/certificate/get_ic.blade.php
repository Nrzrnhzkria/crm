@extends('layouts.temp')

@section('title')
E-Certificate
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 px-3 pt-5 pb-3 text-center">
        <img src="{{ asset('assets/images/logo.png') }}" style="max-width:150px">
        <h1 class="display-4 text-dark px-4 pt-3">{{ $product->name }}</h1>
    </div>

    <div class="col-md-12 py-3">
        <div class="container text-center">
            <div class="row">
                <div class="col-auto pb-4 d-block mx-auto">
                    <div class="pricing-item bg-white py-4 px-4" style=" box-shadow: 0px 0px 30px -7px rgba(0,0,0,0.29); border-radius: 5px;">
                        
                        <div class="lead px-3 py-3">Sila masukkan no. IC/passport bagi mendapatkan e-sijil</div>
                        <form action="{{ url('verify') }}/{{ $product->product_id }}" method="get">
                            @csrf
                            <div class="col-md-12 pb-4">
                                <input type="text" class="form-control" name="ic" placeholder="tanpa '-' .Cth: 91042409**** / A********" maxlength="12" required="" >
                            </div>
                            <div class="col-md-12 pb-5">
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-circle btn-lg btn-dark"><i class="fas fa-arrow-right"></i></button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="lead text-center px-4 py-2">
    <b>Momentum Internet (1079998-A) © 2020 All Rights Reserved​</b>
</footer>

@endsection
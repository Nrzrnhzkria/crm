@extends('layouts.temp')

@section('title')
Harap Maaf!
@endsection

<style>
  body {
    background-color:rgb(233, 233, 233)!important ; 
  }

</style>

@section('content')
<div class="row">
    <div class="col-md-12 px-5 py-4">
        <div class="text-center">
            <h3 class="display-4">Harap Maaf!</h3>
            <h3 class="display-4">Anda perlu melengkapkan borang kemaskini peserta</h3>
            <div class="py-3" style="font-size: 24px; color: red;">
            <i class="far fa-times-circle fa-8x text-center"></i>
            </div>
            <hr>
            <p class="lead">
                Sila <a href="{{ url('pendaftaran-peserta')}}/{{ $product->product_id }}">kemaskini peserta</a> terlebih dahulu untuk naik taraf pakej.
                Jika terdapat sebarang pertanyaan, sila <a href="http://bit.ly/journeymomentuminternet">hubungi kami.</a>
            </p>
        </div>
    </div>
</div>
@endsection
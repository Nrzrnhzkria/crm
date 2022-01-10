@extends('layouts.temp')

@section('title')
  Terima Kasih
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
        <h3 class="display-4">Terima Kasih!</h3>
        <h3 class="display-4">Anda telah berjaya menaik taraf pakej.</h3>
        <div class="py-3" style="font-size: 24px; color: green;">
          <i class="far fa-check-circle fa-8x text-center"></i>
        </div>
        <hr>
        <p class="lead"> Pengesahan naik taraf pakej akan dihantar kepada emel yang telah didaftarkan dalam masa 48 Jam. Terima kasih kerana menunggu. </p>
        <p class="lead py-3">
          Jika ada sebarang pertanyaan, sila <a href="https://momentuminternet.com/contactus/">hubungi kami.</a><br><br>
          {{-- <a class="btn btn-dark py-3 px-4" href="{{ url('updateform')}}/{{$product->product_id}}/{{$package->package_id}}/{{$student->stud_id}}/{{$payment->payment_id}}" role="button">Kemaskini</a> --}}
        </p>
    </div>
  </div>
</div>
@endsection
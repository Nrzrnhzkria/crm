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
        <h3 class="display-4">Anda telah mencapai had limit kemaskini peserta.</h3>
        <div class="py-3" style="font-size: 24px; color: red;">
          <i class="far fa-times-circle fa-8x text-center"></i>
        </div>
        <hr>
        <p class="lead">Jika ada sebarang pertanyaan, sila <a href="https://momentuminternet.com/contactus/">hubungi kami.</a></p>
    </div>
  </div>
</div>
@endsection
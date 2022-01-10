@extends('layouts.app')

@section('title')
Home
@endsection
<style>

  /* HERO */
  .hero-image {
    background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(/storage/cover_<?php echo url('/'); ?>/assets/images/23053.jpg);
    height: 70%;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    position: relative;
  }
  
  .hero-text {
    text-align: center;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: white;
  }
  
  .hero-text button {
    border: none;
    outline: 0;
    display: inline-block;
    padding: 10px 25px;
    color: black;
    background-color: #ddd;
    text-align: center;
    cursor: pointer;
  }
  
  .hero-text button:hover {
    background-color: rgb(19, 19, 19);
    color: white;
  }
</style>

@section('content')
<div class="row" style="height: 550px"> 
  <img src="/storage/cover_images/assets/images/background.png" style="height:550px; width:1350px; padding-left:10%" alt="...">

  <div class="col-md-6 top-left" style="padding-left: 10%;  padding-right: 5%; padding-top: 8%; ">
    <h1 style="font-size: 56px">Cara Memasarkan Perniagaan Anda Secara "<i>Online</i>".</h1>
  </div> 
  <div class="col-md-6 top-right">
    <img src="/storage/cover_images/assets/images/product.png" style="width:100%; padding-left: 3%; padding-right: 10%; padding-top: 8% " class="card-img-top float-right" alt="...">
  </div>
  
</div>
<div class="row center py-5" style="background-color:rgba(168, 214, 245, 0.884)">
  <div class="col-md-12 pb-4" style="text-align: center">
    <H6>Kami menyediakan bimbingan dan ilmu perniagaan kepada anda yang 
      mempunyai perniagaan konvensional atau online.</H6>
  </div>
  <div class="col-md-12 pb-1">
    <a class="btn btn-dark" href="#info">Maklumat Lanjut <i class="fas fa-level-down-alt"></i></a>
  </div>
</div>

<div class="row py-5 px-5" id="info"> 
  <div class="col-md-12">
    <h1 class="pb-5" style="text-align: center">PROGRAM KAMI</h1>
  </div> 
  @if(count($product) > 0)
    @foreach ($product as $products)
    <div class="col-md-4 animate__animated animate__backInLeft animate__delay-2s py-2">
      <img src="/storage/cover_<?php echo url('/'); ?>/assets/images/{{$products->cover_image}}" style="width:100%; border-radius: 0%" class="card-img-top" alt="...">
    </div>
    <div class="col-md-8 animate__animated animate__backInRight animate__delay-2s ">
        <h3>{{ $products->name  }}</h3>
        <div class="card-text blockquote-footer" style="font-size: 12pt; text-align: justify;"><p>{{ $products->description  }}</p>
        <a href="{{ url('showpackage') }}/{{ $products->product_id }}" class="btn btn-dark float-right">Daftar Sekarang <i class="fas fa-angle-double-right"></i></a>
      </div>
    </div>
    @endforeach
  @endif
</div>

<div class="row hero-image" style="background-attachment: fixed">
  <div class="hero-text">
    <h3 class="py-4">Satu platform yang menyediakan program untuk menginternetkan bisnes anda.</h3>
    <button><b>Hubungi Kami</b></button>
  </div>
</div>

<footer class="py-4" style="text-align: center">
  <b>MOMENTUM INTERNET (1079998-A) © 2020 ALL RIGHTS RESERVED​</b>
</footer>
@endsection

<script>
  // All animations will take twice the time to accomplish
document.documentElement.style.setProperty('--animate-duration', '2s');

// All animations will take half the time to accomplish
document.documentElement.style.setProperty('--animate-duration', '.5s');
</script>

@extends('layouts.temp')

@section('title')
    Home
@endsection

@section('content')

<div class="row">
  <img src="/assets/images/bg_4.jpg" class="img-fluid">

  <div class="col-md-12 px-5 pb-5">
    <h2 class="text-center pt-5">PROGRAM KAMI</h2>
    <div class="row">
      @if(count($product) > 0)
        @foreach ($product as $products)
        <div class="col-lg-4 px-5">
          <div class="media block-6 text-center d-block">
            <div class="media-body">
              <hr>
              <h3 class="heading pb-2">{{ $products->name  }}</h3>
              <p class="text-justify">{{ $products->description  }}</p>
            </div>
            <p><a href="{{ url('showpackage') }}/{{ $products->product_id }}" class="btn btn-warning py-3 px-4">Daftar Sekarang</a></p>
          </div>
        </div>
        @endforeach
      @endif
    </div>
  </div>
  
  <div class="col-md-12 px-5 py-5 bg-light">
    <div class="row justify-content-center pb-3">
      <div class="col-md-6 text-center">
        <span>BE THE NEXT</span>
        <h2 class="mb-4">NAK KAMI BANTU!!!</h2>
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
        <p><a href="#" class="btn btn-warning py-3 px-4">Nak Bimbingan</a></p>
      </div>
    </div>
  </div>

</div>

{{-- 
<section class="testimony-section bg-light">
<div class="container">
<div class="row ftco-animate justify-content-center">
<div class="col-md-6 d-flex">
<div class="testimony-img" style="background-image: url(<?php echo url('/'); ?>/assets/images/testimony-img.jpg);"></div>
</div>
<div class="col-md-6 py-5">
<div class="heading-section pb-4 pt-md-4 ftco-animate">
<h2 class="mb-0">Success Stories</h2>
</div>
<div class="carousel-testimony owl-carousel ftco-owl">
<div class="item">
<div class="testimony-wrap">
<div class="text">
<p class="mb-4"></p>
</div>
<div class="d-flex align-items-center">
<div class="user-img" style="background-image: url(<?php echo url('/'); ?>/assets/images/person_1.jpg)">
</div>
<div class="pos ml-3">
<p class="name">Fernando Obiga</p>
<span class="position">Businessman</span>
</div>
</div>
</div>
</div>
<div class="item">
<div class="testimony-wrap">
<div class="text">
<p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
</div>
<div class="d-flex align-items-center">
<div class="user-img" style="background-image: url(<?php echo url('/'); ?>/assets/images/person_1.jpg)">
</div>
<div class="pos ml-3">
<p class="name">Jeffrey Blatch</p>
<span class="position">Businessman</span>
</div>
</div>
</div>
</div>
<div class="item">
<div class="testimony-wrap">
<div class="text">
<p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
</div>
<div class="d-flex align-items-center">
<div class="user-img" style="background-image: url(<?php echo url('/'); ?>/assets/images/person_1.jpg)">
</div>
<div class="pos ml-3">
<p class="name">Henry Ford</p>
<span class="position">Businessman</span>
</div>
</div>
</div>
</div>
<div class="item">
<div class="testimony-wrap">
<div class="text">
<p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
</div>
<div class="d-flex align-items-center">
<div class="user-img" style="background-image: url(<?php echo url('/'); ?>/assets/images/person_1.jpg)">
</div>
<div class="pos ml-3">
<p class="name">Jeff Chan</p>
<span class="position">Businessman</span>
</div>
</div>
</div>
</div>
<div class="item">
<div class="testimony-wrap">
<div class="text">
<p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
</div>
<div class="d-flex align-items-center">
<div class="user-img" style="background-image: url(<?php echo url('/'); ?>/assets/images/person_1.jpg)">
</div>
<div class="pos ml-3">
<p class="name">Michael Bubble</p>
<span class="position">Businessman</span>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</section> --}}

<footer class="row">
  <div class="col-md-12 text-center px-5 py-5" style="color: black">
    <p>
    All Right Reserved © 2019 - 2018
    </p>
    <p> MOMENTUM INTERNET SDN BHD (1079998-A)</p>
    <p></p>
    <p>(GST - 001821650944)</p>
    <p>E sales@momentuminternet.com W www.najibasaddok.com</p>
    <p>Office (HQ) : 288, Jalan Lambak, 86000 Kluang, Johor Darul Tazim<p>
    <p>Branch : 20A & 22A, Jalan Rugbi 13/30, Seksyen 13, 40100 Shah Alam, Selangor Darul Ehsan</a></p>
  </div>
</footer>

@endsection
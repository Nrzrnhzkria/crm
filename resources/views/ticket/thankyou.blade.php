@extends('layouts.temp')

@section('title')
  Terima Kasih
@endsection

<style>
  body {
    background-color:rgb(233, 233, 233)!important ; 
  }

  /* .center-video {
    margin: auto;
    width: 50%;
    padding: 10px;
    text-align: center;
    } */

    .video-size{
      width: 600px;
    }

    @media screen and (max-width: 600px) {
  /* For mobile phones: */
    .center {
      margin: auto;
      width: 100%;
      padding: 10px;
      text-align: center;
    }

    .video-size{
      width: 100%;
    }
}

</style>

@section('content')
<div class="row">
  <div class="col-md-12 px-3 py-4">
    <div class="text-center">
        <h3 class="display-4">Kemaskini berjaya!</h3>
        {{-- <p class="lead pt-3">Anda <b>PERLU</b> mengemaskini nama peserta pada pautan yang diberikan di dalam emel yang telah didaftarkan.</p> --}}
        {{-- <p class="lead">2) Sila tonton video ini sampai habis untuk dapatkan info penting untuk tindakan selanjutnya.</p> --}}
        <div class="py-3" style="font-size: 24px; color: green;">
          <i class="far fa-check-circle fa-8x text-center"></i>
        </div>
        <a class="btn btn-primary" href="{{ $product_link }}" role="button">Zoom Link</a>
        
        {{-- <div class="mx-auto py-4"> --}}
          {{-- <div class="text-center mx-auto py-1">
            <iframe class="video-size" src="https://player.vimeo.com/video/556461041" height="315" width="560" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
          </div> --}}
        {{-- </div> --}}
 
        <hr>
        
        {{-- <p class="lead"> Emel akan diberikan dalam tempoh 48 Jam. Terima kasih kerana menunggu.</p> --}}
        <p class="lead">
          Jika terdapat sebarang pertanyaan, sila <a href="http://bit.ly/journeymomentuminternet" class="link-primary">hubungi kami.</a>
        </p>

    </div>
  </div>
</div>
@endsection
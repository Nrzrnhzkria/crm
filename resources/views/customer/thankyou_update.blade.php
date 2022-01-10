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
  <div class="col-md-12 px-5 py-5">
    <div class="text-center">
      <h3 class="display-4">Maklumat telah berjaya dikemaskini.</h3>
      <div class="py-3" style="font-size: 24px; color: green;">
        <i class="far fa-check-circle fa-6x text-center"></i>
      </div>
      <p class="lead py-2">Peserta perlu menjawab soalan kaji selidik ini untuk mendapatkan akses ke saluran Telegram khas. Segala maklumat berkaitan program akan dihebahkan di saluran tersebut.</p>
      
      <hr class="my-4">
      {{-- <p class="lead">Pengesahan pengemaskinian akan dihantar kepada emel yang telah didaftarkan dalam tempoh 48 Jam. Terima kasih kerana menunggu.</p> --}}
      <p class="lead">Jika terdapat sebarang pertanyaan, sila <a href="http://bit.ly/journeymomentuminternet" class="link-primary">hubungi kami.</a></p>
    </div>
  </div>
</div>
@endsection
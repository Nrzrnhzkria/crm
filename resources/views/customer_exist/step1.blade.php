@extends('layouts.temp')

@section('title')
Pendaftaran Pembeli
@endsection

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script>
{{-- Phone country code css -----------------------}}
<link rel="stylesheet" href="{{ URL::asset('assets/css/intlTelInput.css') }}" />

<style>
    .iti-flag {background-image: url(cover_images/flags.png);}

    @media (-webkit-min-device-pixle-ratio: 2), (min-resolution: 192dpi){
        .iti-flag {background-image: url(image/flag@2x.png);}
    }
</style>

<div class="row">
    <div class="col-md-12 px-3 pt-5 pb-3 text-center">
        <img src="/assets/images/logo.png" style="max-width:150px">
        <h1 class="display-5 text-dark px-3 pt-4">{{ $product->name }}</h1>
        <p>Hai! Terima kasih kerana masih setia menghadiri program kami. Sila semak butiran peribadi anda.</p>
    </div>

    <div class="col-md-6 offset-md-3 pb-5">
        <form action="{{ url('save1') }}/{{ $product->product_id }}/{{ $package->package_id }}/{{ $student->stud_id }}" method="POST">
            @csrf

            <div class="card px-4 py-4 shadow">
                <div class="bg-dark text-white px-2 py-2">Langkah 1/5: Maklumat Pembeli</div>

                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="px-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="form-group row">

                        <input type="hidden" value="{{ $student->stud_id }}" class="form-control" name="stud_id" readonly/>

                        <div class="col-md-12 pb-2">
                            <label for="description">No. Kad Pengenalan/Passport:</label>
                            <input type="text"  value="{{ $student->ic ?? '' }}" class="form-control" name="ic" readonly/>
                        </div>

                        <div class="col-md-6 pb-2">
                            <label for="title">Nama Pertama:</label>
                            <input type="text" value="{{ $student->first_name ?? '' }}" class="form-control" placeholder="Mohammad"  name="first_name">
                        </div>
                        <div class="col-md-6 pb-2">
                            <label for="title">Nama Akhir:</label>
                            <input type="text" value="{{ $student->last_name ?? '' }}" class="form-control" placeholder="Ali"  name="last_name">
                        </div>

                        <div class="col-md-6 pb-2">
                            <label for="description">Emel:</label>
                            <input type="email"  value="{{ $student->email ?? '' }}" class="form-control" name="email" placeholder="example@gmail.com"/>
                        </div>
                        
                        <div class="col-md-6 pb-2">
                            <label for="description">No. Telefon:</label><br>
                            <input id="input-phone" type="tel" name="phoneno" value="{{ $student->phoneno ?? '' }}" class="form-control" />
                            <label style="font-size: 10pt;"><em>Sila pilih kod negara Cth: *+60 dan isikan no anda *Cth: 1123456789</em></label>
                        </div>
                    </div>
                        
                </div>

                <div class="col-md-12">
                    <div class="pull-right">
                        <button type="submit" class="btn btn-circle btn-lg btn-dark"><i class="fas fa-arrow-right"></i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Phone country code -----------------------------------------------------------------------------------------------------}}
<script type="text/javascript" src="{{ URL::asset('assets/js/intlTelInput.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/cleave.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/test.js') }}"></script>
<script>
    var input = document.querySelector('#input-phone');
    var iti = window.intlTelInput (input,  {
        utilsScript:'js/utils.js'
    }); 
</script> 
{{-- End Phone country code -------------------------------------------------------------------------------------------------}}
@endsection
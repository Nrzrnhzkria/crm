@extends('layouts.temp')

@section('title')
E-Certificate
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 px-3 py-5 text-center">
            <img src="/assets/images/logo.png" style="max-width:200px">
            <h1 class="text-dark px-4 pt-3">{{ $product->name }}</h1>
            <h6>Hai! Tahniah kerana telah memberikan komitmen yang terbaik sehingga ke akhir program.</h6>
        </div>

        <div class="col-md-12 d-flex justify-content-center pb-5">  
            <div class="card w-100 shadow">
                <div class="card-header bg-dark text-white">Sila semak butiran peribadi anda</div>

                <div class="card-body">

                    <div class="form-group row">

                        <div class="col-md-6 pb-2">
                            <label for="title">No. Kad Pengenalan/Passport:</label>
                            <input type="text" value="{{ $student->ic }}" class="form-control" disabled/>
                        </div>
                        <div class="col-md-6 pb-2">
                            <label for="title">No. Telefon:</label>
                            <input type="text" value="{{ $student->phoneno }}" class="form-control" disabled/>
                        </div>

                        <div class="col-md-6 pb-2">
                            <label for="description">Nama Peserta:</label>
                            <input type="text"  value="{{ ucwords(strtolower($student->first_name)) }} {{ ucwords(strtolower($student->last_name)) }}" class="form-control" disabled/>
                        </div>
                        
                        <div class="col-md-6 pb-4">
                            <label for="description">Emel:</label><br>
                            <input type="tel"  value="{{ $student->email }}" class="form-control" disabled/>
                        </div>

                        <div class="col-md-12 text-center border-top border-bottom pt-2 pb-0">
                            <p>Sekiranya perlukan pembetulan butiran peribadi, sila <a href="http://bit.ly/journeymomentuminternet">hubungi kami</a>.</p>
                        </div>
                    </div>
                        
                </div>

                <div class="card-footer">
                    <div class="col-md-12">
                        <div class="pull-left">
                            <a href="{{ url('e-cert') }}/{{ $product->product_id }}" class="btn btn-circle btn-lg btn-outline-dark"><i class="fas fa-arrow-left" style="padding-top:35%"></i></a>
                        </div>
                    </div>

                    <div class="col-md-12 pb-3">
                        <div class="pull-right">
                            <a href="{{ url('certificate') }}/{{ $product->product_id }}/{{ $student->stud_id }}" class="btn btn-circle btn-lg btn-success"><i class="fas fa-check py-1"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
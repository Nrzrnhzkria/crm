@extends('layouts.temp')

@section('title')
Pendaftaran Pembeli
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 pt-5 pb-3 text-center">
        <img src="/assets/images/logo.png" style="max-width:150px">
        <h1 class="display-5 text-dark px-3 pt-4">{{ $product->name }}</h1>
    </div>

    <div class="col-md-6 offset-md-3 pb-5">
        <form action="{{ url('langkah-keempat') }}/{{ $product->product_id }}/{{ $package->package_id }}/{{ $student->stud_id }}" method="get" >
            {{ csrf_field() }}
            <div class="card px-4 py-4 shadow">
                <div class="bg-dark text-white px-2 py-2">Langkah 3/5: Pengesahan Pembelian</div>

                <div class="card-body px-2">

                    <table class="table table-borderless">
                        <tr>
                            <td class="w-50">No. Kad Pengenalan / Passport</td>
                            <td>:</td>
                            <td><strong>{{$student->ic}}</strong></td>
                        </tr>
                        <tr>
                            <td class="w-50">Nama Pembeli</td>
                            <td>:</td>
                            <td class="text-break"><strong>{{$stud->first_name }}</strong> <strong>{{$stud->last_name}}</strong></td>
                        </tr>
                        <tr>
                            <td class="w-50">Emel</td>
                            <td>:</td>
                            <td class="text-break"><strong>{{$stud->email }}</strong></td>
                        </tr>
                        <tr>
                            <td class="w-50">No. Telefon</td>
                            <td>:</td>
                            <td><strong>{{$stud->phoneno}}</strong></td>
                        </tr>
                        <tr>
                            <td class="w-50">Pakej</td>
                            <td>:</td>
                            <td class="text-break"><strong>{{$package->name}}</strong></td>
                        </tr>
                        <tr>
                            <td class="w-50">Kuantiti Tiket</td>
                            <td>:</td>
                            {{-- If get 1 free 1 ticket --}}
                            {{-- <td><strong>{{$payment->quantity}} (Free 1 General)</strong></td> --}}
                            {{-- If bulk ticket --}}
                            <td><strong>{{$payment->quantity}}</strong></td>
                        </tr>
                        <tr>
                            <td class="w-50">Jumlah Bayaran</td>
                            <td>:</td>
                            <td><strong>RM {{$payment->totalprice}}</strong></td>
                        </tr>
                    </table>

                    <hr>
                    <div class="col-md-12">
                        <p class="fs-6 text-center">Sila pastikan maklumat telah diisi dengan betul</p>
                    </div>
                    <hr>
                </div>

                <div class="col-md-12">
                    <div class="pull-left">
                        <a href="{{ url('langkah-kedua') }}/{{ $product->product_id }}/{{ $package->package_id }}/{{ $student->stud_id }}" class="btn btn-circle btn-lg btn-outline-dark"><i class="fas fa-arrow-left" style="padding-top:35%"></i></a>
                    </div>
                    <div class="pull-right">
                        <button type="button" class="btn btn-circle btn-lg btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-arrow-right py-1"></i></button>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">TERMA & SYARAT</h5>
                                    </div>
                                    <div class="modal-body">
                                        <ul class="px-4">
                                            <li class="text-justify py-2">Segala pembayaran yang telah dibuat kepada pihak penganjur untuk tujuan penyertaan program yang 
                                                telah didaftarkan <b>TIDAK AKAN DIKEMBALIKAN</b>.</li>

                                            <li class="text-justify py-2">Bayaran penuh yuran penyertaan program mestilah diselesaikan 7 hari sebelum program bermula. Kegagalan 
                                                menjelaskan baki bayaran yuran penyertaan anda sebelum program akan mengakibatkan penyertaan anda dibatalkan.</li>

                                            <li class="text-justify py-2">Sekiranya anda telah menjelaskan bayaran penuh bagi pakej yang ditawarkan, anda dibenarkan untuk menunda 
                                                ke program dan pakej yang sama pada tarikh yang akan datang dalam tempoh 6 bulan. Anda <b>MESTI</b> memaklumkan pihak 
                                                penganjur untuk tujuan ini secara bertulis.</li>

                                            <li class="text-justify py-2">Akan tetapi, sekiranya anda menunda program yang telah didaftarkan dan bayaran penuh masih belum dijelaskan, 
                                                jumlah yuran penyertaan program baru akan dikenakan mengikut harga dan pakej semasa. Perlu dijelaskan bahawa 
                                                anda tidak lagi berpeluang mendapatkan harga promosi yang ditawarkan pada tarikh borang ini ditandatangani.</li>
                                        </ul>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-dark">Setuju</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
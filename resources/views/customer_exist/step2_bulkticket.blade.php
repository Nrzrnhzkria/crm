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
        <form action="{{ url('save2') }}/{{ $product->product_id }}/{{ $package->package_id }}/{{ $student->stud_id }}" method="POST">
            @csrf
            <div class="card px-4 py-4 shadow">
                <div class="bg-dark text-white px-2 py-2">Langkah 2/5: Maklumat Tiket</div>

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
                        <input type="hidden" value="{{ $payment_id ?? ''}}" class="form-control" name="payment_id" readonly/>
                        <input type="hidden" value="{{ $product->product_id }}" class="form-control" name="product_id" readonly/>
                        <input type="hidden" value="{{ $package->package_id }}" class="form-control" name="package_id" readonly/>
                        <input type="hidden" value="{{ $student->stud_id }}" class="form-control" name="stud_id" readonly/>
                        <input type="hidden" value="{{ $product->offer_id }}" class="form-control" name="offer_id" readonly/>

                        <input type="hidden" value="{{ $ticket_id ?? ''}}" class="form-control" name="ticket_id" readonly/>
                        <input type="hidden" value="{{ $ticket_type ?? ''}}" class="form-control" name="ticket_type" readonly/>
                        <input type="hidden" value="{{ $student->ic }}" class="form-control" name="ic" readonly/>

                        <div class="col-md-6 pb-2">
                            <label for="package">Pakej:</label>
                            <input type="text"  value="{{ $package->name }}" class="form-control" readonly/>
                        </div>
                        <div class="col-md-6 pb-2">
                            <label for="price">Harga:</label>
                            <input type="text" value="{{ $package->price }}" class="form-control" readonly/>
                            <input type="hidden" id="price" name="price" value="{{ $package->price }}" readonly>
                            <input type="hidden" name="pay_price" value="{{ $package->price }}" readonly>
                        </div>
                        <div class="col-md-6 pb-2">
                            <label for="quantity">Kuantiti:</label>
                            <select id="quantity" name="quantity" onchange="myFunction(this.value)" value="{{ $payment->quantity ?? '' }}" class="form-select" required> 
                                <option value="" disabled selected>-- Tiket --</option>
                                @if ($product->offer_id == 'OFF004')
                                    <option value="1">1</option>
                                    <option value="3">3</option>
                                    <option value="5">5</option>
                                @else
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                @endif
                            </select>
                        </div>
                        <div class="col-md-6 pb-2">
                            <label for="totalprice">Jumlah Harga (RM)</label><br>
                            <h3><input type="text" id="jumlahharga" name="totalprice" value="{{ $payment->totalprice ?? '' }}" style="border: none; background-color: transparent;" readonly></h3>
                        </div>
                    </div>

                </div>
                
                <div class="col-md-12">
                    <div class="pull-left">
                        <a href="{{ url('langkah-pertama') }}/{{ $product->product_id }}/{{ $package->package_id }}/{{ $student->stud_id }}" class="btn btn-circle btn-lg btn-outline-dark"><i class="fas fa-arrow-left" style="padding-top:35%"></i></a>
                    </div>
                    <div class="pull-right">
                        <button type="submit" class="btn btn-circle btn-lg btn-dark"><i class="fas fa-arrow-right py-1"></i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>

</div>

<script>
    function myFunction(val) {

        var total;
        var package_name = '{{ $package->name }}';
        var price = '{{ $package->price }}';
        var package1 = '{{ $package_name[0]->name }}';
        var package2 = '{{ $package_name[1]->name }}';
        var package3 = '{{ $package_name[2]->name }}';
        var error = 'No such package';        
        var discount1 = 60;
        var discount2 = 120;


        if ('{{ $product->offer_id }}' == 'OFF004' ) {
            
            // for bulk ticket 1,3,5
            if (package_name == package1) {

                if ( price <= 10 )
                {
                    var prices = document.getElementById("price").value;
                    var total_price = val * prices;

                    var divobj = document.getElementById('jumlahharga');
                    divobj.value = total_price;

                } else if ( price > 10 && price <= 30 ){

                    if (val == 1) {
                        total = price * 1;
                    } else if (val == 3) {
                        total = price * 3;
                    } else {
                        total = (price * 5) - 10;
                    }
                    var totallagi = document.getElementById('jumlahharga');
                    totallagi.value = total;

                } else {
                
                    if (val == 1) {
                        total = price * 1;
                    } else if (val == 3) {
                        total = price * 3;
                    } else {
                        total = (price * 5) - 20;
                    }
                    var totallagi = document.getElementById('jumlahharga');
                    totallagi.value = total;

                }

            } else if (package_name == package2) {

                if (val == 1) {
                    total = price * 1;
                } else if (val == 3) {
                    total = price * 3;
                } else {
                    total = (price * 5) - discount1;
                }
                var totallagi = document.getElementById('jumlahharga');
                totallagi.value = Math.round(total);

            } else if (package_name == package3) {

                if (val == 1) {
                    total = price * 1;
                } else if (val == 3) {
                    total = price * 3;
                } else {
                    total = (price * 5) - discount2;
                }
                var totallagi = document.getElementById('jumlahharga');
                totallagi.value = Math.round(total);

            } else {
                
                var totallagi = document.getElementById('jumlahharga');
                totallagi.value = error;

            }

        } else {

            // for bulk ticket 1,2,3
            if (package_name == package1) {

                if ( price <= 10 )
                {
                    var prices = document.getElementById("price").value;
                    var total_price = val * prices;

                    var divobj = document.getElementById('jumlahharga');
                    divobj.value = total_price;

                } else if ( price > 10 && price <= 30 ){

                    if (val == 1) {
                        total = price * 1;
                    } else if (val == 2) {
                        total = price * 2;
                    } else {
                        total = (price * 3) * 0.7;
                    }
                    var totallagi = document.getElementById('jumlahharga');
                    totallagi.value = Math.round(total);

                } else {

                    if (val == 1) {
                        total = price * 1;
                    } else if (val == 2) {
                        total = price * 2;
                    } else {
                        total = (price * 3) * 0.7;
                    }
                    var totallagi = document.getElementById('jumlahharga');
                    totallagi.value = Math.round(total);

                }

            } else if (package_name == package2) {

                if (val == 1) {
                    total = price * 1;
                } else if (val == 2) {
                    total = price * 2;
                } else {
                    total = (price * 3) * 0.7;
                }
                var totallagi = document.getElementById('jumlahharga');
                totallagi.value = Math.round(total);

            } else if (package_name == package3) {

                if (val == 1) {
                    total = price * 1;
                } else if (val == 2) {
                    total = price * 2;
                } else {
                    total = (price * 3) * 0.7;
                }
                var totallagi = document.getElementById('jumlahharga');
                totallagi.value = Math.round(total);

            } else {

                var totallagi = document.getElementById('jumlahharga');
                totallagi.value = error;

            }


        }

    }
</script>

@endsection
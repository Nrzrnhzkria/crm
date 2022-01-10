@extends('layouts.temp')

@section('title')
Upgrade Pakej
@endsection

{{-- Custom button css ----------------------------}}
<style>
    .button {
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 32px 16px;
    border-radius: 5px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    margin: 4px 5px;
    transition-duration: 0.4s;
    cursor: pointer;
    }
    .button4 {
    background-color: #f3f3f3;
    color: #202020;
    border: 1px #e7e7e7 solid;
    width: 150px;
    }

    .button4:hover {background-color: #e7e7e7;}
</style>

@section('content')
<div class="row">
    <div class="col-md-12 pt-5 pb-3 text-center">
        <img src="/assets/images/logo.png" style="max-width:150px">
        <h1 class="display-5 text-dark px-3 pt-4">{{ $product->name }}</h1>
    </div>

    <div class="col-md-6 offset-md-3 pb-5">
        <form action="{{ url('store-details') }}/{{ $product->product_id }}/{{ $current_package->package_id }}/{{ $ticket->ticket_id }}" method="POST">
            @csrf

            <div class="card px-4 py-4 shadow">
                <div class="bg-dark text-white px-2 py-2">Maklumat Tiket</div>

                <div class="card-body px-2">

                    <div class="col-md-6 offset-md-3">
                        @foreach ($package as $packages)
                        @if ($new_package->package_id == $packages->package_id)
                        
                        <table class="table px-5">
                            <tr>
                                <td style="width: 10%">Pakej </td>
                                <td class="w-25 text-break">: &nbsp;&nbsp;&nbsp;&nbsp; {{ $packages->name }}</td>
                            </tr>
                            <tr>
                                <td style="width: 10%">Harga </td>
                                <td style="width: 10%">
                                    <input type="hidden" id="price" value="{{ $packages->price }}" disabled>
                                    : &nbsp;&nbsp;&nbsp;&nbsp; RM <input type="text" id="new_price" name="pay_price" value="{{ $new_package->pay_price ?? '' }}" style="border: none; width: 50px; outline: none;" readonly>
                                </td>
                            </tr>
                        </table> 
                        @endif  
                        @endforeach 
                    </div>

                    <div class="alert alert-info text-left" role="alert">
                        <i class="fas fa-info-circle pr-1 border-right border-info"></i>  Harga pakej di atas telah ditolak daripada pembayaran pakej sebelum
                    </div> 
                </div>

                <div class="col-md-12">
                    <div class="pull-left">
                        <a href="{{ url('upgrade-ticket') }}/{{ $product->product_id }}/{{ $current_package->package_id }}/{{$ticket->ticket_id}}" class="btn btn-circle btn-lg btn-outline-dark"><i class="fas fa-arrow-left" style="padding-top:35%"></i></a>
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

    var x = document.getElementById("price").value;
    var y = '{{ $ticket->pay_price }}';
    var z = x - y;

    /*display the result*/
    var total = document.getElementById('new_price');
    total.value = z;

</script>

@endsection
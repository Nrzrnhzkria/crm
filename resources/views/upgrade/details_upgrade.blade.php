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
<div class="container">
    <div class="row">
        <div class="col-md-12 px-3 pt-5 pb-3 text-center">
            <img src="/assets/images/logo.png" style="max-width:150px">
            <h1 class="display-4 text-dark px-4 pt-3">{{ $product->name }}</h1>
        </div>

        <div class="col-md-12 d-flex justify-content-center pb-5">
            <form action="{{ url('save-details') }}/{{ $product->product_id }}/{{ $current_package->package_id }}/{{ $student->stud_id }}/{{ $payment->payment_id }}" method="POST">
                @csrf
  
                <div class="card w-100 shadow">
                    <div class="card-header bg-dark text-white">Maklumat Tiket</div>
   
                    <div class="card-body px-3">

                        @foreach ($package as $packages)
                        @if ($new_package->package_id == $packages->package_id)
                        <table class="table table-borderless">
                            <tr>
                                <td >Pakej</td>
                                <td>:</td>
                                <td class="text-break">{{ $packages->name }}</td>
                            </tr>
                            <tr>
                                <td >Harga</td>
                                <td>:</td>
                                <td>
                                    <input type="hidden" id="price" value="{{ $packages->price }}" disabled>
                                    RM <input type="text" id="new_price" name="pay_price" value="{{ $new_package->price ?? '' }}" style="border: none; width: 40px; outline: none;" readonly>
                                </td>
                            </tr>
                            <tr>
                                <td >Kuantiti</td>
                                <td>:</td>
                                <td><input type="text" id="quantity" name="quantity" value="{{ $payment->quantity ?? '' }}" style="border: none; width: 40px; outline: none;" readonly></td>
                            </tr>
                            <tr class="border-bottom border-top">
                                <td >Jumlah Bayaran</td>
                                <td>:</td>
                                <td>RM <input type="text" id="new_total" class="text-center" name="totalprice" value="{{ $new_package->totalprice ?? '' }}" style="border: none; width: 40px; outline: none;" readonly></td>
                            </tr>
                        </table> 
                        @endif  
                        @endforeach 
                    </div>

                    <div class="card-footer">
                        <div class="col-md-12">
                            <div class="pull-left">
                                <a href="{{ url('upgrade-package') }}/{{ $product->product_id }}/{{ $current_package->package_id }}/{{ $student->stud_id }}/{{$payment->payment_id}}" class="btn btn-circle btn-lg btn-outline-dark"><i class="fas fa-arrow-left" style="padding-top:35%"></i></a>
                            </div>
                            <div class="pull-right">
                                <button type="submit" class="btn btn-circle btn-lg btn-dark"><i class="fas fa-arrow-right py-1"></i></button>
                            </div>
                        </div>
                    </div>
                </div>






{{-- -------------------------------------------------------------------- --}}






                {{-- <div class="container text-center">
                    <div class="row">
                        <div class="col-auto pb-4 d-block mx-auto">
                            <div class="pricing-item bg-white py-4 px-4" style=" box-shadow: 0px 0px 30px -7px rgba(0,0,0,0.29); border-radius: 5px;">
                                <div class="border-bottom pb-1" style="letter-spacing: 2px">
                                    <h4>Maklumat Tiket</h4>
                                </div>
                                
                                @foreach ($package as $packages)
                                @if ($new_package->package_id == $packages->package_id)
                                <div class="table-responsive">
                                    <table class="table table-borderless">
                                        <thead class="border-bottom">
                                            <tr>
                                                <th>Pakej</th>
                                                <th>Harga</th>
                                                <th>Kuantiti</th>
                                                <th class="text-center">Jumlah Bayaran</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ $packages->name }}</td>
                                                <td>
                                                    <input type="hidden" id="price" value="{{ $packages->price }}" disabled>
                                                    RM <input type="text" id="new_price" name="pay_price" value="{{ $new_package->price ?? '' }}" style="border: none; width: 40px; outline: none;" readonly>
                                                    
                                                    
                                                </td>
                                                <td>
                                                    <input type="text" id="quantity" name="quantity" value="{{ $payment->quantity ?? '' }}" style="border: none; width: 40px; outline: none;" readonly>
                                                </td>
                                                <td class="text-center">
                                                    RM <input type="text" id="new_total" class="text-center" name="totalprice" value="{{ $new_package->totalprice ?? '' }}" style="border: none; width: 40px; outline: none;" readonly>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>   
                                @endif  
                                @endforeach                           

                                <div class="row-fluid pt-1">
                                    <div class="alert alert-info text-left" role="alert">
                                         <i class="fas fa-info-circle pr-1 border-right border-info"></i>  Harga pakej di atas telah ditolak daripada pembayaran pakej sebelum
                                     </div> 
                                 </div>                               
                                <div class="col-md-12 pb-5">
                                    <div class="pull-left">
                                        <a href="{{ url('upgrade-package') }}/{{ $product->product_id }}/{{ $current_package->package_id }}/{{ $student->stud_id }}/{{$payment->payment_id}}" class="btn btn-circle btn-lg btn-outline-dark"><i class="fas fa-arrow-left" style="padding-top:35%"></i></a>
                                    </div>
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-circle btn-lg btn-dark"><i class="fas fa-arrow-right py-1"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                
                    
            </form>
        </div>
    </div>
</div>



<script>
    var x = document.getElementById("price").value;
    var y = '{{ $current_package->price }}';
    var z = x - y;

    /*display the result*/
    var total = document.getElementById('new_price');
    total.value = z;

    // document.getElementById("show_price").innerHTML = z;
    console.log(z);
</script>

<script>
    var a = document.getElementById("quantity").value;
    var b = document.getElementById("new_price").value;
    var c = b * a;

    /*display the result*/
    var divobj = document.getElementById('new_total');
    divobj.value = c;

    console.log(c);
// function new_amount(val) {
        
//     var newprice = document.getElementById("new_price").value;
//     var newamount = val * newprice;

//     /*display the result*/
//     var divobj = document.getElementById('new_total');
//     divobj.value = newamount;

//     console.log(newamount);
// }
</script>
@endsection
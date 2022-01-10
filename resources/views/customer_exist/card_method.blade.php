@extends('layouts.temp')

@section('title')
Pendaftaran Pembeli
@endsection

{{-- Style to remove arrow in number input ---------}}
<style>
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
    }

    /* Firefox */
    input[type=number] {
    -moz-appearance: textfield;
    }
</style>

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 px-3 py-5 text-center">
            <img src="/assets/images/logo.png" style="max-width:200px">
            <h1 class="display-4 text-dark px-4 pt-3">{{ $product->name }}</h1>
        </div>

        <div class="col-md-12 d-flex justify-content-center pb-5">
            <form action="{{ url('saveStripe') }}/{{ $product->product_id }}/{{ $package->package_id }}/{{ $student->stud_id }}" method="POST" onsubmit="return checkForm(this);" data-stripe-publishable-key="pk_live_lNl5S8TossaoQYO0qKwSM5pr004b28isKu">
                @csrf
                <div class="card w-100 shadow">
                    <div class="card-header bg-dark text-white">Langkah 5/5: Pembayaran Tiket</div>
  
                    <div class="card-body">

                        @if(session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }} 
                        </div>
                        @endif
  
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <img class="img-responsive" style="width:200px" src="https://www.hydrohotel.co.im/wp-content/uploads/2020/03/payment-options.png">

                        <div class="form-group px-2">
                            <input class="form-control" type="text" name="cardholder" placeholder="Name on Card" required>
                        </div>

                        <div class="field px-2">

                            <!-- A Stripe Element will be inserted here. -->
                            <div id="card-element"></div>

                            <!-- Used to display form errors. -->
                            <div id="card-errors" role="alert"></div>
                            
                        </div>

                        <div class="form-group px-2">
                            <input  class="creditcard form-control" name="cardnumber" placeholder="Card Number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                            type="number" maxlength="16" required="">
                        </div>

                        <div class="field px-2">
                            <div class="two fields">
                                <div class="field">
                                    <div class="row">
                                        <div class="col">
                                            <input class="form-control" type="number" name="month" placeholder="MM" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="2" required="">
                                        </div>
                                        /
                                        <div class="col">
                                            <input class="form-control" type="number" name="year" placeholder="YYYY" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="4" required="">
                                        </div>
                                    </div>
                                </div>
            
                                <div class="field py-3">
                                    <input class="form-control" type="number" name="cvc" placeholder="CVC Code" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="3" required>
                                </div>
                                <input type="hidden" name="jumlah" class="col-sm-6 text-left pt-2" value="{{ $payment->totalprice }}" readonly >
                            </div>
                        </div>

                    </div>

                    <div class="card-footer">
                        <div class="col-md-12">
                            <div class="pull-left">
                                <a href="{{ url('langkah-keempat') }}/{{ $product->product_id }}/{{ $package->package_id }}/{{ $student->stud_id }}" class="btn btn-circle btn-lg btn-outline-dark"><i class="fas fa-arrow-left" style="padding-top:35%"></i></a>
                            </div>
                            <div class="pull-right">
                                <button type="submit" name="myButton" class="btn btn-circle btn-lg btn-success"><i class="fas fa-check py-1"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Disabled multiple submission on payment --------------------------------------------------------------------------------}}
<script type="text/javascript">

    function checkForm(form) // Submit button clicked
    {
        form.myButton.disabled = true;
        form.myButton.value = "Wait...";
        return true;
    }

</script>
{{-- End Disabled multiple submission on payment ----------------------------------------------------------------------------}}
@endsection
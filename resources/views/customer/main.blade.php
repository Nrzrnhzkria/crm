@extends('layouts.temp')

@section('title')
    Ticket
@endsection

<style>
	.login-html{
		border-radius: 5px;
		background:rgba(0, 0, 0, 0.8);
	}

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

<div class="col-md-12 px-2 pt-5 text-center">
    <img src="/assets/images/logo.png" style="max-width:200px">
    <h1 class="display-4 text-dark px-4 pt-3">{{ $product->name }}</h1>
</div>

<div id="msform" class="px-2 py-3">
	<fieldset>
		<div class="pb-3">Sila isikan No. Kad Pengenalan / Passport</div>
		<form action="{{ url('verification') }}/{{ $product->product_id }}/{{ $package->package_id }}" method="get">
			@csrf
			<div class="col-md-12">
				<input type="text" class="form-control" name="ic" placeholder="tanpa '-'" maxlength="12" required="" >
				<p style="font-size: 10pt; color:#202020; text-align: left;"><em>Cth: 91042409**** / A********</em></p>
			</div>
			<div class="col-md-12 pt-3">
				<button type="submit" class="text-white btn btn-block" style="background-color: #202020">Seterusnya</button>
			</div>
		</form>
	</fieldset>
</div>

<footer class="text-center px-4 py-5">
  <b>Momentum Internet (1079998-A) © 2020 All Rights Reserved​</b>
</footer>

@endsection
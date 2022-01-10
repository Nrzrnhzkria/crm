@extends('studentportal.app')

@section('title')
    Invoices & Receipt
@endsection

@section('content')
<div class="col-md-12 px-4 py-4">   
  <div class="card-header py-2" style="border: 1px solid rgb(233, 233, 233); border-radius: 5px;">
    <a href="{{ route('student.dashboard') }}"><i class="bi bi-arrow-left"></i></a> &nbsp; <a href="{{ route('student.dashboard') }}">Dashboard</a> / <b>Invoices & Receipt</b>
  </div> 
     
  <div class="flex-md-nowrap pt-3 pb-2 mb-3 border-bottom ">
      <h1 class="h2">Invoices & Receipt</h1>
  </div> 
  
  <div class="row">
    <div class="col-md-4">
        <a href="{{ route('invoices-receipt.invoices') }}" class="text-decoration-none text-dark">
            <div class="card border">
                <div class="card-body">
                    <h4><i class="fas fa-file-invoice"></i> Invoices</h4>
                    <p>You can check the list of paid or unpaid invoices in the list of invoices you have received from Momentum Internet. You can also download from the list of invoices you see here.</p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-4">
        <a href="{{ route('invoices-receipt.receipt') }}" class="text-decoration-none text-dark">
            <div class="card border">
                <div class="card-body">
                    <h4><i class="fas fa-receipt"></i> Receipt</h4>
                    <p>You can check the list of paid reeipt in the list of receipt you have received from Momentum Internet. You can also download from the list of receipt you see here. Thank You.</p>
                </div>
            </div>
        </a>
    </div>
  </div>
</div>
@endsection

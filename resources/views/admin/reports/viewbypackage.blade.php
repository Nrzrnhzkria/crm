@extends('layouts.app')

@section('title')
Sales Report
@endsection


@section('content')
<div class="col-md-12 pt-3">     
    <div class="card-header py-2" style="border: 1px solid rgb(233, 233, 233); border-radius: 5px;">
      <a href="{{ url('trackpackage') }}/{{ $product->product_id }}"><i class="bi bi-arrow-left"></i></a> &nbsp; <a href="/dashboard">...</a>
      / <a href="/trackprogram">Sales Report</a> / <a href="{{ url('trackpackage') }}/{{ $product->product_id }}"> {{ $product->name }} </a> 
      / <b>{{ $package->name }}</b>
    </div>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">{{ $package->name }}</h1>

      <div class="btn-group">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#newcustomer">
          <i class="bi bi-plus-lg pr-2"></i>New Customer
        </button>
        <!-- Modal -->
        <div class="modal fade" id="newcustomer" tabindex="-1" role="dialog" aria-labelledby="newcustomerLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="exampleModalLabel">Add New Customer</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="{{ url('new-customer/save') }}/{{ $product->product_id }}/{{ $package->package_id }}" method="POST"> 
              @csrf
                <div class="form-group row px-4">
                    <label for="ic" class="col-sm-4 col-form-label">IC No.</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" name="ic" placeholder="950101012036" maxlength="12" required>
                    </div>
                </div>
                <div class="form-group row px-4">
                    <label for="name" class="col-sm-4 col-form-label">First Name</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" name="first_name" placeholder="John" required>
                    </div>
                </div>
                <div class="form-group row px-4">
                    <label for="name" class="col-sm-4 col-form-label">Last Name</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" name="last_name" placeholder="Doe" required>
                    </div>
                </div>
                <div class="form-group row px-4">
                    <label for="name" class="col-sm-4 col-form-label">Tel No.</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" name="phoneno" placeholder="+60123456789" value="+60" required>
                    </div>
                </div>
                <div class="form-group row px-4">
                    <label for="name" class="col-sm-4 col-form-label">Email</label>
                    <div class="col-sm-8">
                    <input type="email" class="form-control" name="email" placeholder="example@gmail.com" required>
                    </div>
                </div>

                <hr>

                <div class="form-group row px-4">
                  <label for="ic" class="col-sm-4 col-form-label">Price (RM)</label>
                  <div class="col-sm-8">
                  <input type="text" class="form-control" name="pay_price" id="price" value="{{ $package->price }}" required>   
                  </div>
                </div>
                <div class="form-group row px-4">
                    <label for="name" class="col-sm-4 col-form-label">Quantity</label>
                    <div class="col-sm-8">
                      <select id="quantity" name="quantity" onchange="calculateAmount(this.value)" class="form-select" required>
                        <option value="" disabled selected>-- Tiket --</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                      </select>
                    </div>
                </div>
                <div class="form-group row px-4">
                    <label for="name" class="col-sm-4 col-form-label">Total Payment (RM)</label>
                    <div class="col-sm-8">
                      <input type="text" id="totalprice" class="form-control" name="totalprice" style="border: none; outline-width: 0; background-color: #fff;" readonly>
                    </div>
                </div>

                <hr>

                <div class="form-group row px-4">
                  <label for="name" class="col-sm-4 col-form-label">Offer Type</label>
                  <div class="col-sm-8">
                    <select name="offer_id" class="form-select" required>
                      <option value="" disabled selected>-- Please Choose --</option>
                      @foreach($offer as $offers)
                      <option value="{{ $offers->offer_id }}">{{ $offers->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class='col-md-12 text-right px-4 pb-4'>
                  <button type='submit' class='btn btn-success'> <i class="bi bi-save pr-2"></i>Save</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <a href="{{ url('import-customer') }}/{{ $product->product_id }}/{{ $package->package_id }}" class="btn btn-sm btn-outline-dark"><i class="bi bi-upload pr-2"></i>Import Customer</a>
      </div>
        
    </div>

    <!-- Show data in cards --------------------------------------------------->
    <div class="row mb-3">
      <div class="col-xl-3 col-lg-6 py-2">
        <div class="card border-0 gradient-1 shadow text-center">
          <h6 class="pt-3">Paid Ticket</h6>
          <b class="display-6 pb-3">{{ number_format($totalsuccess) }}</b>
        </div>
      </div>
      <div class="col-xl-3 col-lg-6 py-2">
        <div class="card border-0 gradient-2 shadow text-center">
          <h6 class="pt-3">Free Ticket</h6>
          <b class="display-6 pb-3">{{ number_format($freeticket) }}</b>
        </div>
      </div>
      <div class="col-xl-3 col-lg-6 py-2">
        <div class="card border-0 gradient-3 shadow text-center">
          <h6 class="pt-3">Updated Participant</h6>
          <b class="display-6 pb-3">{{ number_format($paidticket) }}</b>
        </div>
      </div>
      <div class="col-xl-3 col-lg-6 py-2">
        <div class="card border-0 gradient-4 shadow text-center">
          <h6 class="pt-3">Pending Payment</h6>
          <b class="display-6 pb-3">{{ number_format($totalcancel) }}</b>
        </div>
      </div>
    </div>  
    
    @if ($message = Session::get('addsuccess'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-bs-dismiss="alert">×</button>	
        <strong>{{ $message }}</strong>
    </div>
    @endif

    @if ($message = Session::get('importsuccess'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-bs-dismiss="alert">×</button>	
        <strong>{{ $message }}</strong>
    </div>
    @endif

    @if ($message = Session::get('updatepayment'))
    <div class="alert alert-info alert-block">
        <button type="button" class="close" data-bs-dismiss="alert">×</button>	
        <strong>{{ $message }}</strong>
    </div>
    @endif

    @if ($message = Session::get('deletepayment'))
    <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-bs-dismiss="alert">×</button>	
        <strong>{{ $message }}</strong>
    </div>
    @endif

    @if ($message = Session::get('search-error'))
    <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-bs-dismiss="alert">×</button>	
        <strong>{{ $message }}</strong>
    </div>
    @endif

    <!-- Search box ---------------------------------------------------------->
    <form action="{{ url('customer/search') }}/{{ $product->product_id }}/{{ $package->package_id }}" method="GET" class="needs-validation" novalidate>
        @csrf
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Enter IC Number" name="search" required>
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
            </div>
        </div>
    </form>

    <!-- Show success payment in table ----------------------------------------------->
    {{-- <div class="float-right">{{$payment->links()}}</div>    --}}
    @if(isset($details))
    <div class="table-responsive">
      <table class="table table-hover">
          <thead>
          <tr class="header">
            <th>#</th>
            <th>IC No.</th>
            <th>Name</th>
            <th>Email</th>
            <th>Status</th>
            <th class="text-center">Update Participant</th> 
            <th><i class="fas fa-cogs"></i></th>
          </tr>
          </thead>
          <tbody> 
            @foreach ($student as $students) 
            @foreach ($payment as $payments)  
            @if ($students->stud_id == $payments->stud_id)
            {{-- @if ($payments->product_id == $product->product_id)   --}}
            <tr>
                <td>{{ $count++ }}</td>
                <td>{{ $students->ic }}</td>
                <td>{{ ucwords(strtolower($students->first_name)) }} {{ ucwords(strtolower($students->last_name)) }}</td>
                <td>{{ $students->email }}</td>
                <td>
                  @if ($payments->status == 'paid')
                    <span class="badge rounded-pill bg-success"> &nbsp;{{ $payments->status }}&nbsp; </span>
                  @elseif ($payments->status == 'due')
                    <span class="badge rounded-pill bg-danger"> &nbsp;{{ $payments->status }}&nbsp; </span>
                  @else
                    <p>NULL</p>
                  @endif
                </td>
                <td class="text-center">
                  @if ($payments->update_count == 1)
                    <i class="bi bi-check-lg" style="color:green"></i>
                  @elseif ($payments->update_count == Null)
                    <i class="bi bi-x-lg" style="color:red"></i>
                  @else
                    <p>NULL</p>
                  @endif
                </td>
                <td>
                  <a class="btn btn-dark" href="{{ url('viewpayment') }}/{{ $product->product_id }}/{{ $payments->package_id }}/{{ $payments->payment_id }}/{{ $payments->stud_id }}"><i class="bi bi-chevron-right"></i></a>
                </td>
            </tr>
            {{-- @endif --}}
            @endif
            @endforeach
            @endforeach
          
          </tbody>
      </table> 
    </div> 
    @endif

    <div class="table-responsive">
      <table class="table table-hover">
        <thead>
        <tr class="header">
          <th>#</th>
          <th>IC No.</th>
          <th>Name</th>
          <th>Email</th>
          <th class="text-center">Update Participant</th> 
          <th><i class="fas fa-cogs"></i></th>
        </tr>
        </thead>
        <tbody> 
          @foreach ($student as $students)   
          @foreach ($payment as $payments)
          @if ($students->stud_id == $payments->stud_id)
          @if ($payments->product_id == $product->product_id)  
          <tr>
              <td>{{ $count++ }}</td>
              <td>{{ $students->ic }}</td>
              <td>{{ ucwords(strtolower($students->first_name)) }} {{ ucwords(strtolower($students->last_name)) }}</td>
              <td>{{ $students->email }}</td>
              <td class="text-center">
                @if ($payments->update_count == 1)
                  <i class="bi bi-check-lg" style="color:green"></i>
                @elseif ($payments->update_count == Null)
                  <i class="bi bi-x-lg" style="color:red"></i>
                @else
                  <p>NULL</p>
                @endif
              </td>
              <td>
                <a class="btn btn-dark" href="{{ url('viewpayment') }}/{{ $product->product_id }}/{{ $payments->package_id }}/{{ $payments->payment_id }}/{{ $payments->stud_id }}"><i class="bi bi-chevron-right"></i></a>
              </td>
          </tr>
          @endif
          @endif
          @endforeach
          @endforeach
        </tbody>
      </table>  
    </div>
  </div>
</div>

<!--
|--------------------------------------------------------------------------
| Search validation
|--------------------------------------------------------------------------
-->
<script>
  // Example starter JavaScript for disabling form submissions if there are invalid fields
  (function() {
    'use strict';
    window.addEventListener('load', function() {
      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.getElementsByClassName('needs-validation');
      // Loop over them and prevent submission
      var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
          if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    }, false);
  })();
</script>

<!--
|--------------------------------------------------------------------------
| This function is to calculate Total Price
|--------------------------------------------------------------------------
-->
<script>
  function calculateAmount(val) {
      
    var prices = document.getElementById("price").value;
    var total_price = val * prices;

    /*display the result*/
    var divobj = document.getElementById('totalprice');
    divobj.value = total_price;

  }
</script>
@endsection

@extends('layouts.app')

@section('title')
  Email Blasting
@endsection


@section('content')

<div class="col-md-12 pt-3">   
    
  <div class="card-header py-2" style="border: 1px solid rgb(233, 233, 233); border-radius: 5px;">
    <a href="{{ url('view')}}/{{ $product->product_id }}"><i class="bi bi-arrow-left"></i></a> &nbsp; <a href="/dashboard">...</a> / <a href="/emailblast">Email Blasting</a> 
    / <a href="{{ url('view')}}/{{ $product->product_id }}"> {{ $product->name }} </a> / <b>{{ $package->name }}</b>
  </div>

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">{{ $package->name }}</h1>
  </div>
  
  <div class="row">

    <div class="col-md-9 "> 
      @if ($message = Session::get('sent-success'))
      <div class="alert alert-success alert-block">
        <button type="button" class="close" data-bs-dismiss="alert">×</button>	
        <strong>{{ $message }}</strong>
      </div>
      @endif

      <!-- Search box ---------------------------------------------------------->
      <input type="text" id="searchInput" class="form-control" onkeyup="successFunction()" placeholder="Enter IC no." title="Type in a name">

      <br>

      @if(count($payment) > 0)
      <div class="row">

        <div class="col-md-5">
          <form id="productForm" name="productForm" class="form-horizontal">
            <em class="pl-3">Choose email template</em>
            <div class="input-group">
              <div class="input-group-prepend">
                  <label class="input-group-text" for="inputGroupSelect01">Emails</label>
              </div>
              <select class="custom-select" id="emailId" name="email" required>
                  <option value="">--</option>
                  @foreach ($emails as $email)
                      <option value="{{$email->id}}">{{$email->name}}</option>
                  @endforeach
              </select>
            </div>
            <span id="chooseEmail" style="visibility:hidden;" class="text-danger font-weight-bold">Email was not chosen</span>
          </form>
        </div>

        <div class="col-md-4">
          <div class="spinner-border text-primary" id="loader" role="status" style="visibility:hidden;">
              <span class="sr-only">Loading...</span>
            </div>
            
        </div>

        <div class="col-md-3">
          <div class="col-sm-offset-2 col-sm-10 ml-5">
            <button type="submit" class="btn btn-primary ml-5" id="bt-get-email" value="create" >Send emails</button>
          </div>
        </div>

      </div>

      <div class="table-responsive">
        <table class="table table-hover" id="searchTable">
          <thead>
            <tr>
              <th>#</th>
              <th>IC No.</th>
              <th>Name</th>
              <th>Email</th>
              <th style="display:none;">PaymentID</th>
              <th><i class="fas fa-cogs"></i></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($payment as $key => $payments)
            @foreach ($student as $students)   
            @if ($payments->stud_id == $students->stud_id)
            @if ($product->product_id == $payments->product_id)  
            <tr>
              <td>{{ $payment->firstItem() + $key }}</td>
              <td>{{ $students->ic }}</td>
              <td>{{ $students->first_name }} {{ $students->last_name }}</td>
              <td>{{ $students->email }}</td>
              <td style="display:none;">{{$payments->id}}</td>
              <td>
                <a class="btn btn-dark" href="{{ url('view-student') }}/{{ $product->product_id }}/{{ $package->package_id }}/{{ $payments->payment_id }}/{{ $students->stud_id }}"><i class="bi bi-chevron-right"></i></a>
              </td>
            </tr>
            
            @endif
            @endif
            @endforeach
            @endforeach
          </tbody>
        </table>
        <input type="hidden" id="prod_id" name="prod_id" value="{{$product_id}}">
        <input type="hidden" name="pack_id" id="pack_id" value="{{$package_id}}">
      </div>
      
      @else
        <p>Purchased confirmation email has been sent to all imported customer</p>
      @endif
      <div class="float-right pt-3">{{$payment->links()}}</div>

    </div>

    <div class="col-md-3">

      <div class="card bg-light py-4 mb-4 text-center shadow">
        <div class="card-block text-dark">
          <div class="rotate">
          <i class="fas fa-file-invoice-dollar fa-6x" style="color:rgba(0, 229, 255, 0.3)"></i>
          </div>
          <h3 class="pt-3 pl-3">{{$total}}</h3>
          <h6 class="lead pb-2 pl-3">Imported Customer</h6>
        </div>
      </div>
    
    </div>
  </div>
</div>

<!-- Enable function for search payment ------------------------------------->
<script>
  function successFunction() 
  {
    var input, filter, table, tr, td, i, txtValue;

    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("searchTable");
    tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) 
    {
      td = tr[i].getElementsByTagName("td")[1];
      
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }       
    }
  }

  $(function () {
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#bt-get-email').click(function (e) {
        e.preventDefault();

        $emailValueId = document.getElementById("emailId").value;

        if($emailValueId != (null || "")){
          document.getElementById("loader").style.visibility = "visible";
          document.getElementById("chooseEmail").style.visibility = "hidden";

          var myTab = document.getElementById('searchTable');
          var emailList = [];
          var paymentId = [];

          // GET THE CELLS COLLECTION OF THE CURRENT ROW.
          var firstObjCells = myTab.rows.item(0).cells;
          var column = 0;
          var columnPayment = 0;

          // LOOP THROUGH EACH CELL OF THE CURENT ROW TO READ CELL VALUES.
          for (var k = 0; k < firstObjCells.length; k++) {
            if(firstObjCells.item(k).innerHTML == ""){
              column = k;
            }
            if(firstObjCells.item(k).innerHTML == "PaymentID"){
              columnPayment = k;
            }
          }  

          // LOOP THROUGH EACH ROW OF THE TABLE AFTER HEADER.
          for (i = 1; i < myTab.rows.length; i++) {

            var objCells = myTab.rows.item(i).cells;
            emailList.push(objCells.item(column).innerHTML);
            paymentId.push(objCells.item(columnPayment).innerHTML);
          }

          // console.log($())

          $.ajax({
            data:{
              emailList: emailList,
              emailId: $('#emailId').val(),
              prod_id: $('#prod_id').val(),
              pack_id: $('#pack_id').val(),
              paymentId: paymentId
            },
            url: "{{ route('email-bulk-blast') }}",
            type: "POST",
            success: function (data) {
              console.log(data);
                console.log('jadi');
                location.reload();
            },
            error: function (data) {
              console.log('error');
              console.log(data);
            }
          });
        }else{
          document.getElementById("chooseEmail").style.visibility = "visible";
          console.log('please choose eail');
        }
    });
  });
</script>
@endsection



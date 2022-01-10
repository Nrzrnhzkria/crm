@extends('layouts.app')

@section('title')
    Email Blasting
@endsection


@section('content')

<div class="col-md-12 pt-3">     

  <div class="card-header py-2" style="border: 1px solid rgb(233, 233, 233); border-radius: 5px;">
    <a href="/dashboard"><i class="bi bi-arrow-left"></i></a> &nbsp; <a href="dashboard">Dashboard</a> / <b>Email Blasting</b>
  </div>

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Email Blasting</h1>
  </div>

  <input type="text" id="myInput" class="form-control" onkeyup="myFunction()" placeholder="Please Enter Event Name" title="Type in a name">

  <div class="float-right pt-3">{{$product->links()}}</div>

  <br> 

  @if(count($product) > 0)
    <div class="table-responsive">
      <table class="table table-hover" id="myTable">
        <thead>
          <tr class="header">
            <th>#</th>
            <th style="width:12%">Event Date</th>
            <th>Event Name</th>
            <th><i class="fas fa-cogs"></i></th>
          </tr>
        </thead>
        <tbody> 
        @foreach ($product as $key => $products)
        <tr>
          <td>{{ $product->firstItem() + $key }}</td>
          <td>{{ date('d/m/Y', strtotime($products->created_at)) }}</td>
          <td>
            {{ $products->name }}
            @if ($products->status == 'active')
              <span class="badge rounded-pill bg-success"> &nbsp;On Going&nbsp; </span>
            @else
            @endif
          </td>
          <td>
            <a class="btn btn-dark" href="{{ url('view') }}/{{ $products->product_id }}"><i class="bi bi-chevron-right"></i></a>
          </td>
        </tr>
        @endforeach
        </tbody>
      </table>    
    </div>    
  @else
    <p>There are no record to display.</p>
  @endif
  
</div>

<!-- Enable function for search data ------------------------------------->
<script>
  function myFunction() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[2];
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
</script>
@endsection
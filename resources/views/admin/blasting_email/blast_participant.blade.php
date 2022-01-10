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

      @if(count($ticket) > 0)
      <div class="table-responsive">
        <table class="table table-hover" id="searchTable">
          <thead>
            <tr>
              <th>#</th>
              <th>IC No.</th>
              <th>Name</th>
              <th>Email</th>
              <th><i class="fas fa-cogs"></i></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($ticket as $key => $tickets)
            @foreach ($student as $students)   
            @if ($tickets->ic == $students->ic)
            @if ($product->product_id == $tickets->product_id)  
            <tr>
                <td>{{ $ticket->firstItem() + $key }}</td>
                <td>{{ $students->ic }}</td>
                <td>{{ $students->first_name }} {{ $students->last_name }}</td>
                <td>{{ $students->email }}</td>
                <td>
                  <a class="btn btn-dark" href="{{ url('view-participant') }}/{{ $product->product_id }}/{{ $package->package_id }}/{{ $tickets->ticket_id }}/{{ $students->stud_id }}"><i class="bi bi-chevron-right"></i></a>
                </td>
            </tr>
            @endif
            @endif
            @endforeach
            @endforeach
          </tbody>
        </table>
      </div>

      @else
        <p>Purchased confirmation email has been sent to all imported customer</p>
      @endif
      <div class="float-right pt-3">{{$ticket->links()}}</div>

    </div>

    <div class="col-md-3">

      <div class="card bg-light py-4 mb-4 text-center shadow">
        <div class="card-block text-dark">
          <div class="rotate">
            <i class="fas fa-file-invoice-dollar fa-6x" style="color:rgba(0, 229, 255, 0.3)"></i>
          </div>
          <h3 class="pt-3 pl-3">{{$total}}</h3>
          <h6 class="lead pb-2 pl-3">Imported Free Ticket</h6>
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
</script>
@endsection



@extends('studentportal.app')

@section('title')
    List Invoices
@endsection


@section('content')

<div class="col-md-12 px-4 py-4">   

  <div class="card-header py-2" style="border: 1px solid rgb(233, 233, 233); border-radius: 5px;">
    <a href="/student/dashboard"><i class="bi bi-arrow-left"></i></a> &nbsp; <a href="/student/dashboard">Dashboard</a> / <b>List Invoices</b>
  </div> 
     
  <div class="flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">List Invoices</h1>
  </div> 
  
  <div class="row">
    <div class="col-md-12 "> 
        
      <!-- Search box ---------------------------------------------------------->
      {{-- <form action="{{ route('student.searchInvoice') }}" class="input-group" method="GET">
          @if(isset($query))

            <input type="text" class="form-control" name="search" value="{{$query}}" placeholder="Search date">

          @else
            <input type="text" class="form-control" name="search" value="" placeholder="Search date">

          @endif
      </form> --}}
      
      <div class="float-right pt-3"></div>
      <br>
      
        <!-- View event details in table ----------------------------------------->
        <div class="table-responsive">
            <table class="table table-hover" id="myTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Membership</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Price</th>
                        <th class="text-center"><i class="fas fa-cogs"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($invoices as $key => $invoice)
                        <tr>
                            <td>
                            {{( ( $invoices->currentPage() - 1 ) * 10) + $key + 1}}
                            </td>
                            <td>
                            {{ $membership_level->name }}
                            </td>
                            <td>
                            {{ $invoice->for_date }}
                            </td>
                            <td>
                                @if ($invoice->status == 'not paid')
                                    <span class="badge bg-danger">Unpaid</span>
                                @endif

                                @if ($invoice->status == 'paid')
                                    <span class="badge bg-success">Paid</span>
                                @endif
                            </td>
                            <td>
                            <b>RM {{ number_format($invoice->price) }}</b>
                            </td>
                            <td class="text-center">
                            <a href="{{ url('student/invoice-download') }}/{{$membership_level->level_id}}/{{$invoice->invoice_id}}/{{$stud_detail->id}}" class="btn-sm btn-secondary text-decoration-none"><i class="fas fa-download pr-2"></i>Invoice</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>   
            @if(isset($query))
                {{ $invoices->appends(['search' => $query])->links() }} 
            @else
                {{ $invoices->links() }} 
            @endif
        </div>  
    </div>
  </div>
</div>
@endsection
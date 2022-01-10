@extends('studentportal.app')

@section('title')
    List Receipt
@endsection

@section('content')

<div class="col-md-12 px-4 py-4">   

  <div class="card-header py-2" style="border: 1px solid rgb(233, 233, 233); border-radius: 5px;">
    <a href="/student/dashboard"><i class="bi bi-arrow-left"></i></a> &nbsp; <a href="/student/dashboard">Dashboard</a> / <b>List Receipt</b>
  </div> 
     
  <div class="flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">List Receipt</h1>
  </div> 
  
  <div class="row">
    <div class="col-md-12 "> 
        
      
      <div class="float-right pt-3"></div>
      <br>
      
        <!-- View event details in table ----------------------------------------->
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Paid Date</th>
                        <th scope="col">Paid Price</th>
                        <th scope="col">Download</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($payment as $key => $p)
                        <tr>
                            <th scope="row">{{ $key+1 }}</th>
                            <td>
                                {{ $membership_level->name }}
                            </td>
                            <td>
                                {{ date('d/m/Y', strtotime($p->created_at)) }}
                            </td>
                            <td>
                                <b>RM {{ number_format($p->pay_price) }}.00</b>
                            </td>
                            <td>
                                <a href="{{ url('download-receipt') }}/{{ $membership_level->level_id }}/{{ $p->payment_id }}/{{ $student->stud_id }}" class="btn-sm btn-secondary mr-8 float-left text-decoration-none"><i class="fas fa-download pr-2"></i>Receipt</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No result founds</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>  
            @if(isset($query))
                {{ $payment->appends(['search' => $query])->links() }} 
            @else
                {{ $payment->links() }} 
            @endif
        </div>  
    </div>
  </div>
</div>
@endsection
@extends('layouts.app')

@section('title')
    Event
@endsection


@section('content')

<div class="col-md-12 pt-3">     
      
  <div class="card-header py-2" style="border: 1px solid rgb(233, 233, 233); border-radius: 5px;">
    <a href="/dashboard"><i class="bi bi-arrow-left"></i></a> &nbsp; <a href="dashboard">Dashboard</a> / <b>Event</b>
  </div>

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Event</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group mr-2">
        <a href="addproduct" class="btn btn-sm btn-outline-secondary"><i class="bi bi-plus-lg pr-2"></i>New Event</a>
      </div>
    </div>
  </div>
  
  @if ($message = Session::get('success'))
  <div class="alert alert-success alert-block">
      <button type="button" class="close" data-bs-dismiss="alert">×</button>	
      <strong>{{ $message }}</strong>
  </div>
  @endif
  
  @if ($message = Session::get('updatesuccess'))
  <div class="alert alert-info alert-block">
      <button type="button" class="close" data-bs-dismiss="alert">×</button>	
      <strong>{{ $message }}</strong>
  </div>
  @endif

  @if ($message = Session::get('delete'))
  <div class="alert alert-danger alert-block">
      <button type="button" class="close" data-bs-dismiss="alert">×</button>	
      <strong>{{ $message }}</strong>
  </div>
  @endif

  <div class="float-right pt-3">{{$product->links()}}</div>
  @if(count($product) > 0)
  <div class="table-responsive">
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Event</th>
          <th scope="col">Date</th>
          <th scope="col">Offer</th>
          <th scope="col"><i class="fas fa-cogs"></i></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($product as $key => $products)    
        @foreach ($offers as $offer)     
        @if ($products->offer_id == $offer->offer_id)               
          <tr>
              <td>{{ $product->firstItem() + $key  }}</td>
              <td>
                {{ $products->name  }} 
                @if ($products->status == 'active')
                    <span class="badge rounded-pill bg-success"> &nbsp;On Going&nbsp; </span>
                @else
                @endif
              </td>
              <td>{{ date('d/m/Y', strtotime($products->date_from)) }} - {{ date('d/m/Y', strtotime($products->date_to)) }}</td>
              <td>{{ $offer->name }}</td>
            <td>
              <a class="btn btn-dark" href="{{ url('package') }}/{{ $products->product_id }}"><i class="bi bi-chevron-right"></i></a>
              <a class="btn btn-outline-warning" href="{{ url('edit') }}/{{ $products->product_id }}"><i class="bi bi-pencil-square"></i></a>
              <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $products->product_id }}"><i class="bi bi-trash"></i></button>
              <!-- Modal -->
              <div class="modal fade" id="exampleModal{{ $products->product_id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      Are you sure you want to delete this event ?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <a class="btn btn-danger" href="{{ url('delete') }}/{{ $products->product_id }}">Delete</a>
                    </div>
                  </div>
                </div>
              </div>
            </td>
          </tr>   
        @endif
        @endforeach 
        @endforeach
      </tbody>
    </table>
  </div>
  @else
    <p>There are no event to display.</p>
  @endif
    
</div>
@endsection

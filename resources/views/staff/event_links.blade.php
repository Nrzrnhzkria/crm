@if (Session::get('role_id') == 'ROD005')

  @extends('staff.app')

  @section('title')
  Staff Dashboard
  @endsection

  <style>
      .card {
        overflow: hidden;
      }
    
      .card-block .rotate {
        z-index: 8;
        float: right;
        height: 100%;
      }
    
      .card-block .rotate i {
        color: rgba(20, 20, 20, 0.15);
        position: absolute;
        left: 0;
        left: auto;
        right: -10px;
        bottom: 0;
        display: block;
        -webkit-transform: rotate(-44deg);
        -moz-transform: rotate(-44deg);
        -o-transform: rotate(-44deg);
        -ms-transform: rotate(-44deg);
        transform: rotate(-44deg);
      }
  </style>

  @section('content')

  <div class="col-md-12 pt-3">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Events</li>
      </ol>
    </nav>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Event</h1>
    </div>

    {{-- <div class="col-md-12 pt-3 table-responsive">
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
        </table>
    </div> --}}

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
              <td><a class="btn btn-dark" href="{{ url('staff/link-detail') }}/{{ $products->product_id }}"><i class="bi bi-chevron-right"></i></a></td>
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
@endif
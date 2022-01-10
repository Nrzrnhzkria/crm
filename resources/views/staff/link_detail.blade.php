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
        <li class="breadcrumb-item"><a href="{{ route('staff.link') }}">Event</a></li>
        <li class="breadcrumb-item active" aria-current="page">Event Link</li>
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

    @if(count($package) > 0)
  <div class="table-responsive">
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Package</th>          
          <th scope="col">Link</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($package as $key => $packages)    
        @if ($product->product_id == $packages->product_id)                    
          <tr>
            <td>{{ $package->firstItem() + $key }}</td>
            <td>{{ $packages->name  }}</td>
            <td><input type="text" class="form-control" value="{{ $link }}{{ $packages->package_id }}/{{ Session::get('user_id') }}" readonly></td>
            {{-- <td>{{ $packages->package_image  }}</td> --}}
            
          </tr>  
        @endif  
        @endforeach
      </tbody>
    </table>
  </div>
  @else
    <p>There are no package to display.</p>
  @endif
    
  </div>
  @endsection
@endif
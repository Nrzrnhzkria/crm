@extends('layouts.app')

@section('title')
  Package
@endsection


@section('content')

<div class="col-md-12 pt-3">   
    
  <div class="card-header py-2" style="border: 1px solid rgb(233, 233, 233); border-radius: 5px;">
    <a href="/product"><i class="bi bi-arrow-left"></i></a> &nbsp; <a href="dashboard">Dashboard</a> / <a href="/product">Event</a> / <b>Package</b>
  </div>

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Package</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group mr-2">
        <a href="{{ url('addpackage') }}/{{ $product->product_id }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-plus-lg pr-2"></i>New Package</a>
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
  <div class="alert alert-success alert-block">
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

  @if(count($package) > 0)
  <div class="table-responsive">
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Package</th>          
          <th scope="col">Link</th>
          {{-- <th scope="col">Image</th> --}}
          <th scope="col"><i class="fas fa-cogs"></i></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($package as $key => $packages)    
        @if ($product->product_id == $packages->product_id)                    
          <tr>
            <td>{{ $package->firstItem() + $key }}</td>
            <td>{{ $packages->name  }}</td>
            <td><input type="text" class="form-control" value="{{ $link }}{{ $packages->package_id }}" readonly></td>
            {{-- <td>{{ $packages->package_image  }}</td> --}}
            <td>
              <a class="btn btn-warning" href="{{ url('editpack') }}/{{ $packages->package_id }}/{{ $product->product_id }}"><i class="bi bi-pencil-square"></i></a>
              <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $packages->package_id }}"><i class="bi bi-trash"></i></button>
              <!-- Modal -->
              <div class="modal fade" id="exampleModal{{ $packages->package_id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      Are you sure you want to delete this package ?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <a class="btn btn-danger" href="{{ url('deletepack') }}/{{ $packages->package_id }}">Delete</a>
                    </div>
                  </div>
                </div>
              </div>
            </td>
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



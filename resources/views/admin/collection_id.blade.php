@extends('layouts.app')

@section('title')
    Collection ID
@endsection

@section('content')
<div class="col-md-12 pt-3">     
      
  <div class="card-header py-2" style="border: 1px solid rgb(233, 233, 233); border-radius: 5px;">
    <a href="/dashboard"><i class="bi bi-arrow-left"></i></a> &nbsp; <a href="dashboard">Dashboard</a> / <b>Collection ID</b>
  </div>

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Collection ID</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="mr-2">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#newoffer">
                <i class="bi bi-plus-lg pr-2"></i>New Collection ID
            </button>
            <!-- Modal -->
            <div class="modal fade" id="newoffer" tabindex="-1" role="dialog" aria-labelledby="newofferLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header border-bottom-0">
                        <h5 class="modal-title" id="exampleModalLabel">Create New Collection ID</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ url('new-collection/save') }}" method="POST"> 
                    @csrf
                        <div class="form-group row px-4">

                            <label for="name" class="col-sm-4 col-form-label">Collection ID</label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control" name="collection_id" >
                            </div>

                            <label for="name" class="col-sm-4 col-form-label">Collection Name</label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control" name="name" >
                            </div>
                            
                        </div>
                                            
                        <div class='col-md-12 text-right px-4 pb-4'>
                            <button type='submit' class='btn btn-primary'> <i class="bi bi-save pr-2"></i>Submit </button>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
  </div>
  
  @if ($message = Session::get('add-success'))
  <div class="alert alert-success alert-block">
      <button type="button" class="close" data-bs-dismiss="alert">×</button>	
      <strong>{{ $message }}</strong>
  </div>
  @endif
  
  @if ($message = Session::get('update-success'))
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

  <div class="float-right pt-3">{{$billplz->links()}}</div>
  @if(count($billplz) > 0)
  <div class="table-responsive">
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col" style="width: 10%">#</th>
          <th scope="col" style="width: 35%">Collection ID</th>
          <th scope="col" style="width: 35%">Collection Name</th>
          <th scope="col" style="width: 15%"><i class="fas fa-cogs"></i></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($billplz as $key => $billplzs)                        
          <tr>
            <td>{{ $billplz->firstItem() + $key  }}</td>
            <td>{{ $billplzs->collection_id  }}</td>
            <td>{{ $billplzs->name  }}</td>
            <td>
              <!-- Update trigger modal -->
              <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateoffer{{ $billplzs->collection_id }}">
                  <i class="bi bi-pencil-square"></i>
              </button>
              <!-- Update Modal -->
              <div class="modal fade" id="updateoffer{{ $billplzs->collection_id }}" tabindex="-1" role="dialog" aria-labelledby="updateofferLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                      <div class="modal-header border-bottom-0">
                          <h5 class="modal-title" id="updateofferLabel">Update Collection</h5>
                          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <form action="{{ url('update-collection/save') }}/{{ $billplzs->collection_id }}" method="POST"> 
                      @csrf

                            <div class="form-group row px-4">
                                <label for="name" class="col-sm-4 col-form-label">Collection ID</label>
                                <div class="col-sm-8">
                                <input type="text" class="form-control" name="name" value="{{ $billplzs->collection_id }}">
                                </div>
                            </div>
                            <div class="form-group row px-4">
                                <label for="name" class="col-sm-4 col-form-label">Collection Name</label>
                                <div class="col-sm-8">
                                <input type="text" class="form-control" name="name" value="{{ $billplzs->name }}">
                                </div>
                            </div>
                                                
                            <div class='col-md-12 text-right px-4 pb-4'>
                                <button type='submit' class='btn btn-primary'> <i class="bi bi-save pr-2"></i>Submit </button>
                            </div>
                      </form>
                  </div>
                  </div>
              </div>

              <!-- Delete trigger modal -->
              <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#delete{{ $billplzs->collection_id }}"><i class="bi bi-trash"></i></button>
              <!-- Delete Modal -->
              <div class="modal fade" id="delete{{ $billplzs->collection_id }}" tabindex="-1" aria-labelledby="deleteLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      Are you sure you want to delete this billplz collection ?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <a class="btn btn-danger" href="{{ url('delete-collection') }}/{{ $billplzs->collection_id }}">Delete</a>
                    </div>
                  </div>
                </div>
              </div>
            </td>
          </tr>    
        @endforeach
      </tbody>
    </table>
  </div>
  @else
    <p>There are no collection id to display.</p>
  @endif
    
</div>
@endsection

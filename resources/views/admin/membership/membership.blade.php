@extends('layouts.app')

@section('title')
    Membership
@endsection


@section('content')
<div class="col-md-12 pt-3">     
      
  <div class="card-header" style="border: 1px solid rgb(233, 233, 233); border-radius: 5px;">
    <a href="/dashboard"><i class="bi bi-arrow-left"></i></a> &nbsp; <a href="dashboard">Dashboard</a> / <b>Membership</b>
  </div>

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Membership</h1>
    @if(Auth::user()->role_id == 'ROD003' || Auth::user()->role_id == 'ROD004')
    @else
    <div class="btn-toolbar mb-2 mb-md-0">
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#newmembership">
        <i class="bi bi-plus-lg pr-2"></i> New Membership
      </button>
      <!-- Modal -->
      <div class="modal fade" id="newmembership" tabindex="-1" role="dialog" aria-labelledby="newmembershipLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header border-bottom-0">
              <h5 class="modal-title" id="exampleModalLabel">Add New Membership</h5>
              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{ url('membership/save') }}" method="POST"> 
            @csrf
              <div class="form-group row px-4">
                  <label class="col-sm-4 col-form-label">Membership Name</label>
                  <div class="col-sm-8">
                  <input type="text" class="form-control" name="name" required>
                  </div>
              </div>
              <div class="form-group row px-4">
                <label class="col-sm-4 col-form-label">Level</label>
                <div class="col-sm-8" id="inputFormRow">
                    <div class="input-group mb-3">
                        <input type="text" name="level[]" class="form-control" autocomplete="off" required>
                        <div class="input-group-append">                
                            <button id="removeRow" type="button" class="btn btn-danger"><i class="fas fa-times"></i></button>
                        </div>
                    </div>
    
                    <div id="newRow"></div>
                    <button id="addRow" type='button' class='btn'><i class="fas fa-plus pr-1"></i> Add Row</button>
                </div>
              </div>
                                
              <div class='col-md-12 text-right px-4 pb-3'>
                  <button type='submit' class='btn btn-success'> <i class="fas fa-save pr-1"></i> Save </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    @endif
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

  <div class="float-right pt-3">{{$membership->links()}}</div>
  @if(count($membership) > 0)
  
  <div class="table-responsive">
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Membership Name</th>
          <th scope="col"><i class="fas fa-cogs"></i></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($membership as $key => $memberships)                
          <tr>
              <td>{{ $membership->firstItem() + $key  }}</td>
              <td>{{ $memberships->name  }}</td>
            <td>
              <a class="btn btn-dark" href="{{ url('membership/level') }}/{{ $memberships->membership_id }}"><i class="bi bi-arrow-right"></i></a>
              {{-- <a class="btn btn-outline-primary" href="{{ url('edit') }}/{{ $memberships->membership_id }}"><i class="fas fa-edit"></i></a> --}}
              {{-- @if(Auth::user()->role_id == 'ROD003' || Auth::user()->role_id == 'ROD004')
              @else
              <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $memberships->membership_id }}"><i class="fas fa-trash-alt"></i></button>
              <!-- Modal -->
              <div class="modal fade" id="exampleModal{{ $memberships->membership_id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      Are you sure you want to delete this membership ?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <a class="btn btn-danger" href="{{ url('delete') }}/{{ $memberships->membership_id }}">Delete</a>
                    </div>
                  </div>
                </div>
              </div>
              @endif --}}
            </td>
          </tr>   
        @endforeach
      </tbody>
    </table>
  </div>
  @else
    <p>There are no membership to display.</p>
  @endif
</div>


<!-- Enable function to add row ------------------------------------------>
<script type="text/javascript">
    // add row
    $("#addRow").click(function () {
        var html = '';
        html += '<div class="input-group mb-3">';
        html += '<input type="text" name="level[]" class="form-control" autocomplete="off" required>';
        html += '<div class="input-group-append">';
        html += '<button id="removeRow" type="button" class="btn btn-danger"><i class="fas fa-times"></i></button>';
        html += '</div>';

        $('#newRow').append(html);
    });

    // remove row
    $(document).on('click', '#removeRow', function () {
        $(this).closest('#inputFormRow').remove();
    });
</script>
@endsection

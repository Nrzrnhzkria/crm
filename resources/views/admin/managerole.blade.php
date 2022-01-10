@extends('layouts.app')

@section('title')
  Manage Role
@endsection


@section('content')

<div class="col-md-12 pt-3">    

    <div class="card-header py-2" style="border: 1px solid rgb(233, 233, 233); border-radius: 5px;">
        <a href="/manageuser"><i class="bi bi-arrow-left"></i></a> &nbsp; <a href="dashboard">Dashboard</a> / <a href="/manageuser">Manage User</a> / <b>Manage Role</b>
    </div>
    
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Role</h1>
    </div>
    
    @if ($message = Session::get('rolesuccess'))
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

    @if ($message = Session::get('deletesuccess'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-bs-dismiss="alert">×</button>	
            <strong>{{ $message }}</strong>
        </div>
    @endif

    <form action="{{ url('addrole') }}" method="POST"> 
    @csrf
        <div class="row">                  
            <div class='col-md-3 pr-0'>
                <div class="form-group">
                    <input name="name" type="text" class="form-control" placeholder="Add Role" required>
                </div>
            </div>
            <!--
            <div class='col-md-4'>
                <div class="form-group">
                    <label for="name">Description</label>
                    <textarea name="description" type="text" class="form-control" style="height:1cm" required></textarea>
                </div>
            </div>-->
                
            <div class='col-md-2 pl-0 pt-1'>
                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal1"><i class="bi bi-plus-lg"></i></button>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Role Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    Are you sure you want to add this role ?
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type='submit' class='btn btn-primary'>Submit</button>
                </div>
                </div>
            </div>
        </div>
    </form>
                
    <!-- Put content here-->
    @if(count($roles) > 0)
    <div class="table-responsive"> 
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Role Name</th>
                    <th><i class="fas fa-cogs"></i></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $key => $role)                        
                    <tr>
                        <td>{{ $roles->firstItem() + $key  }}</td>
                        <td>{{ $role->name  }}</td>
                    <td>
                        {{-- <a class="btn btn-dark" href="{{ url('details') }}/{{ $role->role_id }}"><i class="bi bi-chevron-right"></i> </a> --}}
                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $role->role_id }}"><i class="bi bi-trash"></i></button>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal{{ $role->role_id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                Are you sure you want to delete this role ?
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <a class="btn btn-danger" href="{{ url('deleterole') }}/{{ $role->role_id }}">Delete</a>
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
    <p>There are no role to display.</p>
    @endif
</div>
@endsection

@extends('layouts.app')

@section('title')
    Manage Role
@endsection


@section('content')

<div class="col-md-12 pt-3">    

        <div class="card-header py-2" style="border: 1px solid rgb(233, 233, 233); border-radius: 5px;">
            <a href="/managerole"><i class="fas fa-arrow-left"></i></a> &nbsp; <a href="dashboard">...</a> / <a href="/manageuser">Manage User</a> / <a href="/managerole">Manage Role</a> / <b>Role Information</b>
        </div>

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Role Information</h1>
        </div>

        <form class="row g-3 px-3" action="{{ url('updaterole') }}/{{ $roles->role_id }}" method="POST"> 
        @csrf
            <div class='col-md-2'>         
                <div class="form-group">
                    <label for="name">Role Name</label>
                    <input name="name" type="text" class="form-control" value="{{ $roles->name }}" required>
                </div>
            </div>
    
            <div class='col-md-4'>
                <div class="form-group">
                    <label for="name">Description</label>
                    <textarea name="description" type="text" class="form-control" style="height:1cm" required>{{ $roles->description }}</textarea>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col" >#</th>
                        <th scope="col" >Permissions</th>
                        <th scope="col" >Action</th>
                    </tr>
                    </thead>
                    <tbody>                       
                            
                        <tr>
                            <td>1</td>
                            <td>Manage User</td>
                            <td>
                                <div class="row">
                                    <div class="form-check" style="padding-right: 30px;">
                                        <input class="form-check-input" type="checkbox" value="create-user" id="create-user">
                                        <label class="form-check-label" for="create-user">
                                        Create
                                        </label>
                                    </div>
                                    <div class="form-check" style="padding-right: 30px;">
                                        <input class="form-check-input" type="checkbox" value="read-user" id="read-user">
                                        <label class="form-check-label" for="read-user">
                                        Read
                                        </label>
                                    </div>
                                    <div class="form-check" style="padding-right: 30px;">
                                        <input class="form-check-input" type="checkbox" value="update-user" id="update-user">
                                        <label class="form-check-label" for="update-user">
                                        Update
                                        </label>
                                    </div>
                                    <div class="form-check" style="padding-right: 30px;">
                                        <input class="form-check-input" type="checkbox" value="delete-user" id="delete-user">
                                        <label class="form-check-label" for="delete-user">
                                        Delete
                                        </label>
                                    </div>
                                </div>
                            </td>
                        </tr>   
                        
                        <tr>
                            <td>2</td>
                            <td>Manage Programme</td>
                            <td>
                                <div class="row">
                                    <div class="form-check" style="padding-right: 30px;">
                                        <input class="form-check-input" type="checkbox" value="create-programme" id="create-programme">
                                        <label class="form-check-label" for="create-programme">
                                        Create
                                        </label>
                                    </div>
                                    <div class="form-check" style="padding-right: 30px;">
                                        <input class="form-check-input" type="checkbox" value="read-programme" id="read-programme">
                                        <label class="form-check-label" for="read-user">
                                        Read
                                        </label>
                                    </div>
                                    <div class="form-check" style="padding-right: 30px;">
                                        <input class="form-check-input" type="checkbox" value="update-programme" id="update-programme">
                                        <label class="form-check-label" for="update-programme">
                                        Update
                                        </label>
                                    </div>
                                    <div class="form-check" style="padding-right: 30px;">
                                        <input class="form-check-input" type="checkbox" value="delete-programme" id="delete-programme">
                                        <label class="form-check-label" for="delete-user">
                                        Delete
                                        </label>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>3</td>
                            <td>Manage Customer</td>
                            <td>
                                <div class="row">
                                    <div class="form-check" style="padding-right: 30px;">
                                        <input class="form-check-input" type="checkbox" name="permission[]" value="create-customer" id="create-customer">
                                        <label class="form-check-label" for="create-customer">
                                        Create
                                        </label>
                                    </div>
                                    <div class="form-check" style="padding-right: 30px;">
                                        <input class="form-check-input" type="checkbox" name="permission[]" value="read-customer" id="read-customer">
                                        <label class="form-check-label" for="read-customer">
                                        Read
                                        </label>
                                    </div>
                                    <div class="form-check" style="padding-right: 30px;">
                                        <input class="form-check-input" type="checkbox" name="permission[]" value="update-customer" id="update-customer">
                                        <label class="form-check-label" for="update-customer">
                                        Update
                                        </label>
                                    </div>
                                    <div class="form-check" style="padding-right: 30px;">
                                        <input class="form-check-input" type="checkbox" name="permission[]" value="delete-customer" id="delete-customer">
                                        <label class="form-check-label" for="delete-customer">
                                        Delete
                                        </label>
                                    </div>
                                </div>
                            </td>
                        </tr>


                    </tbody>
                </table>
            </div>
                    
            <div class='col-md-12 text-end' style="padding-top:29px">
                <button type='submit' class='btn btn-primary'> <i class="bi bi-save pr-2"></i>Save Changes </button>
            </div>
        </form>

</div>
@endsection


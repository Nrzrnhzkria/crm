@extends('layouts.app')

@section('title')
    User Information
@endsection



@section('content')

<div class="col-md-12 pt-3">     

    <div class="card-header py-2" style="border: 1px solid rgb(233, 233, 233); border-radius: 5px;">
        <a href="/manageuser"><i class="bi bi-arrow-left"></i></a> &nbsp; <a href="/dashboard">Dashboard</a> / <a href="/manageuser">Manage User</a> / <b>User Information</b>
    </div>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">User Information</h1>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form class="row g-3 px-3" method="POST" action="{{ url('updateuser') }}/{{ $users->user_id }}">
                        @csrf
                            
                        <div class='col-md-12'>
                            @foreach ($roles as $role)
                            @if ($users->role_id == $role->role_id)
                            <div class="form-group">
                                <label for="role"><b>Current Role</b></label>
                                <input type="text" class="form-control" name="name" value="{{ $role->name }}" disabled>
                            </div>   
                            @endif 
                            @endforeach  
                        </div>
            
                        <div class='col-md-12'>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $users->name }}" required autocomplete="name" autofocus>
            
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
            
                        <div class='col-md-12'>
                            <div class="form-group">
                                <label for="email" >E-Mail Address</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $users->email }}" required autocomplete="email">
            
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                                
                        <div class='col-md-12'>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ $users->password }}" required autocomplete="new-password">
            
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
            
                        <div class='col-md-12'>
                            <div class="form-group">
                                <label for="password-confirm">Confirm Password</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" value="{{ $users->password }}" required autocomplete="new-password">
                            </div>
                        </div>
            
                        <div class='col-md-12'>
                            <label for="name">Change Role</label>
                            <br>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    @foreach ($roles as $role)
                                    <input type="radio" class="form-check-input" name="optradio[]" value="{{ $role->role_id  }}">{{ $role->name  }} &nbsp;&nbsp;
                                    @endforeach
                                </label>
                            </div>
                        </div>
            
                        <div class='col-md-12 pt-3'>
                            <button type="submit" class="btn btn-primary float-right">
                                <i class="bi bi-save pr-2"></i>Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card border-left-primary shadow  py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Invite</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data_count }}</div>
                            </div>
                            <div class="col-auto">
                              <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 pt-3 table-responsive">
                <table class="table table-hover">
                  <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                      $no = (10 * ($data->currentPage() - 1));
          
                    @endphp
                    
                    @forelse ($data as $key => $p)
                        <tr>
                          <th scope="row">{{ ++$no }}</th>
                          <td>{{ $p->name }}</td>
                          <td>RM{{ $p->pay_price }}.00</td>
                          <td>{{ date('d/m/Y', strtotime($p->created_at)) }}</td>
                        </tr>
                    @empty
                      <tr>
                        <td colspan="5" class="text-center">No user invited</td>
                      </tr>
                    @endforelse
                  </tbody>
                </table>
                {{ $data->links() }}
              </div>
        </div>

    </div>
        
</div>
@endsection
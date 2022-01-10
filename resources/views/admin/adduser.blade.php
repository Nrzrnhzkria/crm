@extends('layouts.app')

@section('title')
    Create User
@endsection



@section('content')

<div class="col-md-12 pt-3">     
        
    <div class="card-header py-2" style="border: 1px solid rgb(233, 233, 233); border-radius: 5px;">
        <a href="/manageuser"><i class="bi bi-arrow-left"></i></a> &nbsp; <a href="dashboard">Dashboard</a> / <a href="/manageuser">Manage User</a> / <b>Create User</b>
    </div>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Create User</h1>
    </div>

    <!-- Add user form --------------------------------------------------->
    <form class="row g-3 px-3" method="POST" action="{{ url('adduser') }}">
        @csrf
        <div class='col-md-8'>
            <div class="form-group">
                <label for="name">{{ __('Name') }}</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class='col-md-8'>
            <div class="form-group">
                <label for="email" >{{ __('E-Mail Address') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class='col-md-8'>
            <div class="form-group">
                <label for="password">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class='col-md-8'>
            <div class="form-group">
                <label for="password-confirm">{{ __('Confirm Password') }}</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>
        </div>

        <div class='col-md-8'>
            <label for="name">Role</label>
            <br>
            <div class="form-check-inline">
                <label class="form-check-label">
                    @foreach ($roles as $role)
                    <input type="radio" class="form-check-input" name="optradio" value="{{ $role->role_id  }}" required>{{ $role->name  }} &nbsp;&nbsp;
                    @endforeach
                </label>
            </div>
        </div>

        <div class='col-md-8 pt-3'>
            <button type="submit" class="btn btn-primary float-right"><i class="bi bi-save pr-2"></i>Submit</button>
        </div>
    </form>
        
</div>
@endsection
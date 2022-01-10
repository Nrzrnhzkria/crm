@extends('studentportal.app')

@section('title')
    Check Current Password
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 px-2 py-5 text-center">
        <img src="/assets/images/logo.png" style="max-width:150px">
        <h2 class="display-5 text-dark px-3 pt-4">Momentum Internet Management System (MIMS)</h2>
    </div>

    <div class="col-md-4 offset-md-4">
        
        <div class="card px-4 pt-3 text-center shadow">
            
            <div class="card-body">
                <form method="POST" action="{{ route('check-current-password') }}">
                    @csrf

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-key"></i></span>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter current password" name="password" required autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    @if(Session::get('check_current_password') == "fail")
                        <div class="mb-3 alert alert-danger" role="alert">
                            <strong class="text-danger "> Credential does not match our record </strong>
                        </div>
                    @endif

                    <div class="form-group row text-center">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-sm btn-dark">
                                 Submit
                            </button>
                        </div>

                        {{-- <div class="col-md-12">
                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div> --}}
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

<footer class="text-center px-4 py-5">
    <b>Momentum Internet (1079998-A) © 2020 All Rights Reserved​</b>
</footer>
@endsection

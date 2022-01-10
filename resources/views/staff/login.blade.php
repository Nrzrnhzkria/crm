
@extends('staff.app')

@section('title')
    Login
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 px-2 py-5 text-center">
        <img src="/assets/images/logo.png" style="max-width:150px">
        <h2 class="display-5 text-dark px-3 pt-4">Momentum Internet Management System (MIMS)</h2>
        <h2 class="display-5 text-dark px-3 pt-4">Staff</h2>
    </div>

    <div class="col-md-4 offset-md-4">
        
        <div class="card px-4 pt-3 text-center shadow">
            
            <div class="card-body">
                @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-bs-dismiss="alert">×</button>	
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <form method="POST" action="{{ route('staff.login.submit') }}">
                    @csrf
                    
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-person"></i></span>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-key"></i></span>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- <div class="form-group row text-center">
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label><input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}/> {{ __('Remember Me') }}</label>
                            </div>
                        </div>
                    </div> --}}

                    <div class="form-group row text-center">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-sm btn-dark">
                                <i class="bi bi-box-arrow-in-right pr-1"></i> {{ __('Login') }}
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

@extends('layouts.app')

@section('title')
    Manage Profile
@endsection



@section('content')
@include('layouts.sidebar')
<div class="row py-4">     
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Manage Profile</h1>
        </div>

        <form method="POST" action="{{ url('updateprofile') }}/{{ Auth::user()->user_id }}">
            @csrf
            <div class="row pt-3" style="padding-left: 3%">
                
                <div class='col-md-6'>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ Auth::user()->name }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row" style="padding-left: 3%">
                <div class='col-md-6'>
                    <div class="form-group">
                        <label for="email" >E-Mail Address</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ Auth::user()->email }}" required autocomplete="email" readonly>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                   
            </div>

            <div class="row" style="padding-left: 3%">
                <div class='col-md-3'>
                    <label for="password">Password</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ Auth::user()->password }}" required autocomplete="new-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class='col-md-3'>
                    <label for="password-confirm">Confirm Password</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" value="{{ Auth::user()->password }}" required autocomplete="new-password">
                </div>
            </div>

                {{-- <div class='col-md-8'>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ Auth::user()->password }}" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class='col-md-8'>
                    <div class="form-group">
                        <label for="password-confirm">Confirm Password</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" value="{{ Auth::user()->password }}" required autocomplete="new-password">
                    </div>
                </div> --}}


            <div class="row" style="padding-left: 3%">
                <div class='col-md-6 pt-3'>
                    <button type="submit" class="btn btn-primary float-right">
                        Update
                    </button>
                </div>
            </div>
        </form>
        
    </main>
</div>
@endsection
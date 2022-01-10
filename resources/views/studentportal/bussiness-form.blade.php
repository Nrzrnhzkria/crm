@extends('studentportal.app')

@section('title')
  Staff Dashboard
  @endsection

  <style>
      .card {
        overflow: hidden;
      }
    
      .card-block .rotate {
        z-index: 8;
        float: right;
        height: 100%;
      }
    
      .card-block .rotate i {
        color: rgba(20, 20, 20, 0.15);
        position: absolute;
        left: 0;
        left: auto;
        right: -10px;
        bottom: 0;
        display: block;
        -webkit-transform: rotate(-44deg);
        -moz-transform: rotate(-44deg);
        -o-transform: rotate(-44deg);
        -ms-transform: rotate(-44deg);
        transform: rotate(-44deg);
      }
  </style>

  @section('content')
        {{-- <div class="container">
            <div class="col-md-12 my-auto">
                <form class="">
                    <div class="form-group">
                      <label for="">Bussiness Type</label>
                      <input type="text" class="form-control" id="bussinessType" placeholder="Enter bussiness type">
                      <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="exampleCheck1">
                      <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
            </div>
        </div> --}}
        <div class="container h-50">
            @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-bs-dismiss="alert">×</button>	
                <strong>{{ $message }}</strong>
            </div>
            @endif
            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-bs-dismiss="alert">×</button>	
                <strong>{{ $message }}</strong>
            </div>
            @endif
            <div class="row h-100 justify-content-center align-items-center">
              <div class="card">
                  <div class="card-body">
                    <form class="col-12" action="{{ url('student/bussiness-form') }}" method="post">
                        @csrf
                        <h5 class="card-title">Insert Your Bussiness Details</h5>
                        <hr>
                        <div class="form-group">
                          <label for="formGroupExampleInput">Bussiness Type</label>
                          <input type="text" name="bussiness" class="form-control" id="formGroupExampleInput" placeholder="Bussiness type" required>
                          <small id="emailHelp" class="form-text text-muted">Bussiness type such as bauty product, food supplier and etc.</small>
                        </div>
                        <div class="form-group">
                          <label for="formGroupExampleInput2">Monthly income</label>
                          <input type="number" name="income" class="form-control" min="0" id="formGroupExampleInput2" placeholder="0" onkeypress="return isNumber(event)" required>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-save pr-2"></i>Submit</button>
                    </form>
                  </div>
              </div>
            </div>
            <script type="text/javascript">     
                function isNumber(evt) {
                    evt = (evt) ? evt : window.event;
                    var charCode = (evt.which) ? evt.which : evt.keyCode;
                    if ( (charCode > 31 && charCode < 48) || charCode > 57) {
                        return false;
                    }
                    return true;
                }
            </script>
                
          </div>
          
  @endsection
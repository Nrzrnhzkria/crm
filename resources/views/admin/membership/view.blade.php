@extends('layouts.app')

@section('title')
Membership
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
  .demo{ font-family: 'Poppins', sans-serif; }
  .panel{
      border-radius: 0;
      border: none;
  }
  .panel .panel-heading{
      background: #00324a;
      padding: 20px 40px;
      border-radius: 0;
      margin: 0 0;
  }
  .panel .panel-heading .title{
      color: #fff;
      font-size: 28px;
      font-weight: 400;
      text-transform: capitalize;
      margin: 0;
  }
  .panel .panel-heading .title span{ font-weight: 600; }
  .panel .panel-heading .radio-inline{
      color: #fff;
      padding: 6px 12px 6px 30px;
      margin: 0 -3px;
      border-radius: 0;
  }
  .panel .panel-heading .radio-inline:first-of-type{ border-radius: 5px 0 0 5px; }
  .panel .panel-heading .radio-inline:last-of-type{ border-radius: 0 5px 5px 0; }
  .panel .panel-body .table{ margin: 0; }
  .panel .panel-body .table tr td{ border-color: #e7e7e7; }
  .panel .panel-body .table thead tr.active th{
      background-color: transparent;
      font-size: 17px;
      font-weight: 600;
      padding: 12px;
      border-top: 1px solid #e7e7e7;
      border-bottom-color: #e7e7e7;
  }
  .panel .panel-body .table tbody tr:hover{ background-color: rgba(0,0,0,0.03); }
  .panel .panel-body .table tbody tr td{
      color: #555;
      font-size: 16px;
      padding: 12px 12px;
      vertical-align: middle;
  }
  .panel .panel-body .table tbody .btn{
      color: #fff;
      background: #37BC9B;
      font-size: 13px;
      padding: 5px 8px;
      border: none;
      border-radius: 2px;
      transition: all 0.3s ease;
  }
  .panel .panel-body .table tbody .btn:hover{ background: #2e9c81; }
  .panel .panel-footer{
      color: #999;
      background-color: transparent;
      padding: 15px;
      border: none;
      border-top: 1px solid #e7e7e7;
  }
  @media only screen and (max-width:767px){
      .panel .panel-heading{ padding: 20px; }
      .panel .panel-heading .title{
          margin: 0 0 10px;
          text-align: center;
      }
      .inline-form{ text-align: center; }
  }

</style>


@section('content')
<div class="col-md-12 pt-3">     
  <div class="card-header py-2" style="border: 1px solid rgb(233, 233, 233); border-radius: 5px;">
    <a href="{{ url('membership/level') }}/{{ $membership->membership_id }}"><i class="bi bi-arrow-left"></i></a> &nbsp; <a href="/dashboard">...</a>  / <a href="/membership">Membership</a>
      / <a href="{{ url('membership/level') }}/{{ $membership->membership_id }}">{{ $membership->name }}</a> / <b>{{ $membership_level->name }}</b>
  </div>

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">{{ $membership_level->name }}</h1>

    <div class="btn-group">
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#newcustomer">
        <i class="bi bi-plus-lg pr-2"></i>New Customer
      </button>
      <!-- Modal -->
      <div class="modal fade" id="newcustomer" tabindex="-1" role="dialog" aria-labelledby="newcustomerLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header border-bottom-0">
              <h5 class="modal-title" id="exampleModalLabel">Add New Customer</h5>
              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{ url('store-members') }}/{{ $membership->membership_id }}/{{ $membership_level->level_id }}" method="POST"> 
            @csrf
              <div class="form-group row px-4">
                  <label for="ic" class="col-sm-4 col-form-label">IC No.</label>
                  <div class="col-sm-8">
                  <input type="text" class="form-control" name="ic" placeholder="950101012036" maxlength="12" required>
                  </div>
              </div>
              <div class="form-group row px-4">
                  <label for="name" class="col-sm-4 col-form-label">First Name</label>
                  <div class="col-sm-8">
                  <input type="text" class="form-control" name="first_name" placeholder="John" required>
                  </div>
              </div>
              <div class="form-group row px-4">
                  <label for="name" class="col-sm-4 col-form-label">Last Name</label>
                  <div class="col-sm-8">
                  <input type="text" class="form-control" name="last_name" placeholder="Doe" required>
                  </div>
              </div>
              <div class="form-group row px-4">
                  <label for="name" class="col-sm-4 col-form-label">Tel No.</label>
                  <div class="col-sm-8">
                  <input type="text" class="form-control" name="phoneno" placeholder="+60123456789" value="+60" required>
                  </div>
              </div>
              <div class="form-group row px-4">
                  <label for="name" class="col-sm-4 col-form-label">Email</label>
                  <div class="col-sm-8">
                  <input type="email" class="form-control" name="email" placeholder="example@gmail.com" required>
                  </div>
              </div>
                                
              <div class='col-md-12 text-right px-4'>
                  <button type='submit' class='btn btn-success'> <i class="bi bi-save pr-2"></i>Save </button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <a href="{{ url('import-members') }}/{{ $membership->membership_id }}/{{ $membership_level->level_id }}" type="button" class="btn btn-outline-primary"><i class="bi bi-upload pr-2"></i>Import Customer</a>
    </div>
    
      
  </div>

  <div class="row">
    <div class="col-md-9 "> 

      @if ($message = Session::get('search-error'))
      <div class="alert alert-danger alert-block">
          <button type="button" class="close" data-bs-dismiss="alert">×</button>	
          <strong>{{ $message }}</strong>
      </div>
      @endif

      <!-- Search box ---------------------------------------------------------->
      <form action="{{ url('membership/search') }}/{{ $membership->membership_id }}/{{ $membership_level->level_id }}" method="GET" class="needs-validation" novalidate>
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Enter IC Number" name="search" required>
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
            </div>
        </div>
      </form>
      
      <br>
      
      @if ($message = Session::get('addsuccess'))
      <div class="alert alert-success alert-block">
          <button type="button" class="close" data-bs-dismiss="alert">×</button>	
          <strong>{{ $message }}</strong>
      </div>
      @endif

      @if ($message = Session::get('updatesuccess'))
      <div class="alert alert-success alert-block">
          <button type="button" class="close" data-bs-dismiss="alert">×</button>	
          <strong>{{ $message }}</strong>
      </div>
      @endif

      @if ($message = Session::get('importsuccess'))
      <div class="alert alert-success alert-block">
          <button type="button" class="close" data-bs-dismiss="alert">×</button>	
          <strong>{{ $message }}</strong>
      </div>
      @endif

      @if ($message = Session::get('delete-member'))
      <div class="alert alert-success alert-block">
          <button type="button" class="close" data-bs-dismiss="alert">×</button>	
          <strong>{{ $message }}</strong>
      </div>
      @endif

      @if(isset($details))
      <div class="table-responsive">
        <table class="table table-hover" id="successTable">
          <thead>
          <tr class="header">
            <th>#</th>
            <th>IC No.</th>
            <th>Name</th>
            <th class="text-center">Status</th>
            <th><i class="fas fa-cogs"></i></th>
          </tr>
          </thead>
          <tbody> 
            @foreach ($student as $key => $students)   
            @if ($students->level_id == $membership_level->level_id)
            <tr>
                <td>{{ $count++ }}</td>
                <td>{{ $students->ic }}</td>
                <td>{{ $students->first_name }} {{ $students->last_name }}</td>
                <td class="text-center">
                  @if ($students->status == 'Deactive')
                    <span class="badge rounded-pill bg-danger"> &nbsp;{{ $students->status }}&nbsp; </span>
                  @else
                    <span class="badge rounded-pill bg-success"> &nbsp;Active&nbsp; </span>
                  @endif
                </td>
                <td>
                  <a class="btn btn-dark" href="{{ url('view/members') }}/{{ $membership->membership_id }}/{{ $membership_level->level_id }}/{{ $students->stud_id }}"><i class="bi bi-chevron-right"></i></a>
                </td>
            </tr>
            @endif
            @endforeach
          </tbody>
        </table>  
      </div>
      @endif

      <!-- Show success payment in table ----------------------------------------------->
      @if(count($student) > 0)
      <div class="table-responsive">
        <table class="table table-hover" id="successTable">
          <thead>
          <tr class="header">
            <th>#</th>
            <th>IC No.</th>
            <th>Name</th>
            <th class="text-center">Status</th>
            <th><i class="fas fa-cogs"></i></th>
          </tr>
          </thead>
          <tbody> 
            @foreach ($student as $key => $students)   
            @if ($students->level_id == $membership_level->level_id)
            <tr>
                <td>{{ $count++ }}</td>
                <td>{{ $students->ic }}</td>
                <td>{{ ucwords(strtolower($students->first_name)) }} {{ ucwords(strtolower($students->last_name)) }}</td>
                <td class="text-center">
                  @if ($students->status == 'Deactive')
                    <span class="badge rounded-pill bg-danger"> &nbsp;{{ $students->status }}&nbsp; </span>
                  @elseif ($students->status == 'Break')
                  <span class="badge rounded-pill bg-warning text-dark"> &nbsp;{{ $students->status }}&nbsp; </span>
                  @elseif ($students->status == 'Stop')
                  <span class="badge rounded-pill bg-danger"> &nbsp;{{ $students->status }}&nbsp; </span>
                  @elseif ($students->status == 'Pending')
                  <span class="badge rounded-pill bg-secondary"> &nbsp;{{ $students->status }}&nbsp; </span>
                  @elseif ($students->status == 'End Membership')
                  <span class="badge rounded-pill bg-danger"> &nbsp;End Membership&nbsp; </span>
                  @elseif ($students->status == 'Upgrade Pro')
                  <span class="badge rounded-pill bg-secondary"> &nbsp;Upgrade Pro&nbsp; </span>
                  @elseif ($students->status == 'Terminate')
                  <span class="badge rounded-pill bg-dark"> &nbsp;{{ $students->status }}&nbsp; </span>
                  @else
                    <span class="badge rounded-pill bg-success"> &nbsp;{{ $students->status }}&nbsp; </span>
                  @endif

                </td>
                <td>
                  <a class="btn btn-dark" href="{{ url('view/members') }}/{{ $membership->membership_id }}/{{ $membership_level->level_id }}/{{ $students->stud_id }}"><i class="bi bi-chevron-right"></i></a>
                </td>
            </tr>
            @endif
            @endforeach
          </tbody>
        </table>  
      </div>
      @else
      <p>There are no any payment yet.</p>
      @endif
      {{-- <div class="float-right pt-3">{{$student->links()}}</div>    --}}
      
  </div>
    
  <div class="col-md-3">
      <div class="card bg-light py-4 mb-4 text-center shadow">
        <div class="card-block text-dark">
          <div class="rotate">
          <i class="fas fa-file-invoice-dollar fa-6x" style="color:rgba(0, 229, 255, 0.3)"></i>
          </div>
          <h3 class="pt-3 pl-3">{{$total}}</h3>
          <h6 class="lead pb-2 pl-3">Total {{ $membership_level->name }}</h6>
        </div>
      </div>
      
      <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-body table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr class="active">
                                    <th>Status</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Active</td>
                                    <td><span class="label label-success">{{$totalactive}}</span></td>
                                </tr>
                                <tr>
                                    <td>Deactive</td>
                                    <td><span class="label label-warning">{{$totaldeactive}}</span></td>
                                </tr>
                                <tr>
                                    <td>Break</td>
                                    <td><span class="label label-success">{{$totalbreak}}</span></td>
                                </tr>
                                <tr>
                                    <td>Stop</td>
                                    <td><span class="label label-success">{{$totalstop}}</span></td>
                                </tr>
                                <tr>
                                    <td>Pending</td>
                                    <td><span class="label label-success">{{$totalpending}}</span></td>
                                </tr>
                                <tr>
                                    <td>End Membership</td>
                                    <td><span class="label label-success">{{$totalendmembership}}</span></td>
                                </tr>
                                <tr>
                                    <td>Upgrade Pro</td>
                                    <td><span class="label label-success">{{$totalupgradepro}}</span></td>
                                </tr>
                                <tr>
                                    <td>Terminate</td>
                                    <td><span class="label label-success">{{$totalterminate}}</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
      </div>

  </div>
</div>

<!--
|--------------------------------------------------------------------------
| This function is to calculate Total Price
|--------------------------------------------------------------------------
-->
<script>
  function calculateAmount(val) {
      
    var prices = document.getElementById("price").value;
    var total_price = val * prices;

    /*display the result*/
    var divobj = document.getElementById('totalprice');
    divobj.value = total_price;

  }
  </script>
  

@endsection

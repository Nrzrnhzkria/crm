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
.panel .panel-footer .col{ line-height: 35px; }
.pagination{ margin: 0; }
.pagination li a{
    color: #00324a;
    font-size: 15px;
    font-weight: 600;
    text-align: center;
    line-height: 33px;
    height: 35px;
    width: 35px;
    padding: 0;
    display: block;
    transition: all 0.3s ease 0s;
}
.pagination li a:hover,
.pagination li a:focus,
.pagination li.active a{
    color: #fff;
    background-color: #00324a;
    border-color: #00324a;
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
  <div class="card-header" style="border: 1px solid rgb(233, 233, 233); border-radius: 5px;">
    <a href="/membership"><i class="bi bi-arrow-left"></i></a> &nbsp; <a href="/dashboard">Dashboard</a>  / <a href="/membership">Membership</a> / <b>{{ $membership->name }}</b>
  </div>

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">{{ $membership->name }}</h1>

      <a class="btn btn-outline-warning" href="{{ url('export-members') }}/{{ $membership->membership_id }}"><i class="bi bi-download pr-2"></i> Export Customer</a>
  </div>

  <div class="row">
    <div class="col-md-9 ">            
      
      @if ($message = Session::get('export-members'))
      <div class="alert alert-success alert-block">
          <button type="button" class="close" data-bs-dismiss="alert">×</button>	
          <strong>{{ $message }}</strong>
      </div>
      @endif

      @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Successful!</strong> {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
                
      <!-- Show package in table ----------------------------------------------->
      @if(count($membership_level) > 0)
      <div class="table-responsive">
        <table class="table table-hover" id="successTable">
            <thead>
            <tr class="header">
                <th>#</th>
                <th>Level</th>
                <th class="text-center"><i class="fas fa-cogs"></i></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($membership_level as $key => $membership_levels)    
            <tr>
              <td>{{ $membership_level->firstItem() + $key }}</td>
              <td>{{ $membership_levels->name  }}</td>
              <td class="text-center">
                <a class="btn btn-dark" href="{{ url('membership/level') }}/{{ $membership->membership_id }}/{{ $membership_levels->level_id }}"><i class="bi bi-chevron-right"></i></a>
                <a href="#" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#membership{{ $membership_levels->level_id }}"><i class="fas fa-edit"></i></a>
              </td>
            </tr>
            <!-- Edit Membership Level -->
            <!-- Modal -->
            <div class="modal fade" id="membership{{ $membership_levels->level_id }}" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">{{ $membership_levels->name  }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="{{ url('membership/level/update') }}/{{ $membership_levels->level_id }}" method="POST">
                    @csrf
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" rows="3" name="description" required>{{ $membership_levels->description }}</textarea>
                          </div>
                          <div class="mb-3">
                              <label class="form-label">Price (RM)</label>
                              <input type="text" class="form-control" name="price" placeholder="Enter Price Here" value="{{ $membership_levels->price }}" required>
                          </div>
                          <div class="mb-3">
                              <label class="form-label">Tax (%)</label>
                              <input type="text" class="form-control" name="tax" placeholder="Enter Tax Here" value="{{ $membership_levels->tax }}" required>
                          </div>
                        </div>
                        <div class="col-md-12 mt-3">
                          <p><b>Total Price : </b>RM {{ number_format($membership_levels->price) }}</p>
                          <p><b>Tax (%) : </b>RM {{ number_format($membership_levels->price - $membership_levels->price / $membership_levels->tax, 2) }}</p>
                          <p><b>Total Taxable Amount : </b>RM {{ number_format($membership_levels->price / $membership_levels->tax, 2) }}</p>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-dark">Update <i class="fas fa-arrow-right"></i></button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            @endforeach
            </tbody>
        </table>  
      </div>
      @else
      <p>There are no package yet.</p>
      @endif
      <div class="float-right pt-3">{{$membership_level->links()}}</div>
      
    </div>
    
      
    <div class="col-md-3">

      <div class="card bg-light py-4 mb-4 text-center shadow">
        <div class="card-block text-dark">
          <div class="rotate">
          <i class="fas fa-file-invoice-dollar fa-6x" style="color:rgba(0, 229, 255, 0.3)"></i>
          </div>
          <h3 class="pt-3 pl-3">{{$total}}</h3>
          <h6 class="lead pb-2 pl-3">Total {{ $membership->name }}</h6>
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
        
</div>


<!-- Enable function for search payment ------------------------------------->
<script>
  function successFunction() 
  {
    var input, filter, table, tr, td, i, txtValue;

    input = document.getElementById("successInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("successTable");
    tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) 
    {
      td = tr[i].getElementsByTagName("td")[1];
      
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }       
    }
  }
</script>

@endsection

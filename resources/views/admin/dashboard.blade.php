@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('content')

<div class="col-md-12">     
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
    <p class="lead">{{ $greetings }}</p>
  </div>

  @if ($message = Session::get('updateprofile'))
  <div class="alert alert-info alert-block">
      <button type="button" class="close" data-bs-dismiss="alert">×</button>	
      <strong>{{ $message }}</strong>
  </div>
  @endif

  <div class="row pb-2">

    <div class="col-md-6 pb-3">
      <div class="card border-0 shadow text-center text-success" style="height: 117px">
        <h6 class="pt-4">Today's Registration</h6>
        <b class="display-6 pb-3">+{{ number_format($total_now) }}</b>
      </div>
    </div>
  
    <div class="col-md-6 pb-3">
      <div class="card border-0 shadow text-center text-success" style="height: 117px">
        <h6 class="pt-4">Yesterday's Registration</h6>
        <b class="display-6 pb-3">+{{ number_format($total_yesterday) }}</b>
      </div>
    </div>

    <!-- Show data in bar chart ----------------------------------------------->
    <div class="col-md-4 pb-4">
      <div class="card border-0 bg-white shadow px-4 py-4">      
        <canvas id="barChart" style="width:100%; height: 401px"></canvas>
      </div>
    </div>
    
    <!-- Show data in table --------------------------------------------------->
    <div class="col-md-5 pb-4">
      <div class="card bg-white shadow px-4 py-4">

        <h5 class="text-center pt-4">{{ $product->name }}</h5>
        <b class="text-center pb-4">Report per Hour</b>

        <p class="text-center pb-3">Date : <b>{{ $date_today }}</b> &nbsp;&nbsp; Report Hours : <b>{{ $duration }}</b></p>

        <div class="table-responsive pb-4">
          <table class="table text-center">
            <thead class="thead">
              <tr>
                <th class="text-left w-25">Package</th>
                <th>Registration [A]</th>
                <th>Updated Paid Ticket [B]</th>
                <th>Updated Free Ticket [C]</th>
              </tr>
            </thead>
            <tbody>
              @for ($i = 0; $i < $count_package; $i++)
              <tr>
                <td class="text-left">{{ $package[$i]->name }}</td>
                <td>
                  {{ number_format($registration[$i]) }}
                </td>
                <td>{{ number_format($paidticket[$i]) }}</td>
                <td>{{ number_format($freeticket[$i]) }}</td>
              </tr>
              @endfor
            </tbody>
          </table>
        </div>

        {{-- @if ( Auth::user()->user_id == 'UID001' )
          <div class="table-responsive pb-4">
            <table class="table table-sm table-bordered text-center">
              <thead class="thead">
                <tr>
                  <th class="text-center" rowspan="2">Time</th>       
                  <th colspan="3">Registration [A]</th>
                  <th colspan="3">Updated Paid Ticket [B]</th>
                  <th colspan="3">Updated Free Ticket [C]</th>       
                </tr>
                <tr>
                  @for ($i = 0; $i < $count_package; $i++)
                    <th>{{ $package[$i]->name }}</th>
                  @endfor
                  @for ($i = 0; $i < $count_package; $i++)
                    <th>{{ $package[$i]->name }}</th>
                  @endfor
                  @for ($i = 0; $i < $count_package; $i++)
                    <th>{{ $package[$i]->name }}</th>
                  @endfor
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th class="text-left">12:00 am - 08:00 am</th>                  
                  @for ($i = 0; $i < $count_package; $i++)
                    <td>{{ number_format($registration[$i]) }}</td>
                    <td>{{ number_format($paidticket[$i]) }}</td>
                    <td>{{ number_format($freeticket[$i]) }}</td>
                  @endfor
                </tr>
                <tr>
                  <th class="text-left">08:00 am - 09:00 am</th>
                </tr>
                <tr>
                  <th class="text-left">09:00 am - 10:00 am</th>
                </tr>
                <tr>
                  <th class="text-left">10:00 am - 11:00 am</th>
                </tr>
                <tr>
                  <th class="text-left">11:00 am - 12:00 pm</th>
                </tr>
                <tfoot>
                  <tr> 
                    <th class="text-left">Total Yesterday</th>
                  </tr>
                </tfoot>
              </tbody>
            </table>
          </div>
        @else
        @endif --}}

      </div>
    </div>

    <div class="col-md-3 pb-4">      
      <div class="card border-0 shadow text-center text-danger pt-3" style="height: 284px"> 
        <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
    
        <br>
    
        <p class="text-dark">Updated Ticket [B+C] : <b>{{ number_format($totalticket) }}</b>
        <br>Pending Ticket [A-B] : <b>{{ number_format($pendingticket) }}</b></p>
        
      </div>
      <br>
      <div class="card border-0 gradient-3 shadow text-center" style="height: 145px">
        <h6 class="pt-4 pb-3">Total Ticket [A+C]</h6>
        <b class="display-6 pb-3">{{ number_format($totalticket + $pendingticket) }}</b>
      </div>
    </div>

  </div>

  <h4 class="border-bottom pb-3">Overall Registration</h4>

  <div class="row py-2">
    @for ($i = 0; $i < $count_package; $i++)
    <div class="col-md-3 pb-4">
      <div class="card border-0 shadow text-center" style="height: 125px">
        <h6 class="pt-4">{{ $package[$i]->name }}</h6>
        <b class="display-6 pb-3">{{ number_format($totalpackage[$i]) }}</b>
      </div>
    </div>
    @endfor

    <div class="col-md-3 pb-4">
      <div class="card border-0 gradient-2 shadow text-center" style="height: 125px">
        <h6 class="pt-4">Total</h6>
        <b class="display-6 pb-3">{{ number_format($totalregister) }}</b>
      </div>
    </div>
  </div>

  <h4 class="border-bottom pb-3">Overall Collection</h4>

  <div class="row pt-2">
    @for ($i = 0; $i < $count_package; $i++)
    <div class="col-md-3 pb-4">
      <div class="card border-0 shadow text-center" style="height: 125px">
        <h6 class="pt-4">{{ $package[$i]->name }}</h6>
        <b class="display-6 pb-3">RM {{ number_format($collection[$i]) }}</b>
      </div>
    </div>
    @endfor

    <div class="col-md-3 pb-4">
      <div class="card border-0 gradient-2 shadow text-center" style="height: 125px">
        <h6 class="pt-4">Total</h6>
        <b class="display-6 pb-3">RM {{ number_format($totalcollection) }}</b>
      </div>
    </div>
  </div>

</div>

<!-- Function to show bar chart ----------------------------------------------------->
<script>
  var xValues = ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"];
  var yValues = [{{$mon}}, {{$tue}}, {{$wed}}, {{$thu}}, {{$fri}}, {{$sat}}, {{$sun}}];
  var barColors = ["#1B4F72", "#17A589", "#633974", "#F1948A", "#FDD74C", "#23B4B1", "#DA4414" ];
  
  new Chart("barChart", {
    type: "bar",
    data: {
      labels: xValues,
      datasets: [{
        backgroundColor: barColors,
        data: yValues
      }]
    },
    options: {
      legend: {display: false},
      title: {
        display: true,
        text: "Total Registration per Day (From 8am)"
      }
    }
  });
</script>

<!-- Function to show doughnut chart ----------------------------------------------------->
<script>
  var xValues = ["Updated Ticket", "Pending Ticket"];
  var yValues = [{{ $totalticket }}, {{ $pendingticket }}];
  var barColors = [
    "#3EFF69",
    "#FF3E3E"
  ];

  new Chart("myChart", {
    type: "doughnut",
    data: {
      labels: xValues,
      datasets: [{
        backgroundColor: barColors,
        data: yValues
      }]
    },
    options: {
      title: {
        display: true,
        text: "Ticket Status"
      }
    }
  });
</script>
@endsection

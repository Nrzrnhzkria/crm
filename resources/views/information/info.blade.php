<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <!--
    |--------------------------------------------------------------------------
    | This layout is for Administrator page
    |--------------------------------------------------------------------------
    -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="Jekyll v4.1.1">
    <meta http-equiv="refresh" content="5" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Information | Momentum Internet</title>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://kit.fontawesome.com/e4e5c205fb.js" crossorigin="anonymous"></script>
    <script src="https://js.stripe.com/v3/"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    @yield('css')

    <!-- Bootstrap core CSS -->
    <link href="/docs/4.5/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .center {
      margin: auto;
      width: 70%;
      padding: 10px;
      text-align: center;
      }

      a {
        color: rgb(0, 0, 0);
        text-decoration: none; /* no underline */
      }

      a:hover{
        color: rgb(0, 0, 0);
      }

      /* Highcharts for pie chart css */
      .highcharts-figure, .highcharts-data-table table {
          min-width: 320px; 
          max-width: 660px;
          margin: 1em auto;
      }

      .highcharts-data-table table {
        font-family: Verdana, sans-serif;
        border-collapse: collapse;
        border: 1px solid #EBEBEB;
        margin: 10px auto;
        text-align: center;
        width: 100%;
        max-width: 500px;
      }
      .highcharts-data-table caption {
          padding: 1em 0;
          font-size: 1.2em;
          color: #555;
      }
      .highcharts-data-table th {
        font-weight: 600;
          padding: 0.5em;
      }
      .highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
          padding: 0.5em;
      }
      .highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
          background: #f8f8f8;
      }
      .highcharts-data-table tr:hover {
          background: #f1f7ff;
      }


      .gradient-1
      {
        background-image: linear-gradient(to bottom right, #9c46cb, #77c6ff);
      }
      .gradient-2
      {
        background-image: linear-gradient(to bottom right, #82e4ff, #77ffbd);
      }
      .gradient-3
      {
        background-image: linear-gradient(to bottom right, #6ef5ab, #c6f054);
      }
      .gradient-4
      {
        background-image: linear-gradient(to bottom right, #ffcda5, #ee4d5f);
      }

    </style>
  </head>
  <body class="bg-light pb-3"> 
    @include('layouts.navbar')
    <div class='container-fluid px-3 py-3'>
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

    </div>
  </body>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
  <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
  <script src="{{ asset('js/dashboard.js') }}"></script>
</html>




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
</div>

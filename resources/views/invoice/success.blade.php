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

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | Momentum Internet</title>

    <!-- Scripts -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
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

      a {
        color: rgb(0, 0, 0);
        text-decoration: none; /* no underline */
      }

      a:hover{
        color: rgb(0, 0, 0);
      }

      /* Highcharts css */
      .highcharts-figure, .highcharts-data-table table {
        min-width: 360px; 
        max-width: 800px;
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

      .someElement {
        position: absolute;
        top: 39%;
        left: 39%;
        margin: -100px 0 0 -100px;
      }

    </style>
  </head>
  <body class="bg-light pb-3"> 
    <div class='container-fluid'>
        <div class="d-flex justify-content-center someElement">
            <div class="card" style="width: 30rem; height: 15rem;">
                <div class="card-header" style="background-color: #10e629;">
                    <img class="card-img-top" src="/assets/images/tick.svg" width="100" height="100" alt="Card image cap">
                </div>
                <div class="card-body text-center">
                    <h4>Your payment was succesful!</h4>
                    <p>You will be redirected to dashboard shortly.</p>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            setTimeout(function () {
                location.replace("dashboard");
            }, 4000);
        });
    </script>
  </body>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
  <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
  <script src="{{ asset('js/dashboard.js') }}"></script>
</html>

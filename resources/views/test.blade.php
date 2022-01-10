<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="utf-8" />
  </head>
  <body>
    <h2>Test Email</h2>
    <div>
    {!!$content!!}
    </div>

    {{-- <form action="{{ url('payment-process') }}" method="POST">
      @csrf
      <button type="submit" class="btn btn-danger">Pay Now</button>
    </form> --}}
  </body>
</html>
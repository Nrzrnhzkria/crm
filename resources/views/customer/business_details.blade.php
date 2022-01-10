@extends('layouts.app')

@section('title')
    Customer Business Details
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

/* Bootstrap 4 text input with search icon */

</style>

@section('content')
    <div class="col-md-12 pt-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
              <li class="breadcrumb-item active" aria-current="page">Customer Business Details</li>
            </ol>
        </nav>

        {{-- <script>
          $(document).ready( function() {
          $('.dropdown-toggle').dropdown();
          });
        </script> --}}
        <div class="col-md-12 pt-3 table-responsive">
          {{-- <form action="{{ url('customer_details') }}" class="input-group" method="GET">
              <input type="text" class="form-control" name="search" value="{{ request()->query('search') ? request()->query('search') : '' }}" placeholder="Search name and IC number">
          </form> --}}
          
          <div class="input-group mb-3">
            <form action="{{ url('customer_details') }}" class="input-group" method="GET">
              {{-- <input type="text" class="form-control" aria-label="Text input with segmented dropdown button"> --}}
              <input type="text" class="form-control" name="search" value="{{ request()->query('search') ? request()->query('search') : '' }}" placeholder="Search business type and name">
              <div class="input-group-append col-md-4">
                <select class="custom-select" id="inputGroupSelect01" name="role">
                  @foreach ($role as $r)
                    @if (request()->query('role'))
                      <option {{ request()->query('role') === $r ? 'selected' : '' }} value="{{ $r === 'Role' ? '' : $r }}">{{ $r }}</option>
                    @else
                      <option {{ request()->query('role') === 'Role' ? 'selected' : '' }} value="{{ $r === 'Role' ? '' : $r }}">{{ $r }}</option>
                    @endif
                  @endforeach
                </select>

                <select class="custom-select" id="inputGroupSelect02" name="price">
                  <option {{ !request()->query('price') ? 'selected' : '' }} value="">Income</option>
                  @foreach ($incomeOptions as $i)
                      <option {{ request()->query('price') === $i->range ? 'selected' : '' }} value="{{ $i->range }}">{{ $i->range }}</option>
                  @endforeach
                </select>
                <div class="input-group-append">
                  <button class="btn btn-outline-secondary" type="submit">Search</button>
                </div>
              </div>
            </form>
          </div>

          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Business Role</th>
                <th scope="col">Business Type</th>
                <th scope="col">Business Amount</th>
                <th scope="col">Class</th>
              </tr>
            </thead>

            <tbody>
              @php
                  $no = (10 * ($data->currentPage() - 1));
              @endphp

              @forelse ($data as $key => $k)
                  <tr>
                    <th scope="row">{{ ++$no }}</th>
                    <td>{{ $k->name }}</td>
                    <td>{{ $k->business_role }}</td>
                    <td>{{ $k->business_type }}</td>
                    <td>RM{{ $k->business_amount }}</td>
                    <td>{{ $k->class }}</td>
                  </tr>
              @empty
                <tr>
                  <td colspan="5" class="text-center">No result founds for query</td>
                </tr>
              @endforelse
            </tbody>
          </table>
          {{ $data->links() }}
        </div>
    </div>
@endsection
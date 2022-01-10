@extends('layouts.app')

@section('title')
Customer Profiles
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

<div class="col-md-12 pt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
          <li class="breadcrumb-item active" aria-current="page">Customer Profiles</li>
        </ol>
    </nav>

    <div class="col-md-12 pt-3 table-responsive">
        
        <form action="{{ url('customer_profiles') }}" class="input-group" method="GET">
            <input type="text" class="form-control" name="search" value="{{ request()->query('search') ? request()->query('search') : '' }}" placeholder="Search name and IC number">
        </form>
        
        <table class="table table-hover">
            <thead class="">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">IC</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @php
				    $no = (10 * ($customers->currentPage() - 1));
				@endphp
                @forelse ($customers as $key => $customer)
                <tr>
                    <th scope="row">{{ ++$no }}</th>
                    <td>{{ ucwords(strtolower($customer->first_name)) }} {{ ucwords(strtolower($customer->last_name)) }}</td>
                    <td>{{ $customer->ic }}</td>
                    <td>
                        @if ($customer->status === "Active")
                            <span class="badge rounded-pill bg-success p-2">Active</span>
                        @elseif ($customer->status === "Deactive") 
                            <span class="badge rounded-pill bg-danger p-2">Deactive</span>
                        @else
                            <span class="badge rounded-pill bg-secondary p-2">No Status</span>
                        @endif
                    </td>
                    <td>
                        <a class="btn btn-dark" href="{{ url('customer_profiles') }}/{{ $customer->id }}"><i class="bi bi-chevron-right"></i></a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">No result founds for query {{ request()->query('search') }}</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{ $customers->appends(['search' => request()->query('search') ])->links() }}
    </div>
</div>
@endsection
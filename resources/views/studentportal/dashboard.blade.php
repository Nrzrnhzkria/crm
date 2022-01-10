

@extends('studentportal.app')

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

    body{margin-top:20px;}
    .timeline {
        border-left: 3px solid #727cf5;
        border-bottom-right-radius: 4px;
        border-top-right-radius: 4px;
        background: rgba(114, 124, 245, 0.09);
        margin: 0 auto;
        letter-spacing: 0.2px;
        position: relative;
        line-height: 1.4em;
        font-size: 1.03em;
        padding: 50px;
        list-style: none;
        text-align: left;
        max-width: 40%;
    }

    @media (max-width: 767px) {
        .timeline {
            max-width: 98%;
            padding: 25px;
        }
    }

    .timeline h1 {
        font-weight: 300;
        font-size: 1.4em;
    }

    .timeline h2,
    .timeline h3 {
        font-weight: 600;
        font-size: 1rem;
        margin-bottom: 10px;
    }

    .timeline .event {
        border-bottom: 1px dashed #e8ebf1;
        padding-bottom: 25px;
        margin-bottom: 25px;
        position: relative;
    }

    @media (max-width: 767px) {
        .timeline .event {
            padding-top: 30px;
        }
    }

    .timeline .event:last-of-type {
        padding-bottom: 0;
        margin-bottom: 0;
        border: none;
    }

    .timeline .event:before,
    .timeline .event:after {
        position: absolute;
        display: block;
        top: 0;
    }

    .timeline .event:before {
        left: -207px;
        content: attr(data-date);
        text-align: right;
        font-weight: 100;
        font-size: 0.9em;
        min-width: 120px;
    }

    @media (max-width: 767px) {
        .timeline .event:before {
            left: 0px;
            text-align: left;
        }
    }

    .timeline .event:after {
        -webkit-box-shadow: 0 0 0 3px #727cf5;
        box-shadow: 0 0 0 3px #727cf5;
        left: -55.8px;
        background: #fff;
        border-radius: 50%;
        height: 9px;
        width: 9px;
        content: "";
        top: 5px;
    }

    @media (max-width: 767px) {
        .timeline .event:after {
            left: -31.8px;
        }
    }

    .rtl .timeline {
        border-left: 0;
        text-align: right;
        border-bottom-right-radius: 0;
        border-top-right-radius: 0;
        border-bottom-left-radius: 4px;
        border-top-left-radius: 4px;
        border-right: 3px solid #727cf5;
    }

    .rtl .timeline .event::before {
        left: 0;
        right: -170px;
    }

    .rtl .timeline .event::after {
        left: 0;
        right: -55.8px;
    }

    .pre-scrollable {
        max-height: 100px;
        overflow-y: scroll;
    }
    .bs-example{
    	margin: 20px;
    }
</style>

@section('content')
    <div class="col-md-12 pt-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{ url('customer_profiles') }}">Customer Profiles</a></li>
              <li class="breadcrumb-item active" aria-current="page">Profile</li>
            </ol>
        </nav>
        @if ($message = Session::get('subsSuccess'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-bs-dismiss="alert">×</button>	
            <strong>{{ $message }}</strong>
        </div>
        @endif

        @if ($message = Session::get('subsError'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-bs-dismiss="alert">×</button>	
            <strong>{{ $message }}</strong>
        </div>
        @endif

        @if ($message = Session::get('commentSuccess'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-bs-dismiss="alert">×</button>	
            <strong>{{ $message }}</strong>
        </div>
        @endif

        @if ($message = Session::get('commentError'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-bs-dismiss="alert">×</button>	
            <strong>{{ $message }}</strong>
        </div>
        @endif
        
        <div class="flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 border-bottom bs-example">
            <h1 class="h2">Customer Information</h1>
            <div class="">
            <div class="align-right">
            <a href="statement-format" class="btn btn-danger "><i class="fas fa-download pr-2"></i>Download Statement</a>
            <a href="list-invoice" class="btn btn-primary "><i class="fas fa-download pr-2"></i>Check Invoices</a>
            </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="row">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Total Paid (Monthly)</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">RM {{ number_format($total_paid_month) }}.00</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-money-bill fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Total Paid (Overall)</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">RM {{ number_format($total_paid) }}.00</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-money-bill-wave fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Total Events</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_event }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Membership Level</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $member_lvl }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 pt-3">
                    <div class="card">
                        <div class="card-header">
                            <strong>
                                Personal Details 
                                @if ($student_detail->status == 'Terminate')
                                    <span class="badge bg-dark">{{ $student_detail->status }}</span>
                                @endif
                                @if ($student_detail->status == 'Active')
                                    <span class="badge bg-success">{{ $student_detail->status }}</span>
                                @endif
                                @if ($student_detail->status == 'Pending')
                                    <span class="badge bg-warning">{{ $student_detail->status }}</span>
                                @endif
                                @if ($student_detail->status == 'Stop' || $student_detail->status == 'Break')
                                    <span class="badge bg-danger">{{ $student_detail->status }}</span>
                                @endif
                            </strong>
                        </div>
            
                        <div class="card-body">
                            <form class="px-5" action="{{ url('update_cust', $student_detail) }}" method="post">
                                {{-- url('update/customer_profile') --}}
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="First Name">First Name</label>
                                        <input type="text" name="first" class="form-control" value="{{ $student_detail->first_name }}" disabled>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="First Name">Last Name</label>
                                        <input type="text" name="last" class="form-control" value="{{ $student_detail->last_name }}" disabled>
                                    </div>
                                </div>
            
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="IC Number">IC Number</label>
                                        <input type="text" name="ic" class="form-control" value="{{ $student_detail->ic }}" disabled>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="First Name">Email Address</label>
                                        <input type="text" name="email" class="form-control" value="{{ $student_detail->email }}" disabled>
                                    </div>
                                </div>
            
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="Phone Number">Phone Number</label>
                                        <input type="text" name="phone" class="form-control" value="{{ $student_detail->phoneno }}" disabled>
                                    </div>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 pt-3">
                    <div class="card">
                        <div class="card-header">
                            <strong>Comment</strong>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12 pt-3 table-responsive" id="content" class="overflow-auto" style="height: 230px;">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Comments</th>
                                            <th scope="col">Author</th>
                                            <th scope="col">Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($ncomment as $key => $c)
                                            <tr>
                                                <th scope="row">{{ $key+1 }}</th>
                                                <td>{{ $c->comment }}</td>
                                                <td>{{ $c->author }}</td>
                                                <td>{{ date('d/m/Y', strtotime($c->created_at)) }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">No result founds</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            {{-- <div class="col-md-12 overflow-auto" style="height: 230px;">
                                @forelse ($ncomment as $key => $c)
                                    <div class="form-group">
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="1" disabled>{{ $c->comment }}</textarea>
                                    </div>
                                @empty
                                <div class="form-group">
                                    <p class="text-center mx-auto">No Comments Found</p>
                                </div>
                                @endforelse
                            </div> --}}
                            <hr>
                            

                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add Comment</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ url('add_comment', $student_detail) }}" method="post">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="message-text" class="col-form-label">Comment:</label>
                                                    <textarea class="form-control" onfocus="this.value=''" name="comment" placeholder="Add comment here.." required></textarea>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Add Comment</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <hr>
            
            <div class="row">
                <div class="col-md-6 pt-3">
                    <div class="card">
                        <div class="card-header">
                            <strong>Payment Details</strong>
                        </div>
            
                        <div class="card-body">
                            <div class="col-md-12 pt-3 table-responsive" id="content" class="overflow-auto" style="height: 400px;">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Paid Date</th>
                                            <th scope="col">Paid Price</th>
                                            <th scope="col">Download</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($payment as $key => $p)
                                            <tr>
                                                <th scope="row">{{ $key+1 }}</th>
                                                <td>
                                                    {{ $membership_level->name }}
                                                </td>
                                                <td>
                                                    {{ date('d/m/Y', strtotime($p->created_at)) }}
                                                </td>
                                                <td>
                                                    RM {{ $p->pay_price }}.00
                                                </td>
                                                <td>
                                                    {{-- <a href="{{ url('download-receipt') }}/{{ $membership_level->level_id }}/{{ $p->payment_id }}/{{ $student->id }}" class="btn-sm btn-secondary mr-8 float-left text-decoration-none"><i class="fas fa-download pr-2"></i>Receipt</a> --}}
                                                    <a href="{{ url('/student/receipt') }}/{{ $membership_level->level_id }}/{{ $p->payment_id }}/{{ $stud_id }}" class="btn-sm btn-danger mr-8 float-left"><i class="fas fa-download pr-2"></i>Receipt</a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">No result founds</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 pt-3">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- <div class="card"> -->
                                <div class="card-header">
                                    <strong>Timeline</strong>
                                </div>
                                <div class="card-body">
                                    <div id="content" class="overflow-auto" style="height: 400px;">
                                        <ul class="timeline">
                                            @foreach ($data as $key => $d)
                                                <li class="event" data-date="{{ $d->date_from }}">
                                                    <h3>{{ $d->name }}</h3>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            
        </script>
    </div>
@endsection 
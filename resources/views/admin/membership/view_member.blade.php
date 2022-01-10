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
</style>
  

@section('content')

<div class="col-md-12 pt-3">        
  <div class="card-header" style="border: 1px solid rgb(233, 233, 233); border-radius: 5px;">
      <a href="{{ url('membership/level') }}/{{ $membership->membership_id }}/{{ $membership_level->level_id }}"><i class="bi bi-arrow-left"></i></a> &nbsp; <a href="/membership">...</a>
      / <a href="{{ url('membership/level') }}/{{ $membership->membership_id }}">{{ $membership->name }}</a> / <a href="{{ url('membership/level') }}/{{ $membership->membership_id }}/{{ $membership_level->level_id }}">{{ $membership_level->name }}</a>
      / <b>{{ $student->first_name }}</b>
  </div>
          
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Customer Information</h1>
  </div> 

  <div class="row">      
    <div class="col-md-12">
      <form class="px-1" action="{{ url('update/members') }}/{{ $membership->membership_id }}/{{ $membership_level->level_id }}/{{ $student->stud_id }}" method="post">
        @csrf
      
        <div class="row py-2">     
          <div class="col-md-6">
            <label class="form-label">IC No.</label>
            <input type="text" name="ic" value="{{ $student->ic }}" placeholder="Enter Ic Number" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label class="form-label">Status</label>
            <select class="form-select form-control" name="status">
              <option value="{{ $student->status }}" readonly selected>-- {{ $student->status }} --</option>
              <option value="Active">Active</option>
              <option value="Downgrade">Downgrade</option>
              <option value="Break">Break</option>
              <option value="Stop">Stop</option>
              <option value="Pending">Pending</option>
              <option value="End-Membership">End Membership</option>
              <option value="Upgrade">Upgrade</option>
              <option value="Terminate">Terminate</option>
            </select>
          </div>
        </div>
        <div class="row py-2">
          <div class="col-md-3">
            <label class="form-label">First Name</label>
            <input type="text" name="first_name" value="{{ ucwords(strtolower($student->first_name)) }}" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label class="form-label">Last Name</label>
            <input type="text" name="last_name" value="{{ ucwords(strtolower($student->last_name)) }}" class="form-control" required>
          </div>
        </div>

        <div class="row py-2">
          <div class="col-md-6">
            <label class="form-label">Email</label>
            <input type="text" name="email" value="{{ $student->email }}" placeholder="Enter Email Address" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label class="form-label">Phone No.</label>
            <input type="text" name="phoneno" value="{{ $student->phoneno }}" placeholder="Enter Phone Number" class="form-control" required>
          </div>
        </div>

        <div class="col-md-6 py-3 float-end">
          @if(Auth::user()->role_id == 'ROD003' || Auth::user()->role_id == 'ROD004')
          @else
          <button type="submit" class="btn btn-primary"><i class="bi bi-save pr-2"></i>Save  Changes</button>
            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $student->stud_id }}"><i class="bi bi-trash pr-2"></i>Delete</button>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal{{ $student->stud_id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body text-start">
                    <p>This action will remove the details from the table :</p>
                    <ul>
                      <li>Student</li>
                      <li>Payment</li>
                      <li>Ticket</li>
                    </ul>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a class="btn btn-danger" href="{{ url('delete-member') }}/{{ $membership->membership_id }}/{{ $membership_level->level_id }}/{{ $student->stud_id }}">Delete</a>
                  </div>
                </div>
              </div>
            @endif
            <button type="submit" class="btn btn-primary"><i class="bi bi-save pr-2"></i>Save  Changes</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- List Invoices -->
  <div class="flex-md-nowrap pt-3 mb-3">
    <h1 class="h2">Manage Student</h1>
      </div> 

      <div class="row">
        <div class="col-md-12 "> 
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Membership</th>
                            <th><i class="fas fa-cogs"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                      <tr>
                          <td>
                          1
                          </td>
                          <td>
                          Send Statement
                          </td>
                          <td>
                            <div class="modal fade" id="test" tabindex="-1" aria-labelledby="purchaseModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-scrollable">
                                  <div class="modal-content">
                                  <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Sending Confirmation</h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                      <p>Are you sure you want to send '<b>Statement of Account</b>' to this customer?</p>
                                      <p>Example: </p>
                                      <div class="text-center">
                                          <img src="{{ asset('assets/images/Statement.png') }}" style="max-width:300px">
                                      </div>
                                  </div>
                                  <div class="modal-footer">
                                      <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                                      <a class="btn btn-sm btn-dark" href="{{ url('send-statementmember') }}/{{ $student->membership_id }}/{{ $student->level_id }}/{{ $student->stud_id }}">
                                          Send
                                      </a>
                                  </div>
                                  </div>
                              </div>
                            </div>
                            <button type="sendstatement" data-bs-toggle="modal" data-bs-target="#test" class="btn btn-danger"><i class="bi bi-save pr-2"></i>Send Statement</button>
                          </td>
                      </tr>
                    </tbody>
                    <tbody>
                      <tr>
                          <td>
                          2
                          </td>
                          <td>
                          Upload Cheque
                          </td>
                          <td>
                            <div class="modal fade" id="newcustomer" tabindex="-1" role="dialog" aria-labelledby="newcustomerLabel" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                  <div class="modal-header border-bottom-0">
                                    <h5 class="modal-title" id="exampleModalLabel">Insert Check Information</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <form action="{{ url('uploadCheque') }}/{{ $membership->membership_id }}/{{ $membership_level->level_id }}/{{ $student->stud_id }}" method="POST"> 
                                  @csrf
                                    <div class="form-group row px-4">
                                        <label for="name" class="col-sm-4 col-form-label">Cheque No.</label>
                                        <div class="col-sm-8">
                                        <input type="text" class="form-control" name="cheque_no" placeholder="09 123451 13 12455 14" maxlength="26" required>
                                        </div>
                                    </div>
                                    <div class="form-group row px-4">
                                        <label for="name" class="col-sm-4 col-form-label">Bank Name</label>
                                        <div class="col-sm-8">
                                        <input type="text" class="form-control" name="bankname" placeholder="Maybank" required>
                                        </div>
                                    </div>
                                    <div class="form-group row px-4">
                                        <label for="name" class="col-sm-4 col-form-label">Total Price</label>
                                        <div class="col-sm-8">
                                        <input type="text" class="form-control" name="price" placeholder="RM 10 000" value="" required>
                                        </div>
                                    </div>
                                    <div class="form-group row px-4">
                                        <label for="name" class="col-sm-4 col-form-label">Date</label>
                                        <div class="col-sm-8">
                                        <input type="date" class="form-control" name="date_payment" placeholder="10/10/2021" required>
                                        </div>
                                    </div>
                                    @if ($membership_level->name == 'Ultimate Plus')
                                      <div class="form-group row px-4">
                                          <label for="name" class="col-sm-4 col-form-label">Membership</label>
                                          <div class="col-sm-8">
                                          <select name="membership_type" class="form-select" required>
                                              <option value="ultimateplus" disabled selected>Ultimate Plus</option>
                                          </select>
                                          </div>
                                      </div>
                                    @elseif ($membership_level->name == 'Ultimate Partners')
                                      <div class="form-group row px-4">
                                          <label for="name" class="col-sm-4 col-form-label">Membership</label>
                                          <div class="col-sm-8">
                                          <select name="membership_type" class="form-select" required>
                                              <option value="ultimatepartners" disabled selected>Ultimate Partners</option>
                                          </select>
                                          </div>
                                      </div>
                                    @elseif ($membership_level->name == 'Platinum Pro')
                                      <div class="form-group row px-4">
                                          <label for="name" class="col-sm-4 col-form-label">Membership</label>
                                          <div class="col-sm-8">
                                          <select name="membership_type" class="form-select" required>
                                              <option value="platinumpro" disabled selected>Platinum Pro</option>
                                          </select>
                                          </div>
                                      </div>
                                    @elseif ($membership_level->name == 'Platinum Lite')
                                      <div class="form-group row px-4">
                                          <label for="name" class="col-sm-4 col-form-label">Membership</label>
                                          <div class="col-sm-8">
                                          <select name="membership_type" class="form-select" required>
                                              <option value="platinumlite" disabled selected>Platinum Lite</option>
                                          </select>
                                          </div>
                                      </div>
                                    @endif
                                    <div class='col-md-12 text-right px-4 pb-4'>
                                      {{-- <button type="submit"  class="btn btn-small btn-dark"><i class="bi bi-upload pr-2"></i>Upload</button> --}}
                                      <button type="post" href="{{ url('uploadCheque') }}/{{ $membership->membership_id }}/{{ $membership_level->level_id }}/{{ $student->stud_id }}" class='btn btn-success btn-dark'> <i class="bi bi-save pr-2"></i> Upload </button>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                            <button type="insertcheck" data-bs-toggle="modal" data-bs-target="#newcustomer" class="btn btn-warning"><i class="bi bi-save pr-2"></i>Upload Check</button>
                          </div>
                      </div>
                          </td>
                      </tr>
                    </tbody>
                </table>   
            </div>  
        </div>
      </div>
  <!-- List Invoices -->
  <div class="flex-md-nowrap pt-3 mb-3">
      <h1 class="h2">List Invoices</h1>
  </div> 
  
  <div class="row">
    <div class="col-md-12 "> 
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Membership</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Price</th>
                        <th class="text-center"><i class="fas fa-cogs"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($invoices as $key => $invoice)
                        <tr>
                            <td>
                            {{( ( $invoices->currentPage() - 1 ) * 10) + $key + 1}}
                            </td>
                            <td>
                            {{ $membership_level->name }}
                            </td>
                            <td>
                            {{ $invoice->for_date }}
                            </td>
                            <td>
                                @if ($invoice->status == 'not paid')
                                    <span class="badge bg-danger">Unpaid</span>
                                @endif

                                @if ($invoice->status == 'paid')
                                    <span class="badge bg-success">Paid</span>
                                @endif
                            </td>
                            <td>
                            <b>RM {{ number_format($invoice->price) }}</b>
                            </td>
                            <td class="text-center">
                            <a href="{{ url('download-invoice') }}/{{ $membership_level->level_id }}/{{ $invoice->invoice_id }}/{{ $student->stud_id }}" class="btn-sm btn-secondary text-decoration-none"><i class="fas fa-download pr-2"></i>Invoice</a>
                            <a href="{{ url('send-invoicemember') }}/{{ $student->membership_id }}/{{ $student->level_id }}/{{ $invoice->invoice_id }}/{{ $student->stud_id }}"class="btn-sm btn-success"><i class="bi bi-save pr-2"></i>Send Invoice</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>   
            @if(isset($query))
                {{ $invoices->appends(['search' => $query])->links() }} 
            @else
                {{ $invoices->links() }} 
            @endif
        </div>  
    </div>
  </div>

  <!-- List Receipt -->
  <div class="flex-md-nowrap mt-4">
      <h1 class="h2">List Receipt</h1>
  </div> 
  
  <div class="row">
    <div class="col-md-12 ">     
        <div class="table-responsive">
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
                            <td>{{ $key+1 }}</td>
                            <td>
                                {{ $membership_level->name }}
                            </td>
                            <td>
                                {{ date('d/m/Y', strtotime($p->created_at)) }}
                            </td>
                            <td>
                                <b>RM {{ number_format($p->pay_price) }}.00</b>
                            </td>
                            <td>
                                <a href="{{ url('download-receipt') }}/{{ $membership_level->level_id }}/{{ $p->payment_id }}/{{ $student->stud_id }}" class="btn-sm btn-secondary mr-8 float-left text-decoration-none"><i class="fas fa-download pr-2"></i>Receipt</a>
                                <a href="{{ url('send-receiptmember') }}/{{ $student->membership_id }}/{{ $membership_level->level_id }}/{{ $p->payment_id }}/{{ $student->stud_id }}" class="btn-sm mr-8 ml-1 float-left text-decoration-none btn-warning"><i class="bi bi-save pr-2"></i>Send Receipt</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No result founds</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>  
            @if(isset($query))
                {{ $payment->appends(['search' => $query])->links() }} 
            @else
                {{ $payment->links() }} 
            @endif
        </div>  
    </div>
  </div>
</div>
@endsection
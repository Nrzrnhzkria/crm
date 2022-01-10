@extends('layouts.temp')

@section('title')
{{ $packageName }}
@endsection

@section('content')
<div class="row pt-4">
    <div class="col-md-12 px-2 py-5 text-center">
        <img src="/assets/images/logo.png" style="max-width:150px">
        <h1 class="display-5 text-dark px-3 pt-4">{{ $productName }}</h1>
    </div>
    
    <div class="col-md-6 offset-md-3">
        <div class="card px-4 py-4 shadow">
            <div class="bg-dark text-white px-2 py-2">Langkah 2/2: Maklumat Bisnes</div>
            <div class="card-body">
                <form action="{{ url('save-business-details') }}/{{ $ticket_id }}" method="POST" class="col-md-12">
                    @csrf
                    <h5 class="card-title">Insert Your Bussiness Details</h5>
                    <hr>
                    
                    <div class="pb-3 form-group">
                        <label for="formGroupExampleInput">Bussiness Type</label>
                        <input type="text" name="business" class="form-control" id="formGroupExampleInput" placeholder="Bussiness type" required>
                        <small id="emailHelp" class="form-text text-muted">Bussiness type such as beauty product, food supplier and etc.</small>
                    </div>

                    <div class="pb-3 row">
                        <div class="form-group col-md-6">
                            <label for="formGroupExampleInput2">Monthly income</label>
                            {{-- <input type="number" name="income" class="form-control" min="0" id="formGroupExampleInput2" placeholder="0" onkeypress="return isNumber(event)" required> --}}
                            <select id="inputState" class="form-control" name='income' required>
                                <option value=''>Choose...</option>
                                @foreach ($incomeOptions as $i)
                                    <option value="{{ $i->range }}">{{ $i->range }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputState">Business Role</label>
                            <select id="inputState" class="form-control" name='role' required>
                                <option value=''>Choose...</option>
                                <option value="Employee">Employee</option>
                                <option value="Dropship">Dropship</option>
                                <option value="Agent">Agent</option>
                                <option value="Founder">Founder</option>
                            </select>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save pr-2"></i> Submit</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-12 text-center pt-3">
        <a href="https://momentuminternet.com/privacy-policy/">Privacy & Policy</a>
    </div>
</div>
<script type="text/javascript">     
    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if ( (charCode > 31 && charCode < 48) || charCode > 57) {
            return false;
        }
        return true;
    }
</script>

<footer class="text-center px-4 py-5">
    <b>Momentum Internet (1079998-A) © 2020 All Rights Reserved​</b>
</footer>

@endsection
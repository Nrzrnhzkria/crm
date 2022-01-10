@extends('layouts.app')

@section('title')
    Package 
@endsection

<style>
    /*  Remove Arrows/Spinners for Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
    }

    /*  Remove Arrows/Spinners for Firefox */
    input[type=number] {
    -moz-appearance: textfield;
    }
</style>

@section('content')

<div class="col-md-12 pt-3">
        
    <div class="card-header py-2" style="border: 1px solid rgb(233, 233, 233); border-radius: 5px;">
        <a href="{{ url('package')}}/{{ $product->product_id }}"><i class="bi bi-arrow-left"></i></a> &nbsp; <a href="dashboard">...</a> / <a href="/product">Event</a> / <a href="{{ url('package')}}/{{ $product->product_id }}">Package</a> / <b>Create Package</b>
    </div>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2 class="h2">Create Package</h2>
    </div>
    
    <!-- Add package form ---------------------------------------------------->
    <form class="row g-3 px-3" action="{{ url('storepack') }}/{{ $product->product_id }}/{{ $product->offer_id }}" method="POST" id="dynamic_form" enctype="multipart/form-data"> 
    @csrf
            <div class='col-md-8'>
                <div class='row'>
                    <div class='col-md-9'>         
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input name="name" type="text" class="form-control" required>
                        </div>
                    </div>
            
                    <div class='col-md-3'>
                        <div class="form-group">
                            <label for="phone">Price (RM)</label>
                            <input name="price" type="number" class="form-control" required>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- <div class="col-md-8">                         
                <div class="form-group">
                    <label for="formFile" class="form-label">Package Image</label>
                    <input class="form-control" type="file" id="formFile" name="package_image">
                </div>
            </div> --}}

            <div class="col-md-8">
                <label for="feature">Features</label>
                <div id="inputFormRow">
                    <div class="input-group mb-3">
                        <input type="text" name="feature[]" class="form-control" autocomplete="off" required>
                        <div class="input-group-append">                
                            <button id="removeRow" type="button" class="btn btn-danger"><i class="bi bi-x-lg"></i></button>
                        </div>
                    </div>
                </div>
    
                <div id="newRow"></div>
                <button id="addRow" type='button' class='btn'><i class="bi bi-plus-lg pr-2"></i>Add Row</button>
            </div>
                
            <div class='col-md-8 pt-3'>
                <button type='submit' class='btn btn-primary float-right'> <i class="bi bi-save pr-2"></i>Submit </button>
            </div>
        
    </form>
</div>

<!-- Enable function to add row ------------------------------------------>
<script type="text/javascript">
    // add row
    $("#addRow").click(function () {
        var html = '';
        html += '<div id="inputFormRow">';
        html += '<div class="input-group mb-3">';
        html += '<input type="text" name="feature[]" class="form-control" autocomplete="off" required>';
        html += '<div class="input-group-append">';
        html += '<button id="removeRow" type="button" class="btn btn-danger"><i class="bi bi-x-lg"></i></button>';
        html += '</div>';
        html += '</div>';

        $('#newRow').append(html);
    });

    // remove row
    $(document).on('click', '#removeRow', function () {
        $(this).closest('#inputFormRow').remove();
    });
</script>

@endsection
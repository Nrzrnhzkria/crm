@extends('layouts.app')

@section('title')
  Edit Email Template
@endsection

@section('content')
<div class="row px-4 py-4">
	<div class="col-md-12">
		<div class="card-header py-2" style="border: 1px solid rgb(233, 233, 233); border-radius: 5px;">
			<a href="/emailtemplate"><i class="bi bi-arrow-left"></i></a> &nbsp; 
			<a href="/dashboard">Dashboard</a> / 
			<a href="/emailtemplate">Email Template</a> / 
			<b>Delete Email Template</b>
		</div> 

		<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
			<h1 class="h2">Delete Email Template</h1>
		</div>
		
		
		<br>
			
		@if ($message = Session::get('success'))
		<div class="alert alert-success alert-block">
			<button type="button" class="close" data-bs-dismiss="alert">×</button>	
			<strong>{{ $message }}</strong>
		</div>
		@endif
		
		@if ($message = Session::get('error'))
		<div class="alert alert-danger alert-block">
			<button type="button" class="close" data-bs-dismiss="alert">×</button>	
			<strong>{{ $message }}</strong>
		</div>
		@endif
		
		@if($emailTemplate->count() > 0)
		<form action="{{ url('emailtemplate/delete') }}/{{ $emailTemplate->id }}" method="POST">
			{{ method_field('DELETE') }}
			
			@csrf
			
			<div class='col-md-12'>
				By clicking below button will remove email template titled <strong>{{ $emailTemplate->name }}</strong> permanently.<br /><br />
				<button type='submit' class='btn btn-danger'> 
					<i class="fas fa-trash pr-1"></i> Permanent Delete 
				</button>
			</div>
			
			
		</form>
		@else
			<div class="alert alert-danger alert-block">
				<strong>Selected data is not availble in database. Please select a correct data.</strong>
			</div>
		@endif
	</div>
</div>

@endsection





























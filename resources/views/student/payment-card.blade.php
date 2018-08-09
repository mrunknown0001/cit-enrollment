@extends('layouts.student-layout')

@section('title') Payment @endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Tuition Fee Card Payment</h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0)"><i class="fa fa-credit-card"></i> Home</a></li>
			<li class="active">Payment</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				@include('includes.all')
				
				<div class="box box-primary">
					<div class="box-header with-border">
						<strong><i class="fa fa-credit-card"></i> Tuition Fee Card Payment</strong>
					</div>
					<div class="box-body">
						<div class="row">
							<div class="col-md-6">
								<p><em>Field with red asterisk (<label class="label-required">*</label>) are required fields.</em></p>
								<p>Balance: <strong>&#8369; {{ $balance->balance }}</strong></p>
								<form action="{{ route('student.review.tuition.fee.card.payment') }}" method="GET" autocomplete="off">
									{{ csrf_field() }}
									
									<input type="hidden" name="mop" value="card">
									<input type="hidden" name="currency" value="PHP">
									<input type="hidden" name="name" value="{{ env('app_name') }}">
									<input type="hidden" name="description" value="Tuition Fee Payment using Card">

									<div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
										<label for="amount">Enter Amount to Pay</label><label class="label-required">*</label>
										<input id="amount" type="number" class="form-control" name="amount" placeholder="Enter Amount to Pay" min="500" max="{{ $balance->balance }}" required="">
										@if ($errors->has('amount'))
											<span class="help-block">
												<strong>{{ $errors->first('amount') }}</strong>
											</span>
										@endif
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-primary">Pay with Card</button>
										&nbsp; &nbsp; &nbsp;
										<a href="{{ route('student.balance') }}">Cancel</a>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="box-footer">
						
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
@endsection
@extends('layouts.cashier-layout')

@section('title') Payment @endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Make Payment</h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0)"><i class="fa fa-money"></i> Home</a></li>
			<li class="active">Payment</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<p><a href="{{ route('cashier.payments') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back to Payments</a></p>
				@include('includes.all')
				<div class="box box-primary">
					<div class="box-header with-border">
						<strong><i class="fa fa-money"></i> Make Payment</strong>
					</div>
					<div class="box-body">
				        <p>Name: <strong>{{  $student->firstname . ' ' . $student->lastname }}</strong></p>
				        <p>Student Number: <strong>{{ $student->student_number }}</strong></p>

				        <p>Current Balance: <strong>&#8369; {{ $student->balance->balance }}</strong></p>
						<p><em>Field with red asterisk (<label class="label-required">*</label>) are required fields.</em></p>
				        <form action="{{ route('cashier.make.payment.post') }}" method="POST" autocomplete="off">
				        	{{ csrf_field() }}
				        	<input type="hidden" name="student_id" value="{{ $student->id }}">
							<div class="row">
								<div class="col-md-4">
									<div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
										<label for="amount">Enter Amount</label><label class="label-required">*</label>
										<input id="amount" type="number" class="form-control" name="amount" min="500" max="{{ $student->balance->balance }}" placeholder="Enter Amount" autofocus required="">
										@if ($errors->has('amount'))
											<span class="help-block">
												<strong>{{ $errors->first('amount') }}</strong>
											</span>
										@endif
									</div>

									<div class="form-group">
										<label>Enter Remark <i>(Optional)</i></label>
										<input type="text" name="remark" id="remark" class="form-control" placeholder="Enter Remark (Optional)">
									</div>
								</div>
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-primary">Make Payment</button>
							</div>
				        </form>
					</div>
					<div class="box-footer">
						
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
@endsection
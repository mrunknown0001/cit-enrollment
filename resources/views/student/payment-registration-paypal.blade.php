@extends('layouts.student-layout')

@section('title') Payment @endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Paypal Registration Payment</h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0)"><i class="fa fa-paypal"></i> Home</a></li>
			<li class="active">Payment</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				@include('includes.all')
				
				<div class="box box-primary">
					<div class="box-header with-border">
						<strong><i class="fa fa-paypal"></i> Paypal Registration Payment</strong>
					</div>
					<div class="box-body">
						<div class="row">
							<div class="col-md-6">
								<form action="#" method="POST" autocomplete="off">
									{{ csrf_field() }}
									
									<input type="hidden" name="mop" value="paypal">
									<input type="hidden" name="currency" value="PHP">
									<input type="hidden" name="name" value="Paypal Payment Registration">
									<input type="hidden" name="description" value="Registration Payment using Paypal">

									<div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
										<label for="amount">Enter Amount to Pay</label><label class="label-required">*</label>
										<input id="amount" type="number" class="form-control" name="amount" placeholder="Enter Amount to Pay" min="500" required="">
										@if ($errors->has('amount'))
											<span class="help-block">
												<strong>{{ $errors->first('amount') }}</strong>
											</span>
										@endif
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-primary">Pay with Paypal</button>
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
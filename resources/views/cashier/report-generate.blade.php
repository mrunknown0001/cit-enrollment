@extends('layouts.cashier-layout')

@section('title') Generate Report @endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Generate Report</h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0)"><i class="fa fa-bar-chart"></i> Home</a></li>
			<li class="active">Reports</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<p><a href="{{ route('cashier.payments') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Back to Payments</a></p>
				@include('includes.all')
				<div class="box box-danger">
					<div class="box-header with-border">
						<strong><i class="fa fa-bar-chart"></i> Generate Report</strong>
					</div>
					<div class="box-body">
						<p><a href="{{ route('cashier.generate.all.report.payment') }}" class="btn btn-danger"> All Payments</a></p>
						<p><a href="{{ route('cashier.payment.current.semester.report') }}" class="btn btn-danger"> Payments in Current Semester</a></p>
						<p><button class="btn btn-danger" data-toggle="modal" data-target="#dateRangePayment">Custom Date Range Payment</button></p>
						@include('cashier.includes.modal-payment-date-range')
					</div>
					<div class="box-footer">
						
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
@endsection
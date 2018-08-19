@extends('layouts.student-layout')

@section('title') Payments @endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Payment Details</h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0)"><i class="fa fa-money"></i> Home</a></li>
			<li class="active">Payment</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<p><a href="{{ route('student.payments') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back to Payments</a></p>
				@include('includes.all')

				<div class="box box-primary">
					<div class="box-header with-border">
						<strong><i class="fa fa-money"></i> Payment Details</strong>
					</div>
					<div class="box-body">
						<button class="btn btn-primary" onclick="window.print()"><i class="fa fa-print"></i></button>
						<div class="row">
							<div class="col-md-4">
								<div id="printArea">
									<h3 class="text-center">CIT COLLEGES</h3>
									<p class="text-center"><small>Paniqui, Tarlac</small></p>
									<p></p>
									<p class="text-center">Date: {{ date('m/d/Y', strtotime($payment->created_at)) }}</p>
									<p></p>
									<p>Name: <strong>{{ ucwords($payment->student->firstname . ' ' . $payment->student->lastname) }}-{{ $payment->student->student_number }}</strong></p>
									<p></p>
									<p>Amount: &#8369; {{ $payment->amount }}</h3>
									<p>Description: {{ $payment->description }}</p>

								</div>
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
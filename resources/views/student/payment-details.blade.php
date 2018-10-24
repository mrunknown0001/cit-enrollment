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
			<div class="col-md-6">
				<p><a href="{{ route('student.payments') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back to Payments</a></p>
				@include('includes.all')

				<div class="box box-primary">
					<div class="box-header with-border">
						<strong><i class="fa fa-money"></i> Payment Details</strong>
					</div>
					<div class="box-body">
						<button class="btn btn-primary" onclick="window.print()"><i class="fa fa-print"></i></button>
						<div id="printArea" class="studentPayment">
							<!-- <div class="row">
								<div class="col-md-4"> -->
									<h3 class="text-center">CIT Colleges of Paniqui Foundation, Inc.</h3>
									<p class="text-center"><small>Paniqui, Tarlac</small></p>
									<p class="text-center">STATEMENT OF ACCOUNT</p>
									<p class="text-center">AS of <u>{{ date('F d, Y', strtotime($payment->created_at)) }}</u></p>
									<p></p>
									<p>ID Number: <strong>{{ $payment->student->student_number }}</strong></p>
									<p>Name: <strong>{{ ucwords($payment->student->firstname . ' ' . $payment->student->lastname) }}</strong></p>
									<p>Coures: {{ Auth::user()->enrolled->course->code }}</p>
									<p>Amount Paid: &#8369; {{ $payment->amount }}</p>

									<table class="table table-bordered">
										<thead>
											<tr>
												<th class="text-center">Term SY</th>
												<th class="text-center">Debit</th>
												<th class="text-center">Credit</th>
												<th class="text-center">Balance</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td class="text-cneter">
													Current
												</td>
												<td class="text-center">
													&#8369; {{ $assessment->amount }}
												</td>
												<td class="text-center">
													&#8369; {{ $assessment->amount - $payment->current_balance }}
												</td>
												<td class="text-center">
													&#8369; {{ $payment->current_balance }}
												</td>
											</tr>
											<tr>
												<td class="text-cneter">
													Previous Bal
												</td>
												<td></td>
												<td></td>
												<td></td>
											</tr>
											<tr>
												<td class="text-cneter">
													Outstanding
												</td>
												<td></td>
												<td></td>
												<td></td>
											</tr>
										</tbody>
									</table>
									<p><i>Description: {{ $payment->description }}</i></p>

								<!-- </div>
							</div> -->
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
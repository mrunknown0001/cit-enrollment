@extends('layouts.student-layout')

@section('title') Payment @endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Review Card Registration Payment</h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0)"><i class="fa fa-credit-card"></i> Home</a></li>
			<li class="active">Payment</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				@include('includes.all')
				
				<div class="box box-danger">
					<div class="box-header with-border">
						<strong><i class="fa fa-credit-card"></i> Review Card Registration Payment</strong>
					</div>
					<div class="box-body">
						<div class="row">
							<div class="col-md-6">
								<label class="label-required">Click Pay with Card button to continue...</label>
								<p>Paying: <strong>&#8369; {{ $amount }}</strong></p>
								<form action="{{ route('student.card.registration.payment.post') }}" method="POST" autocomplete="off">
									{{ csrf_field() }}
									<input type="hidden" name="amount" value="{{ $amount . '00' }}">
									<input type="hidden" name="description" value="{{ $description }}">
									<div class="form-group">
										<script
											src="https://checkout.stripe.com/checkout.js" class="stripe-button"
											data-key="pk_test_0tUxQsySTpP3YXHTUHS148lv"
											data-amount="{{ $amount . '00' }}"
											data-currency="php"
											data-name="{{ $name }}"
											data-description="{{ $description }}"
											data-image="{{ asset('uploads/logo.png') }}"
											data-locale="auto">
										</script>
									</div>
									<div class="form-group">
										<a href="{{ route('student.card.registration.payment') }}">Cancel</a>
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
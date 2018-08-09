@extends('layouts.student-layout')

@section('title') Balance @endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Balance</h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0)"><i class="fa fa-usd"></i> Home</a></li>
			<li class="active">Balance</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				@if(count($enrolled) > 0)
					@include('student.includes.make-payment')
				@endif

				@include('includes.all')

				<div class="box box-primary">
					<div class="box-header with-border">
						<strong><i class="fa fa-usd"></i> Balance</strong>
					</div>
					<div class="box-body">
						@if(count($balance) > 0)
							<p>Balance: <strong>&#8369; {{ $balance->balance }}</strong></p>
							<p>Total Tuition Fee: <strong>&#8369; {{ $balance->total }}</strong></p>
						@else
							<p class="text-center">No Balance!</p>
						@endif
					</div>
					<div class="box-footer">
						
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
@endsection
@extends('layouts.cashier-layout')

@section('title') Payment @endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Payment over the Counter</h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0)"><i class="fa fa-money"></i> Home</a></li>
			<li class="active">Payment</li>
		</ol>
	</section>
	<section class="content">
		<p><a href="{{ route('cashier.payments') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back to Payments</a></p>
		@include('includes.all')
		<div class="row">
			<div class="col-md-4">
				<form action="{{ route('registrar.search.student') }}" method="get" class="" autocomplete="off">
					<div class="input-group">
						<input type="text" name="q" class="form-control" placeholder="Search Student">
						<span class="input-group-btn">
							<button type="submit" id="search-btn" class="btn btn-flat btn-primary"><i class="fa fa-search"></i>
						</button>
						</span>
					</div>
				</form>	
			</div>
			<div class="col-md-12">
				<h3 class="text-center"><em>Search Student to Take Payment</em></h3>
			</div>
		</div>
	</section>
</div>
@endsection
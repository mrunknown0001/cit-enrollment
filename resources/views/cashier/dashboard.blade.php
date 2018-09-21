@extends('layouts.cashier-layout')

@section('title') Cashier Dashboard @endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Dashboard</h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0)"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Dashboard</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<p><a href="{{ route('cashier.student.counter.payment') }}" class="btn btn-primary btn-lg"><i class="fa fa-money"></i> Make Payment</a></p>
				@include('includes.all')

			</div>
		</div>
	</section>
</div>
@endsection
@extends('layouts.cashier-layout')

@section('title') Payment Tagging @endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Payment Tagging</h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0)"><i class="fa fa-Money"></i> Home</a></li>
			<li class="active">Payment Tagging</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-4">
				<form action="{{ route('cashier.search.student') }}" method="get" class="" autocomplete="off">
					<div class="input-group">
						<input type="text" name="q" class="form-control" placeholder="Search Student Name or LRN">
						<span class="input-group-btn">
							<button type="submit" id="search-btn" class="btn btn-flat btn-danger"><i class="fa fa-search"></i>
						</button>
						</span>
					</div>
				</form>	
			</div>
			<br>
			<div class="col-md-12">
				@include('includes.all')
				<h3 class="text-center"><em>Search Student</em></h3>
			</div>
		</div>
	</section>
</div>
@endsection
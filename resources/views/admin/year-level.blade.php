@extends('layouts.admin-layout')

@section('title') Year Level @endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Year Level</h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0)"><i class="fa fa-bars"></i> Home</a></li>
			<li class="active">Year Level</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				@include('includes.all')
			</div>
		</div>
	</section>
</div>
@endsection
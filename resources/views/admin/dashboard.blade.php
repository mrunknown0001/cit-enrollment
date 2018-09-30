@extends('layouts.admin-layout')

@section('title') Admin Dashboard @endsection

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
				@include('includes.all')
				@include('admin.includes.enrollment-settings')
			</div>
		</div>
		<div class="row">
			<div class="col-lg-3 col-xs-6">
				<div class="small-box bg-primary">
					<div class="inner">
						<h3>{{ $students }}</h3>
						<p>Students Total</p>
					</div>
					<div class="icon">
						<i class="fa fa-graduation-cap"></i>
					</div>
					<a href="{{ route('admin.students') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>


			<div class="col-lg-3 col-xs-6">
				<div class="small-box bg-primary">
					<div class="inner">
						<h3>{{ $courses }}</h3>
						<p>Courses</p>
					</div>
					<div class="icon">
						<i class="fa fa-book"></i>
					</div>
					<a href="{{ route('admin.courses') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
		</div>
	</section>
</div>
@endsection
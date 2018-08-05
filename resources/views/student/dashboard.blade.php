@extends('layouts.student-layout')

@section('title') Student Dashboard @endsection

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
				
				{{-- check if student is regular or irregular --}}
				{{-- show only if the student is regular and enrollment is active --}}
				@if($es->active == 1)
					@if(count($rp) < 1) 
						@include('student.includes.registration-payment')
					@endif
				@endif

				<div class="box box-primary">
					<div class="box-header with-border">
						<strong><i class="fa fa-graduation-cap"></i> Educational Profile</strong>
					</div>
					<div class="box-body">
						<div class="row">
							<div class="col-md-6">
								<p>Course: <strong>{{ Auth::user()->enrolled->course->title }}</strong></p>
								<p>Year Level: <strong>{{ Auth::user()->info->year_level->name }}</strong></p>
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
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
				
				{{-- shwo if the assessment is already available --}}

				{{-- check if student is regular or irregular --}}
				{{-- show only if the student is regular and enrollment is active --}}
				{{-- @if($es->active == 1)
					@if(count($rp) < 1) 
						@include('student.includes.registration-payment')
					@endif
				@endif --}}

				<div class="box box-danger">
					<div class="box-header with-border">
						<strong><i class="fa fa-graduation-cap"></i> Student Profile</strong>
					</div>
					<div class="box-body">
						<div class="row">
							<div class="col-md-12">
								<p><strong>{{ ucwords(Auth::user()->firstname . ' ' . Auth::user()->lastname) }} - {{ Auth::user()->student_number }}</strong></p>
								<p>Course: <strong>{{ Auth::user()->enrolled->course->title }}</strong></p>
								<p>Year Level: <strong>{{ Auth::user()->info->year_level->name }}</strong></p>
								<div class="row">
									<div class="col-md-6">
										<p>Address: <strong>{{ ucwords(Auth::user()->info->home_address) }}</strong></p>
									</div>
									<div class="col-md-6">
										<p>Nationality: <strong>{{ ucwords(Auth::user()->info->nationality) }}</strong></p>
									</div>
									<div class="col-md-6">
										<p>Civil Status: <strong>{{ ucwords(Auth::user()->info->civil_status) }}</strong></p>
									</div>
									<div class="col-md-6">
										<p>Date of Birth: <strong>{{ Auth::user()->info->date_of_birth == '1970-01-01' ? 'N/A' : date('m/d/Y', strtotime(Auth::user()->info->date_of_birth)) }}</strong></p>
									</div>
									<div class="col-md-6">
										<p>Age: <strong>{{ Auth::user()->info->date_of_birth == '1970-01-01' ? 'N/A' : date('Y') - date('Y', strtotime(Auth::user()->info->date_of_birth)) }}</strong></p>
									</div>
									<div class="col-md-6">
										<p>Place of Birth: <strong>{{ ucwords(Auth::user()->info->place_of_birth) }}</strong></p>
									</div>

									<div class="col-md-12">
										<p>Religious Afflication: <strong>{{ ucwords(Auth::user()->info->religion) }}</strong></p>
									</div>

									<div class="col-md-6">
										<p>Father: <strong>{{ ucwords(Auth::user()->info->fathers_name) }}</strong></p>
									</div>
									<div class="col-md-6">
										<p>Mother: <strong>{{ ucwords(Auth::user()->info->mothers_name) }}</strong></p>
									</div>

									<div class="col-md-6">
										<p>Guardian's Name: <strong>{{ ucwords(Auth::user()->info->guardians_name) }}</strong>
									</div>
									<div class="col-md-6">
										<p>Guardian's Address: <strong>{{ ucwords(Auth::user()->info->guardians_address) }}</strong>
									</div>
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
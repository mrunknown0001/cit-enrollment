@extends('layouts.admin-layout')

@section('title') Students @endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Student Info</h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0)"><i class="fa fa-graduation-cap"></i> Home</a></li>
			<li class="active">Student</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<p>
					<a href="{{ route('admin.students') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Back to Students</a>
				</p>
				@include('includes.all')
				<div class="box box-danger">
					<div class="box-header with-border">
						<strong>Student Information</strong>
					</div>
					<div class="box-body">
						<div class="row">
							<div class="col-md-6">
								<p>Name: <strong>{{ ucwords($student->firstname) }} {{ $student->middle_name ? substr($student->middle_name, 0, 1) . '.' : '' }} {{ ucwords($student->lastname) }} {{ $student->suffix_name ? $student->suffix_name : '' }}</strong></p>
							</div>
							<div class="col-md-6">
								<p>Sex: <strong>{{ ucwords($student->info->sex) }}</strong></p>
							</div>

							<div class="col-md-6">
								<p>Address: <strong>{{ ucwords($student->info->home_address) }}</strong></p>
							</div>
							<div class="col-md-6">
								<p>Nationality: <strong>{{ ucwords($student->info->nationality) }}</strong></p>
							</div>
							<div class="col-md-6">
								<p>Status: <strong>{{ ucwords($student->info->civil_status) }}</strong></p>
							</div>

							<div class="col-md-6">
								<p>Date of Birth: <strong>{{ date('m/d/Y', strtotime($student->info->date_of_birth)) }}</strong></p>
							</div>
							<div class="col-md-6">
								<p>Age: <strong>{{ date('Y') - date('Y', strtotime($student->info->date_of_birth)) }}</strong></p>
							</div>
							<div class="col-md-6">
								<p>Place of Birth: <strong>{{ ucwords($student->info->place_of_birth) }}</strong></p>
							</div>

							<div class="col-md-12">
								<p>Religious Afflication: <strong>{{ ucwords($student->info->religion) }}</strong></p>
							</div>

							<div class="col-md-6">
								<p>Father: <strong>{{ ucwords($student->info->fathers_name) }}</strong></p>
							</div>
							<div class="col-md-6">
								<p>Mother: <strong>{{ ucwords($student->info->mothers_name) }}</strong></p>
							</div>

							<div class="col-md-6">
								<p>Guardian's Name: <strong>{{ ucwords($student->info->guardians_name) }}</strong>
							</div>
							<div class="col-md-6">
								<p>Guardian's Address: <strong>{{ ucwords($student->info->guardians_address) }}</strong>
							</div>
						</div>
						

					</div>
					<div class="box-footer">
						
					</div>
				</div>
				<p><a href="{{ route('admin.student.educational.info', ['id' => $student->id]) }}" class="btn btn-danger"><i class="fa fa-arrow-right"></i> View Educational Information</a></p>
			</div>
		</div>
	</section>
</div>
@endsection
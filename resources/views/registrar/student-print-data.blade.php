@extends('layouts.registrar-layout')

@section('title') Student Print Data @endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1><i class="fa fa-print"></i> Student Print Data</h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0)"><i class="fa fa-graduation-cap"></i> Home</a></li>
			<li class="active">Student</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<button class="btn btn-primary" onclick="window.print()"><i class="fa fa-print"></i> Print</button>
				<hr>
				@include('includes.all')
				<div id="printArea">
					<div class="row">
						<div class="col-md-6">
							<p>Name: <strong>{{ $student->firstname . ' ' . $student->lastname }}</strong></p>
							<p>Student Number: <strong>{{ $student->student_number }}</strong></p>
							<p>Birthday: <strong>{{ date('m/d/Y', strtotime($student->info->date_of_birth)) }}</strong></p>
							<p>Sex: <strong>{{ $student->info->sex }}</strong></p>
							<p>Mobile Number: <strong>{{ $student->info->mobile_number }}</strong></p>
							<p>Email: <strong>{{ $student->info->email }}</strong></p>
							<p>Father: <strong>{{ $student->info->fathers_name }}</strong></p>
						</div>
						<div class="col-md-6">
							{{-- <p>Course: <strong>{{ $student->enrolled->course->title }}</strong></p> --}}
							<p>Curriculum: <strong>{{ $student->info->year_level->name }}</strong></p>
							<p>Place of Birth: <strong>{{ $student->info->place_of_birth }}</strong></p>
							<p>Civil Status: <strong>{{ $student->info->civil_status }}</strong></p>
							<p>Address: <strong>{{ $student->info->home_address }}</strong></p>
							<p>Nationality: <strong>{{ $student->info->nationality }}</strong></p>
							<p>Mother: <strong>{{ $student->info->mothers_name }}</strong></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
@endsection
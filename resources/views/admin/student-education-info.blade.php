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
					<a href="{{ route('admin.students') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back to Students</a>
				</p>
				@include('includes.all')
				<div class="box box-primary">
					<div class="box-header with-border">
						<strong>Student Information</strong>
					</div>
					<div class="box-body">
						
						<div class="row">
							<div class="col-md-9">
								<p>Elementary Completed at: <strong>{{ ucwords($student->prev->elementary_school) }}</strong></p>
							</div>
							<div class="col-md-3">
								<p>Year: <strong>{{ $student->prev->elementary_year_graduated }}</strong></p>
							</div>

							<div class="col-md-9">
								<p>High School Completed at: <strong>{{ ucwords($student->prev->high_school) }}</strong></p>
							</div>
							<div class="col-md-3">
								<p>Year: <strong>{{ $student->prev->high_school_year_graduated }}</strong></p>
							</div>

							<div class="col-md-9">
								<p>College Degree/Title Obtained (if any): <strong>{{ strtoupper($student->prev->college_school) }}</strong></p>
							</div>
							<div class="col-md-3">
								<p>Year: <strong>{{ $student->prev->college_year_graduated }}</strong></p>
							</div>

							<div class="col-md-9">
								<p>School Last Attended: <strong>{{ ucwords($student->prev->school_last_attended) }}</strong></p>
							</div>
							<div class="col-md-3">
								<p>Year: <strong>{{ $student->prev->year_graduated }}</strong></p>
							</div>

							<div class="col-md-12">
								<p>School Location: <strong>{{ ucwords($student->prev->school_address) }}</strong></p>
							</div>
						</div>
						
					</div>
					<div class="box-footer">
						
					</div>
				</div>
				<p><a href="{{ route('admin.student.personal.info', ['id' => $student->id]) }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> View Personal Information</a></p>
			</div>
		</div>
	</section>
</div>
@endsection
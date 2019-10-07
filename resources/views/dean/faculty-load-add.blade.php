@extends('layouts.dean-layout')

@section('title') Faculty Load @endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Add Faculty Load</h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0)"><i class="fa fa-user"></i> Home</a></li>
			<li class="active">Faculty Load</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<p>
					<a href="{{ route('dean.faculty.load') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Back to Faculty Loads</a>
				</p>
				@include('includes.all')
				<div class="box box-danger">
					<div class="box-header with-border">
						<strong><i class="fa fa-user"></i> Add Faculty Load</strong>
					</div>
					<div class="box-body">

					<div class="row">
						<div class="col-md-6">
							<p>Course: <strong>{{ ucwords($schedule->course->title) }}</strong></p>
							<p>Section: <strong>{{ strtoupper($schedule->section->name) }}</strong></p>
						</div>
						<div class="col-md-6">
							<p>Curriculum: <strong>{{ strtoupper($schedule->curriculum->name) }}</strong></p>
							<p>Year Level: <strong>{{ ucwords($schedule->year_level->name) }}</strong></p>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<p><em>Field with red asterisk (<label class="label-required">*</label>) are required fields.</em></p>
							<form action="{{ route('dean.add.faculty.load.post') }}" method="POST" autocomplete="off">
								{{ csrf_field() }}
								<input type="hidden" name="schedule_id" value="{{ $schedule->id }}">
								<div class="form-group">
									<label>Select Faculty</label><label class="label-required">*</label>
									<select name="faculty" id="faculty" class="form-control" required>
										<option value="">Select Faculty</option>
										@if(count($faculty) > 0)
											@foreach($faculty as $f)
											<option value="{{ $f->id }}">{{ ucwords($f->firstname . ' ' . $f->lastname) }}</option>
											@endforeach
										@endif
									</select>
								</div>
								<div class="form-group">
									<label>Select Subject</label><label class="label-required">*</label>
									<select name="subject" id="subject" class="form-control" required>
										<option value="">Select Subject</option>
										@if(count($subjects) > 0)
											@foreach($subjects as $s)
												<option value="{{ $s->id }}">{{ strtoupper($s->code) }}</option>
											@endforeach
										@else

										@endif
									</select>
								</div>
								<div class="form-group">
									<button class="btn btn-danger">Assign Load to Faculty</button>
								</div>
							</form>
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
@extends('layouts.dean-layout')

@section('title') Schedules @endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Add Schedule</h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0)"><i class="fa fa-calendar-check-o"></i> Home</a></li>
			<li class="active">Schedules</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<p><a href="{{ route('dean.schedules') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Back to Schedules</a></p>
				@include('includes.all')
				<div class="box box-danger">
					<div class="box-header with-border">
						<strong><i class="fa fa-calendar-check-o"></i> Add Schedule</strong>
					</div>
					<div class="box-body">
						
					<div class="row">
						<div class="col-md-6">
							{{-- <p>Course: <strong>{{ ucwords($course->title) }}</strong></p> --}}
							<p>Curriculum: <strong>{{ strtoupper($curriculum->name) }}</strong></p>
							<p>Strand: <strong>{{ $strand != NULL ? $strand->strand : "N/A" }}</strong></p>
							<p>Section: <strong>{{ strtoupper($section->name) }}</strong></p>
						</div>
						{{-- <div class="col-md-6">
							<p>Major: <strong>{{ count($major) > 0 ? ucwords($major->name) : 'N/A' }}</strong></p>
							<p>Year Level: <strong>{{ ucwords($yl->name) }}</strong></p>
							<p>Semester: <strong>{{ ucwords($sem->name) }}</strong></p>
						</div> --}}
					</div>
					<div class="row">
						<div class="col-md-6">
							<p><em>Field with red asterisk (<label class="label-required">*</label>) are required fields.</em></p>
							<form action="{{ route('dean.add.schedule.post') }}" method="POST" autocomplete="off">
								{{ csrf_field() }}
								{{-- <input type="hidden" name="course" value="{{ $course->id }}"> --}}
								{{-- <input type="hidden" name="major" value="{{ count($major) > 0 ? $major->id : '' }}"> --}}
								{{-- <input type="hidden" name="year_level" value="{{ $yl->id }}"> --}}
								<input type="hidden" name="section" value="{{ $section->id }}">
								<input type="hidden" name="curriculum" value="{{ $curriculum->id }}">
								<input type="hidden" name="strand" value="{{ $strand != NULL ? $strand->id : NULL }}">

								<div class="form-group">
									<label for="day">Select Day</label><label class="label-required">*</label>
									<select name="day" id="day" class="form-control underlined" required="">
										<option value="">Select Day</option>
										<option value="1">Monday</option>
										<option value="2">Tuesday</option>
										<option value="3">Wednesday</option>
										<option value="4">Thursday</option>
										<option value="5">Friday</option>
										<option value="6">Saturday</option>
										<option value="7">Sunday</option>
									</select>
								</div>
								<div class="form-group">
									<label for="room">Select Room</label><label class="label-required">*</label>
									<select name="room" id="room" class="form-control underlined" required="">
										<option value="">Select Room</option>
										
										@if(count($rooms) > 0)
											@foreach($rooms as $r)
											<option value="{{ $r->id }}">{{ ucwords($r->name) }}</option>
											@endforeach
										@else
										<option value="">No Room Available</option>
										@endif
									</select>
								</div>
								<div class="form-group">
									<label for="subject">Select Subject</label><label class="label-required">*</label>
									<select name="subject" id="subject" class="form-control underlined" required="">
										<option value="">Select Subject</option>
										@foreach($subjects as $s)
										<option value="{{ $s->id }}">{{ strtoupper($s->code) }}</option>
										@endforeach
										@if(count($subjects) > 0)

										@else
										<option value="">No Active Subject</option>
										@endif
									</select>
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-md-6">
											<label for="start_time">Start Time</label><label class="label-required">*</label>
											<select name="start_time" id="start_time" class="form-control underlined" required="">
												<option value="">Select Start Time</option>
												<option value="1">6:00 am</option>
												<option value="2">6:30 am</option>
												<option value="3">7:00 am</option>
												<option value="4">7:30 am</option>
												<option value="5">8:00 am</option>
												<option value="6">8:30 am</option>
												<option value="7">9:00 am</option>
												<option value="8">9:30 am</option>
												<option value="9">10:00 am</option>
												<option value="10">10:30 am</option>
												<option value="11">11:00 am</option>
												<option value="12">11:30 am</option>
												<option value="13">12:00 pm</option>
												<option value="14">12:30 pm</option>
												<option value="15">1:00 pm</option>
												<option value="16">1:30 pm</option>
												<option value="17">2:00 pm</option>
												<option value="18">2:30 pm</option>
												<option value="19">3:00 pm</option>
												<option value="20">3:30 pm</option>
												<option value="21">4:00 pm</option>
												<option value="22">4:30 pm</option>
												<option value="23">5:00 pm</option>
												<option value="24">5:30 pm</option>
												<option value="25">6:00 pm</option>
												<option value="26">6:30 pm</option>
												<option value="27">7:00 pm</option>
												<option value="28">7:30 pm</option>
												<option value="29">8:00 pm</option>
												<option value="30">8:30 pm</option>
												<option value="31">9:00 pm</option>
												<option value="32">9:30 pm</option>
												<option value="33">10:00 pm</option>
												<option value="34">10:30 pm</option>
											</select>
										</div>
										<div class="col-md-6">
											<label for="end_time">End Time</label><label class="label-required">*</label>
											<select name="end_time" id="end_time" class="form-control underlined" required="">
												<option value="">Select End Time</option>
												<option value="1">6:00 am</option>
												<option value="2">6:30 am</option>
												<option value="3">7:00 am</option>
												<option value="4">7:30 am</option>
												<option value="5">8:00 am</option>
												<option value="6">8:30 am</option>
												<option value="7">9:00 am</option>
												<option value="8">9:30 am</option>
												<option value="9">10:00 am</option>
												<option value="10">10:30 am</option>
												<option value="11">11:00 am</option>
												<option value="12">11:30 am</option>
												<option value="13">12:00 pm</option>
												<option value="14">12:30 pm</option>
												<option value="15">1:00 pm</option>
												<option value="16">1:30 pm</option>
												<option value="17">2:00 pm</option>
												<option value="18">2:30 pm</option>
												<option value="19">3:00 pm</option>
												<option value="20">3:30 pm</option>
												<option value="21">4:00 pm</option>
												<option value="22">4:30 pm</option>
												<option value="23">5:00 pm</option>
												<option value="24">5:30 pm</option>
												<option value="25">6:00 pm</option>
												<option value="26">6:30 pm</option>
												<option value="27">7:00 pm</option>
												<option value="28">7:30 pm</option>
												<option value="29">8:00 pm</option>
												<option value="30">8:30 pm</option>
												<option value="31">9:00 pm</option>
												<option value="32">9:30 pm</option>
												<option value="33">10:00 pm</option>
												<option value="34">10:30 pm</option>
											</select>
										</div>
									</div>
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> Save Schedule</button>
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
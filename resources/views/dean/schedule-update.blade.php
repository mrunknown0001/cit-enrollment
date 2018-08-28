@extends('layouts.dean-layout')

@section('title') Schedules @endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Update Schedule</h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0)"><i class="fa fa-calendar-check-o"></i> Home</a></li>
			<li class="active">Schedules</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<p><a href="{{ route('dean.schedules') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back to Schedules</a></p>
				@include('includes.all')
				<div class="box box-primary">
					<div class="box-header with-border">
						<strong><i class="fa fa-user"></i> Add Schedule</strong>
					</div>
					<div class="box-body">
						<p><em>Field with red asterisk (<label class="label-required">*</label>) are required fields.</em></p>
					<div class="row">
						<div class="col-md-6">
							<form action="{{ route('dean.update.schedule.post') }}" method="POST" autocomplete="off">
								{{ csrf_field() }}
								<input type="hidden" name="schedule_id" value="{{ $schedule->id }}">
								<div class="form-group">
									<label for="day">Select Day</label><label class="label-required">*</label>
									<select name="day" id="day" class="form-control underlined" required="">
										<option value="">Select Day</option>
										<option value="1" {{ $schedule->day == 1 ? 'selected' : ''  }}>Monday</option>
										<option value="2" {{ $schedule->day == 2 ? 'selected' : ''  }}>Tuesday</option>
										<option value="3" {{ $schedule->day == 3 ? 'selected' : ''  }}>Wednesday</option>
										<option value="4" {{ $schedule->day == 4 ? 'selected' : ''  }}>Thursday</option>
										<option value="5" {{ $schedule->day == 5 ? 'selected' : ''  }}>Friday</option>
										<option value="6" {{ $schedule->day == 6 ? 'selected' : ''  }}>Saturday</option>
										<option value="7">Sunday</option>
									</select>
								</div>
								<div class="form-group">
									<label for="room">Select Room</label><label class="label-required">*</label>
									<select name="room" id="room" class="form-control underlined" required="">
										<option value="">Select Room</option>
										@if(count($rooms) > 0)
											@foreach($rooms as $r)
											<option value="{{ $r->id }}" {{ $schedule->room_id == $r->id ? 'selected' : '' }}>{{ ucwords($r->name) }}</option>
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
										<option value="{{ $s->id }}" {{ $schedule->subject_id == $s->id ? 'selected' : '' }}>{{ strtoupper($s->code) }}</option>
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
									<button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Update Schedule</button>
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
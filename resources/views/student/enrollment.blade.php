@extends('layouts.student-layout')

@section('title') Enrollment @endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Enrollment</h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0)"><i class="fa fa-file-text-o"></i> Home</a></li>
			<li class="active">Enrollment</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				@include('includes.all')
				@if($es->active == 1)
					@if(count($rp) < 1) 
						@include('student.includes.registration-payment')
					@endif
				@endif
				<div class="box box-primary">
					<div class="box-header with-border">
						<strong><i class="fa fa-file-text-o"></i> Enrollment</strong>
					</div>
					<div class="box-body">
						<div class="row">
							<div class="col-md-6">
								<p>Course: <strong>{{ ucwords($course->title) }}</strong></p>
								<p>Curriculum: <strong>{{ strtoupper($curriculum->name) }}</strong></p>
								<p>Section: <strong>{{ strtoupper($section->name) }}</strong></p>
							</div>
							<div class="col-md-6">
								<p>Major: <strong>{{ count($major) > 0 ? ucwords($major->name) : 'N/A' }}</strong></p>
								<p>Year Level: <strong>{{ ucwords($yl->name) }}</strong></p>
								<p>Semester: <strong>{{ ucwords($sem->name) }}</strong></p>
							</div>
							<div class="col-md-12">
								<table class="table table-bordered table-hover">
									<thead>
										<tr>
											<th class="text-center">Subjects</th>
											<th class="text-center">Days</th>
											<th class="text-center">Units</th>
											<th class="text-center">Room</th>
											<th class="text-center">Time</th>
										</tr>
									</thead>
									<tbody>
										@foreach($subjects as $s)
										<tr>
											<td class="text-center">{{ $s->code }}</td>
											<td class="text-center">
												@foreach($schedules as $sched)
													@if($sched->subject_id == $s->id)
														@if($sched->day == 1)
															 Mon 
														@elseif($sched->day == 2)
															 Tue 
														@elseif($sched->day == 3)
															 Wed 
														@elseif($sched->day == 4)
															 Thu 
														@elseif($sched->day == 5)
															 Fri 
														@elseif($sched->day == 6)
															 Sat 
														@endif
													@endif
												@endforeach
											</td>
											<td class="text-center">Lec: {{ $s->units }} {{ $s->lab_units ? '| Lab: ' . $s->lab_units : '' }}</td>
											<td class="text-center">
												@foreach($schedules as $sched)
													@if($sched->subject_id == $s->id)
														{{-- course id, curriculum id, section id, subject id --}}
														{{-- to get the distinct room --}}
														{{ ucwords($sched->room->name) }}
													@endif
												@endforeach
											</td>
											<td class="text-center">
												@foreach($schedules as $sched)
													@if($sched->subject_id == $s->id)
														{{ \App\Http\Controllers\GeneralController::get_time($sched->start_time) }}-{{
														\App\Http\Controllers\GeneralController::get_time($sched->end_time) 
														}}
													@endif
												@endforeach
											</td>
										</tr>
										@endforeach
									</tbody>
								</table>
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
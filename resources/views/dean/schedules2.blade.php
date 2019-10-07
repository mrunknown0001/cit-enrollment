@extends('layouts.dean-layout')

@section('title') Schedules @endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Schedules</h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0)"><i class="fa fa-calendar-check-o"></i> Home</a></li>
			<li class="active">Schedules</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				{{-- <a href="{{ route('dean.add.schedule') }}" class="btn btn-danger"><i class="fa fa-plus"></i> Add Schedule</a> --}}

				<p><button class="btn btn-danger" data-toggle="modal" data-target="#addSchedule"><i class="fa fa-plus"></i> Add Schedule</button></p>
				@include('dean.includes.modal-schedule-add')

				@include('includes.all')
				@if(count($schedules) > 0)
					<hr>
					<div style="font-size: 12px; font-family: Times New Roman">
						<table class="table table-hover">
							<tr>
								<td>Monday</td>
								@foreach($monday as $sch)
									<td class="text-center">
									{{ $sch->subject->code }}
									{{ \App\Http\Controllers\GeneralController::get_time($sch->start_time) }}-
									{{ \App\Http\Controllers\GeneralController::get_time($sch->end_time) }}
									<a href="#" class="btn btn-link btn-xs">Update</a>
									</td>
								@endforeach
							</tr>					
							<tr>
								<td>Tuesday</td>
								@foreach($tuesday as $sch)
									<td class="text-center">
									{{ $sch->subject->code }}
									{{ \App\Http\Controllers\GeneralController::get_time($sch->start_time) }}-
									{{ \App\Http\Controllers\GeneralController::get_time($sch->end_time) }}
									</td>
								@endforeach
							</tr>					
							<tr>
								<td>Wednesday</td>
								@foreach($wednesday as $sch)
									<td class="text-center">
									{{ $sch->subject->code }}
									{{ \App\Http\Controllers\GeneralController::get_time($sch->start_time) }}-
									{{ \App\Http\Controllers\GeneralController::get_time($sch->end_time) }}
									</td>
								@endforeach
							</tr>					
							<tr>
								<td>Thursday</td>
								@foreach($thursday as $sch)
									<td class="text-center">
									{{ $sch->subject->code }}
									{{ \App\Http\Controllers\GeneralController::get_time($sch->start_time) }}-
									{{ \App\Http\Controllers\GeneralController::get_time($sch->end_time) }}
									</td>
								@endforeach
							</tr>					
							<tr>
								<td>Friday</td>
								@foreach($friday as $sch)
									<td class="text-center">
									{{ $sch->subject->code }}
									{{ \App\Http\Controllers\GeneralController::get_time($sch->start_time) }}-
									{{ \App\Http\Controllers\GeneralController::get_time($sch->end_time) }}
									</td>
								@endforeach
							</tr>					
							<tr>
								<td>Saturday</td>
								@foreach($saturday as $sch)
									<td class="text-center">
									{{ $sch->subject->code }}
									{{ \App\Http\Controllers\GeneralController::get_time($sch->start_time) }}-
									{{ \App\Http\Controllers\GeneralController::get_time($sch->end_time) }}
									</td>
								@endforeach
							</tr>					
						</table>
					</div>
				@else
					<p class="text-center">No Schedules Available!</p>
				@endif
			</div>
		</div>
	</section>
</div>
@endsection
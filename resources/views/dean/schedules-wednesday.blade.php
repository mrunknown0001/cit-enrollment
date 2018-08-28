@extends('layouts.dean-layout')

@section('title') Schedules @endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Wednesday Schedules</h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0)"><i class="fa fa-calendar-check-o"></i> Home</a></li>
			<li class="active">Schedules</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				{{-- <a href="{{ route('dean.add.schedule') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Schedule</a> --}}
				<p></p>
				@include('includes.all')
				@if(count($schedules) > 0)
					<div style="font-size: 12px; font-family: Times New Roman">
						
						@if(count($rooms) > 0)
						<table class="table table-bordered table-striped">
							@foreach($rooms as $r)
							<tr>
								<td class="text-center">{{ strtoupper($r->name) }}</td>
								@if(count($schedules) > 0)
									@foreach($schedules as $sch)
										<td class="text-center">
										@if($sch->room_id == $r->id)
											{{ $sch->subject->code }}
											{{ \App\Http\Controllers\GeneralController::get_time($sch->start_time) }}-
											{{ \App\Http\Controllers\GeneralController::get_time($sch->end_time) }}
											<a href="{{ route('dean.update.schedule', ['id' => $sch->id]) }}" class="">Update</a>
											<a href="{{ route('dean.delete.schedule', ['id' => $sch->id]) }}" class="text-color-red">Delete</a>
										@else
											
										@endif
										</td>
									@endforeach
								@endif
							</tr>
							@endforeach
						</table>
						@else
						<p class="text-center">No Room Found!</p>
						@endif	
					</div>
				@else
					<p class="text-center">No Schedules Available!</p>
				@endif
			</div>
		</div>
	</section>
</div>
@endsection
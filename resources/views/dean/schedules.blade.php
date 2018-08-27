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
				{{-- <a href="{{ route('dean.add.schedule') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Schedule</a> --}}
				<p></p><p></p><p></p>
				<p class="text-center">
					<a href="{{ route('dean.monday.schedule') }}" class="btn btn-primary">Monday</a>
					<a href="{{ route('dean.tuesday.schedule') }}" class="btn btn-primary">Tuesday</a>
					<a href="{{ route('dean.wednesday.schedule') }}" class="btn btn-primary">Wednesday</a>
					<a href="{{ route('dean.thursday.schedule') }}" class="btn btn-primary">Thursday</a>
					<a href="{{ route('dean.friday.schedule') }}" class="btn btn-primary">Friday</a>
					<a href="{{ route('dean.saturday.schedule') }}" class="btn btn-primary">Saturday</a>
				</p>
			</div>
		</div>
	</section>
</div>
@endsection
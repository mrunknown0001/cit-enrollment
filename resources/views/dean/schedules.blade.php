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
				<p><button class="btn btn-primary" data-toggle="modal" data-target="#addSchedule"><i class="fa fa-plus"></i> Add Schedule</button></p>
				@include('dean.includes.modal-schedule-add')
				@include('includes.all')
			</div>
			<div class="col-md-4 col-md-offset-4">
				<p class="text-center">
					<a href="{{ route('dean.monday.schedule') }}" class="btn btn-primary btn-lg btn-block">Monday</a>
					<a href="{{ route('dean.tuesday.schedule') }}" class="btn btn-primary btn-lg btn-block">Tuesday</a>
					<a href="{{ route('dean.wednesday.schedule') }}" class="btn btn-primary btn-lg btn-block">Wednesday</a>
					<a href="{{ route('dean.thursday.schedule') }}" class="btn btn-primary btn-lg btn-block">Thursday</a>
					<a href="{{ route('dean.friday.schedule') }}" class="btn btn-primary btn-lg btn-block">Friday</a>
					<a href="{{ route('dean.saturday.schedule') }}" class="btn btn-primary btn-lg btn-block">Saturday</a>
				</p>
			</div>
		</div>
	</section>
</div>
@endsection
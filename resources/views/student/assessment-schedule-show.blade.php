@extends('layouts.student-layout')

@section('title') Assessment @endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Assessment: Scheudles</h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0)"><i class="fa fa-file-o"></i> Home</a></li>
			<li class="active">Assessment</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<a href="#" class="btn btn-primary">Save Assessment</a>
			</div>
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
								
							</td>
							<td class="text-center">Lec: {{ $s->units }} {{ $s->lab_units ? '| Lab: ' . $s->lab_units : '' }}</td>
							<td class="text-center">
								
							</td>
							<td class="text-center">
								
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<div class="col-md-12">
				<a href="#" class="btn btn-primary">Save Assessment</a>
			</div>
		</div>
	</section>
</div>
@endsection
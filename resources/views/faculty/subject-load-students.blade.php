@extends('layouts.faculty-layout')

@section('title') Subject Students @endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Subject Students</h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0)"><i class="fa fa-book"></i> Home</a></li>
			<li class="active">Subject</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<p><a href="{{ route('faculty.subject.loads') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back to Subject Loads</a></p>
				@include('includes.all')
				
				<div class="row">
					<div class="col-md-6">
						<p>Course: <strong>{{ ucwords($course->title) }}</strong></p>
						<p>Section: <strong>{{ strtoupper($section->name) }}</strong></p>
						<p>Subject: <strong>{{ strtoupper($subject->code) }}</strong></p>
					</div>
					<div class="col-md-6">
						<p>Curriculum: <strong>{{ strtoupper($curriculum->name) }}</strong></p>
						<p>Year Level: <strong>{{ ucwords($yl->name) }}</strong></p>
						<p>Subject Description: <strong>{{ ucwords($subject->description) }}</strong></p>
					</div>
				</div>
				<p><strong>Students:</strong></p>
				@if(count($students) > 0)
				
					<p>
						<a href="#" class="btn btn-primary btn-sm"><i class="fa fa"></i> Encode Grades</a>
					</p>
					
					<ol type="1">
					@foreach($students as $s)
					<li>{{ ucwords($s->firstname . ' ' . $s->lastname) }}</li>
					@endforeach
					</ol>

				@else
					<p class="text-center">No Students Enrolled!</p>
				@endif
			</div>
		</div>
	</section>
</div>
@endsection
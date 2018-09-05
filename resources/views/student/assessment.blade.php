@extends('layouts.student-layout')

@section('title') Assessment @endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Assessment</h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0)"><i class="fa fa-file-o"></i> Home</a></li>
			<li class="active">Assessment</li>
		</ol>
	</section>
	<section class="content">
		{{-- show schedule --}}
		{{-- show sections --}}
		<p>Select/View Sections Schedules</p>
		<div class="row">
			@foreach($sections as $s)
			<div class="col-md-3">
				<a href="{{ route('student.section.schedules', ['id' => $s->id]) }}" class="btn btn-primary btn-block btn-lg">Section {{ strtoupper($s->name) }}</a>
			</div>
			@endforeach
		</div>
	</section>
</div>
@endsection
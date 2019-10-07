@extends('layouts.faculty-layout')

@section('title') Subjects @endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Subjects</h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0)"><i class="fa fa-book"></i> Home</a></li>
			<li class="active">Subjects</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				@include('includes.all')

				@if(count($loads) > 0)
					<div class="row">
					<div class="col-md-4">
					@foreach($loads as $l)
						<p>
							<a href="{{ route('faculty.student.section.subject', [
								'course_id' => $l->course->id,
								'curriculum_id' => $l->curriculum->id,
								'yl_id' => $l->year_level->id,
								'section_id' => $l->section->id,
								'subject_id' => $l->subject->id 
							]) }}" class="btn btn-danger btn-block"><i class="fa fa-book"></i> {{ strtoupper($l->course->code) . ' - ' . ucwords($l->year_level->name) . ' ' . strtoupper($l->section->name) . ' ' . strtoupper($l->subject->code) }}</a>
						</p>

					@endforeach
					</div>
					</div>
				@else
					<p class="text-center">No Subject Assign!</p>
				@endif
			</div>
		</div>
	</section>
</div>
@endsection
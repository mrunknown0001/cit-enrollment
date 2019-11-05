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
				<p class="hideOnPrint"><a href="{{ route('faculty.subject.loads') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Back to Subject Loads</a> <button class="btn btn-danger" onclick="window.print()"><i class="fa fa-print"></i> Print</button></p>
				
				@include('includes.all')
				
				<div class="row">
					<div class="col-md-6">
						{{-- <p>Course: <strong>{{ ucwords($course->title) }}</strong></p> --}}
						<p>Section: <strong>{{ strtoupper($section->name) }}</strong></p>
						<p>Subject: <strong>{{ strtoupper($subject->code) }}</strong></p>
						{{-- <p>Semester: <strong>{{ ucwords($sem->name) }}</strong></p> --}}
					</div>
					<div class="col-md-6">
						<p>Curriculum: <strong>{{ strtoupper($yl->name) }}</strong></p>
						{{-- <p>Year Level: <strong>{{ ucwords($yl->name) }}</strong></p> --}}
						<p>Subject Description: <strong>{{ ucwords($subject->description) }}</strong></p>
					</div>
				</div>
				@if(count($grades) > 0)
				
				<div class="row">
					<div class="col-md-6">
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th class="text-center">Name</th>
									<th class="text-center">Grade</th>
									<th class="text-center hideOnPrint">Action</th>
								</tr>
							</thead>
							<tbody>

								@foreach($grades as $s)
								<tr>
									<td>
										{{ ucwords($s['firstname'] . ' ' . $s['lastname']) }} - {{ $s['student_number'] }}
									</td>
									<td class="text-center">
										{{ $s['grade'] }}
									</td>
									<td class="text-center hideOnPrint">
										<button class="btn btn-default btn-xs" data-toggle="modal" data-target="#gradeUpdate-{{ $s['grade_id'] }}"><i class="fa fa-pencil"></i> Update</button>
									</td>
								</tr>
								@include('faculty.includes.modal-student-grade-update')
								@endforeach
							</tbody>
						</table>				
					</div>

				</div>

				@else
					<p class="text-center">No Students Enrolled!</p>
				@endif
			</div>
		</div>
	</section>
</div>
@endsection
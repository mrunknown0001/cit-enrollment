@extends('layouts.admin-layout')

@section('title') Course Majors @endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Course Majors</h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0)"><i class="fa fa-book"></i> Home</a></li>
			<li class="active">Course Majors</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				@include('includes.all')
				
				{{-- <p><a href="{{ route('admin.add.course.major') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Course Major</a></p> --}}

				<p><button class="btn btn-primary" data-toggle="modal" data-target="#addMajor"><i class="fa fa-plus"></i> Add Course Major</button></p>
				@include('admin.includes.modal-major-add')

				@if(count($majors) > 0)
				<div class="box box-primary">
					<div class="box-header with-border">
						<strong><i class="fa fa-book"></i> Course Majors</strong>
					</div>
					<div class="box-body">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center">Major Name</th>
									<th class="text-center">Course Code</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($majors as $m)
								<tr>
									<td>{{ $m->name }}</td>
									<td class="text-center">{{ strtoupper($m->course->code) }}</td>
									<td class="text-center">
										{{-- <a href="{{ route('admin.update.course.major', ['id' => $m->id]) }}" class="btn btn-default btn-xs"><i class="fa fa-pencil"></i> Update</a> --}}
										<button class="btn btn-default btn-xs" data-toggle="modal" data-target="#updateMajor-{{ $m->id }}"><i class="fa fa-pencil"></i> Update</button>
									</td>
								</tr>
								@include('admin.includes.modal-major-update')
								@endforeach
							</tbody>
							<tfoot>
							</tfoot>
						</table>						
					</div>
					<div class="box-footer">
						
					</div>
				</div>

				@else
				<p class="text-center">No Course Majors Available</p>
				@endif
			</div>
		</div>
	</section>
</div>
@endsection
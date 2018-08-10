@extends('layouts.admin-layout')

@section('title') Courses @endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Courses</h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0)"><i class="fa fa-book"></i> Home</a></li>
			<li class="active">Courses</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				@include('includes.all')
				{{-- <p><a href="{{ route('admin.add.course') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Course</a></p> --}}

				<p><button class="btn btn-primary" data-toggle="modal" data-target="#addCourse"><i class="fa fa-plus"></i> Add Course</button></p>
				@include('admin.includes.modal-course-add')

				@if(count($courses) > 0)
				<div class="box box-primary">
					<div class="box-header with-border">
						<strong><i class="fa fa-book"></i> Courses</strong>
					</div>
					<div class="box-body">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center">Title</th>
									<th class="text-center">Code</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($courses as $c)
									<tr>
										<td>{{ ucwords($c->title) }}</td>
										<td>{{ strtoupper($c->code) }}</td>
										<td class="text-center">
											{{-- <a href="{{ route('admin.update.course', ['id' => $c->id]) }}" class="btn btn-default btn-xs"><i class="fa fa-pencil"></i> Edit</a> --}}
											<button class="btn btn-default btn-xs" data-toggle="modal" data-target="#updateCourse-{{ $c->id }}" ><i class="fa fa-pencil"></i> Update</button>
										</td>
									</tr>
								@include('admin.includes.modal-course-update')
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
				<p class="text-center">No Courses Available</p>
				@endif
			</div>
		</div>
	</section>
</div>
@endsection
@extends('layouts.admin-layout')

@section('title') Curricula @endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Curricula</h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0)"><i class="fa fa-book"></i> Home</a></li>
			<li class="active">Curricula</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				@include('includes.all')
				
				{{-- <p><a href="{{ route('admin.add.curriculum') }}" class="btn btn-danger"><i class="fa fa-plus"></i> Add Course Curriculum</a></p> --}}

				<p><button class="btn btn-danger" data-toggle="modal" data-target="#addCurriculum"><i class="fa fa-plus"></i> Add Course Curriculum</button></p>
				@include('admin.includes.modal-curriculum-add')

				@if(count($curricula) > 0)
				<div class="box box-danger">
					<div class="box-header with-border">
						<strong><i class="fa fa-book"></i> Curricula</strong>
					</div>
					<div class="box-body">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center">Name</th>
									<th class="text-center">Course</th>
									<th class="text-center">Major</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($curricula as $c)
									<tr>
										<td>{{ ucwords($c->name) }}</td>
										<td class="text-center">{{ $c->course->code }}</td>
										<td class="text-center">
											@if(!empty($c->major))
											{{ $c->major->name }}
											@else
											N/A
											@endif
										</td>
										<td class="text-center">
											<a href="{{ route('admin.update.curriculum', ['id' => $c->id]) }}" class="btn btn-default btn-xs"><i class="fa fa-pencil"></i> Update</a>

											{{--<button class="btn btn-default btn-xs" data-toggle="modal" data-target="#updateCurriculum-{{ $c->id }}"><i class="fa fa-pencil"></i> Update</button>--}}
										</td>
										@include('admin.includes.modal-curriculum-update')
									</tr>
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
				<p class="text-center">No Curriculum Available</p>
				@endif
			</div>
		</div>
	</section>
</div>
<script>
	$(".course").click(function () {
		var courseId = $(".course").val();

		if(courseId == '') {
			$('.major')
			    .empty()
			    .append('<option selected="selected" value="">No Course Major</option>')
			;
		}
	});

	$(".course").change(function () {

		var courseId = $(".course").val();

		if(courseId == '') {
			$('.major')
			    .empty()
			    .append('<option selected="selected" value="">No Course Major</option>')
			;
		}
		else {
			$.ajax({url: "/admin/course/" + courseId + "/majors/get", success: function(result){
		        Object.keys(result).forEach(function(key) {

				  $('.major').append('<option value="' + result[key].id + '">' + result[key].name + '</option>');
				  
				});
		    }});
		}
	});
</script>
@endsection
@extends('layouts.admin-layout')

@section('title') Curricula @endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Update Curriculum</h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0)"><i class="fa fa-book"></i> Home</a></li>
			<li class="active">Curricula</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<p><a href="{{ route('admin.curricula') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back to Curricula</a></p>
				@include('includes.all')
				<div class="box box-primary">
					<div class="box-header with-border">
						<strong><i class="fa fa-book"></i> Update Curriculum</strong>
					</div>
					<div class="box-body">
						<form action="{{ route('admin.update.curriculum.post') }}" method="POST" role="form" autocomplete="off">
							{{ csrf_field() }}
							<input type="hidden" name="curriculum_id" value="{{ $curriculum->id }}">
							<div class="row">
								<div class="col-md-6">
							      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
							      	<label for="name">Curriculum Name</label>
							        <input id="name" type="text" class="form-control" name="name" value="{{ $curriculum->name }}" placeholder="Enter Curriculum Name" >
							        @if ($errors->has('name'))
							            <span class="help-block">
							                <strong>{{ $errors->first('name') }}</strong>
							            </span>
							        @endif
							      </div>
							      <div class="form-group{{ $errors->has('course') ? ' has-error' : '' }}">
							      	<label for="course">Select Course</label>
							        <select id="course" name="course" class="form-control">
							        	<option value="">Select Course</option>
										@if(count($courses) > 0)
											@foreach($courses as $c)
												<option value="{{ $c->id }}" {{ $curriculum->course_id == $c->id ? 'selected' : '' }}>{{ $c->code }}</option>
											@endforeach
										@else
										<option value="">No Available Course</option>
										@endif
							        </select>
							        @if ($errors->has('course'))
							            <span class="help-block">
							                <strong>{{ $errors->first('course') }}</strong>
							            </span>
							        @endif
							      </div>
							      <div class="form-group{{ $errors->has('major') ? ' has-error' : '' }}">
							      	<label for="major">Select Course Major</label>
							        <select id="major" name="major" class="form-control">
							        	<option value="">No Course Major</option>

							        </select>
							        @if ($errors->has('major'))
							            <span class="help-block">
							                <strong>{{ $errors->first('major') }}</strong>
							            </span>
							        @endif
							      </div>
								</div>
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Update Curriculum</button>
							</div>
						</form>
					</div>
					<div class="box-footer">
						
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<script>
	$("#course").change(function () {

		var courseId = $("#course").val();

		$.ajax({url: "/admin/course/" + courseId + "/majors/get", success: function(result){
	        Object.keys(result).forEach(function(key) {

			  $('#major').append('<option value="' + result[key].id + '">' + result[key].name + '</option>');
			  
			});
	    }});
	});

	$(document).ready(function () {

		var courseId = $("#course").val();

		$.ajax({url: "/admin/course/" + courseId + "/majors/get", success: function(result){
	        Object.keys(result).forEach(function(key) {

			  $('#major').append('<option value="' + result[key].id + '">' + result[key].name + '</option>');
			  
			});
	    }});
	});
</script>
@endsection
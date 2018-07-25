@extends('layouts.registrar-layout')

@section('title') Students @endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Add Student</h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0)"><i class="fa fa-graduation-cap"></i> Home</a></li>
			<li class="active">Students</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<p><a href="{{ route('registrar.students') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back to Students</a></p>
				@include('includes.all')
				<div class="box box-primary">
					<div class="box-header with-border">
						<strong><i class="fa fa-graduation-cap"></i> Add Student</strong>
					</div>
					<div class="box-body">
						<p><em>Field with red asterisk (<label class="label-required">*</label>) are required fields.</em></p>
						<form action="{{ route('registrar.add.student.post') }}" method="POST" role="form" autocomplete="off">
							{{ csrf_field() }}
							<div class="row">
								<div class="col-md-6">
							      <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
							      	<label for="firstname">Firstname</label><label class="label-required">*</label>
							        <input id="firstname" type="text" class="form-control" name="firstname" value="{{ old('firstname') }}" placeholder="Enter Firstname" autofocus required="">
							        @if ($errors->has('firstname'))
							            <span class="help-block">
							                <strong>{{ $errors->first('firstname') }}</strong>
							            </span>
							        @endif
							      </div>
								</div>
								<div class="col-md-6">
							      <div class="form-group{{ $errors->has('middlename') ? ' has-error' : '' }}">
							      	<label for="middlename">Middlename</label>
							        <input id="middlename" type="text" class="form-control" name="middlename" value="{{ old('middlename') }}" placeholder="Enter Middlename" >
							        @if ($errors->has('middlename'))
							            <span class="help-block">
							                <strong>{{ $errors->first('middlename') }}</strong>
							            </span>
							        @endif
							      </div>
								</div>
								<div class="col-md-6">
							      <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
							      	<label for="lastname">Lastname</label><label class="label-required">*</label>
							        <input id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" placeholder="Enter Lastname" required>
							        @if ($errors->has('lastname'))
							            <span class="help-block">
							                <strong>{{ $errors->first('lastname') }}</strong>
							            </span>
							        @endif
							      </div>
								</div>
								<div class="col-md-6">
							      <div class="form-group{{ $errors->has('suffix_name') ? ' has-error' : '' }}">
							      	<label for="suffix_name">Suffix</label>
							        <input id="suffix_name" type="text" class="form-control" name="suffix_name" value="{{ old('suffix_name') }}" placeholder="Enter Suffix Name" >
							        @if ($errors->has('suffix_name'))
							            <span class="help-block">
							                <strong>{{ $errors->first('suffix_name') }}</strong>
							            </span>
							        @endif
							      </div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
							      <div class="form-group{{ $errors->has('student_number') ? ' has-error' : '' }}">
							      	<label for="student_number">Student Number</label><label class="label-required">*</label>
							        <input id="student_number" type="text" class="form-control" name="student_number" value="{{ old('student_number') }}" placeholder="Enter Student Number" required>
							        @if ($errors->has('student_number'))
							            <span class="help-block">
							                <strong>{{ $errors->first('student_number') }}</strong>
							            </span>
							        @endif
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
							      <div class="form-group{{ $errors->has('course') ? ' has-error' : '' }}">
							      	<label for="course">Select Course</label><label class="label-required">*</label>
							        <select name="course" id="course" class="form-control" required="">
							        	<option value="">Select Course</option>
							        	@if(count($courses) > 0)
											@foreach($courses as $c)
												<option value="{{ $c->id }}">{{ $c->title }}</option>
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
								</div>
								<div class="col-md-6">
							      <div class="form-group{{ $errors->has('curriculum') ? ' has-error' : '' }}">
							      	<label for="curriculum">Select Curriculum</label><label class="label-required">*</label>
							        <select name="curriculum" id="curriculum" class="form-control" required="">
							        	<option value="">Select Curriculum</option>
							        	
							        </select>
							        @if ($errors->has('curriculum'))
							            <span class="help-block">
							                <strong>{{ $errors->first('curriculum') }}</strong>
							            </span>
							        @endif
									</div>
								</div>
								<div class="col-md-6">
							      <div class="form-group{{ $errors->has('major') ? ' has-error' : '' }}">
							      	<label for="major">Select Course Major</label>
							        <select name="major" id="major" class="form-control">
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
								<button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add Student</button>
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

		$.ajax({url: "/registrar/course/" + courseId + "/majors/get", success: function(result){
	        Object.keys(result).forEach(function(key) {

			  $('#major').append('<option value="' + result[key].id + '">' + result[key].name + '</option>');
			  
			});
	    }});

		$.ajax({url: "/registrar/course/" + courseId + "/curriculum/get", success: function(result){
	        Object.keys(result).forEach(function(key) {

			  $('#curriculum').append('<option value="' + result[key].id + '">' + result[key].name + '</option>');
			  
			});
	    }});

	});
</script>
@endsection
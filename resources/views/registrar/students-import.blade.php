@extends('layouts.registrar-layout')

@section('title') Import Students @endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Import Students</h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0)"><i class="fa fa-graduation-cap"></i> Home</a></li>
			<li class="active">Students</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<p><a href="{{ route('registrar.students') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Back to Students</a></p>
				@include('includes.all')
				<div class="box box-danger">
					<div class="box-header with-border">
						<strong><i class="fa fa-graduation-cap"></i> Import Students</strong>
					</div>
					<div class="box-body">
						<p><em>Field with red asterisk (<label class="label-required">*</label>) are required fields.</em></p>
						<form action="{{ route('registrar.import.students.post') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
							{{ csrf_field() }}
							<div class="row">
								<div class="col-md-6">
							        <div class="form-group{{ $errors->has('students') ? ' has-error' : '' }}">
								      	<label for="students">Students</label><label class="label-required">*</label>
								        <input id="students" type="file" name="students" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
								        @if ($errors->has('students'))
								            <span class="help-block">
								                <strong>{{ $errors->first('students') }}</strong>
								            </span>
								        @endif
							        </div>									
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
							     <div class="form-group{{ $errors->has('curriculum') ? ' has-error' : '' }}">
							      	<label for="curriculum">Select Curriculum</label><label class="label-required">*</label>
							        <select name="curriculum" id="curriculum" class="form-control" required="">
							        	<option value="">Select Curriculum</option>
							        	@if(count($yl)> 0)
													@foreach($yl as $y)
														<option value="{{ $y->id }}">{{ $y->name }}</option>
													@endforeach
							        	@else
													
							      		@endif
							        </select>
							        @if ($errors->has('curriculum'))
							            <span class="help-block">
							                <strong>{{ $errors->first('curriculum') }}</strong>
							            </span>
							        @endif
										</div>
								</div>
								<div class="col-md-6">
							      <div class="form-group{{ $errors->has('strand') ? ' has-error' : '' }}">
							      	<label for="strand">Select Strand</label> <label class="label-required"><small>for Grade 11 & 12 only</small></label>
							        <select name="strand" id="strand" class="form-control" >
							        	<option value="">Select Strand</option>
							        	@if(count($strands) > 0)
											@foreach($strands as $s)
												<option value="{{ $s->id }}">{{ $s->strand }}</option>
											@endforeach
							        	@else
											<option value="">No Available Strand</option>
							        	@endif
							        </select>
							        @if ($errors->has('strand'))
							            <span class="help-block">
							                <strong>{{ $errors->first('strand') }}</strong>
							            </span>
							        @endif
									</div>
								</div>
								{{-- <div class="col-md-6">
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
							      <div class="form-group{{ $errors->has('year_level') ? ' has-error' : '' }}">
							      	<label for="year_level">Select Year Level</label><label class="label-required">*</label>
							        <select name="year_level" id="year_level" class="form-control" required="">
							        	<option value="">Select Year Level</option>
							        	@if(count($yl) > 0)
											@foreach($yl as $y)
												<option value="{{ $y->id }}">{{ ucwords($y->name) }}</option>
											@endforeach
							        	@else
										
							        	@endif
							        </select>
							        @if ($errors->has('year_level'))
							            <span class="help-block">
							                <strong>{{ $errors->first('year_level') }}</strong>
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
								</div> --}}
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-danger"><i class="fa fa-plus"></i> Add Students</button>
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

		$('#major')
		    .empty()
		    .append('<option selected="selected" value="">No Course Major</option>')
		;

		$('#curriculum')
		    .empty()
		    .append('<option selected="selected" value="">No Curriculum</option>')
		;

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
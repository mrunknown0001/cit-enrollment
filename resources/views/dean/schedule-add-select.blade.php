@extends('layouts.dean-layout')

@section('title') Schedules @endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Add Schedule</h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0)"><i class="fa fa-calendar-check-o"></i> Home</a></li>
			<li class="active">Schedules</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<p><a href="{{ route('dean.schedules') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back to Schedules</a></p>
				@include('includes.all')
				<div class="box box-primary">
					<div class="box-header with-border">
						<strong><i class="fa fa-calendar-check-o"></i> Select Course, Year Level &amp; Section</strong>
					</div>
					<div class="box-body">
						<p><em>Field with red asterisk (<label class="label-required">*</label>) are required fields.</em></p>
					<div class="row">
						<div class="col-md-12">
							<form action="{{ route('dean.add.schedule') }}" method="GET">
								{{ csrf_field() }}
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Select Course</label><label class="label-required">*</label>
											<select name="course" id="course" class="form-control" required>
												<option value="">Select Course</option>
												@if(count($courses) > 0)
												@foreach($courses as $c)
												<option value="{{ $c->id }}">{{ strtoupper($c->code) }}</option>
												@endforeach
												@else
												<option value="">No Course Found!</option>
												@endif
											</select>
										</div>										
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Select Major</label>
											<select class="form-control" name="major" id="major">
												<option value="">Select Major</option>
											</select>
										</div>										
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Select Curriculum</label><label class="label-required">*</label>
											<select class="form-control" name="curriculum" id="curriculum">
												<option class="">Select Curriculum</option>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Select Year Level</label><label class="label-required">*</label>
											<select class="form-control" name="year_level" id="year_level" required>
												<option value="">Select Year Level</option>
												@if(count($yl) > 0)
												@foreach($yl as $y)
												<option value="{{ $y->id }}">{{ ucwords($y->name) }}</option>
												@endforeach
												@else
												<option value="">No Year Level Found</option>
												@endif
											</select>
										</div>										
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Select Section</label><label class="label-required">*</label>
											<select name="section" id="section" class="form-control">
												<option value="">Select Section</option>
												@if(count($sections) > 0)
												@foreach($sections as $s)
												<option value="{{ $s->id }}">{{ strtoupper($s->name) }}</option>
												@endforeach
												@else
												<option value="">No Section</option>
												@endif
											</select>
										</div>										
									</div>
								</div>





								<div class="form-group">
									<button type="submit" class="btn btn-primary"><i class="fa fa-arrow-right"></i> Continue</button>
								</div>
							</form>
						</div>
					</div>
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
		var majorId = $("#major").val();

		$.ajax({url: "/dean/course/" + courseId + "/majors/get", success: function(result){
	        Object.keys(result).forEach(function(key) {

			  $('#major').append('<option value="' + result[key].id + '">' + result[key].name + '</option>');
			  
			});
	    }});

		$.ajax({url: "/dean/course/" + courseId + "/curriculum/get", success: function(result){
	        Object.keys(result).forEach(function(key) {

			  $('#curriculum').append('<option value="' + result[key].id + '">' + result[key].name + '</option>');
			  
			});
	    }});

	});

	$("#major").change(function () {
		var courseId = $("#course").val();
		var majorId = $("#major").val();

		$.ajax({url: "/registrar/major/" + majorId + "/curriculum/get", success: function(result){
	        Object.keys(result).forEach(function(key) {

			  $('#curriculum').append('<option value="' + result[key].id + '">' + result[key].name + '</option>');
			  
			});
	    }});
	});
</script>
@endsection
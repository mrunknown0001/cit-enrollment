@extends('layouts.admin-layout')

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
				<p><a href="{{ route('admin.subjects') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back to Subjects</a></p>
				@include('includes.all')
				<div class="box box-primary">
					<div class="box-header with-border">
						<strong><i class="fa fa-book"></i> Add Subject</strong>
					</div>
					<div class="box-body">
						<form action="{{ route('admin.add.subject.post') }}" method="POST" autocomplete="off">
							{{ csrf_field() }}
							<div class="row">
								<div class="col-md-6">
									<div class="form-group{{ $errors->has('subject_code') ? ' has-error' : '' }}">
										<label for="subject_code">Subject Code</label>
										<input id="subject_code" type="text" class="form-control" name="subject_code" value="{{ old('subject_code') }}" placeholder="Enter Subject Code" >
										@if ($errors->has('subject_code'))
										<span class="help-block">
											<strong>{{ $errors->first('subject_code') }}</strong>
										</span>
										@endif
									</div>
									<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
										<label for="description">Subject Description</label>
										<input id="description" type="text" class="form-control" name="description" value="{{ old('description') }}" placeholder="Enter Subject Description" >
										@if ($errors->has('description'))
										<span class="help-block">
											<strong>{{ $errors->first('description') }}</strong>
										</span>
										@endif
									</div>
									<div class="form-group{{ $errors->has('units') ? ' has-error' : '' }}">
										<label for="units">Subject Units</label>
										<input id="units" type="number" class="form-control" name="units" value="{{ old('units') }}" placeholder="Enter Subject Units" >
										@if ($errors->has('units'))
										<span class="help-block">
											<strong>{{ $errors->first('units') }}</strong>
										</span>
										@endif
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group{{ $errors->has('course') ? ' has-error' : '' }}">
										<label for="course">Course</label>
										<select name="course" id="course" class="form-control">
											<option value="">Select Course</option>
											@if(count($courses) > 0)
												@foreach($courses as $c)
													<option value="{{ $c->id }}">{{ $c->code }}</option>
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
										<label for="major">Course Major</label>
										<select name="major" id="major" class="form-control">
											<option value="">Select Course Major</option>

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
								<button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add Subject</button>
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

			  // values = "<option value=" + result[key].id + ">" + result[key].name + "</option>";

			  $('#major').append('<option value="' + result[key].id + '">' + result[key].name + '</option>');
			  
			});
	    }});

		alert(values)
	});
</script>
@endsection
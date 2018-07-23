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
						<strong><i class="fa fa-book"></i> Update Subject</strong>
					</div>
					<div class="box-body">
						<form action="{{ route('admin.update.subject.post') }}" method="POST" autocomplete="off">
							{{ csrf_field() }}
							<input type="hidden" name="subject_id" value="{{ $subject->id }}">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
										<label for="code">Subject Code</label>
										<input id="code" type="text" class="form-control" name="code" value="{{ $subject->code }}" placeholder="Enter Subject Code" required>
										@if ($errors->has('code'))
										<span class="help-block">
											<strong>{{ $errors->first('code') }}</strong>
										</span>
										@endif
									</div>
									<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
										<label for="description">Subject Description</label>
										<input id="description" type="text" class="form-control" name="description" value="{{ $subject->description }}" placeholder="Enter Subject Description" required>
										@if ($errors->has('description'))
										<span class="help-block">
											<strong>{{ $errors->first('description') }}</strong>
										</span>
										@endif
									</div>
									<div class="form-group{{ $errors->has('units') ? ' has-error' : '' }}">
										<label for="units">Subject Units</label>
										<input id="units" type="number" class="form-control" name="units" value="{{ $subject->units }}" placeholder="Enter Subject Units" required>
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
										<select name="course" id="course" class="form-control" required="">
											<option value="">Select Course</option>
											@if(count($courses) > 0)
												@foreach($courses as $c)
													<option value="{{ $c->id }}" {{ $subject->id == $c->id ? 'selected' : '' }}>{{ $c->code }}</option>
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
									<div class="form-group{{ $errors->has('year_level') ? ' has-error' : '' }}">
										<label for="year_level">Select Year Level</label>
										<select name="year_level" id="year_level" class="form-control" required="">
											<option value="">Select Year Level</option>
											@if(count($yl) > 0)
												@foreach($yl as $y)
												<option value="{{ $y->id }}" {{ $subject->year_level_id == $y->id ? 'selected' : '' }}>{{ $y->name }}</option>
												@endforeach
											@else
											<option value="">No Available Year Level</option>
											@endif
										</select>
										@if ($errors->has('year_level'))
										<span class="help-block">
											<strong>{{ $errors->first('year_level') }}</strong>
										</span>
										@endif
									</div>
									<div class="form-group{{ $errors->has('semester') ? ' has-error' : '' }}">
										<label for="semester">Select Semester</label>
										<select name="semester" id="semester" class="form-control" required="">
											<option value="">Select Semester</option>
											@if(count($sem) > 0)
												@foreach($sem as $s)
												<option value="{{ $s->id }}" {{ $subject->id == $s->id ? 'selected' : '' }}>{{ $s->name }}</option>
												@endforeach
											@else
											<option value="">No Available Semester</option>
											@endif
										</select>
										@if ($errors->has('semester'))
										<span class="help-block">
											<strong>{{ $errors->first('semester') }}</strong>
										</span>
										@endif
									</div>
								</div>
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Update Subject</button>
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
</script>
@endsection
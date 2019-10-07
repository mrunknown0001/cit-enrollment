@extends('layouts.admin-layout')

@section('title') Course Majors @endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Update Course Major</h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0)"><i class="fa fa-book"></i> Home</a></li>
			<li class="active">Course Majors</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<p><a href="{{ route('admin.course.majors') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Back to Course Majors</a></p>
				@include('includes.all')
				<div class="box box-danger">
					<div class="box-header with-border">
						<strong><i class="fa fa-book"></i> Update Course Major</strong>
					</div>
					<div class="box-body">
						<p><em>Field with red asterisk (<label class="label-required">*</label>) are required fields.</em></p>
						<form action="{{ route('admin.update.course.major.post') }}" method="POST" role="form" autocomplete="off">
							{{ csrf_field() }}
							<input type="hidden" name="major_id" value="{{ $major->id }}">
							<div class="row">
								<div class="col-md-6">
							      <div class="form-group{{ $errors->has('course') ? ' has-error' : '' }}">
							      	<label for="course">Select Course</label><label class="label-required">*</label>
							        <select name="course" id="course" class="form-control">
							        	<option value="">Select Course</option>
										@foreach($courses as $c)
										<option value="{{ $c->id }}" {{ $major->course_id == $c->id ? 'selected' : '' }}>{{ ucwords($c->title) }}</option>
										@endforeach
							        </select>
							        @if ($errors->has('course'))
							            <span class="help-block">
							                <strong>{{ $errors->first('course') }}</strong>
							            </span>
							        @endif
							      </div>
							      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
							      	<label for="major_name">Major Name</label><label class="label-required">*</label>
							        <input id="major_name" type="text" class="form-control" name="major_name" value="{{ $major->name }}" placeholder="Enter Course Code" >
							        @if ($errors->has('major_name'))
							            <span class="help-block">
							                <strong>{{ $errors->first('major_name') }}</strong>
							            </span>
							        @endif
							      </div>
								</div>
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> Update Course Major</button>
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
@endsection
@extends('layouts.admin-layout')

@section('title') Courses @endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Add Course</h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0)"><i class="fa fa-book"></i> Home</a></li>
			<li class="active">Courses</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<p><a href="{{ route('admin.courses') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back to Courses</a></p>
				@include('includes.all')
				<div class="box box-primary">
					<div class="box-header with-border">
						<strong><i class="fa fa-book"></i> Add Course</strong>
					</div>
					<div class="box-body">
						<form action="{{ route('admin.add.course.post') }}" method="POST" role="form" autocomplete="off">
							{{ csrf_field() }}
							<div class="row">
								<div class="col-md-6">
							      <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
							      	<label for="title">Course Title</label>
							        <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="Enter Course Title" >
							        @if ($errors->has('title'))
							            <span class="help-block">
							                <strong>{{ $errors->first('title') }}</strong>
							            </span>
							        @endif
							      </div>
							      <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
							      	<label for="title">Course Code</label>
							        <input id="code" type="text" class="form-control" name="code" value="{{ old('code') }}" placeholder="Enter Course Code" >
							        @if ($errors->has('code'))
							            <span class="help-block">
							                <strong>{{ $errors->first('code') }}</strong>
							            </span>
							        @endif
							      </div>
								</div>
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add Course</button>
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
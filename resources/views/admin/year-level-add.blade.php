@extends('layouts.admin-layout')

@section('title') Year Level @endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Add Year Level</h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0)"><i class="fa fa-bars"></i> Home</a></li>
			<li class="active">Year Level</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<p><a href="{{ route('admin.year.level') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Back to Year Level</a></p>
				@include('includes.all')
				<div class="box box-danger">
					<div class="box-header with-border">
						<strong><i class="fa fa-book"></i> Add Year Level</strong>
					</div>
					<div class="box-body">
						<p><em>Field with red asterisk (<label class="label-required">*</label>) are required fields.</em></p>
						<form action="{{ route('admin.add.year.level.post') }}" method="POST" role="form" autocomplete="off">
							{{ csrf_field() }}
							<div class="row">
								<div class="col-md-6">
							      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
							      	<label for="name">Year Level Name</label>
							        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Enter Year Level Name" >
							        @if ($errors->has('name'))
							            <span class="help-block">
							                <strong>{{ $errors->first('name') }}</strong>
							            </span>
							        @endif
							      </div>
								</div>
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-danger"><i class="fa fa-plus"></i> Add Year Level</button>
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
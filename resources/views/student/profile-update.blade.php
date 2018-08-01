@extends('layouts.student-layout')

@section('title') Student Profile @endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Update Student Profile</h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0)"><i class="fa fa-user"></i> Home</a></li>
			<li class="active">Profile</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				@include('includes.all')
				<div class="box box-primary">
					<div class="box-header with-border">
						<strong><i class="fa fa-user"></i> Update Student Profile</strong>
					</div>
					<div class="box-body">
						<p><em>Field with red asterisk (<label class="label-required">*</label>) are required fields.</em></p>
						<form action="{{ route('student.update.profile.post') }}" method="POST" role="form" autocomplete="off">
							{{ csrf_field() }}
							<div class="row">
								<div class="col-md-6">
							      <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
							      	<label for="firstname">Firstname</label><label class="label-required">*</label>
							        <input id="firstname" type="text" class="form-control" name="firstname" value="{{ Auth::user()->firstname }}" placeholder="Enter Firstname" autofocus required="">
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
							        <input id="middlename" type="text" class="form-control" name="middlename" value="{{ Auth::user()->middle_name }}" placeholder="Enter Middlename" >
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
							        <input id="lastname" type="text" class="form-control" name="lastname" value="{{ Auth::user()->lastname }}" placeholder="Enter Lastname" required>
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
							        <input id="suffix_name" type="text" class="form-control" name="suffix_name" value="{{ Auth::user()->suffix_name }}" placeholder="Enter Suffix Name" >
							        @if ($errors->has('suffix_name'))
							            <span class="help-block">
							                <strong>{{ $errors->first('suffix_name') }}</strong>
							            </span>
							        @endif
							      </div>
								</div>
								<div class="col-md-6">
							      <div class="form-group{{ $errors->has('id_number') ? ' has-error' : '' }}">
							      	<label for="id_number">ID Number</label>
							        <input id="id_number" type="text" class="form-control" name="id_number" value="{{ Auth::user()->id_number }}" placeholder="Enter ID Number" >
							        @if ($errors->has('id_number'))
							            <span class="help-block">
							                <strong>{{ $errors->first('id_number') }}</strong>
							            </span>
							        @endif
							      </div>
								</div>
							</div>

							<div class="form-group">
								<button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Update Student Profile</button>
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
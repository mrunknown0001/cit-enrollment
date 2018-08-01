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
							      <div class="form-group{{ $errors->has('student_number') ? ' has-error' : '' }}">
							      	<label for="student_number">Student Number</label>
							        <input id="student_number" type="text" class="form-control" name="student_number" value="{{ Auth::user()->student_number }}" placeholder="Enter ID Number" disabled="">
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
							      <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
							      	<label for="gender">Gender</label>
							        <input id="gender" type="text" class="form-control" name="gender" value="{{ Auth::user()->info->sex }}" placeholder="Enter Gender" autofocus>
							        @if ($errors->has('gender'))
							            <span class="help-block">
							                <strong>{{ $errors->first('gender') }}</strong>
							            </span>
							        @endif
							      </div>
								</div>
								<div class="col-md-6">
							      <div class="form-group{{ $errors->has('mobile_number') ? ' has-error' : '' }}">
							      	<label for="mobile_number">Mobile Number</label>
							        <input id="mobile_number" type="text" class="form-control" name="mobile_number" value="{{ Auth::user()->info->mobile_number }}" placeholder="Enter Mobile Number" >
							        @if ($errors->has('mobile_number'))
							            <span class="help-block">
							                <strong>{{ $errors->first('mobile_number') }}</strong>
							            </span>
							        @endif
							      </div>
								</div>
								<div class="col-md-6">
							      <div class="form-group{{ $errors->has('contact_number') ? ' has-error' : '' }}">
							      	<label for="contact_number">Contact Number</label>
							        <input id="contact_number" type="text" class="form-control" name="contact_number" value="{{ Auth::user()->info->contact_number }}" placeholder="Enter Contact Number" autofocus>
							        @if ($errors->has('contact_number'))
							            <span class="help-block">
							                <strong>{{ $errors->first('contact_number') }}</strong>
							            </span>
							        @endif
							      </div>
								</div>
								<div class="col-md-6">
							      <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
							      	<label for="email">Email Address</label>
							        <input id="email" type="email" class="form-control" name="email" value="{{ Auth::user()->info->email }}" placeholder="Enter Email Address" >
							        @if ($errors->has('email'))
							            <span class="help-block">
							                <strong>{{ $errors->first('email') }}</strong>
							            </span>
							        @endif
							      </div>
								</div>
								<div class="col-md-6">
							      <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
							      	<label for="address">Home Address</label>
							        <input id="address" type="text" class="form-control" name="address" value="{{ Auth::user()->info->home_address }}" placeholder="Enter Home Address" >
							        @if ($errors->has('address'))
							            <span class="help-block">
							                <strong>{{ $errors->first('address') }}</strong>
							            </span>
							        @endif
							      </div>
								</div>
								<div class="col-md-6">
							      <div class="form-group{{ $errors->has('nationality') ? ' has-error' : '' }}">
							      	<label for="nationality">Nationality</label>
							        <input id="nationality" type="text" class="form-control" name="nationality" value="{{ Auth::user()->info->nationality }}" placeholder="Enter Nationality" >
							        @if ($errors->has('nationality'))
							            <span class="help-block">
							                <strong>{{ $errors->first('nationality') }}</strong>
							            </span>
							        @endif
							      </div>
								</div>
								<div class="col-md-6">
							      <div class="form-group{{ $errors->has('civil_status') ? ' has-error' : '' }}">
							      	<label for="civil_status">Civil Status</label>
							        <select class="form-control" name="civil_status" id="civil_status">
							        	<option value="">Select Civil Status</option>
							        	<option value="1">Single</option>
							        	<option value="2">Married</option>
							        	<option value="3">Widowed</option>
							        	<option value="4">Divorcred</option>
							        	<option value="5">Annulled</option>
							        	<option value="6">Legally Separated</option>
							        </select>
							        @if ($errors->has('civil_status'))
							            <span class="help-block">
							                <strong>{{ $errors->first('civil_status') }}</strong>
							            </span>
							        @endif
							      </div>
								</div>
								<div class="col-md-6">
							      <div class="form-group{{ $errors->has('date_of_birth') ? ' has-error' : '' }}">
							      	<label for="date_of_birth">Date of Birth</label>
							        <input id="date_of_birth" type="text" class="form-control" name="date_of_birth" value="{{ Auth::user()->info->date_of_birth }}" placeholder="Enter Date of Birth: mm/dd/yyy" >
							        @if ($errors->has('date_of_birth'))
							            <span class="help-block">
							                <strong>{{ $errors->first('date_of_birth') }}</strong>
							            </span>
							        @endif
							      </div>
								</div>
								<div class="col-md-6">
							      <div class="form-group{{ $errors->has('place_of_birth') ? ' has-error' : '' }}">
							      	<label for="place_of_birth">Place of Birth</label>
							        <input id="place_of_birth" type="text" class="form-control" name="place_of_birth" value="{{ Auth::user()->info->place_of_birth }}" placeholder="Enter Play of Birth" >
							        @if ($errors->has('place_of_birth'))
							            <span class="help-block">
							                <strong>{{ $errors->first('place_of_birth') }}</strong>
							            </span>
							        @endif
							      </div>
								</div>
								<div class="col-md-6">
							      <div class="form-group{{ $errors->has('religion') ? ' has-error' : '' }}">
							      	<label for="religion">Religion</label>
							        <input id="religion" type="text" class="form-control" name="religion" value="{{ Auth::user()->info->religion }}" placeholder="Enter Religion" >
							        @if ($errors->has('religion'))
							            <span class="help-block">
							                <strong>{{ $errors->first('religion') }}</strong>
							            </span>
							        @endif
							      </div>
								</div>
								<div class="col-md-6">
							      <div class="form-group{{ $errors->has('fathers_name') ? ' has-error' : '' }}">
							      	<label for="fathers_name">Father's Name</label>
							        <input id="fathers_name" type="text" class="form-control" name="fathers_name" value="{{ Auth::user()->info->fathers_name }}" placeholder="Enter Father's Name" >
							        @if ($errors->has('religion'))
							            <span class="help-block">
							                <strong>{{ $errors->first('religion') }}</strong>
							            </span>
							        @endif
							      </div>
								</div>
								<div class="col-md-6">
							      <div class="form-group{{ $errors->has('mothers_name') ? ' has-error' : '' }}">
							      	<label for="mothers_name">Mother's Name</label>
							        <input id="mothers_name" type="text" class="form-control" name="mothers_name" value="{{ Auth::user()->info->mothers_name }}" placeholder="Enter Mother's Name" >
							        @if ($errors->has('mothers_name'))
							            <span class="help-block">
							                <strong>{{ $errors->first('mothers_name') }}</strong>
							            </span>
							        @endif
							      </div>
								</div>
								<div class="col-md-6">
							      <div class="form-group{{ $errors->has('parents_address') ? ' has-error' : '' }}">
							      	<label for="parents_address">Parent's Address</label>
							        <input id="parents_address" type="text" class="form-control" name="parents_address" value="{{ Auth::user()->info->parents_address }}" placeholder="Enter Parents's Address" >
							        @if ($errors->has('parents_address'))
							            <span class="help-block">
							                <strong>{{ $errors->first('parents_address') }}</strong>
							            </span>
							        @endif
							      </div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
							      <div class="form-group{{ $errors->has('guardians_name') ? ' has-error' : '' }}">
							      	<label for="guardians_name">Guardian's Name</label>
							        <input id="guardians_name" type="text" class="form-control" name="mothers_name" value="{{ Auth::user()->info->guardians_name }}" placeholder="Enter Guardian's Name" >
							        @if ($errors->has('guardians_name'))
							            <span class="help-block">
							                <strong>{{ $errors->first('guardians_name') }}</strong>
							            </span>
							        @endif
							      </div>
								</div>
								<div class="col-md-6">
							      <div class="form-group{{ $errors->has('guardians_address') ? ' has-error' : '' }}">
							      	<label for="guardians_address">Guardian's Address</label>
							        <input id="guardians_address" type="text" class="form-control" name="guardians_address" value="{{ Auth::user()->info->guardians_address }}" placeholder="Enter Guardian's Address" >
							        @if ($errors->has('guardians_address'))
							            <span class="help-block">
							                <strong>{{ $errors->first('guardians_address') }}</strong>
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
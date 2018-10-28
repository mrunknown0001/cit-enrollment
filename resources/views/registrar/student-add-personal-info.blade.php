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
						<strong><i class="fa fa-graduation-cap"></i> Add Student: {{ ucwords($firstname . ' ' . $lastname) }} - {{ $sn }}</strong>
					</div>
					<div class="box-body">
						<p><em>Field with red asterisk (<label class="label-required">*</label>) are required fields.</em></p>
						<form action="{{ route('registrar.add.student.educational.info') }}" method="GET" autocomplete="off" role="form">
							{{ csrf_field() }}
							<input type="hidden" name="sn" value="{{ $sn }}">
							<input type="hidden" name="firstname" value="{{ $firstname }}">
							<input type="hidden" name="lastname" value="{{ $lastname }}">
							<input type="hidden" name="middlename" value="{{ $middlename }}">
							<input type="hidden" name="suffix" value="{{ $suffix }}">
							<input type="hidden" name="course_id" value="{{ $course_id }}">
							<input type="hidden" name="major_id" value="{{ $major_id }}">
							<input type="hidden" name="curriculum_id" value="{{ $curriculum_id }}">
							<input type="hidden" name="yl_id" value="{{ $yl_id }}">
							<div class="row">
								<div class="col-md-6">
							      <div class="form-group{{ $errors->has('sex') ? ' has-error' : '' }}">
							      	<label for="sex">Select Sex</label>
									<select class="form-control" name="sex" id="sex">
										<option value="">Select One</option>
										<option value="Male" {{ $sex == 'Male' ? 'selected' : '' }}>Male</option>
										<option value="Female" {{ $sex == 'Female' ? 'selected' : '' }}>Female</option>
									</select>
							        @if ($errors->has('sex'))
							            <span class="help-block">
							                <strong>{{ $errors->first('sex') }}</strong>
							            </span>
							        @endif
									</div>
								</div>
								<div class="col-md-6">
							      <div class="form-group{{ $errors->has('civil_status') ? ' has-error' : '' }}">
							      	<label for="civil_status">Select Civil Status</label>
									<select class="form-control" name="civil_status" id="civil_status">
										<option value="">Select One</option>
										<option value="Single" {{ $civil_status == 'Single' ? 'selected' : '' }}>Single</option>
										<option value="Married" {{ $civil_status == 'Married' ? 'selected' : '' }}>Married</option>
										<option value="Widowed" {{ $civil_status == 'Widowed' ? 'selected' : '' }}>Widowed</option>
										<option value="Annulled" {{ $civil_status == 'Annulled' ? 'selected' : '' }}>Annulled</option>
										<option value="Divorced" {{ $civil_status == 'Divorced' ? 'selected' : '' }}>Divorced</option>
									</select>
							        @if ($errors->has('civil_status'))
							            <span class="help-block">
							                <strong>{{ $errors->first('civil_status') }}</strong>
							            </span>
							        @endif
									</div>
								</div>
								<div class="col-md-6">
							      <div class="form-group{{ $errors->has('mobile_number') ? ' has-error' : '' }}">
							      	<label for="mobile_number">Enter Mobile Number</label>
							      	<input type="number" name="mobile_number" id="mobile_number" class="form-control" value="{{ $mobile_number }}" placeholder="Enter Mobile Number">
							        @if ($errors->has('mobile_number'))
							            <span class="help-block">
							                <strong>{{ $errors->first('mobile_number') }}</strong>
							            </span>
							        @endif
									</div>
								</div>
								<div class="col-md-6">
							      <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
							      	<label for="email">Enter Email</label>
							      	<input type="email" name="email" id="email" class="form-control" value="{{ $email }}" placeholder="Enter Email">
							        @if ($errors->has('email'))
							            <span class="help-block">
							                <strong>{{ $errors->first('email') }}</strong>
							            </span>
							        @endif
									</div>
								</div>
								<div class="col-md-6">
							      <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
							      	<label for="address">Enter Address</label>
							      	<input type="text" name="address" id="address" class="form-control" value="{{ $address }}" placeholder="Enter Address">
							        @if ($errors->has('address'))
							            <span class="help-block">
							                <strong>{{ $errors->first('address') }}</strong>
							            </span>
							        @endif
									</div>
								</div>
								<div class="col-md-6">
							      <div class="form-group{{ $errors->has('nationality') ? ' has-error' : '' }}">
							      	<label for="nationality">Enter Nationality</label>
							      	<input type="text" name="nationality" id="nationality" class="form-control" value="{{ $nationality }}" placeholder="Enter Nationality">
							        @if ($errors->has('nationality'))
							            <span class="help-block">
							                <strong>{{ $errors->first('nationality') }}</strong>
							            </span>
							        @endif
									</div>
								</div>
								<div class="col-md-6">
							      <div class="form-group{{ $errors->has('place_of_birth') ? ' has-error' : '' }}">
							      	<label for="place_of_birth">Enter Place of Birth</label>
							      	<input type="text" name="place_of_birth" id="place_of_birth" class="form-control" value="{{ $pob }}" placeholder="Enter Place of Birth">
							        @if ($errors->has('place_of_birth'))
							            <span class="help-block">
							                <strong>{{ $errors->first('place_of_birth') }}</strong>
							            </span>
							        @endif
									</div>
								</div>
								<div class="col-md-6">
							      <div class="form-group{{ $errors->has('date_of_birth') ? ' has-error' : '' }}">
							      	<label for="date_of_birth">Enter Date of Birth</label>
							      	<input type="date" name="date_of_birth" id="date_of_birth" class="form-control" value="{{ $dob }}" placeholder="mm/dd/yyyy">
							        @if ($errors->has('date_of_birth'))
							            <span class="help-block">
							                <strong>{{ $errors->first('date_of_birth') }}</strong>
							            </span>
							        @endif
									</div>
								</div>
								<div class="col-md-6">
							      <div class="form-group{{ $errors->has('religion') ? ' has-error' : '' }}">
							      	<label for="religion">Enter Religion</label>
							      	<input type="text" name="religion" id="religion" class="form-control" value="{{ $religion }}" placeholder="Enter Religion">
							        @if ($errors->has('religion'))
							            <span class="help-block">
							                <strong>{{ $errors->first('religion') }}</strong>
							            </span>
							        @endif
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
							      <div class="form-group{{ $errors->has('fathers_name') ? ' has-error' : '' }}">
							      	<label for="fathers_name">Enter Father's Name</label>
							      	<input type="text" name="fathers_name" id="fathers_name" class="form-control" value="{{ $father }}" placeholder="Enter Father's Name">
							        @if ($errors->has('fathers_name'))
							            <span class="help-block">
							                <strong>{{ $errors->first('fathers_name') }}</strong>
							            </span>
							        @endif
									</div>
								</div>
								<div class="col-md-6">
							      <div class="form-group{{ $errors->has('mothers_name') ? ' has-error' : '' }}">
							      	<label for="mothers_name">Enter Mother's Name</label>
							      	<input type="text" name="mothers_name" id="mothers_name" class="form-control" value="{{ $mother }}" placeholder="Enter Mother's Name">
							        @if ($errors->has('mothers_name'))
							            <span class="help-block">
							                <strong>{{ $errors->first('mothers_name') }}</strong>
							            </span>
							        @endif
									</div>
								</div>
								<div class="col-md-6">
							      <div class="form-group{{ $errors->has('guardians_name') ? ' has-error' : '' }}">
							      	<label for="guardians_name">Enter Guardian's Name</label>
							      	<input type="text" name="guardians_name" id="guardians_name" class="form-control" value="{{ $guardian }}" placeholder="Enter Guardian's Name">
							        @if ($errors->has('guardians_name'))
							            <span class="help-block">
							                <strong>{{ $errors->first('guardians_name') }}</strong>
							            </span>
							        @endif
									</div>
								</div>
								<div class="col-md-6">
							      <div class="form-group{{ $errors->has('guardians_address') ? ' has-error' : '' }}">
							      	<label for="guardians_address">Enter Guardian's Address</label>
							      	<input type="text" name="guardians_address" id="guardians_address" class="form-control" value="{{ $guardians_address }}" placeholder="Enter Guardian's Address">
							        @if ($errors->has('guardians_address'))
							            <span class="help-block">
							                <strong>{{ $errors->first('guardians_address') }}</strong>
							            </span>
							        @endif
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-md-2">
										<button type="submit" class="btn btn-primary"><i class="fa fa-arrow-right"></i> Continue</button>
									</div>
							</form>
									<div class="col-md-5"></div>
									<div class="col-md-5 text-center">
										<form action="{{ route('registrar.add.student') }}">
											{{ csrf_field() }}
											<input type="hidden" name="sn" value="{{ $sn }}">
											<input type="hidden" name="firstname" value="{{ $firstname }}">
											<input type="hidden" name="lastname" value="{{ $lastname }}">
											<input type="hidden" name="middlename" value="{{ $middlename }}">
											<input type="hidden" name="suffix_name" value="{{ $suffix }}">
											<input type="hidden" name="course_id" value="{{ $course_id }}">
											<input type="hidden" name="major_id" value="{{ $major_id }}">
											<input type="hidden" name="curriculum_id" value="{{ $curriculum_id }}">
											<input type="hidden" name="yl_id" value="{{ $yl_id }}">
											<button type="submit" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back to Basic Information</button>
										</form>
									</div>
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
@endsection
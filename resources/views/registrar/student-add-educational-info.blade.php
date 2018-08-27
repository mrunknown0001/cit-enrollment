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
						<form action="{{ route('registrar.add.student.post') }}" method="POST" autocomplete="off" role="form">
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
							
							<input type="hidden" name="sex" value="{{ $sex }}">
							<input type="hidden" name="civil_status" value="{{ $civil_status }}">
							<input type="hidden" name="mobile_number" value="{{ $mobile_number }}">
							<input type="hidden" name="email" value="{{ $email }}">
							<input type="hidden" name="address" value="{{ $address }}">
							<input type="hidden" name="nationality" value="{{ $nationality }}">
							<input type="hidden" name="pob" value="{{ $pob }}">
							<input type="hidden" name="dob" value="{{ $dob }}">
							<input type="hidden" name="religion" value="{{ $religion }}">
							<input type="hidden" name="father" value="{{ $father }}">
							<input type="hidden" name="mother" value="{{ $mother }}">
							<input type="hidden" name="guardian" value="{{ $guardian }}">
							<input type="hidden" name="guardians_address" value="{{ $guardians_address }}">

							<div class="row">
								<div class="col-md-6">
							      <div class="form-group{{ $errors->has('elementary_school') ? ' has-error' : '' }}">
							      	<label for="elementary_school">Enter Elementary School</label>
							      	<input type="text" name="elementary_school" id="elementary_school" class="form-control" placeholder="Enter Elementary School">
							        @if ($errors->has('elementary_school'))
							            <span class="help-block">
							                <strong>{{ $errors->first('elementary_school') }}</strong>
							            </span>
							        @endif
									</div>
								</div>
								<div class="col-md-6">
							      <div class="form-group{{ $errors->has('elementary_year_graduated') ? ' has-error' : '' }}">
							      	<label for="elementary_year_graduated">Enter Elementary Year Graduated</label>
							      	<input type="text" name="elementary_year_graduated" id="elementary_year_graduated" class="form-control" placeholder="Enter Elementary Year Graduated">
							        @if ($errors->has('elementary_year_graduated'))
							            <span class="help-block">
							                <strong>{{ $errors->first('elementary_year_graduated') }}</strong>
							            </span>
							        @endif
									</div>
								</div>
								<div class="col-md-6">
							      <div class="form-group{{ $errors->has('high_school') ? ' has-error' : '' }}">
							      	<label for="high_school">Enter High School</label>
							      	<input type="text" name="high_school" id="high_school" class="form-control" placeholder="Enter High School">
							        @if ($errors->has('high_school'))
							            <span class="help-block">
							                <strong>{{ $errors->first('high_school') }}</strong>
							            </span>
							        @endif
									</div>
								</div>
								<div class="col-md-6">
							      <div class="form-group{{ $errors->has('high_school_year_graduated') ? ' has-error' : '' }}">
							      	<label for="high_school_year_graduated">Enter High School Year Graduated</label>
							      	<input type="text" name="high_school_year_graduated" id="high_school_year_graduated" class="form-control" placeholder="Enter High School Year Graduated">
							        @if ($errors->has('high_school_year_graduated'))
							            <span class="help-block">
							                <strong>{{ $errors->first('high_school_year_graduated') }}</strong>
							            </span>
							        @endif
									</div>
								</div>
								<div class="col-md-6">
							      <div class="form-group{{ $errors->has('college') ? ' has-error' : '' }}">
							      	<label for="college">Enter College Degree (if any)</label>
							      	<input type="text" name="college" id="college" class="form-control" placeholder="Enter College Degree">
							        @if ($errors->has('college'))
							            <span class="help-block">
							                <strong>{{ $errors->first('college') }}</strong>
							            </span>
							        @endif
									</div>
								</div>
								<div class="col-md-6">
							      <div class="form-group{{ $errors->has('college_year_graduated') ? ' has-error' : '' }}">
							      	<label for="college_year_graduated">Enter College Year Graduated</label>
							      	<input type="text" name="college_year_graduated" id="college_year_graduated" class="form-control" placeholder="Enter College Year Graduated">
							        @if ($errors->has('college_year_graduated'))
							            <span class="help-block">
							                <strong>{{ $errors->first('college_year_graduated') }}</strong>
							            </span>
							        @endif
									</div>
								</div>
								<div class="col-md-6">
							      <div class="form-group{{ $errors->has('school_last_attended') ? ' has-error' : '' }}">
							      	<label for="school_last_attended">Enter School Last Attended</label>
							      	<input type="text" name="school_last_attended" id="school_last_attended" class="form-control" placeholder="Enter School Last Attended">
							        @if ($errors->has('school_last_attended'))
							            <span class="help-block">
							                <strong>{{ $errors->first('school_last_attended') }}</strong>
							            </span>
							        @endif
									</div>
								</div>
								<div class="col-md-6">
							      <div class="form-group{{ $errors->has('school_address') ? ' has-error' : '' }}">
							      	<label for="school_address">Enter School Address</label>
							      	<input type="text" name="school_address" id="school_address" class="form-control" placeholder="Enter School Address">
							        @if ($errors->has('school_address'))
							            <span class="help-block">
							                <strong>{{ $errors->first('school_address') }}</strong>
							            </span>
							        @endif
									</div>
								</div>
								<div class="col-md-6">
							      <div class="form-group{{ $errors->has('year_graduated') ? ' has-error' : '' }}">
							      	<label for="year_graduated">Enter Last School Graduated</label>
							      	<input type="text" name="year_graduated" id="year_graduated" class="form-control" placeholder="Enter Last School Year Graduated">
							        @if ($errors->has('year_graduated'))
							            <span class="help-block">
							                <strong>{{ $errors->first('year_graduated') }}</strong>
							            </span>
							        @endif
									</div>
								</div>
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Update Student Information</button>
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
@extends('layouts.registrar-layout')

@section('title') Password @endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Password</h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0)"><i class="fa fa-key"></i> Home</a></li>
			<li class="active">Password</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				@include('includes.all')
				<div class="box box-primary">
					<div class="box-header with-border">
						<strong><i class="fa fa-key"></i> Password Change</strong>
					</div>
					<div class="box-body">
						<div class="row">
							<div class="col-md-6">
								<p><em>Field with red asterisk (<label class="label-required">*</label>) are required fields.</em></p>
								<form action="{{ route('registrar.change.password.post') }}" method="POST">
									{{ csrf_field() }}
									<div class="form-group{{ $errors->has('old_password') ? ' has-error' : '' }}">
										<label for="old_password">Old Password</label><label class="label-required">*</label>
										<input id="old_password" type="password" class="form-control" name="old_password" placeholder="Enter Old Password" autofocus required="">
										@if ($errors->has('old_password'))
											<span class="help-block">
												<strong>{{ $errors->first('old_password') }}</strong>
											</span>
										@endif
									</div>
									<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
										<label for="password">New Password</label><label class="label-required">*</label>
										<input id="password" type="password" class="form-control" name="password" placeholder="Enter New Password" autofocus required="">
										@if ($errors->has('password'))
											<span class="help-block">
												<strong>{{ $errors->first('password') }}</strong>
											</span>
										@endif
									</div>
									<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
										<label for="password_confirmation">Confirm New Password</label><label class="label-required">*</label>
										<input id="password_confirmation" type="password" class="form-control" name="password_confirmation" placeholder="Confirm New Password" autofocus required="">
										@if ($errors->has('password'))
											<span class="help-block">
												<strong>{{ $errors->first('password') }}</strong>
											</span>
										@endif
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-primary"><i class="fa fa-key"></i> Change Password</button>
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
@endsection
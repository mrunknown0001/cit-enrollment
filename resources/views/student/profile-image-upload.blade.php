@extends('layouts.student-layout')

@section('title') Profile Image @endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1> Change Profile Image</h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0)"><i class="fa fa-user"></i> Home</a></li>
			<li class="active">Profile Image</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				@include('includes.all')
				<div class="box box-danger">
					<div class="box-header with-border">
						<strong><i class="fa fa-key"></i> Change Profile Image</strong>
					</div>
					<div class="box-body">
						<div class="row">
							<div class="col-md-6">
								<p><em>Field with red asterisk (<label class="label-required">*</label>) are required fields.</em></p>
								<form action="{{ route('student.upload.profile.image.post') }}" method="POST" enctype="multipart/form-data">
									{{ csrf_field() }}
									<div class="form-group">
										<label for="image">Browse Image File</label><label class="label-required">*</label>
										<input type="file" name="image" id="image" accept="image/x-png,image/gif,image/jpeg" required="">
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> Save Profile Image</button>
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
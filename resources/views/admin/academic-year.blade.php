@extends('layouts.admin-layout')

@section('title') Academic Year @endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Academic Year</h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0)"><i class="fa fa-calendar"></i> Home</a></li>
			<li class="active">Academic Year</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				@include('includes.all')
				@if ($errors->has('password'))
					<div class="alert alert-danger text-center top-space">
						<a href="javascript:void(0)" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<b>{{ $errors->first('password') }}</b>
					</div>
		        @endif
				<div class="box box-primary">
					<div class="box-header with-border">
						<strong><i class="fa fa-calendar"></i> Academic Year</strong>
					</div>
					<div class="box-body">
						<div class="row">
							<div class="col-md-6">
								@if(count($ay) > 0)
									<p>Current Academic Year: <strong>{{ $ay->from . '-' . $ay->to }}</strong></p>
									<p>Semester: <strong>{{ $sem->name }}</strong></p>
									@if($sem->id == 1)
									@include('admin.includes.select-second-semester')
									@else
									@include('admin.includes.close-academic-year')
									@endif
								@else
									@include('admin.includes.academic-year-add')
								@endif
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
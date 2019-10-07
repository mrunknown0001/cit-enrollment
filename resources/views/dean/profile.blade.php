@extends('layouts.dean-layout')

@section('title') Dean Profile @endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Dean Profile</h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0)"><i class="fa fa-user"></i> Home</a></li>
			<li class="active">Profile</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				@include('includes.all')
				<div class="box box-danger">
					<div class="box-header with-border">
						<strong><i class="fa fa-user"></i> Dean Profile</strong>
					</div>
					<div class="box-body">
						<div class="row">
							<div class="col-md-6">
								<p>Name: <strong>{{ ucwords(Auth::guard('dean')->user()->firstname . ' ' . Auth::guard('dean')->user()->lastname) }}</strong></p>
								<p>ID Number: <strong>{{ Auth::guard('dean')->user()->id_number }}</strong></p>
								<p><a href="{{ route('dean.update.profile') }}" class="btn btn-default"><i class="fa fa-pencil"></i> Update Profile</a></p>
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
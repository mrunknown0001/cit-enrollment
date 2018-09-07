@extends('layouts.dean-layout')

@section('title') Faculty Load @endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Add Faculty Load</h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0)"><i class="fa fa-user"></i> Home</a></li>
			<li class="active">Faculty Load</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<p>
					<a href="{{ route('dean.faculty.load') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back to Faculty Loads</a>
				</p>
				@include('includes.all')
				<div class="box box-primary">
					<div class="box-header with-border">
						<strong><i class="fa fa-user"></i> Add Faculty Load</strong>
					</div>
					<div class="box-body">

					<div class="row">
						<div class="col-md-6">
							<p><em>Field with red asterisk (<label class="label-required">*</label>) are required fields.</em></p>
							<form action="#" method="POST" autocomplete="off">
								{{ csrf_field() }}
								<div class="form-group">
									
								</div>
								<div class="form-group">
									<button class="btn btn-primary">Assign Load to Faculty</button>
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
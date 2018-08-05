@extends('layouts.student-layout')

@section('title') Enrollment @endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Enrollment</h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0)"><i class="fa fa-file-text-o"></i> Home</a></li>
			<li class="active">Enrollment</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				@include('includes.all')
				
				<div class="box box-primary">
					<div class="box-header with-border">
						<strong><i class="fa fa-file-text-o"></i> Enrollment</strong>
					</div>
					<div class="box-body">
						<p>Load all subjects in the box. Show rooms, time and day in subject schedules</p>
					</div>
					<div class="box-footer">
						
					</div>
				</div>

			</div>
		</div>
	</section>
</div>
@endsection
@extends('layouts.registrar-layout')

@section('title') Students @endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Student Subjects</h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0)"><i class="fa fa-graduation-cap"></i> Home</a></li>
			<li class="active">Student</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<p>
					<a href="{{ route('registrar.students') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back to Students</a>
				</p>
				@include('includes.all')
				<div class="box box-primary">
					<div class="box-header with-border">
						<strong>Student Subjects</strong>
					</div>
					<div class="box-body">

						

					</div>
					<div class="box-footer">
						
					</div>
				</div>

			</div>
		</div>
	</section>
</div>
@endsection
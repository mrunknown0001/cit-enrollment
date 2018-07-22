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
			</div>
		</div>
	</section>
</div>
@endsection
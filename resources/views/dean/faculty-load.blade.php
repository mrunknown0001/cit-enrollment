@extends('layouts.dean-layout')

@section('title') Faculty Load @endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Faculty Load</h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0)"><i class="fa fa-user"></i> Home</a></li>
			<li class="active">Faculty Load</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<p>
					<a href="{{ route('dean.add.faculty.load') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Assign Subject to Faculty</a>
				</p>
				@include('includes.all')

			</div>
		</div>
	</section>
</div>
@endsection
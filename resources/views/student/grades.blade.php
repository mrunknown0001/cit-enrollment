@extends('layouts.student-layout')

@section('title') My Grades @endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>My Grades</h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0)"><i class="fa fa-file-o"></i> Home</a></li>
			<li class="active">Grades</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				@include('includes.all')

				@if(count($semesters) > 0)
					<form>
						<div class="form-group">
							<select id="semester">
								<option value="">Select Semesters Taken</option>
								@foreach($semesters as $s)
								<option value="{{ $s->id }}">{{ $s->ay->from . '-' . $s->ay->to . ' ' . $s->semester->name }}</option>
								@endforeach
							</select>
						</div>
					</form>
				@else
					<p class="text-center">No Grades Found!</p>
				@endif

			</div>
		</div>
	</section>
</div>
@endsection
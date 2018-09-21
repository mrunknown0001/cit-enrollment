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
					<a href="{{ route('dean.selection.faculty.load') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Assign Subject to Faculty</a>
				</p>
				@include('includes.all')
				@if(count($loads) > 0) 
					<table class="table table-hover table-bordered table-striped">
						<thead>
							<tr>
								<th class="text-center">Faculty Name</th>
								<th class="text-center">Subject Loads</th>
								<th class="text-center">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($loads as $l)
							<tr>
								<td class="text-center">
									{{ ucwords($l->faculty->firstname . ' ' . $l->faculty->lastname) }}
								</td>
								<td class="text-center">
									{{ strtoupper($l->course->code) . ' ' . ucwords($l->year_level->name) . ' ' . strtoupper($l->section->name) . ' - ' . strtoupper($l->subject->code) }}
								</td>
								<td class="text-center">
									<a href="{{ route('dean.delete.faculty.load', ['id' => $l->id]) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</a>
									{{--<a href="#" class="btn btn-default btn-xs"><i class="fa fa-pencil"></i> Update</a>--}}
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				@else
					<p class="text-center">No Subject Assigned to Faculty.</p>
				@endif

			</div>
		</div>
	</section>
</div>
@endsection
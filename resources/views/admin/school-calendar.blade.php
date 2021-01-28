@extends('layouts.admin-layout')

@section('title') School Calendar @endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>School Calendar</h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0)"><i class="fa fa-calendar"></i> Home</a></li>
			<li class="active">School Calendar</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				@include('includes.all')
				

				<p><button class="btn btn-danger" data-toggle="modal" data-target="#addSchoolCalendar"><i class="fa fa-plus"></i> Add School Calendar</button></p>
				@include('admin.includes.modal-calendar-add')

				@if(count($calendars) > 0)
				<div class="box box-danger">
					<div class="box-header with-border">
						<strong><i class="fa fa-users"></i> School Calendar</strong>
					</div>
					<div class="box-body">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center">Title</th>
									<th class="text-center">Date</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($calendars as $c)
									<tr>
										<td>{{ $c->title }}</td>
										<td>{{ $c->date }}</td>
										<td>
											<button class="btn btn-xs" data-toggle="modal" data-target="#UpdateSchoolCalendar-{{ $c->id }}"><i class="fa fa-pencil"></i> Update</button>
										</td>
										@include('admin.includes.modal-calendar-update')
									</tr>
								@endforeach
							</tbody>
							<tfoot>
							</tfoot>
						</table>						
					</div>
					<div class="box-footer">
						
					</div>
				</div>


				@else
				<p class="text-center">No Data Available</p>
				@endif
			</div>
		</div>
	</section>
</div>
@endsection
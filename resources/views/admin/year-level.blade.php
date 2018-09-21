@extends('layouts.admin-layout')

@section('title') Year Level @endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Year Level</h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0)"><i class="fa fa-bars"></i> Home</a></li>
			<li class="active">Year Level</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				{{-- <p><a href="{{ route('admin.add.year.level') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Year Level</a></p> --}}

				{{-- <p><button class="btn btn-primary" data-toggle="modal" data-target="#addYearLevel"><i class="fa fa-plus"></i> Add Year Level</button></p>
				@include('admin.includes.modal-year-level-add')  --}}

				<p>
					<button class="btn btn-primary" data-toggle="modal" data-target="#incrementYearLevel">
						<i class="fa fa-plus"></i> Add Year Level
					</button>
				</p>

				@include('includes.all')
				
				@if(count($year_levels) > 0)
				<div class="box box-primary">
					<div class="box-header with-border">
						<strong><i class="fa fa-bars"></i> Year Level</strong>
					</div>
					<div class="box-body">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center">Name</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($year_levels as $y)
								<tr>
									<td class="text-center">{{ ucwords($y->name) }}</td>
									<td class="text-center">
										{{-- <a href="{{ route('admin.update.year.level', ['id' => $y->id]) }}" class="btn btn-default btn-xs"><i class="fa fa-pencil"></i> Update
										</a> --}}
										<button class="btn btn-default btn-xs" data-toggle="modal" data-target="#updateYearLevel-{{ $y->id }}"><i class="fa fa-pencil"></i> Update</button>
									</td>
								</tr>
								@include('admin.includes.modal-year-level-update')
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
				<p class="text-center">No Year Level Available</p>
				@endif
			</div>
		</div>
	</section>
</div>
@include('admin.includes.modal-year-level-increment')
@endsection
@extends('layouts.dean-layout')

@section('title') Rooms @endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Rooms</h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0)"><i class="fa fa-building"></i> Home</a></li>
			<li class="active">Rooms</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				@include('includes.all')
				
				{{-- <p><a href="{{ route('dean.add.room') }}" class="btn btn-danger"><i class="fa fa-plus"></i> Add Room</a></p> --}}

				<p><button class="btn btn-danger" data-toggle="modal" data-target="#addRoom"><i class="fa fa-plus"></i> Add Room</button></p>
				@include('dean.includes.modal-room-add')

				@if(count($rooms) > 0)
				<div class="box box-danger">
					<div class="box-header with-border">
						<strong><i class="fa fa-building"></i> Rooms</strong>
					</div>
					<div class="box-body">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center">Room Name/Number</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($rooms as $r)
								<tr>
									<td class="text-center">{{ ucwords($r->name) }}</td>
									<td class="text-center">
										{{-- <a href="{{ route('dean.update.room', ['id' => $r->id]) }}" class="btn btn-default btn-xs"><i class="fa fa-pencil"></i> Update</a> --}}
										<button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#updateRoom-{{ $r->id }}"><i class="fa fa-pencil"></i> Update</button>
										<a href="{{ route('dean.delete.room', ['id' => $r->id]) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</a>
									</td>
								</tr>
								@include('dean.includes.modal-room-update')
								@endforeach
							</tbody>
							<tfoot></tfoot>
						</table>
					</div>
					<div class="box-footer">
						
					</div>
				</div>

				@else
				<p class="text-center">No Rooms Available</p>
				@endif
			</div>
		</div>
	</section>
</div>
@endsection
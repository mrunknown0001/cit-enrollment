@extends('layouts.dean-layout')

@section('title') Sections @endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Sections</h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0)"><i class="fa fa-users"></i> Home</a></li>
			<li class="active">Sections</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<p>
					<button class="btn btn-primary" data-toggle="modal" data-target="#addSection"><i class="fa fa-plus"></i> Add Section</button>
					@include('dean.includes.modal-section-add')
				</p>
				@include('includes.all')

				@if(count($sections) > 0)
				<table class="table table-bordered table-hover table-striped">
					<thead>
						<tr>
							<th class="text-center">Section Name</th>
							<th class="text-center">Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($sections as $s)
						<tr>
							<td class="text-center">{{ strtoupper($s->name) }}</td>
							<td class="text-center">
								<button class="btn btn-default btn-xs" data-toggle="modal" data-target="#updateSection-{{ $s->id }}"><i class="fa fa-pencil"></i> Update</button>
							</td>
							@include('dean.includes.modal-section-update')
						</tr>
						@endforeach
					</tbody>
				</table>
				@else
				<p class="text-center">No Sections!</p>
				@endif
				
			</div>
		</div>
	</section>
</div>
@endsection
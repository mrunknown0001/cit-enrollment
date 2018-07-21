@extends('layouts.admin-layout')

@section('title') Registrars @endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Registrars</h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0)"><i class="fa fa-users"></i> Home</a></li>
			<li class="active">Registrars</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				@include('includes.all')
				<p><a href="{{ route('admin.add.registrar') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Registrar</a></p>
				@if(count($registrars) > 0)
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th class="text-center">Username</th>
							<th class="text-center">Name</th>
							<th class="text-center">Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($registrars as $r)
						<tr>
							<td>{{ $r->username }}</td>
							<td>
								{{ ucwords($r->firstname . ' ' . $r->lastname) }}
								{{ strtoupper($r->suffix_name) }}
							</td>
							<td class="text-center">
								<a href="{{ route('admin.update.registrar', ['id' => $r->id]) }}" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil"></span> Update</a>
							</td>
						</tr>
						@endforeach
					</tbody>
					<tfoot>
					</tfoot>
				</table>
				@else
				<p class="text-center">No Registrar Available</p>
				@endif
			</div>
		</div>
	</section>
</div>
@endsection
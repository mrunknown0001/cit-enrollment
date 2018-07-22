@extends('layouts.admin-layout')

@section('title') Deans @endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Deans</h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0)"><i class="fa fa-users"></i> Home</a></li>
			<li class="active">Deans</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				@include('includes.all')
				<p><a href="{{ route('admin.add.dean') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Dean</a></p>
				@if(count($deans) > 0)
				<div class="box box-primary">
					<div class="box-header with-border">
						<strong><i class="fa fa-users"></i> Deans</strong>
					</div>
					<div class="box-body">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center">Username</th>
									<th class="text-center">Name</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($deans as $d)
								<tr>
									<td>{{ $d->username }}</td>
									<td>
										{{ ucwords($d->firstname . ' ' . $d->lastname) }}
										{{ strtoupper($d->suffix_name) }}
									</td>
									<td class="text-center">
										<a href="{{ route('admin.update.dean', ['id' => $d->id]) }}" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil"></span> Update</a>
									</td>
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
				<p class="text-center">No Deans Available</p>
				@endif
			</div>
		</div>
	</section>
</div>
@endsection
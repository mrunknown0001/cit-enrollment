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
				<table class="table table-bordered">
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
								<a href="#" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-eye-open"></span> View Details</a>
							</td>
						</tr>
						@endforeach
					</tbody>
					<tfoot>
						
					</tfoot>
				</table>
				@else
				<p class="text-center">No Deans Available</p>
				@endif
			</div>
		</div>
	</section>
</div>
@endsection
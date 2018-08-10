@extends('layouts.admin-layout')

@section('title') Unit Price and Miscellaneous @endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Unit Price and Miscellaneous</h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0)"><i class="fa fa-rub"></i> Home</a></li>
			<li class="active">Unit Price and Miscellaneous</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				@include('includes.all')
				<div class="box box-primary">
					<div class="box-header with-rub">
						<strong><i class="fa fa-rub"></i> Unit Price and Miscellaneous</strong>
					</div>
					<div class="box-body">
						<p><a href="{{ route('admin.add.misc.fee') }}" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> Add Miscellaneous Fee</a></p>
						<div class="row">
							<div class="col-md-6">
								@if(count($misc) > 0)
								<table class="table table-bordered">
									<tr>
										<th class="text-center">Name</th>
										<th class="text-center">Amount</th>
										<th class="text-center">Action</th>
									</tr>
									@foreach($misc as $m)
									<tr>
										<td class="text-center">{{ ucwords($m->name) }}</td>
										<td class="text-center">&#8369; {{ $m->amount }}</td>
										<td class="text-center">
											<a href="{{ route('admin.update.misc.fee', ['id' => $m->id]) }}" class="btn btn-default btn-xs"><i class="fa fa-pencil"></i> Update</a>
										</td>
									</tr>
									@endforeach
								</table>
								@else
								<p class="text-center">No Miscellaneous Fee!</p>
								@endif
							</div>
							<div class="col-md-6">
								<table class="table table-bordered">
									<tr>
										<th class="text-center">Price Per Unit</th>
										<th class="text-center">Action</th>
									</tr>
									<tr>
										<td class="text-center">
											&#8369; {{ $unit_price->amount }}
										</td>
										<td class="text-center">
											<a href="{{ route('admin.update.unit.price') }}" class="btn btn-default btn-xs"><i class="fa fa-pencil"></i> Update</a>
										</td>
									</tr>
								</table>
							</div>
						</div>
					</div>
					<div class="box-footer">
						
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
@endsection
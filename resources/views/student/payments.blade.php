@extends('layouts.student-layout')

@section('title') Payments @endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Payments</h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0)"><i class="fa fa-credit-card"></i> Home</a></li>
			<li class="active">Payments</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				@include('includes.all')

				@if(count($payments) > 0)
				<div class="box box-primary">
					<div class="box-header with-border">
						<strong><i class="fa fa-credit-cardcap"></i> Payments</strong>
					</div>
					<div class="box-body">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center">MOP</th>
									<th class="text-center">Amount</th>
									<th class="text-center">Description</th>
									<th class="text-center">Date &amp; Time</th>
								</tr>
							</thead>
							<tbody>
								@foreach($payments as $p)
									<tr>
										<td class="text-center">
											{{ $p->mop->name }}
										</td>
										<td class="text-center">
											&#8369; {{ $p->amount }}
										</td>
										<td>
											{{ $p->description }}
										</td>
										<td class="text-center">
											{{ date('l, F j, Y g:i:s a', strtotime($p->created_at)) }}
										</td>
									</tr>
								@endforeach
							</tbody>
							<tfoot>
								
							</tfoot>
						</table>
					</div>
					<div class="box-footer">
						{{ $payments->links() }}
					</div>
				</div>
				@else
				<p class="text-center">No Payments Available!</p>
				@endif
			</div>
		</div>
	</section>
</div>
@endsection
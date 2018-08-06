@extends('layouts.cashier-layout')

@section('title') Payments @endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Payments</h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0)"><i class="fa fa-money"></i> Home</a></li>
			<li class="active"> Payments</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				@include('includes.all')
				@if(count($payments) > 0)
				<p>
					<a href="{{ route('cashier.student.counter.payment') }}" class="btn btn-primary btn-xs"><i class="fa fa-money"></i> Make Payment</a>
					<a href="#" class="btn btn-primary btn-xs"><i class="fa fa-bar-chart"></i> Generate Report</a>
				</p>
				<div class="box box-primary">
					<div class="box-header with-border">
						<strong><i class="fa fa-money"></i> Payments</strong>
					</div>
					<div class="box-body">
						<div class="row">
							<div class="col-md-12">
								<table class="table table-bordered">
									<thead>
										<tr>
											<th class="text-center">Student</th>
											<th class="text-center">MOP</th>
											<th class="text-center">Amount</th>
											<th class="text-center">Description</th>
											<th class="text-center">Date &amp; Time</th>
										</tr>
									</thead>
									<tbody>
										@foreach($payments as $p)
										<tr>
											<td>
												{{ ucwords($p->student->firstname . ' ' . $p->student->lastname) }}
											</td>
											<td class="text-center">
												{{ ucwords($p->mop->name) }}
											</td>
											<td class="text-center">
												&#8369; {{ $p->amount }}
											</td>
											<td>
												{{ $p->description }}
											</td>
											<td>
												{{ date('l, F j, Y g:i:s a', strtotime($p->created_at)) }}
											</td>
										</tr>
										@endforeach
									</tbody>
									<tfoot>
										{{ $payments->links() }}
									</tfoot>
								</table>
							</div>
						</div>
					</div>
					<div class="box-footer">
						
					</div>
				</div>
				@else
				<p class="text-center">No Payments Made!</p>
				@endif
			</div>
		</div>
	</section>
</div>
@endsection
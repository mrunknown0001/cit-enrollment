@extends('layouts.cashier-layout')

@section('title') Balances @endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Balances</h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0)"><i class="fa fa-rub"></i> Home</a></li>
			<li class="active">Balances</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">

				@if(count($balances) > 0)
					<p><a href="{{ route('cashier.balance.generate') }}" class="btn btn-danger btn-xs">Generate Student Balances</a></p>
					@include('includes.all')
					<div class="box box-danger">
						<div class="box-header with-border">
							<strong><i class="fa fa-rub"></i> Balances</strong>
						</div>
						<div class="box-body">
							<div class="row">
								<div class="col-md-12">
									<table class="table table-bordered table-hover">
										<thead>
											<tr>
												<th class="text-center">Student</th>
												<th class="text-center">Balance</th>
												<th class="text-center">Total Payable</th>
											</tr>
										</thead>
										<tbody>
											@foreach($balances as $b)
												<tr>
													<td>{{ ucwords($b->student->firstname . ' ' . $b->student->lastname) }}</td>
													<td class="text-center">&#8369; {{ $b->balance }}</td>
													<td class="text-center">&#8369; {{ $b->total }}</td>
												</tr>
											@endforeach
										</tbody>
										<tfoot></tfoot>
									</table>
								</div>
							</div>
						</div>
						<div class="box-footer">
							{{ $balances->links() }}
						</div>
					</div>
				@else
					@include('includes.all')
					<p class="text-center">No Balances!</p>
				@endif
			</div>
		</div>
	</section>
</div>
@endsection
@extends('layouts.cashier-layout')

@section('title') Payment @endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Payment over the Counter: Search Result: "{{ $keyword }}"</h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0)"><i class="fa fa-money"></i> Home</a></li>
			<li class="active">Payment</li>
		</ol>
	</section>
	<section class="content">
		<p><a href="{{ route('cashier.payments') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Back to Payments</a></p>
		@include('includes.all')
		<div class="row">
			<div class="col-md-4">
				<form action="{{ route('cashier.search.student') }}" method="get" class="" autocomplete="off">
					<div class="input-group">
						<input type="text" name="q" class="form-control" placeholder="Search Student">
						<span class="input-group-btn">
							<button type="submit" id="search-btn" class="btn btn-flat btn-danger"><i class="fa fa-search"></i>
						</button>
						</span>
					</div>
				</form>	
			</div>
			<hr>
			<div class="col-md-12">
				@if(count($students) > 0)
				<div class="box box-danger">
					<div class="box-header with-border">
						<strong><i class="fa fa-graduation-cap"></i> Students</strong>
					</div>
					<div class="box-body">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center">Name of Student</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($students as $s)
								<tr>
									<td>{{ ucwords($s->firstname . ' ' . $s->lastname) }}</td>
									<td class="text-center">
										<button class="btn btn-default btn-xs" data-toggle="modal" data-target="#studentInfo-{{ $s->id }}"><i class="fa fa-eye"></i> View Info</button>

									
									</td>
								</tr>
								@include('cashier.includes.modal-student-info')
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
					<p class="text-center">No Students Found for "{{ $keyword }}"</p>
				@endif
			</div>
		</div>
	</section>
</div>
@endsection
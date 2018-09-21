@extends('layouts.admin-layout')

@section('title') Cashiers @endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Cashiers</h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0)"><i class="fa fa-users"></i> Home</a></li>
			<li class="active">Cashiers</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				@include('includes.all')
				{{-- <p><a href="{{ route('admin.add.cashier') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Cashiers</a></p> --}}

				<p><button class="btn btn-primary" data-toggle="modal" data-target="#addCashier"><i class="fa fa-plus"></i> Add Cashier</button></p>
				@include('admin.includes.modal-cashier-add')

				@if(count($cashiers) > 0)
				<div class="box box-primary">
					<div class="box-header with-border">
						<strong><i class="fa fa-users"></i> Cashiers</strong>
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
								@foreach($cashiers as $c)
								<tr>
									<td>{{ $c->username }}</td>
									<td>
										{{ ucwords($c->firstname . ' ' . $c->lastname) }}
										{{ strtoupper($c->suffix_name) }}
									</td>
									<td class="text-center">
										{{-- <a href="{{ route('admin.update.cashier', ['id' => $c->id]) }}" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil"></span> Update</a> --}}
										
										<button class="btn btn-default btn-xs" data-toggle="modal" data-target="#cashierResetPass-{{ $c->id }}"><i class="fa fa-key"></i> Reset Password</button>

										<button class="btn btn-default btn-xs" data-toggle="modal" data-target="#updateCashier-{{ $c->id }}"><i class="fa fa-pencil"></i> Update</button>
									</td>
								</tr>
								@include('admin.includes.modal-cashier-reset-password')
								@include('admin.includes.modal-cashier-update')
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
				<p class="text-center">No Cashier Available</p>
				@endif
			</div>
		</div>
	</section>
</div>
@endsection
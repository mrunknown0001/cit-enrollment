@extends('layouts.admin-layout')

@section('title') Strands @endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Strands</h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0)"><i class="fa fa-book"></i> Home</a></li>
			<li class="active">Strands</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				@include('includes.all')
				

				<p><button class="btn btn-danger" data-toggle="modal" data-target="#addStrand"><i class="fa fa-plus"></i> Add Strand</button></p>
				@include('admin.includes.modal-strand-add')

				@if(count($strands) > 0)
				<div class="box box-danger">
					<div class="box-header with-border">
						<strong><i class="fa fa-users"></i> Strands</strong>
					</div>
					<div class="box-body">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center">Strand</th>
									<th class="text-center">Code</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
							<tfoot>
							</tfoot>
						</table>						
					</div>
					<div class="box-footer">
						
					</div>
				</div>


				@else
				<p class="text-center">No Strand Available</p>
				@endif
			</div>
		</div>
	</section>
</div>
@endsection
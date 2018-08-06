@extends('layouts.student-layout')

@section('title') Enrollment @endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Enrollment</h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0)"><i class="fa fa-file-text-o"></i> Home</a></li>
			<li class="active">Enrollment</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				@include('includes.all')
				
				<div class="box box-primary">
					<div class="box-header with-border">
						<strong><i class="fa fa-file-text-o"></i> Enrollment</strong>
					</div>
					<div class="box-body">
						<p>Academic Year: <strong>{{ $ay->from . '-' . $ay->to }}</strong></p>
						<p>Semester: <strong>{{ $sem->name }}</strong></p>
						
						<table class="table table-bordered">
							<thead>
								<tr>
									<th class="text-center">Code</th>
									<th class="text-center">Description</th>
									<th class="text-center">Units</th>
								</tr>
							</thead>
							<tbody>
								@foreach($subjects as $s)
								<tr>
									<td class="text-center">{{ $s->code }}</td>
									<td class="text-center">{{ $s->description }}</td>
									<td class="text-center">{{ $s->units }}</td>
								</tr>
								@endforeach
							</tbody>
							<tfoot></tfoot>
						</table>
						<hr>
						<p>Total Payable: <strong>&#8369; {{ $total_payable }}</strong></p>
					</div>
					<div class="box-footer">
						
					</div>
				</div>

			</div>
		</div>
	</section>
</div>
@endsection
@extends('layouts.registrar-layout')

@section('title') Subjects @endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Subjects</h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0)"><i class="fa fa-book"></i> Home</a></li>
			<li class="active">Subjects</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<p><a href="{{ route('registrar.add.subject') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Subject</a></p>
				@include('includes.all')
				@if(count($subjects) > 0)
				<div class="box box-primary">
					<div class="box-header with-border">
						<strong><i class="fa fa-book"></i> Subjects</strong>
					</div>
					<div class="box-body">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center">Code</th>
									<th class="text-center">Description</th>
									<th class="text-center">Units (Lec|Lab)</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($subjects as $s)
								<tr>
									<td class="text-center">{{ strtoupper($s->code) }}</td>
									<td>{{ ucwords($s->description) }}</td>
									<td class="text-center">{{ $s->units }}{{ $s->lab_units ? '|' . $s->lab_units : '' }}</td>
									<td class="text-center">
										<a href="{{ route('registrar.update.subject', ['id' => $s->id]) }}" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil"></span> Update</a>
									</td>
								</tr>
								@endforeach
							</tbody>
							<tfoot>
							</tfoot>
						</table>	
					</div>
					<div class="box-footer">
						{{ $subjects->links() }}
					</div>
				</div>

				@else
				<p class="text-center">No Subjects Available</p>
				@endif
			</div>
		</div>
	</section>
</div>
<script>

</script>
@endsection
@extends('layouts.admin-layout')

@section('title') Academic Year @endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Academic Year</h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0)"><i class="fa fa-calendar"></i> Home</a></li>
			<li class="active">Academic Year</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				@include('includes.all')
				@if ($errors->has('password'))
					<div class="alert alert-danger text-center top-space">
						<a href="javascript:void(0)" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<b>{{ $errors->first('password') }}</b>
					</div>
		        @endif
				<div class="box box-primary">
					<div class="box-header with-border">
						<strong><i class="fa fa-calendar"></i> Academic Year</strong>
					</div>
					<div class="box-body">
						<div class="row">
							<div class="col-md-6">
								@if(!empty($ay))
									<p>Current Academic Year: <strong>{{ $ay->from . '-' . $ay->to }}</strong></p>
									<p>Semester: <strong>{{ $sem->name }}</strong></p>
									@if($sem->id == 1)
									@include('admin.includes.select-second-semester')
									@elseif($sem->id == 2)
									@include('admin.includes.select-summer')
									@else
									@include('admin.includes.close-academic-year')
									@endif
								@else
									@include('admin.includes.academic-year-add')
								@endif
							</div>
						</div>
					</div>
					<div class="box-footer">
						
					</div>
				</div>
			</div>
			<div class="col-md-6">
				@if(count($ays) > 0)
				<table class="table table-bordered table-hover table-striped">
					<thead>
						<tr>
							<th class="text-center">From</th>
							<th class="text-center">To</th>
						</tr>
					</thead>
					<tbody>
						@foreach($ays as $a)
						<tr>
							<td class="text-center">{{ $a->from }}</td>
							<td class="text-center">{{ $a->to }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				<p>{{ $ays->links() }}</p>
				@endif
			</div>
		</div>
	</section>
</div>
@endsection
@extends('layouts.registrar-layout')

@section('title') Students @endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Students</h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0)"><i class="fa fa-graduation-cap"></i> Home</a></li>
			<li class="active">Students</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				@include('includes.all')
				<p><a href="{{ route('registrar.add.student') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Student</a></p>

				<div class="row">
					<div class="col-md-4">
						<form action="#" method="get" class="" autocomplete="off">
							<div class="input-group">
								<input type="text" name="q" class="form-control" placeholder="Search...">
								<span class="input-group-btn">
									<button type="submit" name="search" id="search-btn" class="btn btn-flat btn-primary"><i class="fa fa-search"></i>
								</button>
								</span>
							</div>
						</form>						
					</div>
				</div>
				<p></p>

				@if(count($students) > 0)


				<div class="box box-primary">
					<div class="box-header with-border">
						<strong><i class="fa fa-graduation-cap"></i> Students List</strong>
					</div>
					<div class="box-body">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center">Name</th>
									<th class="text-center">Student Number</th>
									<td class="text-center">Registered</td>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($students as $s)
									<tr>
										<td>{{ ucwords($s->lastname . ', ' . $s->firstname) }}</td>
										<td>{{ $s->student_number }}</td>
										<td>
											@if($s->registered == 1)
												YES
											@else
												NO
											@endif
										</td>
										<td class="text-center">
											<a href="{{ route('registrar.update.student', ['id' => $s->id]) }}" class="btn btn-default btn-xs"><i class="fa fa-pencil"></i> Update</a>
										</td>
									</tr>
								@endforeach
							</tbody>
							<tfoot>
							</tfoot>
						</table>
					</div>
					<div class="box-footer">
						{{ $students->links() }}
					</div>
				</div>
				@else
				<p class="text-center">No Students</p>
				@endif
			</div>
		</div>
	</section>
</div>
@endsection
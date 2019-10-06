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
				<p>
					<a href="{{ route('registrar.add.student') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Student</a>
					<button class="btn btn-primary" data-toggle="modal" data-target="#generateReport"><i class="fa fa-bar-chart"></i> Generate Report</button>
				</p>

				<div class="row">
					<div class="col-md-4">
						<form action="{{ route('registrar.search.student') }}" method="get" class="" autocomplete="off">
							<div class="input-group">
								<input type="text" name="q" class="form-control" placeholder="Search...">
								<span class="input-group-btn">
									<button type="submit" id="search-btn" class="btn btn-flat btn-primary"><i class="fa fa-search"></i>
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
									<th class="text-center">Registered</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($students as $s)
									<tr>
										<td>
											{{ ucwords($s->lastname . ', ' . $s->firstname) }}
											@if(!enpty($s->enrolled_now))
											<small>[Enrolled]</small>
											@else
											<small>[Not Enrolled]</small>
											@endif
										</td>
										<td class="text-center">{{ $s->student_number }}</td>
										<td class="text-center">
											@if($s->registered == 1)
												YES
											@else
												NO
											@endif
										</td>
										<td class="text-center">
											<a href="{{ route('registrar.stuent.view.data.print', ['id' => $s->id]) }}" class="btn btn-default btn-xs" target="_blank"><i class="fa fa-print"></i>Print</a>
											<a href="{{ route('registrar.current.subjects', ['id' => $s->id]) }}" class="btn btn-default btn-xs"><i class="fa fa-book"></i> Subjects</a>
											<a href="{{ route('registrar.student.personal.info', ['id' => $s->id]) }}" class="btn btn-default btn-xs"><i class="fa fa-eye"></i> View Info</a>
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
@include('registrar.includes.modal-report-generate')
@endsection
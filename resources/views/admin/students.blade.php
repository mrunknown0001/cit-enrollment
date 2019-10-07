@extends('layouts.admin-layout')

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

				<div class="row">
					<div class="col-md-4">
						<form action="{{ route('admin.students.search') }}" method="get" class="" autocomplete="off">
							{{ csrf_field() }}
							<div class="input-group">
								<input type="text" name="q" class="form-control" placeholder="Search...">
								<span class="input-group-btn">
									<button type="submit" id="search-btn" class="btn btn-flat btn-danger"><i class="fa fa-search"></i>
								</button>
								</span>
							</div>
						</form>						
					</div>
					<div class="col-md-3">
						<button class="btn btn-danger" data-toggle="modal" data-target="#setLimit">Set Student Limit Per Class</button>
						@include('admin.includes.modal-student-set-limit')
					</div>
				</div>
				<p></p>

				@if(count($students) > 0)


				<div class="box box-danger">
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
										<td>{{ ucwords($s->lastname . ', ' . $s->firstname) }}</td>
										<td class="text-center">{{ $s->student_number }}</td>
										<td class="text-center">
											@if($s->registered == 1)
												YES
											@else
												NO
											@endif
										</td>
										<td class="text-center">
											{{-- <button class="btn btn-default btn-xs" data-toggle="modal" data-target="#studentProfile-{{ $s->id }}"><i class="fa fa-eye"></i> View</button> --}}
											<a href="{{ route('admin.student.personal.info', ['id' => $s->id]) }}" class="btn btn-default btn-xs"><i class="fa fa-eye"></i> View</a>
											<button class="btn btn-default btn-xs" data-toggle="modal" data-target="#studentResetPass-{{ $s->id }}"><i class="fa fa-key"></i> Reset Password</button>
										</td>
									</tr>
									@include('admin.includes.view-student-info')
									@include('admin.includes.reset-student-password')
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
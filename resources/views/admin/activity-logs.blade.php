@extends('layouts.admin-layout')

@section('title') Activity Logs @endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Activity Logs</h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0)"><i class="fa fa-history"></i> Home</a></li>
			<li class="active">Activity Logs</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				@include('includes.all')

				@if(count($logs) > 0)
					<div class="box box-primary">
						<div class="box-header">
							<strong><i class="fa fa-history"></i> Activity Logs</strong>
						</div>
						<div class="box-body">
							<table class="table table-hover">
								<thead>
									<tr>
										<th>Name</th>
										<th>User Type</th>
										<th>Action</th>
										<th>Date &amp; Time</th>
									</tr>
								</thead>
								<tbody>
									@foreach($logs as $log)
									<tr>
										<td>
											@if($log->user_type == 1)
				                            {{ ucwords($log->admin->firstname . ' ' . $log->admin->lastname) }}
				                            @elseif($log->user_type == 2)
				                            {{ ucwords($log->dean->firstname . ' ' . $log->dean->lastname) }}
				                            @elseif($log->user_type == 3)
				                            {{ ucwords($log->registrar->firstname . ' ' . $log->registrar->lastname) }}
				                            @elseif($log->user_type == 4)
				                            {{ ucwords($log->cashier->firstname . ' ' . $log->cashier->lastname) }}
				                            @elseif($log->user_type == 5)
				                            {{ ucwords($log->faculty->firstname . ' ' . $log->faculty->lastname) }}
				                            @elseif($log->user_type == 6)
				                            {{ ucwords($log->student->firstname . ' ' . $log->student->lastname) }}
				                            @else
				                            N/A
				                            @endif
										</td>
										<td>
											@if($log->user_type == 1)
				                            Administrator
				                            @elseif($log->user_type == 2)
				                            Dean
				                            @elseif($log->user_type == 3)
				                            Registrar
				                            @elseif($log->user_type == 4)
				                            Cashier
				                            @elseif($log->user_type == 5)
				                            Faculty
				                            @elseif($log->user_type == 6)
				                            Student
				                            @else
				                            N/A
				                            @endif
										</td>
										<td>
											{{ ucwords($log->action) }}
										</td>
										<td>
											{{ date('l, F j, Y g:i:s a', strtotime($log->created_at)) }}
										</td>
									</tr>
									@endforeach
								</tbody>
								<tfoot>
									
								</tfoot>
							</table>
						</div>
						<div class="box-footer">
							{{ $logs->links() }}
						</div>
					</div>
				@else
					<p class="text-center">No Activity Logs</p>
				@endif
			</div>
		</div>
	</section>
</div>
@endsection
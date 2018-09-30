
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Activity Logs Print</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"><!-- 
  <link rel="stylesheet"  href="{{ asset('adminlte/css/AdminLTE.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/css/skins/skin-blue-light.min.css') }}"> -->
  <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <script src="{{ asset('js/app.js') }}"></script>
  <style type="text/css">
    .vertical-center {
      margin-top: 100px !important;
    }
  </style>
</head>
<body>
	<div class="content-wrapper">
		<section class="content">
			<div class="row">
				<div class="col-md-12">
					@if(count($logs) > 0)
						<div class="box box-primary">
							<div class="box-header">
								<!-- <strong><i class="fa fa-history"></i> Activity Logs</strong> -->
								<h3>Activity Logs</h3>
							</div>
							<div class="box-body">
								<table class="table table-hover table-bordered table-striped">
									<thead>
										<tr>
											<th class="text-center">Name</th>
											<th class="text-center">User Type</th>
											<th class="text-center">Action</th>
											<th class="text-center">Client IP</th>
											<th class="text-center">Date &amp; Time</th>
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
											<td class="text-center">
												{{ $log->ip_address }}
											</td>
											<td>
												{{-- date('l, F j, Y g:i:s a', strtotime($log->created_at)) --}}
												{{ date('l, F j, Y g:i:s a', $log->date_time) }}
											</td>
										</tr>
										@endforeach
									</tbody>
									<tfoot>
										
									</tfoot>
								</table>
							</div>
						</div>
					@else
						<p class="text-center">No Activity Logs</p>
					@endif
				</div>
			</div>
		</section>
	</div>
<script type="text/javascript">
	$( document ).ready(function() {
	    window.print();
	});
</script>
</body>
</html>



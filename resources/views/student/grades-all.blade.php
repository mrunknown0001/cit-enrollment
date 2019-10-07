@extends('layouts.student-layout')

@section('title') My Grades @endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>My Grades</h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0)"><i class="fa fa-file-o"></i> Home</a></li>
			<li class="active">Grades</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<p>
					<a href="{{ route('student.grades') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Back to Current Grades</a>
				</p>
				@include('includes.all')

				@if(count($grades) > 0)
					<p><i>All Available Grades.</i></p>
					{{--<form>
						<div class="form-group">
							<select id="semester">
								<option value="">Select Semesters Taken</option>
								@foreach($semesters as $s)
								<option value="{{ $s->id }}">{{ $s->ay->from . '-' . $s->ay->to . ' ' . $s->semester->name }}</option>
								@endforeach
							</select>
						</div>
					</form>--}}
					
					<div class="row">
						<div class="col-md-6">
							<table class="table table-bordered table-striped">
								<thead>
									<tr>
										<th class="text-center">Subject Code</th>
										<th class="text-center">Grades</th>
									</tr>
								</thead>
								<tbody>
									@foreach($grades as $g)
										<tr>
											<td class="text-center">
												{{ $g->subject->code }}
											</td>
											<td class="text-center">{{ $g->grade }}</td>
										</tr>
									@endforeach
								</tbody>
							</table>							
						</div>
					</div>




				@else
					<p class="text-center">No Grades Found!</p>
				@endif


			</div>
		</div>
	</section>
</div>
@endsection
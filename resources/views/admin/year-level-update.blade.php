@extends('layouts.admin-layout')

@section('title') Year Level @endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Update Year Level</h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0)"><i class="fa fa-bars"></i> Home</a></li>
			<li class="active">Year Level</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<p><a href="{{ route('admin.year.level') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back to Year Level</a></p>
				@include('includes.all')
				<div class="box box-primary">
					<div class="box-header with-border">
						<strong><i class="fa fa-book"></i> Update Year Level</strong>
					</div>
					<div class="box-body">
						<form action="{{ route('admin.update.year.level.post') }}" method="POST" role="form" autocomplete="off">
							{{ csrf_field() }}
							<input type="hidden" name="yl_id" value="{{ $yl->id }}">
							<div class="row">
								<div class="col-md-6">
							      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
							      	<label for="name">Year Level Name</label>
							        <input id="name" type="text" class="form-control" name="name" value="{{ $yl->name }}" placeholder="Enter Year Level Name" >
							        @if ($errors->has('name'))
							            <span class="help-block">
							                <strong>{{ $errors->first('name') }}</strong>
							            </span>
							        @endif
							      </div>
								</div>
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Update Year Level</button>
							</div>
						</form>
					</div>
					<div class="box-footer">
						
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
@endsection
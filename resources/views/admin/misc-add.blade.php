@extends('layouts.admin-layout')

@section('title') Unit Price and Miscellaneous @endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Add Miscellaneous Fee</h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0)"><i class="fa fa-rub"></i> Home</a></li>
			<li class="active">Unit Price and Miscellaneous</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<p><a href="{{ route('admin.unit.price.misc') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back to Unit Price and Miscellaneous</a></p>
				@include('includes.all')
				<div class="box box-primary">
					<div class="box-header with-border">
						<strong><i class="fa fa-rub"></i> Add Miscellaneous Fee</strong>
					</div>
					<div class="box-body">
						<div class="row">
							<div class="col-md-6">
								<form action="{{ route('admin.add.misc.fee.post') }}" method="POST" autocomplete="off">
									{{ csrf_field() }}
								      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
								      	<label for="name">Miscellaneous Fee Name</label><label class="label-required">*</label>
								        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Enter Miscellaneous Fee Name" autofocus>
								        @if ($errors->has('name'))
								            <span class="help-block">
								                <strong>{{ $errors->first('name') }}</strong>
								            </span>
								        @endif
								      </div>
								      <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
								      	<label for="amount">Miscellaneous Fee Amount</label><label class="label-required">*</label>
								        <input id="amount" type="number" class="form-control" name="amount" value="{{ old('amount') }}" placeholder="Enter Miscellaneous Fee Amount">
								        @if ($errors->has('amount'))
								            <span class="help-block">
								                <strong>{{ $errors->first('amount') }}</strong>
								            </span>
								        @endif
								      </div>
								      <div class="form-group">
								      	<button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Save Miscellaneous Fee</button>
								      </div>
								</form>
							</div>
						</div>
					</div>
					<div class="box-footer">
						
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
@endsection
@extends('layouts.admin-layout')

@section('title') Unit Price and Miscellaneous @endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Update Unit Price</h1>
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
						<strong><i class="fa fa-rub"></i> Update Unit Price</strong>
					</div>
					<div class="box-body">
						<div class="row">
							<div class="col-md-6">
								<form action="{{ route('admin.update.unit.price.post') }}" method="POST" autocomplete="off">
									{{ csrf_field() }}
								      <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
								      	<label for="amount">Miscellaneous Fee Amount</label><label class="label-required">*</label>
								        <input id="amount" type="number" class="form-control" name="amount" value="{{ $price->amount }}" placeholder="Enter Miscellaneous Fee Amount">
								        @if ($errors->has('amount'))
								            <span class="help-block">
								                <strong>{{ $errors->first('amount') }}</strong>
								            </span>
								        @endif
								      </div>
								      <div class="form-group">
								      	<button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Update Unit Price</button>
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
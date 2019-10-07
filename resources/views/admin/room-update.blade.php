@extends('layouts.admin-layout')

@section('title') Rooms @endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Update Room</h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0)"><i class="fa fa-building"></i> Home</a></li>
			<li class="active">Rooms</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<p><a href="#" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Back to Rooms</a></p>
				@include('includes.all')
				<div class="box box-danger">
					<div class="box-header with-border">
						<strong><i class="fa fa-building"></i> Update Room</strong>
					</div>
					<div class="box-body">
						<p><em>Field with red asterisk (<label class="label-required">*</label>) are required fields.</em></p>
						<div class="row">
							<div class="col-md-6">
								<form action="{{ route('admin.update.room.post') }}" method="POST" autocomplete="off">
									{{ csrf_field() }}
									<input type="hidden" name="room_id" value="{{ $room->id }}">
									<div class="form-group{{ $errors->has('room_name') ? ' has-error' : '' }}">
								      	<label for="room_name">Room Name</label><label class="label-required">*</label>
								        <input id="room_name" type="text" class="form-control" name="room_name" value="{{ $room->name }}" placeholder="Enter Room Name" autofocus>
								        @if ($errors->has('room_name'))
								            <span class="help-block">
								                <strong>{{ $errors->first('room_name') }}</strong>
								            </span>
								        @endif
							        </div>
									<div class="form-group{{ $errors->has('room_number') ? ' has-error' : '' }}">
								      	<label for="room_number">Room Number</label><label class="label-required">*</label>
								        <input id="room_number" type="text" class="form-control" name="room_number" value="{{ $room->number }}" placeholder="Enter Room Number" autofocus>
								        @if ($errors->has('room_number'))
								            <span class="help-block">
								                <strong>{{ $errors->first('room_number') }}</strong>
								            </span>
								        @endif
							      </div>
							      <div class="form-group">
							      	<button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> Update Room</button>
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
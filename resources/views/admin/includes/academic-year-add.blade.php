<form action="{{ route('admin.add.academic.year') }}" method="POST">
	{{ csrf_field() }}
	<div class="row">
		<div class="col-md-6">
			<div class="form-group{{ $errors->has('start_year') ? ' has-error' : '' }}">
				<label for="start_year">Select Start Year</label>
				<select name="start_year" id="start_year" class="form-control">
					<option value="">Select Start Year</option>
					<option value="{{ date('Y') }}">{{ date('Y') }}</option>
				</select>
				@if ($errors->has('start_year'))
		            <span class="help-block">
		                <strong>{{ $errors->first('start_year') }}</strong>
		            </span>
		        @endif
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group{{ $errors->has('end_year') ? ' has-error' : '' }}">
				<label for="end_year">Select End Year</label>
				<select name="end_year" id="end_year" class="form-control">
					<option value="">Select End Year</option>
					<option value="{{ date('Y') + 1 }}">{{ date('Y') + 1 }}</option>
				</select>
				@if ($errors->has('end_year'))
		            <span class="help-block">
		                <strong>{{ $errors->first('end_year') }}</strong>
		            </span>
		        @endif
			</div>
		</div>
	</div>
	<div class="form-group">
		<button type="submit" class="btn btn-primary">Add School Year</button>
	</div>
</form>
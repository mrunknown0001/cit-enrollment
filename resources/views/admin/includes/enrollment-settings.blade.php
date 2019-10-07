@if($es->active == 1)
	<p class="text-center">Enrollment is <span class="label bg-green">ENABLED</span> <button type="button" class="btn btn-link" data-toggle="modal" data-target="#semesterModal">Disable Enrollment</button></p>

  <div class="modal fade" id="semesterModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <strong>Disable Enrollment</strong>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
  		<p>Please Enter password to Disable Enrollment and click Disable Enrollment button</p>
  		<form action="{{ route('admin.disable.enrollment') }}" method="POST">
          	{{ csrf_field() }}
          	<div class="form-group">
          		<input type="password" name="password" class="form-control" placeholder="Enter Password" required="">
          	</div>
        </div>
        <div class="modal-footer">
  			<button type="submit" class="btn btn-danger">Disable Enrollment</button>
  		</form>
        </div>
      </div>
    </div>
  </div>
@else
	<p class="text-center">Enrollment is <span class="label bg-red">DISABLED</span> <button type="button" class="btn btn-link" data-toggle="modal" data-target="#semesterModal">Enable Enrollment</button></p>

  <div class="modal fade" id="semesterModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <strong>Enable Enrollment</strong>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
  		<p>Please Enter password to Enable Enrollment and click Enable Enrollment button</p>
  		<form action="{{ route('admin.enable.enrollment') }}" method="POST">
          	{{ csrf_field() }}
          	<div class="form-group">
          		<input type="password" name="password" class="form-control" placeholder="Enter Password" required="">
          	</div>
        </div>
        <div class="modal-footer">
  			<button type="submit" class="btn btn-danger">Enable Enrollment</button>
  		</form>
        </div>
      </div>
    </div>
  </div>
@endif
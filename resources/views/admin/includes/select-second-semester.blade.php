<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#semesterModal">
  Activate Second Semester
</button>

<div class="modal fade" id="semesterModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <strong>Select Second Semester</strong>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<p>Please Enter password activate Second Semester and click Activate Second Semester</p>
		<form action="{{ route('admin.select.second.semester.post') }}" method="POST">
        	{{ csrf_field() }}
        	<div class="form-group">
        		<input type="password" name="password" class="form-control" placeholder="Enter Password" required="">
        	</div>
      </div>
      <div class="modal-footer">
			<button type="submit" class="btn btn-primary">Activate Second Semester</button>
		</form>
      </div>
    </div>
  </div>
</div>
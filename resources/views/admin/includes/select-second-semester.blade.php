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
		<p>Click button below to activate Second Semester</p>
      </div>
      <div class="modal-footer">
        <form action="{{ route('admin.select.second.semester') }}" method="GET">
        	{{ csrf_field() }}
			<button type="submit" class="btn btn-primary">Activate Second Semester</button>
		</form>
      </div>
    </div>
  </div>
</div>
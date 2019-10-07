<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#closeay">
  Close Academic Year
</button>

<div class="modal fade" id="closeay" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <strong>Close Academic Year</strong>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		    <p>Please Enter Password to Close Academic Year and click Close Academic Year button</p>
        <form action="{{ route('admin.close.academic.year.post') }}" method="POST">
          {{ csrf_field() }}
          <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="Enter Password" required="">
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger">Close Academic Year</button>
      </form>
      </div>
    </div>
  </div>
</div>
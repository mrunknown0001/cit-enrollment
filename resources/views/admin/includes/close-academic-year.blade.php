<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#closeay">
  Close School Year
</button>

<div class="modal fade" id="closeay" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <strong>Close School Year</strong>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		    <p>Please Enter Password to Close School Year and click Close School Year button</p>
        <form action="{{ route('admin.close.academic.year.post') }}" method="POST">
          {{ csrf_field() }}
          <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="Enter Password" required="">
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger">Close School Year</button>
      </form>
      </div>
    </div>
  </div>
</div>
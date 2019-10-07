<div class="modal fade" id="incrementYearLevel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <strong> Confirmation </strong>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p><strong>Are you sure you want to add year level?</strong></p>


      </div>
      <div class="modal-footer">
        <form action="{{ route('admin.increment.year.level.post') }}" method="POST">
          {{ csrf_field() }}
          <div class="form-group">
            <button class="btn btn-danger"><i class="fa fa-plus"></i> Confirm</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
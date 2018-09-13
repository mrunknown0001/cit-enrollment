<div class="modal fade" id="setLimit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <strong>Set Limit of Student Per Section</strong>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <p>Current Limt: <strong>{{ $limit->limit }}</strong></p>
        <p><em>Field with red asterisk (<label class="label-required">*</label>) are required fields.</em></p>
        <form action="{{ route('admin.student.limit.post') }}" method="POST">
          {{ csrf_field() }}
          <div class="form-group">
            <label>Student Limit</label>
            <input type="number" name="limit" id="limit" value="{{ $limit->limit }}" class="form-control" placeholder="Enter Student Limit">
          </div>
          <div class="form-group">
            <button class="btn btn-primary"><i class="fa fa-floppy-o"></i> Save</button>
          </div>
        </form>


      </div>
      <div class="modal-footer">
        Student Limit
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="updateYearLevel-{{ $y->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <strong>Update Year Level</strong>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

            <p><em>Field with red asterisk (<label class="label-required">*</label>) are required fields.</em></p>
            <form action="{{ route('admin.update.year.level.post') }}" method="POST" role="form" autocomplete="off">
              {{ csrf_field() }}
              <input type="hidden" name="yl_id" value="{{ $y->id }}">
              <div class="row">
                <div class="col-md-12">
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                      <label for="name">Year Level Name</label>
                      <input id="name" type="text" class="form-control" name="name" value="{{ $y->name }}" placeholder="Enter Year Level Name" >
                      @if ($errors->has('name'))
                          <span class="help-block">
                              <strong>{{ $errors->first('name') }}</strong>
                          </span>
                      @endif
                    </div>
                </div>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Update Year Level</button>
              </div>
            </form>


      </div>
      <div class="modal-footer">
        Update Year Level Form
      </div>
    </div>
  </div>
</div>
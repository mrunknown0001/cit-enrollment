<div class="modal fade" id="updateCourse-{{ $c->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <strong>Update Course</strong>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


            <p><em>Field with red asterisk (<label class="label-required">*</label>) are required fields.</em></p>
            <form action="{{ route('admin.update.course.post') }}" method="POST" role="form" autocomplete="off">
              {{ csrf_field() }}
              <input type="hidden" name="course_id" value="{{ $c->id }}">
              <div class="row">
                <div class="col-md-12">
                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                      <label for="title">Course Title</label><label class="label-required">*</label>
                      <input id="title" type="text" class="form-control" name="title" value="{{ $c->title }}" placeholder="Enter Course Title" >
                      @if ($errors->has('title'))
                          <span class="help-block">
                              <strong>{{ $errors->first('title') }}</strong>
                          </span>
                      @endif
                    </div>
                    <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                      <label for="title">Course Code</label><label class="label-required">*</label>
                      <input id="code" type="text" class="form-control" name="code" value="{{ $c->code }}" placeholder="Enter Course Code" >
                      @if ($errors->has('code'))
                          <span class="help-block">
                              <strong>{{ $errors->first('code') }}</strong>
                          </span>
                      @endif
                    </div>
                </div>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Save</button>
              </div>
            </form>


      </div>
      <div class="modal-footer">
        Update Course Form
      </div>
    </div>
  </div>
</div>
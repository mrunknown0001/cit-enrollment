<div class="modal fade" id="addFacultyLoad" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <strong>Add Faculty Load</strong>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @if(count($subjects) > 0)
            <p><em>Field with red asterisk (<label class="label-required">*</label>) are required fields.</em></p>
            <form action="{{ route('admin.add.faculty.load.post') }}" method="POST" role="form" autocomplete="off">
              {{ csrf_field() }}
              <div class="row">
                <div class="col-md-12">
                    <div class="form-group{{ $errors->has('faculty') ? ' has-error' : '' }}">
                      <label for="faculty">Faculty</label><label class="label-required">*</label>
                      <select class="form-control" name="faculty" id="faculty" required="">
                        <option value="">Please Select Faculty</option>
                        @if(count($faculties) > 0)
                          @foreach($faculties as $f)
                            <option value="{{ $f->id }}">{{ ucwords($f->lastname . ', ' . $f->firstname) }}</option>
                          @endforeach
                        @endif
                      </select>
                      @if ($errors->has('faculties'))
                          <span class="help-block">
                              <strong>{{ $errors->first('faculties') }}</strong>
                          </span>
                      @endif
                    </div>
                    <div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
                      <label for="subject">Subject</label><label class="label-required">*</label>
                      <select class="form-control" name="subject" id="subject" required="">
                        <option value="">Please Select Subject</option>
                        @if(count($subjects) > 0)
                          @foreach($subjects as $s)
                            <option value="{{ $s->id }}">{{ $s->code }}</option>
                          @endforeach
                        @endif
                      </select>
                      @if ($errors->has('subject'))
                          <span class="help-block">
                              <strong>{{ $errors->first('subject') }}</strong>
                          </span>
                      @endif
                    </div>
                </div>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add Faculty Load</button>
              </div>
            </form>
        @else
          <p class="text-center">No Semester Selected</p>
        @endif
      </div>
      <div class="modal-footer">
        Add Faculty Load Form
      </div>
    </div>
  </div>
</div>
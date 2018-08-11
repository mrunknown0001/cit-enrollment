<div class="modal fade" id="addCurriculum" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <strong>Add Course Curriculum</strong>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


            <p><em>Field with red asterisk (<label class="label-required">*</label>) are required fields.</em></p>
            <form action="{{ route('admin.add.curriculum.post') }}" method="POST" role="form" autocomplete="off">
              {{ csrf_field() }}
              <div class="row">
                <div class="col-md-12">
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                      <label for="name">Curriculum Name</label><label class="label-required">*</label>
                      <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Enter Curriculum Name" >
                      @if ($errors->has('name'))
                          <span class="help-block">
                              <strong>{{ $errors->first('name') }}</strong>
                          </span>
                      @endif
                    </div>
                    <div class="form-group{{ $errors->has('course') ? ' has-error' : '' }}">
                      <label for="course">Select Course</label><label class="label-required">*</label>
                      <select id="course" name="course" class="form-control course">
                        <option value="">Select Course</option>
                    @if(count($courses) > 0)
                      @foreach($courses as $co)
                        <option value="{{ $co->id }}">{{ $co->code }}</option>
                      @endforeach
                    @else
                    <option value="">No Available Course</option>
                    @endif
                      </select>
                      @if ($errors->has('course'))
                          <span class="help-block">
                              <strong>{{ $errors->first('course') }}</strong>
                          </span>
                      @endif
                    </div>
                    <div class="form-group{{ $errors->has('major') ? ' has-error' : '' }}">
                      <label for="major">Select Course Major</label>
                      <select id="major" name="major" class="form-control major">
                        <option value="">No Course Major</option>

                      </select>
                      @if ($errors->has('major'))
                          <span class="help-block">
                              <strong>{{ $errors->first('major') }}</strong>
                          </span>
                      @endif
                    </div>
                </div>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add Curriculum</button>
              </div>
            </form>


      </div>
      <div class="modal-footer">
        Add Course Curriculum Form
      </div>
    </div>
  </div>
</div>
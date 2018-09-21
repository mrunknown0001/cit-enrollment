<div class="modal fade" id="addMajor" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <strong>Add Course Major</strong>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


            <p><em>Field with red asterisk (<label class="label-required">*</label>) are required fields.</em></p>
            <form action="{{ route('admin.add.course.major.post') }}" method="POST" role="form" autocomplete="off">
              {{ csrf_field() }}
              <div class="row">
                <div class="col-md-12">
                    <div class="form-group{{ $errors->has('course') ? ' has-error' : '' }}">
                      <label for="course">Select Course</label><label class="label-required">*</label>
                      <select name="course" id="course" class="form-control">
                        <option value="">Select Course</option>
                    @foreach($courses as $c)
                    <option value="{{ $c->id }}">{{ ucwords($c->title) }}</option>
                    @endforeach
                      </select>
                      @if ($errors->has('course'))
                          <span class="help-block">
                              <strong>{{ $errors->first('course') }}</strong>
                          </span>
                      @endif
                    </div>
                    <div class="form-group{{ $errors->has('major_name') ? ' has-error' : '' }}">
                      <label for="major_name">Major Name</label><label class="label-required">*</label>
                      <input id="major_name" type="text" class="form-control" name="major_name" value="{{ old('major_name') }}" placeholder="Enter Course Code" >
                      @if ($errors->has('major_name'))
                          <span class="help-block">
                              <strong>{{ $errors->first('major_name') }}</strong>
                          </span>
                      @endif
                    </div>
                </div>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add Course Major</button>
              </div>
            </form>


      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>
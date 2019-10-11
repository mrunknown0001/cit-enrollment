<div class="modal fade" id="addSchoolCalendar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <strong>Add School Calendar</strong>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


        <p><em>Field with red asterisk (<label class="label-required">*</label>) are required fields.</em></p>
        <form action="{{ route('admin.school.calendar.add.post') }}" method="POST" role="form" autocomplete="off">
          {{ csrf_field() }}
          <div class="row">
            <div class="col-md-6">
                <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                  <label for="title">Title</label><label class="label-required">*</label>
                  <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="Enter Strand" autofocus required>
                  @if ($errors->has('title'))
                      <span class="help-block">
                          <strong>{{ $errors->first('title') }}</strong>
                      </span>
                  @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                  <label for="date">Date</label><label class="label-required">*</label>
                  <input id="date" type="date" class="form-control" name="date" value="{{ old('date') }}" placeholder="" required>
                  @if ($errors->has('date'))
                      <span class="help-block">
                          <strong>{{ $errors->first('date') }}</strong>
                      </span>
                  @endif
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                  <label for="description">Description</label>
                  <input id="description" type="text" class="form-control" name="description" value="{{ old('description') }}" placeholder="Enter Description" >
                  @if ($errors->has('description'))
                      <span class="help-block">
                          <strong>{{ $errors->first('description') }}</strong>
                      </span>
                  @endif
                </div>
            </div>
            
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-danger"><i class="fa fa-plus"></i> Add School Calendar</button>
          </div>
        </form>


      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>
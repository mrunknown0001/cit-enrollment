<div class="modal fade" id="addDean" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <strong>Add Principal</strong>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


        <p><em>Field with red asterisk (<label class="label-required">*</label>) are required fields.</em></p>
        <form action="{{ route('admin.add.dean.post') }}" method="POST" role="form" autocomplete="off">
          {{ csrf_field() }}
          <div class="row">
            <div class="col-md-6">
                <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                  <label for="firstname">Firstname</label><label class="label-required">*</label>
                  <input id="firstname" type="text" class="form-control" name="firstname" value="{{ old('firstname') }}" placeholder="Enter Firstname" autofocus>
                  @if ($errors->has('firstname'))
                      <span class="help-block">
                          <strong>{{ $errors->first('firstname') }}</strong>
                      </span>
                  @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group{{ $errors->has('middlename') ? ' has-error' : '' }}">
                  <label for="middlename">Middlename</label>
                  <input id="middlename" type="text" class="form-control" name="middlename" value="{{ old('middlename') }}" placeholder="Enter Middlename" >
                  @if ($errors->has('middlename'))
                      <span class="help-block">
                          <strong>{{ $errors->first('middlename') }}</strong>
                      </span>
                  @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                  <label for="lastname">Lastname</label><label class="label-required">*</label>
                  <input id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" placeholder="Enter Lastname" >
                  @if ($errors->has('lastname'))
                      <span class="help-block">
                          <strong>{{ $errors->first('lastname') }}</strong>
                      </span>
                  @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group{{ $errors->has('suffix_name') ? ' has-error' : '' }}">
                  <label for="suffix_name">Suffix</label>
                  <input id="suffix_name" type="text" class="form-control" name="suffix_name" value="{{ old('suffix_name') }}" placeholder="Enter Suffix Name" >
                  @if ($errors->has('suffix_name'))
                      <span class="help-block">
                          <strong>{{ $errors->first('suffix_name') }}</strong>
                      </span>
                  @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                  <label for="username">Username</label><label class="label-required">*</label>
                  <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Enter Username" autofocus>
                  @if ($errors->has('username'))
                      <span class="help-block">
                          <strong>{{ $errors->first('username') }}</strong>
                      </span>
                  @endif
                </div>
            </div>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-danger"><i class="fa fa-plus"></i> Add Principal</button>
          </div>
        </form>


      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>
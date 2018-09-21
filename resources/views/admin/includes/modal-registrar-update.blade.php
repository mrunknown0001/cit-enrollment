<div class="modal fade" id="updateRegistrar-{{ $r->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <strong>Update Registrar</strong>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


            <p><em>Field with red asterisk (<label class="label-required">*</label>) are required fields.</em></p>
            <form action="{{ route('admin.update.registrar.post') }}" method="POST" role="form" autocomplete="off">
              {{ csrf_field() }}
              <input type="hidden" name="registrar_id" value="{{ $r->id }}">
              <div class="row">
                <div class="col-md-6">
                    <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                      <label for="firstname">Firstname</label><label class="label-required">*</label>
                      <input id="firstname" type="text" class="form-control" name="firstname" value="{{ $r->firstname }}" placeholder="Enter Firstname" autofocus>
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
                      <input id="middlename" type="text" class="form-control" name="middlename" value="{{ $r->middle_name }}" placeholder="Enter Middlename" >
                      @if ($errors->has('middle_name'))
                          <span class="help-block">
                              <strong>{{ $errors->first('middlename') }}</strong>
                          </span>
                      @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                      <label for="lastname">Lastname</label><label class="label-required">*</label>
                      <input id="lastname" type="text" class="form-control" name="lastname" value="{{ $r->lastname }}" placeholder="Enter Lastname" >
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
                      <input id="suffix_name" type="text" class="form-control" name="suffix_name" value="{{ $r->suffix_name }}" placeholder="Enter Suffix Name" >
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
                      <input id="username" type="text" class="form-control" name="username" value="{{ $r->username }}" placeholder="Enter Username" autofocus>
                      @if ($errors->has('username'))
                          <span class="help-block">
                              <strong>{{ $errors->first('username') }}</strong>
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
        
      </div>
    </div>
  </div>
</div>
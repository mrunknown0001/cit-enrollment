<div class="modal fade" id="registrarLogin" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <strong>Registrar Login</strong>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

    <p class="login-box-msg">Online Enrollment for Mayantoc High School</p>
    @include('includes.all')
    <form action="{{ route('registrar.login.post') }}" method="post" autocomplete="off">
      {{ csrf_field() }}

      <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
        <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Enter Username">
        @if ($errors->has('username'))
            <span class="help-block">
                <strong>{{ $errors->first('username') }}</strong>
            </span>
        @endif
      </div>

      <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <input id="password" type="password" class="form-control" name="password" placeholder="Enter Password">
        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
      </div>

      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name="remember_me" id="remember_me" checked=""> Remember Me
            </label>
          </div>
        </div>
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
        </div>
      </div>
    </form>

      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>
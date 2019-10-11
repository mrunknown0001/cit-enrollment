<div class="modal fade" id="studentLogin" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <strong>Student Login</strong>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <p class="login-box-msg text-center">Online Enrollment for Mayantoc High School</p>
      @include('includes.all')
      <form action="{{ route('student.login.post') }}" method="post" autocomplete="off">
        {{ csrf_field() }}
        <div class="form-group{{ $errors->has('student_number') ? ' has-error' : '' }}">
          <input id="username" type="text" class="form-control" name="student_number" value="{{ old('student_number') }}" placeholder="Enter LRN" required>
          @if ($errors->has('student_number'))
              <span class="help-block">
                  <strong>{{ $errors->first('student_number') }}</strong>
              </span>
          @endif
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
          <input id="password" type="password" class="form-control" name="password" placeholder="Enter Password" required>
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
            <button type="submit" class="btn btn-danger btn-block btn-flat">Login</button>
          </div>
        </div>
      </form>
      <a href="{{ route('registration') }}">Click here to register</a>
      &nbsp;
      <a href="{{ route('forgot.password') }}">Forgot Password?</a>

      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="studentRegistration" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <strong>Student Registration</strong>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

    <p class="login-box-msg text-center">Online Enrollment for Mayantoc High School</p>
    @include('includes.all')
    <form action="{{ route('student.show.details.post') }}" method="POST" autocomplete="off">
      {{ csrf_field() }}
      <div class="form-group{{ $errors->has('student_number') ? ' has-error' : '' }}">
        <input id="username" type="text" class="form-control" name="student_number" value="{{ old('student_number') }}" placeholder="Enter LRN">
        @if ($errors->has('student_number'))
            <span class="help-block">
                <strong>{{ $errors->first('student_number') }}</strong>
            </span>
        @endif
      </div>

      <div class="row">
        <div class="col-xs-12">
          <label for="terms"><input type="checkbox" name="terms" id="terms" required checked> By registering to this website, you Agree to <a href="{{ route('terms.and.condition') }}" target="_blank"> Privacy Statement</a> of the the website.</label>
        </div>
        <div class="col-xs-4">
          <button type="submit" class="btn btn-danger btn-block btn-flat">Continue</button>
        </div>
      </div>
    </form>

    <p><a href="{{ route('login') }}">Click here to Login</a></p>


      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>
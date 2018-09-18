
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Student Registration - Online Enrollment for CIT Colleges of Paniqui Foundation Inc.</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet"  href="{{ asset('adminlte/css/AdminLTE.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/css/skins/skin-blue-light.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-box-body">
    <div class="login-logo">
      <a href="javascript:void(0)"><b>Student</b> Registration</a>
    </div>
    <p class="login-box-msg">Online Enrollment for CIT Colleges of Paniqui Foundation Inc.</p>
    @include('includes.all')
    <p>Name: <strong>{{ ucwords($student->firstname . ' ' . $student->lastname) }}</strong></p>
    <p>Student Number: <strong>{{ $student->student_number }}</strong></p>
    <p>If this is you. Please enter Password to Create Account</p>
    <form action="{{ route('registrer.student.post') }}" method="POST" autocomplete="off">
      {{ csrf_field() }}
      <input type="hidden" name="student_id" value="{{ $student->id }}">
      <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <input id="password" type="password" class="form-control" name="password" placeholder="Enter Password" required="">
        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
      </div>
      <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <input id="password" type="password" class="form-control" name="password_confirmation"  placeholder="Confirm Password" required="">
        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
      </div>

      <div class="row">
        <div class="col-xs-12">
          <label for="terms"><input type="checkbox" name="terms" id="terms" required checked> By registering to this website, you Agree to <a href="{{ route('terms.and.condition') }}" target="_blank">Terms and Conditon</a> of the the website.</label>
        </div>
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Continue</button>
        </div>
      </div>
    </form>
    <p><a href="{{ route('registration') }}">Cancel</a></p>
    <p>Already have an account? <a href="{{ route('login') }}">Click here to Login</a></p>
  </div>
</div>
@include('includes.modal-terms-and-condition')
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>

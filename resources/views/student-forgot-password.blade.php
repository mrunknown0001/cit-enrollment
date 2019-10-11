
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Student Login - Online Enrollment for Mayantoc High School</title>
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
      <a href="javascript:void(0)"><b>Student</b><br>Forgot Password</a>
    </div>
    <p class="login-box-msg">Online Enrollment for Mayantoc High School</p>
    @include('includes.all')
    <form action="{{ route('forgot.password.post') }}" method="post" autocomplete="off">
      {{ csrf_field() }}
      <div class="form-group{{ $errors->has('student_number') ? ' has-error' : '' }}">
        <label>Enter LRN</label>
        <input id="student_number" type="text" class="form-control" name="student_number" value="{{ old('student_number') }}" placeholder="Enter LRN" required autofocus>
        @if ($errors->has('student_number'))
            <span class="help-block">
                <strong>{{ $errors->first('student_number') }}</strong>
            </span>
        @endif
      </div>

      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">

          </div>
        </div>
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Continue</button>
        </div>
      </div>
    </form>
    <p><a href="{{ route('registration') }}">Click here to register</a>
    &nbsp;
    <a href="{{ route('landing.page') }}">Go to Landing Page</a></p>
  </div>
</div>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>

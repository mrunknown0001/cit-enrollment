
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
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
  <link rel="stylesheet" type="text/css" href="{{ asset('css/password-strength.css') }}">

  <script src="{{ asset('js/password-strength.js') }}"></script>
  <script src="{{ asset('js/app.js') }}"></script>

  {{--<style type="text/css">
    .bg-danger {
      background-color: red;
    }
    .bg-warning {
      background-color: orange;
    }
    .bg-success {
      background-color: green;
    }
  </style>--}}
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-box-body">
    <div class="login-logo">
      <a href="javascript:void(0)"><b>Student</b> Registration</a>
    </div>
    <p class="login-box-msg">Online Enrollment for CIT Colleges of Paniqui Foundation Inc.</p>
    <p>Name: <strong>{{ ucwords($student->firstname . ' ' . $student->lastname) }}</strong></p>
    <p>Student Number: <strong>{{ $student->student_number }}</strong></p>
    <p>If this is you. Please enter Password to Create Account</p>
    <form action="{{ route('registrer.student.post') }}" method="POST" autocomplete="off">
      {{ csrf_field() }}
      <input type="hidden" name="student_id" value="{{ $student->id }}">
      <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <input id="password" type="password" class="form-control" name="password" placeholder="Enter Password ( Atleast 6 Characters )" required="">
        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
      </div>
      <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation"  placeholder="Confirm Password" required="">
        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
      </div>
      <div class="form-group">
        <div class="progress">
          <div id="jak_pstrength_text" class="progress-bar progress-bar-animated jak_pstrength" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <label for="terms"><input type="checkbox" name="terms" id="terms" required checked> By registering to this website, you Agree to <a href="{{ route('terms.and.condition') }}" target="_blank">Terms and Conditon</a> of the the website.</label>
        </div>
        <div class="col-xs-4">
          <button type="submit" class="btn btn-danger btn-block btn-flat">Continue</button>
        </div>
      </div>
    </form>
    <p><a href="{{ route('registration') }}">Cancel</a></p>
    <p>Already have an account? <a href="{{ route('login') }}">Click here to Login</a></p>
  </div>
</div>

@include('includes.modal-terms-and-condition')




<script type="text/javascript">
  jQuery(document).ready(function(){
    jQuery("#password").keyup(function() {
      passwordStrength(jQuery(this).val());
    });
  });
</script>
</body>
</html>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Principal Login - Online Enrollment for CIT Colleges of Paniqui Foundation Inc.</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet"  href="{{ asset('adminlte/css/AdminLTE.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/css/skins/skin-blue-light.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <script src="{{ asset('js/app.js') }}"></script>
  <style type="text/css">
    .vertical-center {
      margin-top: 100px !important;
    }
  </style>
</head>
<body class="hold-transition login-page">
@include('includes.modal-dean-login')
<script type="text/javascript">
    $(window).on('load',function(){
        $('#deanLogin').modal('show');
    });
</script>

<div class="row">
  <div class="col-md-4 col-md-offset-4 text-center vertical-center">
    <button class="btn btn-danger" id="centerButton" data-toggle="modal" data-target="#deanLogin"><i class="fa fa-key"></i> Principal Login</button>
    <br>
    <a href="{{ route('landing.page') }}" class="btn btn-link">go to landing page</a>
  </div>
</div>
{{-- <div class="login-box">
  <div class="login-box-body">
    <div class="login-logo">
      <a href="javascript:void(0)"><b>Dean</b> Login</a>
    </div>
    <p class="login-box-msg">Online Enrollment for CIT Colleges of Paniqui Foundation Inc.</p>
    @include('includes.all')
    <form action="{{ route('dean.login.post') }}" method="post" autocomplete="off">
      {{ csrf_field() }}
      <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
        <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Enter Username" autofocus>
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
          <button type="submit" class="btn btn-danger btn-block btn-flat">Sign In</button>
        </div>
      </div>
    </form>
  </div>
</div>
--}}
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title') | Principal</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet"  href="{{ asset('adminlte/css/AdminLTE.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/css/skins/skin-red.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
  <script src="{{ asset('js/app.js') }}"></script>
</head>
<body class="hold-transition skin-red sidebar-mini">
<div class="wrapper">
  @include('dean.includes.main-header')
  @include('dean.includes.main-sidebar')
  @yield('content')
  @include('includes.footer')
</div>
<script src="{{ asset('adminlte/js/adminlte.min.js') }}"></script>
@include('includes.timeout')
</body>
</html>

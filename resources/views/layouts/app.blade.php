<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title') | CIT Online Enrollment </title>

        <!--Admin Theme-->
        <link rel="stylesheet"  href="{{ asset('adminlte/css/AdminLTE.min.css') }}">

        <!-- AdminLTE Skin -->
        <link rel="stylesheet" href="{{ asset('adminlte/css/skins/skin-blue-light.min.css') }}">

        <!-- Bootstrap 3.3.7 && Fontawesome -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">

    </head>
    <body class="skin-blue-light">
        @yield('content')
    <script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
    </body>
</html>

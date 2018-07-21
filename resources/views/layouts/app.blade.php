<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title') | {{ env('app_name') }} </title>
        <link rel="stylesheet"  href="{{ asset('adminlte/css/AdminLTE.min.css') }}">
        <link rel="stylesheet" href="{{ asset('adminlte/css/skins/skin-blue-light.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    </head>
    <body class="skin-blue-light">
        @yield('content')
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    </body>
</html>

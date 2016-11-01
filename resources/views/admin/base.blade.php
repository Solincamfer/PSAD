<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'default') | PSAD</title>
    <link rel="stylesheet" href="{{asset('plugins/bootstrap3.3.7/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/font-awesome4.7.0/css/font-awesome.min.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>
    @yield('contenido')
    <script src="{{asset('plugins/bootstrap3.3.7/js/jquery.min.js')}}"></script>
    <script src="{{asset('plugins/bootstrap3.3.7/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/val.js')}}"></script>
</body>
</html>
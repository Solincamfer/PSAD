<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>@yield('title', 'default') | PSAD</title>
        <link rel="stylesheet" href="{{asset('plugins/bootstrap3.3.7/css/bootstrap.min.css')}}">
         <link rel="stylesheet" href="{{asset('css/bootstrapValidator.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/font-awesome4.7.0/css/font-awesome.min.css')}}">
        <link href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/stylesys.css')}}">
        <link rel="shortcut icon" href="{{asset('img/favicon_logo2.png')}}">
        <link rel="stylesheet" href="{{asset('plugins/sweetalert/sweetalert.css')}}">
    </head>
    <body>
        @yield('contenido')
        <script src="{{asset('plugins/bootstrap3.3.7/js/jquery.min.js')}}"></script>
        <script src="{{asset('plugins/bootstrap3.3.7/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('js/bootstrapValidator.js')}}"></script>
        <script src="{{asset('plugins/sweetalert/sweetalert.min.js')}}"></script>
        <script src="{{asset('js/configuraciones.js')}}"></script>
        <script src="{{asset('js/val.js')}}"></script>
        <script src="{{asset('js/AJAX.js')}}"></script>
        <script src="{{asset('js/buscador.js')}}"></script>
        <script src="{{asset('js/botonModificar.js')}}"></script>
        <script src="{{asset('js/botonGuardarMA.js')}}"></script>
        <script src="{{asset('js/vista_planes.js')}}"></script>
        <script src="{{asset('js/movUsuarios.js')}}"></script>
        <script src="{{asset('js/vistaSucursales.js')}}"></script>
        <script src="{{asset('js/sucursalPlanes.js')}}"></script>
        <script src="{{asset('js/respSucursal.js')}}"></script>
        @yield('js')    
    </body>
</html>

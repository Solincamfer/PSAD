@extends('admin.base')
    @section('contenido')
        @section('title')
            Login
        @endsection        
        @include('layout/header')       
            <div class="container">
                <div id="card">
                    <h1 class="title">Panel de Acceso</h1>

<<<<<<< HEAD
                    <form action="/login/verificar" method="POST" id="log" data-toggle="validator">
=======
                    <form action="/login/verificar" method="post" id="log" data-toggle="validator">
>>>>>>> origin/master
                            {{ csrf_field() }}
                            <div class="alert alert-success alert-dismissible fade in" role="alert" id="AccesoTrue"><p>Credenciales correctas.</p>
                            </div>
                            <div class="form-group col-md-6 col-md-offset-3">
                                <label for="user" style="font-size: 20px"><i class="fa fa-user"></i> Usuario:</label>
                                <input type="text" id="user" name="user" class="form-control" required>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group col-md-6 col-md-offset-3">
                                <label for="pwd" style="font-size: 20px"><i class="fa fa-lock"></i> Contraseña:</label>
                                <input type="password" id="pwd" name="pwd" class="form-control" required>
                                <div class="help-block with-errors"></div>
                            </div>
                        
                        <div class="form-group row" id="f2">                            
                            <div class="col-md-2 col-md-offset-8" id="log1">
                                <button type="submit" class="btn btn-success btn-sm" id="login">
                                Iniciar Sesión 
                                <i class="fa fa-sign-in"></i>
                                </button>
                            </div>
                            <div class="col-md-1" id="log2">
                                <button type="reset" class="btn btn-danger btn-sm" id="close">
                                Cancelar 
                                <i class="fa fa-times"></i>
                                </button>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                    </form>
                </div>
            </div>
        @include('layout/footer')
    @endsection
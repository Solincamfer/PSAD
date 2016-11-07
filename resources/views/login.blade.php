@extends('admin.baselog')
    @section('contenido')
        @section('title')
            Login
        @endsection             
            <div class="container">
                <div id="card">
                    <img src="{{asset('img/PSAD_logo1.png')}}" style="margin-left: 40%; width: 250px;">
                    <!--<h1 class="title">Panel de Acceso</h1>-->
                    <form action="login/verificar" method="POST" id="log" data-toggle="validator">
                            {{ csrf_field() }}
                            <div class="alert alert-success alert-dismissible fade in" role="alert" id="AccesoTrue"><p>Credenciales correctas.</p>
                            </div>
                            <div class="form-group col-md-12">
                                <input type="text" id="user" name="user" class="form-control" placeholder="Usuario" required><i class="fa fa-user"></i>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group col-md-12">
                                <input type="password" id="pwd" name="pwd" class="form-control" placeholder="Contraseña" required><i class="fa fa-lock"></i>
                                <div class="help-block with-errors"></div>
                            </div>
                        <div class="form-group container-fluid" id="f2">
                            <div class="col-md-12">
                                   <button type="submit" class="btn" id="log1">
                                       <p>Iniciar Sesión <i class="fa fa-sign-in"></i></p>
                                   </button>
                            </div>
                            <div class="col-md-12">
                                <button type="" id="log2">
                                    <p>Cancelar <i class="fa fa-times"></i></p> 
                                </button>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                    </form>
                    <span></span>
                </div>
            </div>
        @include('layout/footer')
    @endsection
@extends('admin.baselog')
    @section('contenido')
        @section('title')
            Login
        @endsection             
            <div class="container">
                <div id="card">
                    <img src="{{asset('img/PSAD_logo1.png')}}" style="margin-left: 40%; width: 250px;">
                    <!--<h1 class="title">Panel de Acceso</h1>-->
                    <form action="/login/verificar" method="post" id="log" data-toggle="validator">
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
                        
                        <div class="form-group row" id="f2">                       
                            <div class="col-md-3 col-md-offset-6" id="log1">
                                <button type="" class="btn btn-success btn-sm" id="login">
                                Iniciar Sesión 
                                <i class="fa fa-sign-in"></i>
                                </button>
                            </div>
                            <div class="col-md-2" id="log2">
                                <button type="reset" class="btn btn-danger btn-sm" id="close">
                                Cancelar 
                                <i class="fa fa-times"></i>
                                </button>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <i class="fa fa-refresh fa-spin login"></i>
                    </form>
                    <span></span>
                </div>
            </div>

</script>
        @include('layout/footer')
    @endsection
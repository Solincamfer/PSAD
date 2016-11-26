@extends('admin.basesys')
    @section('contenido')
        @section('title')
            Registro Servicios - Planes
        @endsection
            @include('layout/header')
                @include('layout/sidebar')
                    <div class="contenido">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-4 ttlp">
                                    <h1>Servicios</h1>
                                </div>
                            </div>
                        </div>
                        <div class="container">
                            <div class="col-md-10 col-md-offset-2">
                                <div class="row espFil">
                                    <div class="col-md-2 hh">
                                        <a id="" type="button" class="btn" data-toggle="modal" data-target="#myModal1" href="#myModal1">
                                            <div class="col-md-8 col-md-offset-2">
                                                <img src="{{asset('img/passage-of-time.png')}}" alt="" class="im">
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-2 sp">
                                        <a id="" type="button" class="btn" data-toggle="modal" data-target="#myModal2" href="#myModal2">
                                            <div class="col-md-8 col-md-offset-2">
                                                <img src="{{asset('img/lifeline-signal.png')}}" alt="" class="im">
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-2 sr">
                                        <a id="" type="button" class="btn" data-toggle="modal" data-target="#myModal3" href="#myModal3">
                                            <div class="col-md-8 col-md-offset-2">
                                                <img src="{{asset('img/shopping-support-online.png')}}" alt="" class="im">
                                            </div>
                                        </a>
                                    </div>


                                </div>
                                <div class="row espFil">
                                    <div class="col-md-2 st">
                                        <a id="" type="button" class="btn" data-toggle="modal" data-target="#myModal4" href="#myModal4">
                                            <div class="col-md-8 col-md-offset-2">
                                                <img src="{{asset('img/technical-support.png')}}" alt="" class="im">
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-2 tr">
                                        <a id="" type="button" class="btn" data-toggle="modal" data-target="#myModal5" href="#myModal5">
                                            <div class="col-md-8 col-md-offset-2">
                                                <img src="{{asset('img/technical-service-van.png')}}" alt="" class="im">
                                            </div>
                                        </a>
                                    </div>

                                    <div class="col-md-2 mant">
                                        <a id="" type="button" class="btn" data-toggle="modal" data-target="#myModal5" href="#myModal5">
                                            <div class="col-md-8 col-md-offset-2">
                                                <img src="{{asset('img/mechanic-tools.png')}}" alt="" class="im">
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--Modal Horarios-->
                        <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel1">Modificar Servicio</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form action="">
                                            <div class="container-fluid contsr1">
                                                <div class="rSrv">
                                                    <div class="col-md-5 col-md-offset-1">
                                                        <div class="form-group row icc">
                                                            <label for="">Tiempo de inicio</label>
                                                            <input type="time"><i class="fa fa-clock-o"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group row icc">
                                                            <label for="">Tiempo final</label>
                                                            <input type="time"><i class="fa fa-clock-o"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-10 col-md-offset-1">
                                                        <div class="row">
                                                            <label for="">Dias de la Semana</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5 col-md-offset-1">
                                                        <div class="form-group row icc">   
                                                            <span class="down"><i class="fa fa-chevron-down" id="i1"></i></span>
                                                            <select name="" id="">
                                                                <option value="0">Desde</option>
                                                            </select><i class="fa fa-calendar"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group row icc">
                                                            <span class="down"><i class="fa fa-chevron-down" id="i2"></i></span> 
                                                            <select name="" id="">
                                                                <option value="0">Hasta</option>
                                                            </select><i class="fa fa-calendar"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5 col-md-offset-1">
                                                        <div class="form-group row icc">
                                                            <label for="">Precio</label>
                                                            <input type="number"><i class="fa fa-money"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="bttnMd" id="btnSv">Guardar <i class="fa fa-floppy-o"></i></button>
                                        <button type="button" class="bttnMd" data-dismiss="modal" id="btnCs">Cerrar <i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--Modal Soporte Presencial-->
                        <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel2">Modificar Servicio "Soporte Presencial"</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form action="">
                                            <div class="container-fluid contsr">
                                                <div class="rSrv">
                                                    <div class="col-md-6 col-md-offset-3">
                                                        <label class="radio-inline flb"><input type="radio" name="radio">Soporte presencial contabilizada</label>
                                                        <div class="form-group row icc2">
                                                            <input type="number" placeholder="Cantidad de visitas mensuales"><i class="fa fa-briefcase"></i>
                                                        </div>
                                                        <label class="radio-inline flb"><input type="radio" name="radio">Respuesta presencial por emergencia</label>
                                                    </div>
                                                    <div class="col-md-6 col-md-offset-3">
                                                        <div class="form-group row icc3">
                                                            <input type="number" placeholder="Precio"><i class="fa fa-money"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="bttnMd" id="btnSv">Guardar <i class="fa fa-floppy-o"></i></button>
                                        <button type="button" class="bttnMd" data-dismiss="modal" id="btnCs">Cerrar <i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--Soporte Remoto-->
                        <div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel3">Modificar Servicio "Soporte Remoto"</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form action="">
                                            <div class="container-fluid contsr">
                                                <div class="rSrv">
                                                    <div class="col-md-6 col-md-offset-3">
                                                        <label class="radio-inline flb"><input type="radio" name="radio">Soporte remoto contabilizado</label>
                                                        <div class="form-group row icc2">
                                                            <input type="number" placeholder="Cantidad de conexiones Remotas"><i class="fa fa-briefcase"></i>
                                                        </div>
                                                        <label class="radio-inline flb"><input type="radio" name="radio">Soporte remoto ilimitado</label>
                                                    </div>
                                                    <div class="col-md-6 col-md-offset-3">
                                                        <div class="form-group row icc3">
                                                            <input type="number" placeholder="Precio"><i class="fa fa-money"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="bttnMd" id="btnSv">Guardar <i class="fa fa-floppy-o"></i></button>
                                        <button type="button" class="bttnMd" data-dismiss="modal" id="btnCs">Cerrar <i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
    @endsection
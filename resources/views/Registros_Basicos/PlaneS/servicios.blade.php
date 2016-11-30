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
                            <div class="row">
                                <div class="col-md-2" align="left">
                                    <a href="/menu/registros/planeservicios/"><button id="btnBk" type="button" class="btnBk" href="#"><i class="fa fa-chevron-left"></i> VOLVER</button></a>
                                </div>
                            </div>
                        </div>
                        <div class="container">
                            <div class="col-md-10 col-md-offset-2 spc">
                                <div class="row espFil">
                                    <a id="" type="button" class="btn tltpcd" data-ttl="Horarios" data-toggle="modal" data-target="#myModal1" href="#myModal1">
                                        <div class="col-md-2 hh">
                                            <div class="col-md-8 col-md-offset-2">
                                                <img src="{{asset('img/passage-of-time.png')}}" alt="" class="im">
                                            </div>
                                        </div>
                                    </a>
                                    <a id="" type="button" class="btn tltpcd" data-ttl="Soporte Presencial" data-toggle="modal" data-target="#myModal2" href="#myModal2">
                                        <div class="col-md-2 sp">
                                            <div class="col-md-8 col-md-offset-2">
                                                <img src="{{asset('img/lifeline-signal.png')}}" alt="" class="im">
                                            </div>
                                        </div>
                                    </a>
                                    <a id="" type="button" class="btn tltpcd" data-ttl="Soporte Remoto" data-toggle="modal" data-target="#myModal3" href="#myModal3">
                                        <div class="col-md-2 sr">
                                            <div class="col-md-8 col-md-offset-2">
                                                <img src="{{asset('img/shopping-support-online.png')}}" alt="" class="im">
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="row espFil">
                                    <a id="" type="button" class="btn tltpcd" data-ttl="Soporte telefónico" data-toggle="modal" data-target="#myModal4" href="#myModal4">
                                        <div class="col-md-2 st">
                                            <div class="col-md-8 col-md-offset-2">
                                                <img src="{{asset('img/technical-support.png')}}" alt="" class="im">
                                            </div>
                                        
                                        </div>
                                    </a>
                                    <a id="" class="btn tltpcd" data-ttl="Tiempo de Respuesta" data-toggle="modal" data-target="#myModal5" href="#myModal5">
                                        <div class="col-md-2 tr">
                                            <div class="col-md-8 col-md-offset-2">
                                                <img src="{{asset('img/technical-service-van.png')}}" alt="" class="im">
                                            </div>
                                        </div>
                                    </a>
                                    <a id="" class="btn tltpcd2" data-ttl="Mantenimiento">
                                        <div class="col-md-2">
                                            <div class="contcd">
                                                <div class="cardrt">
                                                    <div class="side ftside mnt">
                                                        <img src="{{asset('img/mechanic-tools.png')}}" alt="" class="im">
                                                    </div>
                                                    <div class="side bkside">
                                                        <div class="pf">
                                                            <p>Mantenimiento anual,</p>
                                                            <p>estandarización </p>
                                                            <p>y toma de inventario.</p>
                                                            <p>Esta incluido en el plan</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
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
                                                    <div class="col-md-10 col-md-offset-1">
                                                        <fieldset class="fst">
                                                            <legend>Opciones Soporte Presencial</legend>
                                                            <label class="flb"><input type="radio" name="radio" id="stpc">Soporte presencial contabilizada</label>
                                                            <div class="form-group row icc2">
                                                                <input class="desact" type="number" placeholder="Cantidad de visitas mensuales" id="cvm"><i class="fa fa-laptop"></i>
                                                            </div>
                                                            <label class="flb"><input type="radio" name="radio" id="rppe">Respuesta presencial por emergencia</label>
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-md-8 col-md-offset-2">
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
                                                    <div class="col-md-10 col-md-offset-1 mrk">
                                                        <fieldset class="fst">
                                                            <legend>Opciones Soporte Remoto</legend>
                                                            <label class="radio-inline flb"><input type="radio" name="radio" id="strc">Soporte remoto contabilizado</label>
                                                            <div class="form-group row icc2">
                                                                <input class="desact" type="number" placeholder="Cantidad de conexiones Remotas" id="ccr"><i class="fa fa-desktop"></i>
                                                            </div>
                                                            <label class="radio-inline flb"><input type="radio" name="radio" id="stri">Soporte remoto ilimitado</label>
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-md-8 col-md-offset-2">
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

                        <!--Soporte telefónico-->
                        <div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel4">Modificar Servicio "Soporte Telefónico"</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form action="">
                                            <div class="container-fluid contsr">
                                                <div class="rSrv">
                                                    <div class="col-md-10 col-md-offset-1">
                                                        <fieldset class="fst">
                                                            <legend>Opciones Soporte Telefónico</legend>
                                                            <label class="radio-inline flb"><input type="radio" name="radio" id="sttc">Soporte telefónico contabilizado</label>
                                                            <div class="form-group row icc2">
                                                                <input class="desact" type="number" placeholder="Cantidad de llamadas semanales" id="clls"><i class="fa fa-phone"></i>
                                                            </div>
                                                            <label class="radio-inline flb"><input type="radio" name="radio" id="stti">Soporte telefónico ilimitada</label>
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-md-8 col-md-offset-2">
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

                        <!--Tiempo de Respuesta-->
                        <div class="modal fade" id="myModal5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel5">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel5">Modificar Servicio "Soporte Telefónico"</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form action="">
                                            <div class="container-fluid contsr">
                                                <div class="rSrv">
                                                    <div class="col-md-8 col-md-offset-2">
                                                            <label class="flb" for="">Tiempo de Respuesta("Horas")</label>
                                                            <div class="form-group row icc4">
                                                                <input type="number" placeholder="No Maximo a"><i class="fa fa-wrench"></i>
                                                            </div>
                                                    </div>
                                                    <div class="col-md-8 col-md-offset-2">
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
    @endsection
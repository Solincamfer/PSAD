@extends('admin.basesys')
    @section('contenido')
        @section('title')
            Registro Servicios - Planes
        @endsection
            @include('layout/header')
                @include('layout/sidebar')
                    <div class="contenido">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-4 ttlp">
                                    <h1>{{$datosC1}} - Servicios</h1>
                                </div>
                            </div>
                            <div class="row sep-div1">
                                <div class="col-md-2">
                                    <a href="/menu/registros/planeservicios/">
                                        <div class="bttn-volver">
                                            <button id="btnBk" type="button" href="#" class="bttn-vol"><span class="fa fa-chevron-left"></span><span class="txt-bttn">VOLVER</span></button>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="container">
                            <div class="col-md-10 col-md-offset-2 spc">
                                <div class="row espFil">
                                    <input type="hidden" id="plan" value="{{$extra}}">

<!-- //////  TARJETA DE HORARIOS  //////-->

                                    <a id="s1" type="button" class="btn tltpcd m_Servicio " data-ttl="Horarios" data-toggle="modal" data-target="#myModal1" href="#myModal1">
                                        <div class="col-md-2 hh">
                                            <div class="col-md-8 col-md-offset-2">
                                                <img src="{{asset('img/passage-of-time.png')}}" alt="" class="im">
                                            </div>
                                        </div>
                                    </a>

<!-- //////  TARJETA DE SOPORTE PRESENCIAL  //////-->
                                    <a id="s2" type="button" class="btn tltpcd m_Servicio" data-ttl="Soporte Presencial" data-toggle="modal" data-target="#myModal2" href="#myModal2">
                                        <div class="col-md-2 sp">
                                            <div class="col-md-8 col-md-offset-2">
                                                <img src="{{asset('img/lifeline-signal.png')}}" alt="" class="im">
                                            </div>
                                        </div>
                                    </a>

<!-- //////  TARJETA DE SOPORTE REMOTO  //////-->
                                    <a id="s3" type="button" class="btn tltpcd m_Servicio" data-ttl="Soporte Remoto" data-toggle="modal" data-target="#myModal3" href="#myModal3">
                                        <div class="col-md-2 sr">
                                            <div class="col-md-8 col-md-offset-2">
                                                <img src="{{asset('img/shopping-support-online.png')}}" alt="" class="im">
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="row espFil">

<!-- //////  TARJETA DE SOPORTE TELEFONICO  //////-->     
                                    <a id="s4" type="button" class="btn tltpcd m_Servicio" data-ttl="Soporte telefónico" data-toggle="modal" data-target="#myModal4" href="#myModal4">
                                        <div class="col-md-2 st">
                                            <div class="col-md-8 col-md-offset-2">
                                                <img src="{{asset('img/technical-support.png')}}" alt="" class="im">
                                            </div>
                                        
                                        </div>
                                    </a>

<!-- //////  TARJETA DE TIEMPO DE RESPUESTA  //////-->
                                    <a id="s5" class="btn tltpcd m_Servicio" data-ttl="Tiempo de Respuesta" data-toggle="modal" data-target="#myModal5" href="#myModal5">
                                        <div class="col-md-2 tr">
                                            <div class="col-md-8 col-md-offset-2">
                                                <img src="{{asset('img/technical-service-van.png')}}" alt="" class="im">
                                            </div>
                                        </div>
                                    </a>

<!-- //////  TARJETA DE MANTENIMIENTO  //////-->
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

<!-- //////  MODAL HORARIOS  //////-->
                        <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel1">Modificar Servicio "Horarios"</h4>
                                    </div>
                                    <form action="/menu/registros/planes/servicios/insertar" method="post" id="NewHorario" class="NewServicio">
                                        {{ csrf_field() }}  
                                        <div class="modal-body">
                                            <div class="container-fluid contsr1">
                                                <div class="rSrv">
                                                    <div class="col-md-5 col-md-offset-1">
                                                        <div class="form-group row icc">
                                                            <label for="">Tiempo de inicio</label>
                                                            <input type="time" id="horaI" name="horaI"><i class="fa fa-clock-o"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group row icc">
                                                            <label for="">Tiempo final</label>
                                                            <input type="time" id="horaF" name="horaF"><i class="fa fa-clock-o"></i>
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
                                                            <select name="diaI" id="diaI">
                                                                <option value=""> - </option>
                                                                <option value="Lunes">Lunes</option>
                                                                <option value="Martes">Martes</option>
                                                                <option value="Miercoles">Miercoles</option>
                                                                <option value="Jueves">Jueves</option>
                                                                <option value="Viernes">Viernes</option>
                                                                <option value="Sabado">Sabado</option>
                                                                <option value="Domingo">Domingo</option>
                                                            </select><i class="fa fa-calendar"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group row icc">
                                                            <span class="down"><i class="fa fa-chevron-down" id="i2"></i></span> 
                                                            <select name="diaF" id="diaF">
                                                                <option value=""> - </option>
                                                                <option value="Lunes">Lunes</option>
                                                                <option value="Martes">Martes</option>
                                                                <option value="Miercoles">Miercoles</option>
                                                                <option value="Jueves">Jueves</option>
                                                                <option value="Viernes">Viernes</option>
                                                                <option value="Sabado">Sabado</option>
                                                                <option value="Domingo">Domingo</option>
                                                            </select><i class="fa fa-calendar"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5 col-md-offset-1">
                                                        <div class="form-group row icc">
                                                            <label for="precio">Precio</label>
                                                            <input type="text" id="precio" name="precio"><i class="fa fa-money"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="bttnMd" id="saveHorario">Guardar <i class="fa fa-floppy-o"></i></button>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>

<!-- //////  MODAL SOPORTE PRESENCIAL  //////-->
                        <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel2">Modificar Servicio "Soporte Presencial"</h4>
                                    </div>
                                    <form method="post" id="NewPresencial" class="NewServicio">
                                        <div class="modal-body">
                                            {{ csrf_field() }}  
                                            <div class="container-fluid contsr">
                                                <div class="rSrv">
                                                    <div class="col-md-10 col-md-offset-1">
                                                        <fieldset class="fst">
                                                            <legend>Opciones Soporte Presencial</legend>
                                                            <label class="flb"><input type="radio" name="radio1" id="stpc"  value="contabilizado">Soporte presencial contabilizado</label>
                                                            <div class="form-group row icc2">
                                                    
                                                            </div>
                                                            <label class="flb"><input type="radio" name="radio1" id="stpe"  value="ilimitado">Respuesta presencial por emergencia</label>
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-md-8 col-md-offset-2">
                                                        <div class="form-group row icc3">
                                                            <input type="number" placeholder="Precio" id="precioP" name="precioP"><i class="fa fa-money"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="bttnMd" id="savePresencial">Guardar <i class="fa fa-floppy-o"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

<!-- //////  MODAL SOPORTE REMOTO //////-->
                        <div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel3">Modificar Servicio "Soporte Remoto"</h4>
                                    </div>
                                    <form method="post" id="NewRemoto" class="NewServicio">
                                        <div class="modal-body">
                                            <div class="container-fluid contsr">
                                                <div class="rSrv">
                                                    <div class="col-md-10 col-md-offset-1 mrk">
                                                        <fieldset class="fst">
                                                            <legend>Opciones Soporte Remoto</legend>
                                                            <label class="radio-inline flb"><input type="radio" name="radio2" id="strc" value="contabilizado">Soporte remoto contabilizado</label>
                                                            <div class="form-group row icc5">
                                                                
                                                            </div>  
                                                            <label class="radio-inline flb"><input type="radio" name="radio2" id="stri" value="ilimitado">Soporte remoto ilimitado</label>
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-md-8 col-md-offset-2">
                                                        <div class="form-group row icc3">
                                                            <input type="number" class="" id="precioR" placeholder="Precio"><i class="fa fa-money"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="bttnMd" id="saveRemoto">Guardar <i class="fa fa-floppy-o"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

<!-- //////  MODAL SOPORTE TELEFONICO  //////-->
                        <div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel4">Modificar Servicio "Soporte Telefónico"</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form id="NewTelefonico" class="NewServicio">
                                            <div class="container-fluid contsr">
                                                <div class="rSrv">
                                                    <div class="col-md-10 col-md-offset-1">
                                                        <fieldset class="fst">
                                                            <legend>Opciones Soporte Telefónico</legend>
                                                            <label class="radio-inline flb"><input type="radio" name="radio3" id="sttc" value="contabilizado">Soporte telefónico contabilizado</label>
                                                            <div class="form-group row icc4">

                                                            </div>
                                                            <label class="radio-inline flb"><input type="radio" name="radio3" id="stti" value="ilimitado">Soporte telefónico ilimitado</label>
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-md-8 col-md-offset-2">
                                                        <div class="form-group row icc3">
                                                            <input type="number" id="precioT" placeholder="Precio"><i class="fa fa-money"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="bttnMd" id="saveTelefonico">Guardar <i class="fa fa-floppy-o"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>

<!-- //////  MODAL TIEMPO DE RESPUESTA //////-->
                        <div class="modal fade" id="myModal5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel5">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel5">Modificar Servicio "Tiempo de Respuesta"</h4>
                                    </div>
                                    <form action="" id="NewTR" class="NewServicio">
                                        <div class="modal-body">
                                            <div class="container-fluid contsr">
                                                <div class="rSrv">
                                                    <div class="col-md-8 col-md-offset-2">
                                                            <label class="flb" for="">Tiempo de Respuesta("Horas")</label>
                                                            <div class="form-group row icc3">
                                                                <input type="number" id="tr" placeholder="No Maximo a"><i class="fa fa-wrench"></i>
                                                            </div>
                                                    </div>
                                                    <div class="col-md-8 col-md-offset-2">
                                                        <div class="form-group row icc3">
                                                            <input type="number" id="precioTR" placeholder="Precio"><i class="fa fa-money"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="bttnMd" id="saveTR">Guardar <i class="fa fa-floppy-o"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
    @endsection
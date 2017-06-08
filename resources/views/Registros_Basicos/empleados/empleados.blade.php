@extends('admin.basesys')
    @section('contenido')
        @section('title')
            Registro Empleado
        @endsection
            @include('layout/header')
                @include('layout/sidebar')
                    <div class="contenido">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-2 ttlp">
                                    <h1>Empleados</h1>
                                </div>
                            </div>
                            <div class="row sep-div">
                                <div class="col-md-2 despl-bttn">
                                    @if($agregar)
                                    <div class="bttn-agregar">
                                        <button id="btnAdd" type="button" class="bttn-agr" data-toggle="modal" data-target="#myModal" href="#myModal"><span class="fa fa-plus"></span><span class="txt-bttn">AGREGAR</span></button>
                                    </div>
                                    @endif 
                                </div>
                                <div  class="col-md-4 despl-bttn">
                                    <div class="search-cont" id="scnt">
                                        <form action="" method="">
                                            <div class="input-group sci">
                                                <input type="search" class="form-control filtro" placeholder="Buscar empleado..."><span class="fa fa-search"></span>
                                            </div>
                                        </form> 
                                        <a class="bttn-search">
                                            <span class="fa fa-search"></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-5 col-sm-5 col-md-6 col-md-offset-3" style=""> 

                            @foreach($consulta as $empleado)
                                <div class="contMd" style="">
                                    <div class="icl">
                                        @foreach($acciones as $accion)
                                          @if($accion->id!=78)
                                             
                                             @if($accion->id!=76)
                                                <span class="iclsp">
                                                <a href="{{$accion->url.$empleado->id}}" class="tltp" data-ttl="{{$accion->descripcion}}">
                                                <i class="{{$accion->clase_css}}"></i>
                                               </a>
                                              </span>
                                             @elseif($accion->id==76)
                                                <span class="iclsp">
                                                  <a href="#myModal2" class="tltp modificarEmpleado" id="m{{$empleado->id}}" data-ttl="{{$accion->descripcion}}" data-registro="{{$empleado->id}}" data-toggle="modal" data-target="#myModal2"> 
                                                  <i class="{{$accion->clase_css}}"></i>
                                                  </a>
                                               </span>
                                             @endif
                                          @elseif($accion->id==78)
                                            @if($accion->status_ac==1)
                                                  <div class="chbx">
                                                    <input type="checkbox" class="btnAcc" name="inchbx1" id="{{'inchbx'. $empleado->id}}" value="{{$accion->status_ac}}" checked><label for="{{'inchbx'. $empleado->id}}" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
                                                  </div>
                                            @elseif($accion->staus_ac==0)
                                              <div class="chbx">
                                                <input type="checkbox" class="btnAcc" name="status" id="{{'inchbx'. $empleado->id}}" value="{{$accion->status_ac}}"><label for="{{'inchbx'. $empleado->id}}" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
                                              </div>
                                            @endif
                                          @endif
                                        @endforeach
                                    </div>
                                <p class="ttlMd"><strong>{{$empleado->nombre."  ".$empleado->apellido}}</strong></p>
                                </div>
                            @endforeach
                            <input type="hidden" name="TND" value="{{$datosC6}}">
                        </div>
                        <!--    Registro -->

<!--  /////////////////////////////  MODAL DE AGREGAR ////////////////////////////// -->
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Agregar Empleado</h4>
                                    </div>
                                    <form id="NewEmp" >
                                      <div class="modal-body">
                                            {{ csrf_field() }}
                                            <ul class="nav nav-tabs" role="tablist">
                                                <li role="presentation" class="active"><a href="#dbe1" aria-controls="dbe1" role="tab" data-toggle="tab">Datos básic. Prim.</a></li>
                                                <li role="presentation"><a href="#dbe2" aria-controls="dbe2" role="tab" data-toggle="tab">Datos básic. Sec.</a></li>
                                                <li role="presentation"><a href="#dhe" aria-controls="dhe" role="tab" data-toggle="tab">Dir. de Hab.</a></li>
                                                <li role="presentation"><a href="#ctoe" aria-controls="ctoe" role="tab" data-toggle="tab">Contactos</a></li>
                                                <li role="presentation"><a href="#user" aria-controls="user" role="tab" data-toggle="tab">Usuario</a></li>
                                            </ul>
                                            <div class="container-fluid">
                                                <div class="tab-content">
                                                    <div role="tabpanel" class="tab-pane active" id="dbe1">
                                                        <div class="container-fluid contdbe1">
                                                           <div class="row rEmp1">
                                                               <div class="col-md-6">
                                                                   <div class="form-group row">
                                                                       <label for="nomEmp1">1er Nombre</label>
                                                                       <input type="text" name="nomEmp1" class="form-control" id="nomEmp1"><i class="fa fa-user icemp"></i>
                                                                   </div>
                                                               </div>
                                                               <div class="col-md-6">
                                                                   <div class="form-group row">
                                                                       <label for="nomEmp2">2do Nombre</label>
                                                                       <input type="text" name="nomEmp2" class="form-control" id="nomEmp2"><i class="fa fa-user-plus icemp"></i>
                                                                   </div>
                                                               </div>
                                                               <div class="col-md-6">
                                                                   <div class="form-group row">
                                                                       <label for="apellEmp1">1er Apellido</label>
                                                                       <input type="text" name="apellEmp1" class="form-control" id="apellEmp1"><i class="fa fa-user icemp"></i>
                                                                   </div>
                                                               </div>
                                                               <div class="col-md-6">
                                                                   <div class="form-group row">
                                                                       <label for="apellEmp2">2do Apellido</label>
                                                                       <input type="text" name="apellEmp2" class="form-control" id="apellEmp2"><i class="fa fa-user-plus icemp"></i>
                                                                   </div>
                                                               </div>
                                                           </div>
                                                        </div>
                                                    </div>

                                                    <div role="tabpanel" class="tab-pane" id="dbe2">
                                                        <div class="container-fluid contdbe2">
                                                           <div class="row rEmp2">
                                                                <div class="col-md-10 col-md-offset-1">
                                                                    <label for="rifEmp">Rif</label>
                                                                    <br>
                                                                    <div class="col-md-5">
                                                                        <div class="form-group row">
                                                                          
                                                                            <span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                                            <select name="TrifEmp" class="form-control" id="selRifEmp">
                                                                                <option value="0">-</option>
                                                                                @foreach ($extra as $rif)
                                                                                  <option value="{{$rif->id}}">{{$rif->descripcion}}</option>
                                                                                @endforeach
                                                                            </select><i class="fa fa-clipboard icemp"></i>
                                                                          
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-7">
                                                                        <div class="form-group row">
                                                                            <input type="tel" class="form-control" name="rifEmp" id="numRifEmp"><i class="fa fa-address-card icemp"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-10 col-md-offset-1">
                                                                    <label for="ciEmp">Documento de identidad</label>
                                                                    <br>
                                                                    <div class="col-md-5">
                                                                        <div class="form-group row">
                                                                            <span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                                            <select name="TciEmp" class="form-control" id="selCiEmp">
                                                                                <option value="0">-</option>
                                                                                @foreach ($datosC1 as $cedula)
                                                                                  <option value="{{$cedula->id}}">{{$cedula->descripcion}}</option>
                                                                                @endforeach
                                                                            </select><i class="fa fa-clipboard icemp"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-7">
                                                                        <div class="form-group row">
                                                                            <input type="tel" class="form-control" name="ciEmp" id="numCiEmp"><i class="fa fa-address-card-o icemp"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                           </div>
                                                           <div class="row rEmp3">
                                                               <div class="col-md-10 col-md-offset-1">
                                                                   <div class="form-group row">
                                                                       <label for="fnEmp">Fecha de nacimiento</label><span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                                       <input type="date" name="fnEmp" class="form-control" id="fnEmp"><i class="fa fa-calendar icemp"></i>
                                                                   </div>
                                                               </div>
                                                               <div class="col-md-10 col-md-offset-1">
                                                                   <div class="form-group row">
                                                                       <label for="dptoEmp">Departamento</label><span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                                       <select name="dptoEmp" class="form-control" id="dptoEmp">
                                                                           <option value="0">-</option>
                                                                           @foreach ($datosC5 as $departamentos)
                                                                              <option value="{{$departamentos->id}}">{{$departamentos->descripcion}}</option>
                                                                            @endforeach
                                                                       </select><i class="fa fa-briefcase icemp"></i>
                                                                   </div>
                                                               </div>
                                                               <div class="col-md-10 col-md-offset-1">
                                                                   <div class="form-group row">
                                                                       <label for="cgoEmp">Cargo</label><span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                                       <select name="cgoEmp" class="form-control" id="cgoEmp">
                                                                           <option value="">-</option>
                                                                       </select><i class="fa fa-id-badge icemp"></i>
                                                                   </div>
                                                               </div>
                                                           </div>
                                                        </div>
                                                    </div>

                                                    <div role="tabpanel" class="tab-pane" id="dhe">
                                                        <div class="container-fluid contdhe">
                                                           <div class="row rEmp4">
                                                               <div class="form-group col-md-6">
                                                                   <label for="pdhe">País</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                                   <select name="pdhe" class="form-control" id="pdhe">
                                                                       <option value="0">-</option>
                                                                       @foreach ($datosC2 as $pais)
                                                                          <option value="{{$pais->id}}">{{$pais->descripcion}}</option>
                                                                        @endforeach
                                                                   </select><i class="fa fa-globe icemp"></i>
                                                               </div>
                                                               <div class="form-group col-md-6">
                                                                   <label for="rgdhe">Región</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                                   <select name="rgdhe" class="form-control" id="rgdhe">
                                                                       <option value="0">-</option>
                                                                   </select><i class="fa fa-map icemp"></i>
                                                               </div>
                                                               <div class="form-group col-md-6">
                                                                   <label for="edodhe">Estado</label><span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                                   <select name="edodhe" class="form-control" id="edodhe">
                                                                       <option value="0">-</option>
                                                                   </select><i class="fa fa-map-pin icemp"></i>
                                                               </div>
                                                               <div class="form-group col-md-6">
                                                                   <label for="mundhe">Municipio</label><span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                                   <select name="mundhe" class="form-control" id="mundhe">
                                                                       <option value="0">-</option>
                                                                   </select><i class="fa fa-map-signs icemp"></i>
                                                               </div>
                                                               <div class="form-group col-md-12">
                                                                   <label for="descpdhe">Descripcion de la dirección</label>
                                                                   <textarea type="text" name="descpdhe" class="form-control" id="descpdhe"></textarea><i class="fa fa-map-marker icemp"></i>
                                                               </div>
                                                           </div>
                                                        </div>
                                                    </div>

                                                    <div role="tabpanel" class="tab-pane" id="ctoe">
                                                       <div class="container-fluid contcte">
                                                           <div class="row rEmp5">
                                                               <div class="col-md-10 col-md-offset-1">
                                                                  <label for="tlflcle">Teléfono Local</label>
                                                                  <br>
                                                                   <div class="col-md-5">
                                                                       <div class="form-group row">
                                                                           <span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                                           <select name="tlflcle" class="form-control" id="tlflcle">
                                                                               <option value="0">-</option>
                                                                              @foreach ($datosC4 as $tl)
                                                                                <option value="{{$tl->id}}">{{$tl->descripcion}}</option>
                                                                              @endforeach
                                                                           </select><i class="fa fa-hashtag icemp"></i>
                                                                       </div>
                                                                   </div>
                                                                   <div class="col-md-7">
                                                                       <div class="form-group row">
                                                                           <input type="tel" name="numerol"class="form-control" id="numtlflcle"><i class="fa fa-phone icemp"></i>
                                                                       </div>
                                                                   </div>
                                                               </div>
                                                               <div class="col-md-10 col-md-offset-1">
                                                                   <label for="tlfmvle">Teléfono Móvil</label>
                                                                   <br>
                                                                   <div class="col-md-5">
                                                                       <div class="form-group row">
                                                                           <span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                                           <select name="tlfmvle" class="form-control" id="tlfmvle">
                                                                               <option value="0">-</option>
                                                                              @foreach ($datosC3 as $tc)
                                                                                <option value="{{$tc->id}}">{{$tc->descripcion}}</option>
                                                                              @endforeach
                                                                           </select><i class="fa fa-hashtag icemp"></i>
                                                                       </div>
                                                                   </div>
                                                                   <div class="col-md-7">
                                                                       <div class="form-group row">
                                                                           <input type="tel" name="numeroc" class="form-control" id="numtlfmvle"><i class="fa fa-mobile icemp"></i>
                                                                       </div>
                                                                   </div>
                                                               </div>
                                                               <div class="row">
                                                                   <div class="col-md-10 col-md-offset-1">
                                                                       <div class="form-group row">
                                                                           <label for="maile">Correo Electrónico</label>
                                                                           <input type="text" name="maile" class="form-control" id="maile"><i class="fa fa-envelope icemp"></i>
                                                                       </div>
                                                                   </div>
                                                               </div>
                                                           </div>
                                                       </div>
                                                    </div>
                                                    
                                                    <div role="tabpanel" class="tab-pane" id="user">
                                                        <div class="container-fluid contuser">
                                                            <div class="row rEmp6">
                                                                <div class="col-md-8 col-md-offset-2">
                                                                    <div class="form-group row">
                                                                        <label for="nomUs">Nombre de Usuario</label>
                                                                        <input type="text" class="form-control" name="nomUs" id="nomUs"><i class="fa fa-user-circle icemp"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-8 col-md-offset-2">
                                                                    <div class="form-group row">
                                                                        <label for="pwUs1">Contraseña</label>
                                                                        <input type="password" class="form-control" name="pwUs1" id="pwUs1"><i class="fa fa-lock icemp"></i>    
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-8 col-md-offset-2">
                                                                    <div class="form-group row">
                                                                        <label for="stUs">Estatus de Usuario</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                                        <select name="status" id="stUs" class="form-control">
                                                                            <option value="">-</option>
                                                                            <option value="1">Activo</option>
                                                                            <option value="0">Inactivo</option>
                                                                        </select><i class="fa fa-check icemp"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 
                                      </div>
                                      <div class="modal-footer">
                                        <button type="submit" class="bttnMd" id="saveEmpl">Guardar <i class="fa fa-floppy-o"></i></button>
                                      </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
  <!-- ///////////////// MODAL DE MODIFICAR EMPLEADO ////////////////////////-->
  
                        <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel2">Modificar Empleado</h4>
                            </div>
                            <div class="modal-body">
                                <form action="" id="updateEmp">
                                    {{ csrf_field() }}
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li role="presentation" class="active"><a href="#dbem1" aria-controls="dbem1" role="tab" data-toggle="tab">Datos básic. Prim.</a></li>
                                        <li role="presentation"><a href="#dbem2" aria-controls="dbem2" role="tab" data-toggle="tab">Datos básic. Sec.</a></li>
                                        <li role="presentation"><a href="#dhem" aria-controls="dhem" role="tab" data-toggle="tab">Dir. de Hab.</a></li>
                                        <li role="presentation"><a href="#ctoem" aria-controls="ctoem" role="tab" data-toggle="tab">Contactos</a></li>
                                        <li role="presentation"><a href="#userm" aria-controls="userm" role="tab" data-toggle="tab">Usuario</a></li>
                                    </ul>
                                    <div class="container-fluid">
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane active" id="dbem1">
                                                <div class="container-fluid contdbe1">
                                                    <div class="row rEmp1">
                                                        <div class="col-md-6">
                                                            <div class="form-group row">
                                                                <label for="nomEmpm1">1er Nombre</label>
                                                                <input type="text" name="nomEmpm1" class="form-control" id="nomEmpm1"><i class="fa fa-user icemp"></i>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group row">
                                                                <label for="nomEmpm2">2do Nombre</label>
                                                                <input type="text" name="nomEmpm2" class="form-control" id="nomEmpm2"><i class="fa fa-user-plus icemp"></i>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group row">
                                                                <label for="apellEmpm1">1er Apellido</label>
                                                                <input type="text" name="apellEmpm1" class="form-control" id="apellEmpm1"><i class="fa fa-user icemp"></i>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group row">
                                                                <label for="apellEmpm2">2do Apellido</label>
                                                                <input type="text" name="apellEmpm2" class="form-control" id="apellEmpm2"><i class="fa fa-user-plus icemp"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div role="tabpanel" class="tab-pane" id="dbem2">
                                                <div class="container-fluid contdbe2">
                                                    <div class="row rEmp2">
                                                        <div class="col-md-10 col-md-offset-1">
                                                            <label for="rifEmpm">Rif</label>
                                                            <br>
                                                            <div class="col-md-5">
                                                                <div class="form-group row">
                                                                    <span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                                    <select name="rifEmpm" class="form-control" id="selRifEmpm">
                                                                        <option value="">-</option>
                                                                        @foreach ($extra as $rif)
                                                                          <option value="{{$rif->id}}">{{$rif->descripcion}}</option>
                                                                        @endforeach
                                                                    </select><i class="fa fa-clipboard icemp"></i>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-7">
                                                                <div class="form-group row">
                                                                    <input type="tel" class="form-control" name="rifEmpm" id="numRifEmpm"><i class="fa fa-address-card icemp"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-10 col-md-offset-1">
                                                            <label for="ciEmpm">Documento de identidad</label>
                                                            <br>
                                                            <div class="col-md-5">
                                                                <div class="form-group row">
                                                                    <span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                                    <select name="ciEmpm" class="form-control" id="selCiEmpm">
                                                                        <option value="">-</option>
                                                                        @foreach ($datosC1 as $cedula)
                                                                          <option value="{{$cedula->id}}">{{$cedula->descripcion}}</option>
                                                                        @endforeach
                                                                    </select><i class="fa fa-clipboard icemp"></i>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-7">
                                                                <div class="form-group row">
                                                                    <input type="tel" class="form-control" name="ciEmpm" id="numCiEmpm"><i class="fa fa-address-card-o icemp"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row rEmp3">
                                                        <div class="col-md-10 col-md-offset-1">
                                                            <div class="form-group row">
                                                                <label for="fnEmpm">Fecha de nacimiento</label><span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                                <input type="date" name="fnEmpm" class="form-control" id="fnEmpm"><i class="fa fa-calendar icemp"></i>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-10 col-md-offset-1">
                                                            <div class="form-group row">
                                                                <label for="dptoEmpm">Departamento</label><span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                                <select name="dptoEmpm" class="form-control" id="dptoEmpm">
                                                                    <option value="">-</option>
                                                                    @foreach ($datosC5 as $departamentos)
                                                                      <option value="{{$departamentos->id}}">{{$departamentos->descripcion}}</option>
                                                                    @endforeach
                                                                </select><i class="fa fa-briefcase icemp"></i>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-10 col-md-offset-1">
                                                            <div class="form-group row">
                                                                <label for="cgoEmpm">Cargo</label><span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                                <select name="cgoEmpm" class="form-control" id="cgoEmpm">
                                                                    <option value="">-</option>
                                                                </select><i class="fa fa-id-badge icemp"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div role="tabpanel" class="tab-pane" id="dhem">
                                                <div class="container-fluid contdhe">
                                                    <div class="row rEmp4">
                                                        <div class="form-group col-md-6">
                                                            <label for="pdhem">País</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                            <select name="pdhem" class="form-control" id="pdhem">
                                                                <option value="">-</option>
                                                                @foreach ($datosC2 as $pais)
                                                                  <option value="{{$pais->id}}">{{$pais->descripcion}}</option>
                                                                @endforeach
                                                            </select><i class="fa fa-globe icemp"></i>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="rgdhem">Región</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                            <select name="rgdhem" class="form-control" id="rgdhem">
                                                                <option value="">-</option>
                                                            </select><i class="fa fa-map icemp"></i>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="edodhem">Estado</label><span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                            <select name="edodhem" class="form-control" id="edodhem">
                                                                <option value="">-</option>
                                                            </select><i class="fa fa-map-pin icemp"></i>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="mundhem">Municipio</label><span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                            <select name="mundhem" class="form-control" id="mundhem">
                                                                <option value="">-</option>
                                                            </select><i class="fa fa-map-signs icemp"></i>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label for="descpdhem">Descripcion de la dirección</label>
                                                            <textarea type="text" name="descpdhem" class="form-control" id="descpdhem"></textarea><i class="fa fa-map-marker icemp"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div role="tabpanel" class="tab-pane" id="ctoem">
                                                <div class="container-fluid contcte">
                                                    <div class="row rEmp5">
                                                        <div class="col-md-10 col-md-offset-1">
                                                            <label for="tlflclem">Teléfono Local</label>
                                                            <br>
                                                            <div class="col-md-5">
                                                                <div class="form-group row">
                                                                    <span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                                    <select name="tlflclem" class="form-control" id="tlflclem">
                                                                        <option value="">-</option>
                                                                        @foreach ($datosC4 as $tl)
                                                                          <option value="{{$tl->id}}">{{$tl->descripcion}}</option>
                                                                        @endforeach
                                                                    </select><i class="fa fa-hashtag icemp"></i>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-7">
                                                                <div class="form-group row">
                                                                    <input type="tel" class="form-control" id="numtlflclem"><i class="fa fa-phone icemp"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-10 col-md-offset-1">
                                                            <label for="tlfmvlem">Teléfono Móvil</label>
                                                            <br>
                                                            <div class="col-md-5">
                                                                <div class="form-group row">
                                                                    <span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                                    <select name="tlfmvlem" class="form-control" id="tlfmvlem">
                                                                        <option value="">-</option>
                                                                        @foreach ($datosC3 as $tc)
                                                                          <option value="{{$tc->id}}">{{$tc->descripcion}}</option>
                                                                        @endforeach
                                                                    </select><i class="fa fa-hashtag icemp"></i>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-7">
                                                                <div class="form-group row">
                                                                    <input type="tel" class="form-control" id="numtlfmvlem"><i class="fa fa-mobile icemp"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-10 col-md-offset-1">
                                                                <div class="form-group row">
                                                                    <label for="mailem">Correo Electrónico</label>
                                                                    <input type="text" name="mailem" class="form-control" id="mailem"><i class="fa fa-envelope icemp"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div role="tabpanel" class="tab-pane" id="userm">
                                                <div class="container-fluid contuser">
                                                    <div class="row rEmp6">
                                                        <div class="col-md-8 col-md-offset-2">
                                                            <div class="form-group row">
                                                                <label for="nomUsm">Nombre de Usuario</label>
                                                                <input type="text" class="form-control" name="nomUsm" id="nomUsm"><i class="fa fa-user-circle icemp"></i>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-8 col-md-offset-2">
                                                            <div class="form-group row">
                                                                <label for="pwUs1mm">Contraseña</label>
                                                                <input type="password" class="form-control" name="pwUs1mm" id="pwUs1mm"><i class="fa fa-lock icemp"></i>    
                                                            </div>
                                                        </div>
                                                        <div class="col-md-8 col-md-offset-2">
                                                            <div class="form-group row">
                                                                <label for="stUsm">Estatus de Usuario</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                                <select name="stUsm" id="stUsm" class="form-control">
                                                                    <option value="">-</option>
                                                                    <option value="1">Activo</option>
                                                                    <option value="0">Inactivo</option>
                                                                </select><i class="fa fa-check icemp"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                      <button type="button" class="bttnMd" id="btnSvm">Guardar <i class="fa fa-floppy-o"></i></button>
                                  </div>
                                </form>
                            
                        </div>
                        </div>
                        </div>
                </div>   
    @endsection
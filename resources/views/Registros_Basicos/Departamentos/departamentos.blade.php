@extends('admin.basesys')
    @section('contenido')
        @section('title')
            Registro Departamento
        @endsection
        @include('layout/header')
                @include('layout/sidebar')
            <div class="contenido">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-2 ttlp">
                            <h1>Mi Compañia</h1>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4 form-group row" style="padding-top: 10px;">
                            <select class="form-control" id="comboDireccion" >
                                <option value="0" selected="selected">Seleccione una Dirección</option>
                                @foreach($consulta as $direccion)
                                <option value="{{$direccion->id}}">{{$direccion->descripcion}}</option>
                                @endforeach
                            </i></select>

                        </div>
                        <div class="col-md-4" style="padding-top: 20px; padding-left: 0px;">
                           <h1><a data-toggle="modal" data-target="#myModall" href="#myModal" id="link-direcciones">Direcciones</a></h1>
                        </div>
                        <div class="col-md-4">
                            @if($agregar)
                            <div class="bttn-agregar">
                                <button id="btnAdd" type="button" class="bttn-agr" data-toggle="modal" data-target="#myModalD" href="#myModal"><span class="fa fa-plus"></span><span class="txt-bttn">AGREGAR</span></button>
                            </div>
                            @endif
                        </div>

                    </div>
                    <div class="row" style="padding-top: 30px;">
                        <ul class="nav nav-tabs">
                            <li class="active col-md-3" data-valor="dep"><a data-toggle="tab" id="nav-dep" href="#dep">Departamentos</a></li>
                            <li class="col-md-3" data-valor="area"
                            ><a data-toggle="tab" id="nav-area" href="#area">Areas</a></li>
                            <li class="col-md-3" data-valor="car"><a data-toggle="tab" id="nav-cargo" href="#cargo">Cargos</a></li>
                        </ul>


                        <div class="tab-content ">

                            <div id="dep" class="tab-pane fade in active col-xs-5 col-sm-5 col-md-6 col-md-offset-2">
                                <div class="row" style="padding:40px 0 20px 0;">
                                    <div  class="col-md-10">
                                        
                                    </div>
                                </div>
                                <div class="contRegister contDep" id="contDep">
                                @foreach($datosC3 as $director)
                                    <div class="titulo-registros">
                                      <label>{{$director->descripcion}}</label>
                                    </div>
                                  @foreach($extra as $departamento)
                                    @if($departamento->director_id == $director->id)
                                        <div class="contMd">

                                            <div class="icl">
                                                @foreach($acciones as $accion)
                                                    @if($accion->id!=94 )
                                                        @if($accion->id==95)
                                                            <span class="iclsp">
                                                                <a  class="tltp modificar" data-padre="{{$departamento->director_id }}" data-modal="1" data-reg="{{$departamento->id}}" id="ModificaDepar{{$departamento->id}}" data-ttl="{{$accion->descripcion}}" data-toggle="modal" >
                                                                    <i class="{{$accion->clase_css}}"></i>
                                                                </a>
                                                            </span>
                                                        @elseif($accion->id==96)
                                                            <span class="iclsp">
                                                                <a class="tltp add-reg" data-modal="1" data-reg="{{$departamento->id}}"  data-ttl="{{$accion->descripcion}}">
                                                                    <i class="{{$accion->clase_css}}"></i>
                                                                </a>
                                                            </span>
                                                        @endif
                                                    @elseif($accion->id==94 )
                                                        @if($departamento->status==1)
                                                            <div class="chbx">
                                                                <input type="checkbox" data-table="1" data-registro="{{ $departamento->id }}" class="btnAcc" name="status" id="{{'inchbx'. $departamento->id}}" value="{{$departamento->status}}" checked><label for="{{'inchbx'. $departamento->id}}" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
                                                            </div>
                                                        @elseif($departamento->status==0)
                                                            <div class="chbx">
                                                                <input type="checkbox" data-table="1" data-registro="{{ $departamento->id }}" class="btnAcc" name="status" id="{{'inchbx'. $departamento->id}}" value="{{$departamento->status}}"><label for="{{'inchbx'. $departamento->id}}" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
                                                            </div>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </div>
                                            <div class="checkbox ttlMd1 filtro">
                                                <label><input type="checkbox" value="{{$departamento->id}}">{{$departamento->descripcion}}</label>
                                            </div>
                                        </div>
                                    @endif
                                  @endforeach
                                @endforeach
                                </div>

                            </div>
                            <div id="area" class="tab-pane fade col-xs-5 col-sm-5 col-md-6 col-md-offset-2 ">
                              <div class="row" style="padding:40px 0 20px 0;">
                                  <div  class="col-md-10">
                                   
                                  </div>
                              </div>
                              <div class="contRegister contArea" id="contArea">

                              </div>
                            </div>
                            <div id="cargo" class="tab-pane fade col-xs-5 col-sm-5 col-md-6 col-md-offset-2">
                              <div class="row" style="padding:40px 0 20px 0;">
                                  <div  class="col-md-10">

                                  </div>
                              </div>
                              <div class="contRegister contCarg">
                              </div>

                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden"   name="TND"  value="{{$extra}}">

<!-- VENTANAS MODALES DE DIRECCIONES -->

    <!-- MODAL AGREGAR DIRECCION -->
                <div class="modal fade" id="myModalD" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel"><strong>Agregar Dirección</strong></h4>
                            </div>
                            <div class="modal-body">
                                <form method="post" class="form-horizontal " id="nuevaDireccion">
                                    {{ csrf_field() }}
                                    <div class="container-fluid" id="contdpto">
                                        <div class="row">
                                            <div id="dpto">
                                               <div class="col-md-8 col-md-offset-2">
                                                   <div class="form-group row">
                                                       <label for="nomDireccion">Nombre de la Dirección</label>
                                                       <input type="text" name="direccion" class="form-control " id="nomDireccion"/><i class="fa fa-briefcase" id="icdp1"></i>
                                                   </div>
                                               </div>
                                               <div class="col-md-8 col-md-offset-2">
                                                   <div class="form-group row">
                                                       <label for="stDireccion">Estatus de la Dirección</label><span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                       <select name="comboDireccion" class="form-control" id="stDireccion">
                                                            <option value="">-</option>
                                                            <option value="1">ACTIVO</option>
                                                            <option value="0">INACTIVO</option>
                                                       </select><i class="fa fa-check" id="icdp2"></i>
                                                   </div>
                                               </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" id="button-save" class="bttnMd">Guardar <i class="fa fa-floppy-o"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

    <!-- MODAL LISTAR DIRECCIONES -->
                <div class="modal fade" id="myModall" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel"><strong>Lista de Direcciones</strong></h4>
                            </div>
                            <div class="modal-body">
                                <div class="contRegisterDireccion">
                            
                                </div>
                                <div class="modal-footer">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>


    <!-- MODAL MODIFICAR DIRECCION -->
                <div class="modal fade" id="myModalDM" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel2"><strong>Modificar Dirección</strong></h4>
                            </div>
                            <div class="modal-body">
                                <form method="post" class="form-horizontal formUpdateReg" id="updateDireccion">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="padre">
                                    <input type="hidden" name="registro">
                                    <div class="container-fluid" id="contdpto">
                                        <div class="row">
                                            <div id="dptom">
                                                <div class="col-md-8 col-md-offset-2">
                                                    <div class="form-group row">
                                                        <label for="nomDptom_">Nombre de la Dirección</label>
                                                        <input type="text" name="campoD" class="form-control descripcion" id="direccionDesc"/><i class="fa fa-briefcase " id="micdp1"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-md-offset-2">
                                                    <div class="form-group row">
                                                        <label for="stDptom_">Estatus de la Dirección</label><span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                        <select name="campoE" class="form-control status" id="direccionEst">
                                                            <option value="1">ACTIVO</option>
                                                            <option value="0">INACTIVO</option>
                                                        </select><i class="fa fa-check" id="micdp2"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" value="" id="MIndexD" name="MIndex">

                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="bttnMd" id="buttonUpdateDir">Guardar <i class="fa fa-floppy-o"></i></button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>

<!-- VENTANAS MODALES DE DEPARTAMENTOS -->

    <!-- MODAL NUEVO DEPARTAMENTO -->
            
                <div class="modal fade" id="myModalDE" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel"><strong>Agregar Departamento</strong></h4>
                            </div>
                            <div class="modal-body">
                                <form method="post" enctype="multipart/form-data" class="form-horizontal" id="newDep">
                                    {{ csrf_field() }}
                                    <input type="hidden" id="padredir" name="padre" value="">
                                    <div class="container-fluid" id="contdpto">
                                        <div class="row">
                                            <div id="dpto">
                                               <div class="col-md-8 col-md-offset-2">
                                                   <div class="form-group row">
                                                       <label for="nombreDpto">Nombre del Departamento</label>
                                                       <input type="text"  name="departamento" class="form-control " id="nombreDpto"/><i class="fa fa-briefcase" id="icdp1"></i>
                                                   </div>
                                               </div>
                                               <div class="col-md-8 col-md-offset-2">
                                                   <div class="form-group row">
                                                       <label for="statusDpto">Estatus del Departamento</label><span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                       <select name="estatusDpto" class="form-control" id="statusDpto">
                                                            <option value="">-</option>
                                                            <option value="1">ACTIVO</option>
                                                            <option value="0">INACTIVO</option>
                                                       </select><i class="fa fa-check" id="icdp2"></i>
                                                   </div>
                                               </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="bttnMd" id="btnSvDep">Guardar <i class="fa fa-floppy-o"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
    

    <!-- MODAL MODIFICAR DEPARTAMENTO -->

                <div class="modal fade" id="myModalDEM" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel2"><strong>Modificar Departamento</strong></h4>
                            </div>
                            <div class="modal-body">
                                <form method="post" class="form-horizontal formUpdateReg" id="updateDepartamento">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="padre">
                                    <input type="hidden" name="registro">
                                    <div class="container-fluid" id="contdpto">
                                        <div class="row">
                                            <div id="dptom">
                                                <div class="col-md-8 col-md-offset-2">
                                                    <div class="form-group row">
                                                        <label for="nomDptom_">Nombre del Departamento</label>
                                                        <input type="text" name="campoD" class="form-control descripcion" id="depText"/><i class="fa fa-briefcase " id="micdp1"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-md-offset-2">
                                                    <div class="form-group row">
                                                        <label for="stDptom_">Estatus del Departamento</label><span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                        <select name="campoE" class="form-control status" id="depStatus">
                                                            <option value="1">ACTIVO</option>
                                                            <option value="0">INACTIVO</option>
                                                        </select><i class="fa fa-check" id="micdp2"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" value="" id="MIndexD" name="MIndex">

                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="bttnMd" id="buttonUpdateDep">Guardar <i class="fa fa-floppy-o"></i></button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

<!-- VENTANAS MODAL AREAS -->
    <!-- MODAL AGREGAR AREAS -->
                 <div class="modal fade" id="myModalAR" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel"><strong>Agregar Area</strong></h4>
                            </div>
                            <div class="modal-body">
                                <form method="post" enctype="multipart/form-data" class="form-horizontal" id="newArea">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="padre" value="">
                                    <div class="container-fluid" id="contdpto">
                                        <div class="row">
                                            <div id="dpto">
                                               <div class="col-md-8 col-md-offset-2">
                                                   <div class="form-group row">
                                                       <label for="nombreArea">Nombre del Area</label>
                                                       <input type="text" name="area"  class="form-control " id="nombreArea"/><i class="fa fa-briefcase" id="icdp1"></i>
                                                   </div>
                                               </div>
                                               <div class="col-md-8 col-md-offset-2">
                                                   <div class="form-group row">
                                                       <label for="statusArea">Estatus del Area</label><span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                       <select name="comboArea" class="form-control" id="statusArea">
                                                            <option value="">-</option>
                                                            <option value="1">ACTIVO</option>
                                                            <option value="0">INACTIVO</option>
                                                       </select><i class="fa fa-check" id="icdp2"></i>
                                                   </div>
                                               </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="bttnMd" id="btnSvArea">Guardar <i class="fa fa-floppy-o"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

    <!-- MODAL MODIFICAR AREAS -->
                <div class="modal fade" id="myModalARM" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel2"><strong>Modificar Area</strong></h4>
                            </div>
                            <div class="modal-body">
                                <form method="post" class="form-horizontal formUpdateReg" id="updateArea">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="padre">
                                    <input type="hidden" name="registro">
                                    <div class="container-fluid" id="contdpto">
                                        <div class="row">
                                            <div id="dptom">
                                                <div class="col-md-8 col-md-offset-2">
                                                    <div class="form-group row">
                                                        <label for="nomDptom_">Nombre del Area</label>
                                                        <input type="text" name="campoD" class="form-control descripcion" id="depText"/><i class="fa fa-briefcase " id="micdp1"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-md-offset-2">
                                                    <div class="form-group row">
                                                        <label for="stDptom_">Estatus del Area</label><span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                        <select name="campoE" class="form-control status" id="depStatus">
                                                            <option value="1">ACTIVO</option>
                                                            <option value="0">INACTIVO</option>
                                                        </select><i class="fa fa-check" id="micdp2"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" value="" id="MIndexD" name="MIndex">

                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="bttnMd" id="buttonUpdateAre">Guardar <i class="fa fa-floppy-o"></i></button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
<!--VENTANAS MODAL CARGOS -->
    <!-- MODAL AGREGAR CARGO -->
                <div class="modal fade" id="myModalCA" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel"><strong>Agregar Cargo</strong></h4>
                            </div>
                            <div class="modal-body">
                                <form method="post" enctype="multipart/form-data" class="form-horizontal" id="newCargo">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="padre">
                                    <input type="hidden" name="registro">
                                    <div class="container-fluid" id="contdpto">
                                        <div class="row">
                                            <div id="dpto">
                                               <div class="col-md-8 col-md-offset-2">
                                                   <div class="form-group row">
                                                       <label for="nombreCargo">Nombre del Cargo</label>
                                                       <input type="text"  name="cargo" class="form-control " id="nombreCargo"/><i class="fa fa-briefcase" id="icdp1"></i>
                                                   </div>
                                               </div>
                                               <div class="col-md-8 col-md-offset-2">
                                                   <div class="form-group row">
                                                       <label for="statusCargo">Estatus del Cargo</label><span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                       <select name="comboCargo" class="form-control" id="statusCargo">
                                                            <option value="">-</option>
                                                            <option value="1">ACTIVO</option>
                                                            <option value="0">INACTIVO</option>
                                                       </select><i class="fa fa-check" id="icdp2"></i>
                                                   </div>
                                               </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="bttnMd" id="btnSvCargo">Guardar <i class="fa fa-floppy-o"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

    <!-- MODAL MODIFICAR CARGOS -->
                <div class="modal fade" id="myModalCAM" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel2"><strong>Modificar Cargo</strong></h4>
                            </div>
                            <div class="modal-body">
                                <form method="post" class="form-horizontal formUpdateReg" id="updateCargo" =>
                                    {{ csrf_field() }}
                                    <input type="hidden" name="padre">
                                    <input type="hidden" name="registro">
                                    <div class="container-fluid" id="contdpto">
                                        <div class="row">
                                            <div id="dptom">
                                                <div class="col-md-8 col-md-offset-2">
                                                    <div class="form-group row">
                                                        <label for="nomDptom_">Nombre del Cargo</label>
                                                        <input type="text" name="campoD" class="form-control descripcion" id="depText"/><i class="fa fa-briefcase " id="micdp1"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-md-offset-2">
                                                    <div class="form-group row">
                                                        <label for="stDptom_">Estatus del Cargo</label><span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                        <select name="campoE" class="form-control status" id="depStatus">
                                                            <option value="1">ACTIVO</option>
                                                            <option value="0">INACTIVO</option>
                                                        </select><i class="fa fa-check" id="micdp2"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" value="" id="MIndexD" name="MIndex">

                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="bttnMd" id="buttonUpdateCar">Guardar <i class="fa fa-floppy-o"></i></button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
    @endsection

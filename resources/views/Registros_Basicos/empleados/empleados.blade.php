@extends('admin.basesys')
    @section('contenido')
        @section('title')
            Registro Empleado
        @endsection
            @include('layout/header')
                @include('layout/sidebar')
                    <div class="contenido">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-2 ttlp">
                                    <h1>Empleados</h1>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-5 col-sm-5 col-md-6 col-md-offset-3" style=""> 
                                <button id="btnAdd" type="button" class="btnAdc col-md-offset-11" data-toggle="modal" data-target="#myModal" href="#myModal"><i class="fa fa-plus"></i> AGREGAR</button>
                            @for($i=0; $i < 5; $i++)
                                <div class="contMd" style="">
                                    <div class="icl">
                                        @for($j=0; $j < 5; $j++)
                                            <button class="btnAcc" type="submit">Modificar</button>
                                        @endfor
                                    </div>
                                <p class="ttlMd"><strong>REGISTRO</strong></p>
                                </div>
                            @endfor
                        </div>
                        <!--    Registro -->


                        <!-- Modal -->
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Agregar Empleado</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form action="">
                                            {{ csrf_field() }}
                                            <ul class="nav nav-tabs" role="tablist">
                                                <li role="presentation" class="active"><a href="#dbe1" aria-controls="dbe1" role="tab" data-toggle="tab">Datos básic. Prim.</a></li>
                                                <li role="presentation"><a href="#dbe2" aria-controls="dbe2" role="tab" data-toggle="tab">Datos básic. Sec.</a></li>
                                                <li role="presentation"><a href="#dhe" aria-controls="dhe" role="tab" data-toggle="tab">Dir. de Habitación</a></li>
                                                <li role="presentation"><a href="#ctoe" aria-controls="ctoe" role="tab" data-toggle="tab">Contactos</a></li>
                                            </ul>
                                            <div class="container-fluid">
                                                <div class="tab-content">
                                                    <div role="tabpanel" class="tab-pane active" id="dbe1">
                                                        <div class="container-fluid" id="contdbe1">
                                                            <div class="form-group row" id="rEmp1">
                                                                <div class="col-md-6">
                                                                    <label for="nomEmp1">1er Nombre</label>
                                                                    <input type="text" name="nomEmp1" class="form-control" id="nomEmp1"><i class="fa fa-user"></i>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="nomEmp2">2do Nombre</label>
                                                                    <input type="text" name="nomEmp2" class="form-control" id="nomEmp2"><i class="fa fa-user-plus"></i>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row" id="rEmp2">
                                                                <div class="col-md-6">
                                                                    <label for="apellEmp1">1er Apellido</label>
                                                                    <input type="text" name="apellEmp1" class="form-control" id="apellEmp1"><i class="fa fa-user"></i>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="apellEmp2">2do Apellido</label>
                                                                    <input type="text" name="apellEmp2" class="form-control" id="apellEmp2"><i class="fa fa-user-plus"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div role="tabpanel" class="tab-pane" id="dbe2">
                                                        <div class="container-fluid" id="contdbe2">
                                                            <div class="form-group row" id="rEmp3">
                                                                <div class="col-md-6">
                                                                    <label for="rifEmp">Rif</label>
                                                                    <br>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="ciEmp">Documento de identidad</label>
                                                                    <br>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <select name="rifEmp" class="form-control" id="selRifEmp">
                                                                        <option value="0">-</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <input type="tel" class="form-control" name="rifEmp" id="numRifEmp"><i class="fa fa-address-card"></i>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <select name="ciEmp" class="form-control" id="selCiEmp">
                                                                        <option value="0">-</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <input type="tel" class="form-control" name="ciEmp" id="numCiEmp"><i class="fa fa-id-badge"></i>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row" id="rEmp4">
                                                                <div class="col-md-6">
                                                                    <label for="fnEmp">Fecha de nacimiento</label>
                                                                    <input type="date" name="fnEmp" class="form-control" id="fnEmp"><i class="fa fa-calendar"></i>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="cgoEmp">Cargo</label>
                                                                    <select name="cgoEmp" class="form-control" id="cgoEmp">
                                                                        <option value="0">-</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div role="tabpanel" class="tab-pane" id="dhe">
                                                        <div class="container-fluid" id="contdhe">
                                                            <div class="form-group row" id="rEmp5">
                                                                <div class="col-md-6">
                                                                    <label for="pdhe">País</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="rgdhe">Región</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <select name="pdhe" class="form-control" id="pdhe">
                                                                        <option value="0">-</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <select name="rgdhe" class="form-control" id="rgdhe">
                                                                        <option value="0">-</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row" id="rEmp6">
                                                                <div class="col-md-6">
                                                                    <label for="edodhe">Estado</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="mundhe">Municipio</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <select name="edodhe" class="form-control" id="edodhe">
                                                                        <option value="0">-</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <select name="mundhe" class="form-control" id="mundhe">
                                                                        <option value="0">-</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row" id="rEmp7">
                                                                <div class="col-md-12">
                                                                    <label for="descpdhe">Descripcion de la dirección</label>
                                                                    <input type="text" name="descpdhe" class="form-control" id="descpdhe"><i class="fa fa-map-marker"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div role="tabpanel" class="tab-pane" id="ctoe">
                                                        <div class="form-group row" id="rEmp8">
                                                            <div class="col-md-6">
                                                                <label for="tlflcle">Teléfono Local</label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="tlfmvle">Teléfono Móvil</label>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <select name="tlflcle" class="form-control" id="tlflcle">
                                                                    <option value="0">-</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input type="tel" class="form-control" id="numtlflcle"><i class="fa fa-phone"></i>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <select name="tlfmvle" class="form-control" id="tlfmvle">
                                                                    <option value="0">-</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input type="tel" class="form-control" id="numtlfmvle"><i class="fa fa-mobile"></i>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row" id="rEmp9">
                                                            <div class="col-md-12">
                                                                <label for="maile">Correo Electrónico</label>
                                                                <input type="text" name="maile" class="form-control" id="maile"><i class="fa fa-envelope"></i>
                                                            </div>
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
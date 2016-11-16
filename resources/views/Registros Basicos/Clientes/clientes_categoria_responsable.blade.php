@extends('admin.basesys')
    @section('contenido')
        @section('title')
            Registro Categoría - Responsable
        @endsection
            @include('layout/header')
                @include('layout/sidebar')
                <div class="contenido">
                    <div class="col-xs-5 col-sm-5 col-md-6 col-md-offset-3" style=""> 
                        <button id="btnAdd" type="button" class="btnAd col-md-offset-10" data-toggle="modal" data-target="#myModal" href="#myModal">AGREGAR <i class="fa fa-plus-circle"></i></button>
                        @for($i=0; $i < 5; $i++)
                            <div class="contMd" style="">
                                @for($j=0; $j < 5; $j++)
                                    <button class="btnAcc" type="submit">Modificar</button>
                                @endfor
                                <p class="ttlMd"><strong>REGISTRO</strong></p>
                            </div>
                        @endfor
                    </div>
                    <!--Registro -->


                    <!-- Modal -->
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Agregar Categoría - Responsable</h4>
                                </div>
                                <div class="modal-body">
                                    <form action="">
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li role="presentation" class="active"><a href="#dbr1" aria-controls="dbr1" role="tab" data-toggle="tab">Datos básicos Primarios</a></li>
                                            <li role="presentation"><a href="#dbr2" aria-controls="dbr2" role="tab" data-toggle="tab">Datos básicos Secundarios</a></li>
                                            <li role="presentation"><a href="#ctor" aria-controls="ctor" role="tab" data-toggle="tab">Contactos</a></li>
                                        </ul>
                                        <div class="container-fluid">
                                            <div class="tab-content">
                                                <div role="tabpanel" class="tab-pane active" id="dbr1">
                                                    <div class="container-fluid" id="contrpbdbr1">
                                                        <div class="form-group row" id="rRpb1">
                                                            <div class="col-md-6">
                                                                <label for="nomRpb1">1er Nombre</label>
                                                                <input type="text" name="nomRpb1" class="form-control" id="nomRpb1"><i class="fa fa-user"></i>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="nomRpb2">2do Nombre</label>
                                                                <input type="text" name="nomRpb2" class="form-control" id="nomRpb2"><i class="fa fa-user-plus"></i>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row" id="rRpb2">
                                                            <div class="col-md-6">
                                                                <label for="apellRpb1">1er Apellido</label>
                                                                <input type="text" name="apellRpb1" class="form-control" id="apellRpb1"><i class="fa fa-user"></i>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="apellRpb2">2do Apellido</label>
                                                                <input type="text" name="apellRpb2" class="form-control" id="apellRpb2"><i class="fa fa-user-plus"></i>
                                                            </div> 
                                                        </div>
                                                    </div>
                                                </div>
                                                <div role="tabpanel" class="tab-pane" id="dbr2">
                                                    <div class="container-fluid" id="contrpbdbr2">
                                                        <div class="form-group row" id="rRpb3">
                                                            <div class="col-md-6">
                                                                <label for="rifRpb">Rif</label>
                                                                <br>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="rifRpb">Documento de identidad</label>
                                                                <br>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <select name="selRifRpb" class="form-control" id="selRifRpb">
                                                                    <option value="0">-</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input type="tel" class="form-control" id="numRifRpb"><i class="fa fa-address-card"></i>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <select name="selCiRpb" class="form-control" id="selCiRpb">
                                                                    <option value="0">-</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input type="tel" class="form-control" id="numCiRpb"><i class="fa fa-id-badge"></i>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row" id="rRpb4">
                                                            <div class="col-md-6">
                                                                <label for="fnRpb">Fecha de nacimiento</label>
                                                                <input type="date" name="fnRpb" class="form-control" id="fnRpb"><i class="fa fa-calendar"></i>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="cgoRpb">Cargo</label>
                                                                <select name="cgoRpb" class="form-control" id="cgoRpb">
                                                                    <option value="0">-</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div role="tabpanel" class="tab-pane" id="ctor">
                                                    <div class="container-fluid" id="contrpbctor">
                                                        <div class="form-group row" id="rRpb5">
                                                            <div class="col-md-6">
                                                                <label for="telclRpb">Teléfono Local</label>
                                                                <br>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="telmvlRpb">Teléfono Móvil</label>
                                                                <br>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <select name="selTelclRpb" class="form-control" id="selTelclRpb">
                                                                    <option value="0">-</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input type="tel" class="form-control" id="numTelclRpb"><i class="fa fa-phone"></i>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <select name="selTelmvlRpb" class="form-control" id="selTelmvlRpb">
                                                                    <option value="0">-</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input type="tel" class="form-control" id="numTelmvlRpb"><i class="fa fa-mobile"></i>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row" id="rRpb6">
                                                            <label for="mailRpb">Correo Electrónico</label>
                                                            <input type="text" name="mailRpb" class="form-control" id="mailRpb"><i class="fa fa-envelope"></i>
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
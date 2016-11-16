@extends('admin.basesys')
    @section('contenido')
        @section('title')
            Registro Sucursales
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
                                        <h4 class="modal-title" id="myModalLabel">Agregar Sucursales</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form action="">
                                            <div class="container-fluid">
                                                <div class="form-group row">
                                                    <div class="col-md-6 col-md-offset-6" align="right">
                                                        <input type="checkbox" name="cbSuc" id="cbSuc">
                                                        <label for="chbSuc">Heredar datos del Cliente Matriz</label>
                                                    </div>
                                                </div>
                                                <ul class="nav nav-tabs" role="tablist">
                                                    <li role="presentation" class="active"><a href="#dbs" aria-controls="dbs" role="tab" data-toggle="tab">Datos básicos</a></li>
                                                    <li role="presentation"><a href="#dfs" aria-controls="dfs" role="tab" data-toggle="tab">Dirección Fiscal</a></li>
                                                    <li role="presentation"><a href="#dcs" aria-controls="dcs" role="tab" data-toggle="tab">Dirección Comercial</a></li>
                                                    <li role="presentation"><a href="#ctos" aria-controls="ctos" role="tab" data-toggle="tab">Contactos</a></li>
                                                </ul>
                                            </div>
                                            <div class="container-fluid">
                                                <div class="tab-content">

                                                    <div role="tabpanel" class="tab-pane active" id="dbs">
                                                        <div class="container-fluid" id="contdbs">
                                                            <div class="form-group row" id="rDbs1">
                                                                <div class="col-md-6">
                                                                    <label for="rss">Razon Social:</label>
                                                                    <input type="text" name="rss" class="form-control" id="rss"><i class="fa fa-university"></i>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="ncs">Nombre Comercial:</label>
                                                                    <input type="text" name="ncs" class="form-control" id="ncs"><i class="fa fa-building"></i>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row" id="rDbs2">
                                                                <div class="col-md-6">
                                                                    <label for="selRifs">Rif</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="tpcs">Tipo de Contribuyente</label>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <select name="selRifs" class="form-control" id="selRifs">
                                                                        <option value="0">-</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <input type="tel" class="form-control" id="numRifs"><i class="fa fa-address-card"></i>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <select name="tpcs" class="form-control" id="tpcs">
                                                                        <option value="0">-</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div role="tabpanel" class="tab-pane" id="dfs">
                                                        <div class="container-fluid" id="contdfs">
                                                            <div class="form-group row" id="rDfs1">
                                                                <div class="col-md-6">
                                                                    <label for="pdfs">País</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="rgdfs">Región</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <select name="pdfs" class="form-control" id="pdfs">
                                                                        <option value="0">-</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <select name="rgdfs" class="form-control" id="rgdfs">
                                                                        <option value="0">-</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row" id="rDfs2">
                                                                <div class="col-md-6">
                                                                    <label for="edodfs">Estado</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="mundfs">Municipio</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <select name="edodfs" class="form-control" id="edodfs">
                                                                        <option value="0">-</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <select name="mundfs" class="form-control" id="mundfs">
                                                                        <option value="0">-</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row" id="rDfs3">
                                                                <div class="col-md-12">
                                                                    <label for="descpdfs">Descripcion de la direccion</label>
                                                                    <input type="text" name="descpdfs" class="form-control" id="descpdfs"><i class="fa fa-map-marker"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div role="tabpanel" class="tab-pane" id="dcs">
                                                        <div class="container-fluid" id="contdcs">
                                                            <div class="form-group row" id="rDcs1">
                                                                <div class="col-md-6">
                                                                    <label for="pdcs">País</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="rgdcs">Región</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <select name="pdcs" class="form-control" id="pdcs">
                                                                        <option value="0">-</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <select name="rgdcs" class="form-control" id="rgdcs">
                                                                        <option value="0">-</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row" id="rDcs2">
                                                                <div class="col-md-6">
                                                                    <label for="edodcs">Estado</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="mundcs">Municipio</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <select name="edodcs" class="form-control" id="edodcs">
                                                                        <option value="0">-</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <select name="mundcs" class="form-control" id="mundcs">
                                                                        <option value="0">-</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row" id="rDcs3">
                                                                <div class="col-md-12">
                                                                    <label for="descpdcs">Descripcion de la direccion</label>
                                                                    <input type="text" name="descpdcs" class="form-control" id="descpdcs"><i class="fa fa-map-marker"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div role="tabpanel" class="tab-pane" id="ctos">
                                                        <div class="container-fluid" id="contctos">
                                                            <div class="form-group row" id="rCtos1">
                                                                <div class="col-md-6">
                                                                    <label for="tlflcls">Teléfono Local</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="tlfmvls">Teléfono Móvil</label>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <select name="tlflcls" class="form-control" id="tlflcls">
                                                                        <option value="0">-</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <input type="tel" class="form-control" id="numtlflcls"><i class="fa fa-phone"></i>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <select name="tlfmvls" class="form-control" id="tlfmvls">
                                                                        <option value="0">-</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <input type="tel" class="form-control" id="numtlfmvls"><i class="fa fa-mobile"></i>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row" id="rCtos2">
                                                                <div class="col-md-12">
                                                                    <label for="mails">Correo Electrónico</label>
                                                                    <input type="text" name="mails" class="form-control" id="mails"><i class="fa fa-envelope"></i>
                                                                </div>
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
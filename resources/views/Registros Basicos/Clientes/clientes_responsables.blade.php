@extends('admin.basesys')
    @section('contenido')
        @section('title')
            Registro Responsable - Cliente
        @endsection
            @include('layout/header')
                @include('layout/sidebar')
                    <div class="contenido">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-3 ttlp">
                                    <h1>Cliente - Responsable</h1>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xs-5 col-sm-5 col-md-6 col-md-offset-3" style=""> 
                        @if($agregar)
                            <button id="btnAdd" type="button" class="btnAd col-md-offset-11" data-toggle="modal" data-target="#myModal" href="#myModal"><i class="fa fa-plus"></i> AGREGAR</button>
                        @endif 
                                <div class="contMd" style="">
                                    @foreach($acciones as $accion)
                                          @if($accion->descripcion!="Status")
                                            <span style="display: inline-block; float: right;"><a href="{{$accion->url}}"><i class="{{$accion->clase_css}}"></i></a></span>
                                          @elseif($accion->descripcion=="Status")
                                                 @if($accion->status_ac==1)
                                                     <input type="checkbox" class="btnAcc" name="status" value="{{$accion->status_ac}}" checked>
                                            
                                                 @elseif($accion->staus_ac==0)
                                                     <input type="checkbox" class="btnAcc" name="status" value="{{$accion->status_ac}}" >
                                                 @endif


                                          @endif
                                    @endforeach
                                    <p class="ttlMd"><strong>REGISTRO</strong></p>
                                </div>
                   
                        </div>
                        <!-- 	Registro -->


                        <!-- Modal -->
                        @if($agregar)
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Agregar Responsable - Cliente</h4>
                                    </div>
                                    
                                        <form method="post" class="form-horizontal Validacion" action="">
                                        <div class="modal-body">
                                            <ul class="nav nav-tabs" role="tablist">
                                                <li role="presentation" class="active"><a href="#dbr1" aria-controls="dbr1" role="tab" data-toggle="tab" style="display:;">Datos básicos Primarios</a></li>
                                                <li role="presentation"><a href="#dbr2" aria-controls="dbr2" role="tab" data-toggle="tab" style="display:;">Datos básicos Secundarios</a></li>
                                                <li role="presentation"><a href="#ctor" aria-controls="ctor" role="tab" data-toggle="tab" style="display:;">Contactos</a></li>
                                            </ul>
                                            <div class="container-fluid">
                                                <div class="tab-content">
                                                    <div role="tabpanel" class="tab-pane active">
                                                        <div class="container-fluid" id="dbr1">
                                                            <center><u><p>DATOS BASICOS PRIMARIOS</p></u></center>
                                                            <br>
                                                        </div>
                
                                                    <div role="tabpanel" class="tab-pane" id="dbr2">
                                                    <center><u><p>DATOS BASICOS SECUNDARIOS</p></u></center>
                                                    <br>
                                                    <div class="container-fluid" id="contrpbdbr3">
                                                        <div class="col-md-12">
                                                                <div class="col-md-6">                                                            
                                                                <div class="col-md-12">
                                                                    <label for="rifRpb">Rif</label>
                                                                    <br>
                                                                </div>
                                                                <div class="col-md-5">
                                                                <div class="form-group" id="rRpb3">
                                                                    <select name="selRifRpb" class="form-control userEmail" id="selRifRpb">
                                                                        <option value="">-</option>
                                                                        <option value="1">G</option>
                                                                    </select>
                                                                </div>
                                                                </div>
                                                                <div class="col-md-7">
                                                                <div class="form-group" id="rRpb3">                                                
                                                                    <input type="text" class="form-control userEmail" name="numRifRpb"><i class="fa fa-address-card"></i>
                                                                </div>
                                                                </div>
                                                                </div>
                                                                <div class="col-md-6">                                                            
                                                                <div class="col-md-12">
                                                                    <label for="rifRpb">Documento de identidad</label>
                                                                    <br>
                                                                </div>
                                                                <div class="col-md-5">
                                                                <div class="form-group" id="rRpb3">
                                                                    <select name="selciRpb" class="form-control userEmail" id="selciRpb">
                                                                        <option value="">-</option>
                                                                        <option value="1">G</option>
                                                                    </select>
                                                                </div>
                                                                </div>
                                                                <div class="col-md-7">
                                                                <div class="form-group" id="rRpb3">                                                
                                                                    <input type="text" class="form-control userEmail" name="txtci"><i class="fa fa-id-badge"></i>
                                                                </div>
                                                                </div>
                                                                </div>                                                               
                                                            </div>
                                                            <div class="col-md-6">
                                                            <div class="form-group row" id="rRpb4">
                                                                
                                                                    <label for="fnRpb">Fecha de nacimiento</label>
                                                                    <input type="date" name="fnRpb" class="form-control userEmail" id="fnRpb"><i class="fa fa-calendar"></i>
                                                                </div>
                                                                </div><div class="col-md-5 col-md-offset-1">
                                                                <div class="form-group row" id="rRpb4">
                                                                
                                                                    <label for="cgoRpb">Cargo</label>
                                                                    <select name="cgoRpb" class="form-control userEmail" id="cgoRpb">
                                                                        <option value="">-</option>
                                                                        <option value="1">caracas</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div role="tabpanel" class="tab-pane" id="ctor">
                                                    <center><u><p>CONTACTOS</p></u></center>
                                                    <br>
                                                        <div class="col-md-6">                                                            
                                                                <div class="col-md-12">
                                                                    <label for="rifRpb">Telefono movil</label>
                                                                    <br>
                                                                </div>
                                                                <div class="col-md-5">
                                                                <div class="form-group" id="rRpb3">
                                                                    <select name="selRifRpb" class="form-control userEmail" id="selRifRpb">
                                                                        <option value="">-</option>
                                                                        <option value="1">0414</option>
                                                                    </select>
                                                                </div>
                                                                </div>
                                                                <div class="col-md-7">
                                                                <div class="form-group" id="rRpb3">                                                
                                                                    <input type="text" class="form-control userEmail" name="numTelclRpb"><i class="fa fa-address-card"></i>
                                                                </div>
                                                                </div>
                                                                </div>
                                                                <div class="col-md-6">                                                            
                                                                <div class="col-md-12">
                                                                    <label for="rifRpb">Telefono fijo</label>
                                                                    <br>
                                                                </div>
                                                                <div class="col-md-5">
                                                                <div class="form-group" id="rRpb3">
                                                                    <select name="selRifRpb" class="form-control userEmail" id="selRifRpb">
                                                                        <option value="">-</option>
                                                                        <option value="1">0212</option>
                                                                    </select>
                                                                </div>
                                                                </div>
                                                                <div class="col-md-7">
                                                                <div class="form-group" id="rRpb3">                                                
                                                                    <input type="text" class="form-control userEmail" name="numTelmvlRpb"><i class="fa fa-address-card"></i>
                                                                </div>
                                                                </div>
                                                                </div>
                                                                <div class="form-group col-md-12 ">
                                                                
                                                                    <label for="mail">Correo Electrónico</label>
                                                                    <input type="text" name="mail2" id="" class="form-control userEmail">
                                                                    <i class="fa fa-envelope"></i>
                                                                
                                                            </div>
                                                    </div>
                                                </div>
                                            </div> 
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="bttnMd" id="btnSv">Guardar <i class="fa fa-floppy-o"></i></button>
                                                <button type="button" class="bttnMd" data-dismiss="modal" id="btnCs">Cerrar <i class="fa fa-times"></i></button>
                                            </div>
                                        </form>
                                   
                                    
                                </div>
                            </div>
                        </div>
                     @endif   
                    </div>   
    @endsection
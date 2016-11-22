@extends('admin.basesys')
    @section('contenido')
        @section('title')
            Registro Categoría - Responsable
        @endsection
            @include('layout/header')
                @include('layout/sidebar')
                <div class="contenido">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4 ttlp">
                                <h1>Categoría - Responsable</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-5 col-sm-5 col-md-6 col-md-offset-3" style=""> 
                    @if($agregar)
                        <div class="container">
                            <div class="row">
                                <div class="col-md-2" align="left">
                                    <button id="btnBk" type="button" class="btnBk" href="#"><i class="fa fa-chevron-left"></i> VOLVER</button>
                                </div>
                                <div class="col-md-offset-8">
                                    <button id="btnAdd" type="button" class="btnAd" data-toggle="modal" data-target="#myModal" href="#myModal"><i class="fa fa-plus"></i> AGREGAR</button> 
                                </div>
                            </div>
                        </div>
                    @endif
                            <div class="contMd" style="">
                               <div class="icl">
                                   @foreach($acciones as $accion)
                                       @if($accion->descripcion!="Status")
                                           @if($accion->data_toogle=="modal")
                                           <span class="iclsp">
                                               <a href="#myModal2" class="tltp" data-ttl="{{$accion->descripcion}}" data-toggle="modal" data-target="#myModal2">
                                                   <i class="{{$accion->clase_css}}"></i>
                                               </a>
                                           </span>
                                           @elseif($accion->data_toogle!="modal")
                                           <span class="iclsp">
                                               <a href="{{$accion->url}}" class="tltp" data-ttl="{{$accion->descripcion}}">
                                                   <i class="{{$accion->clase_css}}"></i>
                                               </a>
                                           </span>
                                           @endif
                                       @elseif($accion->descripcion=="Status")
                                           @if($accion->status_ac==1)
                                           <div class="chbx">
                                               <input type="checkbox" class="btnAcc" name="status" id="inchbx1" value="{{$accion->status_ac}}" checked><label for="inchbx1" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
                                           </div>
                                           @elseif($accion->staus_ac==0)
                                               <div class="chbx">
                                                   <input type="checkbox" class="btnAcc" name="status" id="inchbx2" value="{{$accion->status_ac}}"><label for="inchbx2" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
                                               </div>
                                           @endif
                                       @endif
                                   @endforeach
                               </div>
                                <p class="ttlMd"><strong>REGISTRO</strong></p>
                            </div>
                      
                    </div>
                    <!--Registro -->


                    <!-- Modal -->
                    @if($agregar)
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Agregar Categoría - Responsable</h4>
                                </div>
                                
                                <form method="post" class="form-horizontal Validacion" action="">
                                        {{ csrf_field() }}
                                        <div class="modal-body">
                                            <ul class="nav nav-tabs not-active" role="tablist" >
                                                <li role="presentation" class="active"><a href="#dbrc1" id="a1" aria-controls="dbrc1" role="tab" data-toggle="tab">Datos básicos Primarios</a></li>
                                                <li role="presentation"><a href="#dbrc2" id="a2" aria-controls="dbrc2" role="tab" data-toggle="tab">Datos básicos Secundarios</a></li>
                                                <li role="presentation"><a href="#ctorc" id="a3" aria-controls="ctor3" role="tab" data-toggle="tab" >Contactos</a></li>
                                            </ul>
                                            <div class="container-fluid">
                                                <div class="tab-content">
                                                    <div role="tabpanel" class="tab-pane active" id="dbrc1">
                                                    <br>
                                                        <div class="row" id="contrpbdbrc1">                                            
                                                            <div class="col-md-5  col-md-offset-1">
                                                                <div class="form-group" id="rRpb1">
                                                                    <label for="nomRpb1">1er Nombre</label>
                                                                    <input type="text" name="nomRpb1" class="form-control userEmail" id="input1"><i class="fa fa-user"></i>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4  col-md-offset-1">
                                                                <div class="form-group" id="rRpb2">    
                                                                
                                                                    <label for="nomRpb2">2do Nombre</label>
                                                                    <input type="text" name="nomRpb2" class="form-control userEmail" id="input2"><i class="fa fa-user-plus"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row" id="contrpbdbr2">   
                                                            <div class="col-md-5  col-md-offset-1">
                                                                <div class="form-group" id="rRpb3">
                                                                
                                                                    <label for="apellRpb1">1er Apellido</label>
                                                                    <input type="text" name="apellRpb1" class="form-control userEmail" id="input3"><i class="fa fa-user"></i>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 col-md-offset-1">
                                                                <div class="form-group" id="rRpb4">                                               
                                                                    <label for="apellRpb2">2do Apellido</label>
                                                                    <input type="text" name="apellRpb2" class="form-control userEmail" id="input4"><i class="fa fa-user-plus"></i>
                                                                </div> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div role="tabpanel" class="tab-pane" id="dbr2">
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
                                                                    <select name="selRifRpb" class="form-control userEmail" id="input5">
                                                                        <option value="">-</option>
                                                                        <option value="1">G</option>
                                                                    </select>
                                                                </div>
                                                                </div>
                                                                <div class="col-md-7">
                                                                <div class="form-group" id="rRpb3">                                                
                                                                    <input type="text" class="form-control typeRifNumber" name="numRifRpb" id="input6"><i class="fa fa-address-card"></i>
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
                                                                    <select name="selciRpb" class="form-control userEmail" id="input7">
                                                                        <option value="">-</option>
                                                                        <option value="1">G</option>
                                                                    </select>
                                                                </div>
                                                                </div>
                                                                <div class="col-md-7">
                                                                <div class="form-group" id="rRpb3">                                                
                                                                    <input type="text" class="form-control typeCiNumber" name="txtci" id="input8"><i class="fa fa-id-badge"></i>
                                                                </div>
                                                                </div>
                                                                </div>                                                               
                                                            </div>
                                                            <div class="col-md-6">
                                                            <div class="form-group row" id="rRpb4">
                                                                
                                                                    <label for="fnRpb">Fecha de nacimiento</label>
                                                                    <input type="date" name="fnRpb" class="form-control userEmail" id="input9"><i class="fa fa-calendar"></i>
                                                                </div>
                                                                </div><div class="col-md-5 col-md-offset-1">
                                                                <div class="form-group row" id="rRpb4">
                                                                
                                                                    <label for="cgoRpb">Cargo</label>
                                                                    <select name="cgoRpb" class="form-control userEmail" id="input10">
                                                                        <option value="">-</option>
                                                                        <option value="1">caracas</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div role="tabpanel" class="tab-pane" id="ctor">
                                                    <br>
                                                        <div class="col-md-6">                                                            
                                                                <div class="col-md-12">
                                                                    <label for="rifRpb">Telefono movil</label>
                                                                    <br>
                                                                </div>
                                                                <div class="col-md-6">
                                                                <div class="form-group" id="rRpb3">
                                                                    <select name="selRifRpb" class="form-control userEmail" id="input11">
                                                                        <option value="">-</option>
                                                                        <option value="1">0414</option>
                                                                    </select>
                                                                </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                <div class="form-group" id="rRpb3">                                                
                                                                    <input type="text" class="form-control typeTlfNumber" name="numTelclRpb" id="input12"><i class="fa fa-address-card"></i>
                                                                </div>
                                                                </div>
                                                                </div>
                                                                <div class="col-md-6">                                                            
                                                                <div class="col-md-12">
                                                                    <label for="rifRpb">Telefono fijo</label>
                                                                    <br>
                                                                </div>
                                                                <div class="col-md-6">
                                                                <div class="form-group" id="rRpb3">
                                                                    <select name="selRifRpb" class="form-control userEmail" id="input13">
                                                                        <option value="">-</option>
                                                                        <option value="1">0212</option>
                                                                    </select>
                                                                </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                <div class="form-group" id="rRpb3">                                                
                                                                    <input type="text" class="form-control typeTlfNumber" name="numTelmvlRpb" id="input14"><i class="fa fa-address-card"></i>
                                                                </div>
                                                                </div>
                                                                </div>
                                                                <div class="form-group col-md-12 ">
                                                                
                                                                    <label for="mail">Correo Electrónico</label>
                                                                    <input type="text" name="mail2" id="input15" class="form-control typeEmail">
                                                                    <i class="fa fa-envelope"></i>
                                                                
                                                            </div>
                                                    </div>
                                                </div>
                                            </div> 
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="bttnMd" id="btnAn">Anterior <i class="fa fa-times"></i></button>
                                                <button type="button" class="bttnMd" id="btnResp">Siguiente <i class="fa fa-hand-o-right"></i></button>
                                            </div>
                                        </form>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>   
    @endsection
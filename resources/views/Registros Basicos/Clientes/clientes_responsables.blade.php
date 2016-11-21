@extends('admin.basesys')
    @section('contenido')
        @section('title')
            Registro Cliente - Responsable
        @endsection
            @include('layout/header')
                @include('layout/sidebar')
                    <div class="contenido">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-4 ttlp">
                                    <h1>Cliente - Responsable</h1>
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
                                    <div class="col-md-2 col-md-offset-3" align="center">
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
                                            <ul class="nav nav-tabs hidden" role="tablist">
                                                <li role="presentation" class="active"><a href="#dbr1" aria-controls="dbr1" role="tab" data-toggle="tab">Datos básicos Primarios</a></li>
                                                <li role="presentation"><a href="#dbr2" aria-controls="dbr2" role="tab" data-toggle="tab">Datos básicos Secundarios</a></li>
                                                <li role="presentation"><a href="#ctor" aria-controls="ctor" role="tab" data-toggle="tab">Contactos</a></li>
                                            </ul>
                                            <div class="container-fluid">
                                                <div class="tab-content">
                                                    <div role="tabpanel" class="tab-pane active" id="dbr1">
                                                        <div class="container-fluid" id="contrpbdbr1">
                                                            <center><u><p>DATOS BASICOS PRIMARIOS</p></u></center>
                                                            <br>
                                                            <div class="row">                                            
                                                                <div class="col-md-5  col-md-offset-1" id="rRpb1">
                                                                    <div class="form-group">
                                                                        <label for="nomRpb1">1er Nombre</label>
                                                                        <input type="text" name="nomRpb1" class="form-control userEmail" id="input1"><i class="fa fa-user" id="icr1"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-5  col-md-offset-1" id="rRpb2">
                                                                    <div class="form-group">    
                                                                        <label for="nomRpb2">2do Nombre</label>
                                                                        <input type="text" name="nomRpb2" class="form-control userEmail" id="input2"><i class="fa fa-user-plus" id="icr2"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">   
                                                                <div class="col-md-5  col-md-offset-1" id="rRpb3">
                                                                    <div class="form-group">
                                                                        <label for="apellRpb1">1er Apellido</label>
                                                                        <input type="text" name="apellRpb1" class="form-control userEmail" id="input3"><i class="fa fa-user" id="icr3"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-5 col-md-offset-1" id="rRpb4">
                                                                    <div class="form-group">  
                                                                        <label for="apellRpb2">2do Apellido</label>
                                                                        <input type="text" name="apellRpb2" class="form-control userEmail" id="input4"><i class="fa fa-user-plus" id="icr4"></i>
                                                                    </div> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div role="tabpanel" class="tab-pane" id="dbr2">
                                                    <div class="container-fluid" id="contrpbdbr2">
                                                        <center><u><p>DATOS BASICOS SECUNDARIOS</p></u></center>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-8 col-md-offset-2" id="rRpb5">
                                                                    <div class="col-md-12" id="sp1">
                                                                        <label for="rifRpb">Rif</label>
                                                                    </div>
                                                                    <div class="col-md-5">
                                                                        <div class="form-group">
                                                                            <select name="selRifRpb" class="form-control userEmail" id="selRifRpb">
                                                                                <option value="">-</option>
                                                                                <option value="1">G</option>
                                                                            </select><i class="fa fa-clipboard" id="icr5"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-7">
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control userEmail" name="numRifRpb"><i class="fa fa-address-card" id="icr6"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <div class="col-md-8 col-md-offset-2" id="rRpb6">
                                                                    <div class="col-md-12" id="sp2">
                                                                        <label for="rifRpb">Documento de identidad</label>
                                                                    </div>
                                                                    <div class="col-md-5">
                                                                        <div class="form-group">
                                                                            <select name="selciRpb" class="form-control userEmail" id="selciRpb">
                                                                                <option value="">-</option>
                                                                                <option value="1">G</option>
                                                                            </select><i class="fa fa-clipboard" id="icr7"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-7">
                                                                        <div class="form-group"> 
                                                                            <input type="text" class="form-control userEmail" name="txtci"><i class="fa fa-address-card-o" id="icr8"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>                                                               
                                                            </div>
                                                        <div class="col-md-8 col-md-offset-2" id="rRpb7">
                                                                <div class="form-group row">       
                                                                    <label for="fnRpb">Fecha de nacimiento</label>
                                                                    <input type="date" name="fnRpb" class="form-control userEmail" id="fnRpb"><i class="fa fa-calendar" id="icr9"></i>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-8 col-md-offset-2" id="rRpb8">
                                                                <div class="form-group row">    
                                                                    <label for="cgoRpb">Cargo</label>
                                                                    <select name="cgoRpb" class="form-control userEmail" id="cgoRpb">
                                                                        <option value="">-</option>
                                                                        <option value="1">caracas</option>
                                                                    </select><i class="fa fa-id-badge" id="icr10"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div role="tabpanel" class="tab-pane" id="ctor">
                                                        <div class="container-fluid" id="contrpbdbr3">
                                                            <center><u><p>CONTACTOS</p></u></center>
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-md-8 col-md-offset-2" id="rRpb9">                                     <div class="col-md-12">
                                                                        <label for="rifRpb">Telefono movil</label>
                                                                        <br>
                                                                    </div>
                                                                    <div class="col-md-5">
                                                                        <div class="form-group">
                                                                            <select name="selRifRpb" class="form-control userEmail" id="selRifRpb">
                                                                                <option value="">-</option>
                                                                                <option value="1">0414</option>
                                                                            </select><i class="fa fa-hashtag" id="icr11"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-7">
                                                                        <div class="form-group">     
                                                                            <input type="text" class="form-control userEmail" name="numTelclRpb"><i class="fa fa-mobile" id="icr12"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-8 col-md-offset-2" id="rRpb10">         <div class="col-md-12">
                                                                        <label for="rifRpb">Telefono fijo</label>
                                                                        <br>
                                                                    </div>
                                                                    <div class="col-md-5">
                                                                        <div class="form-group">
                                                                            <select name="selRifRpb" class="form-control userEmail" id="selRifRpb">
                                                                                <option value="">-</option>
                                                                                <option value="1">0212</option>
                                                                            </select><i class="fa fa-hashtag" id="icr13"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-7">
                                                                        <div class="form-group">           
                                                                            <input type="text" class="form-control userEmail" name="numTelmvlRpb"><i class="fa fa-phone" id="icr14"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <div class="col-md-8 col-md-offset-2" id="rRpb11">
                                                                    <label for="mail">Correo Electrónico</label>
                                                                    <input type="text" name="mail2" id="" class="form-control userEmail">
                                                                    <i class="fa fa-envelope" id="icr15"></i>
                                                                </div>
                                                            </div>
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
                     
                    <!--Modal Modificar-->
                        <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel2">Modificar Responsable - Cliente</h4>
                                    </div>

                                    <form method="post" class="form-horizontal Validacion" action="">
                                        <div class="modal-body">
                                            <ul class="nav nav-tabs hidden" role="tablist">
                                                <li role="presentation" class="active"><a href="#dbrm1" aria-controls="dbr1" role="tab" data-toggle="tab">Datos básicos Primarios</a></li>
                                                <li role="presentation"><a href="#dbrm2" aria-controls="dbr2" role="tab" data-toggle="tab">Datos básicos Secundarios</a></li>
                                                <li role="presentation"><a href="#ctorm" aria-controls="ctor" role="tab" data-toggle="tab">Contactos</a></li>
                                            </ul>
                                            <div class="container-fluid">
                                                <div class="tab-content">
                                                    <div role="tabpanel" class="tab-pane active" id="dbrm1">
                                                        <div class="container-fluid" id="contrpbdbrm1">
                                                            <center><u><p>DATOS BASICOS PRIMARIOS</p></u></center>
                                                            <br>
                                                            <div class="row">                                            
                                                                <div class="col-md-5  col-md-offset-1" id="rRpbm1">
                                                                    <div class="form-group">
                                                                        <label for="nomRpb1">1er Nombre</label>
                                                                        <input type="text" name="nomRpb1" class="form-control userEmail" id="input1"><i class="fa fa-user" id="micr1"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-5  col-md-offset-1" id="rRpbm2">
                                                                    <div class="form-group">    
                                                                        <label for="nomRpb2">2do Nombre</label>
                                                                        <input type="text" name="nomRpb2" class="form-control userEmail" id="input2"><i class="fa fa-user-plus" id="micr2"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">   
                                                                <div class="col-md-5  col-md-offset-1" id="rRpbm3">
                                                                    <div class="form-group">
                                                                        <label for="apellRpb1">1er Apellido</label>
                                                                        <input type="text" name="apellRpb1" class="form-control userEmail" id="input3"><i class="fa fa-user" id="micr3"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-5 col-md-offset-1" id="rRpbm4">
                                                                    <div class="form-group">  
                                                                        <label for="apellRpb2">2do Apellido</label>
                                                                        <input type="text" name="apellRpb2" class="form-control userEmail" id="input4"><i class="fa fa-user-plus" id="micr4"></i>
                                                                    </div> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div role="tabpanel" class="tab-pane" id="dbrm2">
                                                        <div class="container-fluid" id="contrpbdbrm2">
                                                            <center><u><p>DATOS BASICOS SECUNDARIOS</p></u></center>
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-md-8 col-md-offset-2" id="rRpbm5">
                                                                    <div class="col-md-12" id="spm1">
                                                                        <label for="rifRpb">Rif</label>
                                                                    </div>
                                                                    <div class="col-md-5">
                                                                        <div class="form-group">
                                                                            <select name="selRifRpb" class="form-control userEmail" id="selRifRpb">
                                                                                <option value="">-</option>
                                                                                <option value="1">G</option>
                                                                            </select><i class="fa fa-clipboard" id="micr5"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-7">
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control userEmail" name="numRifRpb"><i class="fa fa-address-card" id="micr6"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-8 col-md-offset-2" id="rRpbm6">
                                                                    <div class="col-md-12" id="spm2">
                                                                        <label for="rifRpb">Documento de identidad</label>
                                                                    </div>
                                                                    <div class="col-md-5">
                                                                        <div class="form-group">
                                                                            <select name="selciRpb" class="form-control userEmail" id="selciRpb">
                                                                                <option value="">-</option>
                                                                                <option value="1">G</option>
                                                                            </select><i class="fa fa-clipboard" id="micr7"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-7">
                                                                        <div class="form-group"> 
                                                                            <input type="text" class="form-control userEmail" name="txtci"><i class="fa fa-address-card-o" id="micr8"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>                                                               
                                                            </div>
                                                            <div class="col-md-8 col-md-offset-2" id="rRpbm7">
                                                                <div class="form-group row">       
                                                                    <label for="fnRpb">Fecha de nacimiento</label>
                                                                    <input type="date" name="fnRpb" class="form-control userEmail" id="fnRpb"><i class="fa fa-calendar" id="micr9"></i>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-8 col-md-offset-2" id="rRpbm8">
                                                                <div class="form-group row">    
                                                                    <label for="cgoRpb">Cargo</label>
                                                                    <select name="cgoRpb" class="form-control userEmail" id="cgoRpb">
                                                                        <option value="">-</option>
                                                                        <option value="1">caracas</option>
                                                                    </select><i class="fa fa-id-badge" id="micr10"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div role="tabpanel" class="tab-pane" id="ctorm">
                                                        <div class="container-fluid" id="contrpbdbrm3">
                                                            <center><u><p>CONTACTOS</p></u></center>
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-md-8 col-md-offset-2" id="rRpbm9">                                     <div class="col-md-12">
                                                                    <label for="rifRpb">Telefono movil</label>
                                                                    <br>
                                                                    </div>
                                                                    <div class="col-md-5">
                                                                        <div class="form-group">
                                                                            <select name="selRifRpb" class="form-control userEmail" id="selRifRpb">
                                                                                <option value="">-</option>
                                                                                <option value="1">0414</option>
                                                                            </select><i class="fa fa-hashtag" id="micr11"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-7">
                                                                        <div class="form-group">     
                                                                            <input type="text" class="form-control userEmail" name="numTelclRpb"><i class="fa fa-mobile" id="micr12"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-8 col-md-offset-2" id="rRpbm10">         <div class="col-md-12">
                                                                    <label for="rifRpb">Telefono fijo</label>
                                                                    <br>
                                                                    </div>
                                                                    <div class="col-md-5">
                                                                        <div class="form-group">
                                                                            <select name="selRifRpb" class="form-control userEmail" id="selRifRpb">
                                                                                <option value="">-</option>
                                                                                <option value="1">0212</option>
                                                                            </select><i class="fa fa-hashtag" id="micr13"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-7">
                                                                        <div class="form-group">           
                                                                            <input type="text" class="form-control userEmail" name="numTelmvlRpb"><i class="fa fa-phone" id="micr14"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <div class="col-md-8 col-md-offset-2" id="rRpbm11">
                                                                    <label for="mail">Correo Electrónico</label>
                                                                    <input type="text" name="mail2" id="" class="form-control userEmail">
                                                                    <i class="fa fa-envelope" id="micr15"></i>
                                                                </div>
                                                            </div>
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
                    </div>   
    @endsection
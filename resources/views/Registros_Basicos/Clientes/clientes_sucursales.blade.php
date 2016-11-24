@extends('admin.basesys')
    @section('contenido')
        @section('title')
            Registro Categoria - Sucursales
        @endsection
            @include('layout/header')
                @include('layout/sidebar')
                    <div class="contenido">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-4 ttlp">
                                    <h1>Categoría - Sucursales</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-5 col-sm-5 col-md-6 col-md-offset-3" style="">
                            @if($agregar) 
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-2" align="left">
                                            <a href="/menu/registros/clientes/categoria"><button id="btnBk" type="button" class="btnBk" href="#"><i class="fa fa-chevron-left"></i> VOLVER</button></a>
                                        </div>
                                        <div class="col-md-2 col-md-offset-3">
                                            <button id="btnAdd" type="button" class="btnAd" data-toggle="modal" data-target="#myModal" href="#myModal"><i class="fa fa-plus"></i> AGREGAR</button> 
                                        </div>
                                    </div>
                                </div>
                            @endif
                                <div class="contMd" style="">
                                    <div class="icl">
                                        @foreach($acciones as $accion)
                                            @if($accion->id!=30)
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
                                            @elseif($accion->id=30)
                                                @if($accion->status_ac==1)
                                                    <div class="chbx">
                                                        <input type="checkbox" class="btnAcc" name="status" id="{{'inchbx'. $accion->id}}" value="{{$accion->status_ac}}" checked><label for="{{'inchbx'. $accion->id}}" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
                                                    </div>
                                                @elseif($accion->status_ac==0)
                                                    <div class="chbx">
                                                        <input type="checkbox" class="btnAcc" name="status" id="{{'inchbx'. $accion->id}}" value="{{$accion->status_ac}}"><label for="{{'inchbx'. $accion->id}}" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
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
                                        <h4 class="modal-title" id="myModalLabel">Agregar Sucursal</h4>
                                    </div>
                                     <form method="post" class="form-horizontal Validacion" id="Formcliente" action="">
                                        {{ csrf_field() }}
                                        <div class="modal-body">                        
                                             <ul class="nav nav-tabs not-active" role="tablist">
                                                <li role="presentation" class="active" ><a href="#db" id="a1" aria-controls="db" role="tab" data-toggle="tab">Datos basicos</a></li>
                                                <li role="presentation" ><a href="#df" id="a2" aria-controls="df" role="tab" data-toggle="tab">Dirección Fiscal </a></li>
                                                <li role="presentation" ><a href="#dc" id="a3" aria-controls="dc" role="tab" data-toggle="tab">Direccion Comercial</a></li>
                                                <li role="presentation" ><a href="#ctt" id="a4" aria-controls="ctt" role="tab" data-toggle="tab">Contacto</a></li>
                                            </ul>
                                        <div class="container-fluid">
                                            <div class="tab-content">

                                                <div role="tabpanel" class="tab-pane active" id="db">
                                                    <div class="container-fluid" id="contDb">
                                                    <br>
                                                        <div class="col-md-12" id="dbc1">
                                                            <div class="form-group col-md-12">
                                                                <label for="rs">Razon Social:</label>                           
                                                                <input type="text" name="rs" class="form-control userEmail"  id="input1"/>
                                                                <i class="fa fa-university" id="icc1"></i>                              
                                                            </div>                                                          
                                                            <div class="form-group col-md-12">
                                                            
                                                                <label for="nc">Nombre Comercial:</label>
                                                                <input type="text" name="nc" id="input2" class="form-control userEmail" />
                                                                <i class="fa fa-building" id="icc2"></i>
                                                            
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12" id="dbc2">   
                                                            <label for="rif" class="col-md-12">Rif:</label><span class="ic"><i class="fa fa-chevron-down"></i></span>                                   
                                                            <div class="form-group col-md-4" id="sep">
                                                                <select name="rif" id="input3" class="form-control userEmail">
                                                                    <option value="">-</option>
                                                                    <option value="1">J-</option>
                                                                    <option value="2">G-</option>
                                                                </select><i class="fa fa-clipboard" id="icc3"></i>
                                                            </div>  
                                                            <div class="form-group col-md-8">                                   
                                                                <input type="text" id="input4" class="form-control typeRifNumber" name="df"/>
                                                                <i class="fa fa-address-card" id="icc4"></i>
                                                            </div>  
                                                        </div>                                                          
                                                        <div class="col-md-12" id="dbc3">   
                                                            <div class="form-group col-md-12">                                                  
                                                                <label for="tipCon">Contribuyente</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                                <select name="tipCon" id="input5" class="form-control userEmail" >
                                                                    <option value="">-</option>
                                                                    <option value="1">asdas</option>
                                                                    <option value="2">sada</option>
                                                                </select><i class="fa fa-clipboard" id="icc5"></i>                                                      
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div role="tabpanel" class="tab-pane" id="df">
                                                    <div class="container-fluid" id="contdf">
                                                    <br>
                                                        <div class="form-group col-md-6" id="dfc1">
                                                            <label for="paisdf">País</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                            <select name="paisdf" id="input6" class="form-control userEmail">
                                                                <option value="">-</option>
                                                                <option value="caracas">caracas</option>    
                                                            </select><i class="fa fa-globe" id="icc6"></i>
                                                        </div>
                                                        <div class="form-group col-md-7" id="dfc2">
                                                            <div class="col-md-offset-2">
                                                                <label for="regiondf">Región</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                                <select name="regiondf" id="input7" class="form-control userEmail">
                                                                    <option value="">-</option>
                                                                    <option value="caracas">caracas</option>
                                                                </select><i class="fa fa-map" id="icc7"></i>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-6" id="dfc3">
                                                            <label for="edodf">Estado</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                            <select name="edodf" id="input8" class="form-control userEmail">
                                                                <option value="">-</option>
                                                                <option value="caracas">caracas</option>
                                                            </select><i class="fa fa-map-pin" id="icc8"></i>
                                                        </div>
                                                        <div class="form-group col-md-7" id="dfc4">
                                                            <div class="col-md-offset-2">
                                                                <label for="mundf">Municipio</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                                <select name="mundf" id="input9" class="form-control userEmail">
                                                                    <option value="">-</option>
                                                                    <option value="caracas">caracas</option>
                                                                </select><i class="fa fa-map-signs" id="icc9"></i>
                                                        </div>  
                                                        </div>
                                                        <div class="form-group col-md-12" id="dfc5">
                                                                <label for="descDirdf">Descripción de la dirección</label>
                                                            <textarea type="text" name="descDirdf" id="input10" class="form-control userEmail"></textarea><i class="fa fa-map-marker" id="icc10"></i>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div role="tabpanel" class="tab-pane" id="dc">
                                                    <div class="container-fluid" id="contdc">
                                                    <br>                                    
                                                        <div class="form-group col-md-6" id="dcc1">
                                                            <label for="paisdc">País</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                            <select name="paisdc" id="input11" class="form-control userEmail">
                                                                <option value="">-</option>
                                                                <option value="caracas">caracas</option>    
                                                            </select><i class="fa fa-globe" id="icc11"></i>
                                                        </div>
                                                        <div class="form-group col-md-7" id="dcc2">
                                                            <div class="col-md-offset-2">
                                                                <label for="regiondc">Región</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                                <select name="regiondc" id="input12" class="form-control userEmail">
                                                                    <option value="">-</option>
                                                                    <option value="caracas">caracas</option>
                                                                </select><i class="fa fa-map" id="icc12"></i>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-6" id="dcc3">
                                                            <label for="edodc">Estado</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                            <select name="edodc" id="input13" class="form-control userEmail">
                                                                <option value="">-</option>
                                                                <option value="caracas">caracas</option>
                                                            </select><i class="fa fa-map-pin" id="icc13"></i>
                                                        </div>
                                                        <div class="form-group col-md-7" id="dcc4">
                                                            <div class="col-md-offset-2">
                                                                <label for="mundc">Municipio</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                                <select name="mundc" id="input14" class="form-control userEmail">
                                                                    <option value="">-</option>
                                                                    <option value="caracas">caracas</option>
                                                                </select><i class="fa fa-map-signs" id="icc14"></i>
                                                        </div>  
                                                        </div>                                                  
                                                        <div class="form-group col-md-12" id="dcc5">
                                                                <label for="descDirdc">Descripción de la dirección</label>
                                                                <textarea type="text" name="descDirdc" id="input15" class="form-control userEmail"></textarea><i class="fa fa-map-marker" id="icc15"></i>
                                                        </div>
                                                    </div>
                                                    
                                                </div>

                                                <div role="tabpanel" class="tab-pane" id="ctt">
                                                    <div class="container-fluid" id="contctt">
                                                        <br>                                                            
                                                            <div class="row">
                                                                <div id="ctoc1">
                                                                   <div class="col-md-12">
                                                                       <label for="tlflcl">N° Local:</label><span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                                   </div>
                                                                   <div class="col-md-5">
                                                                       <div class="form-group">
                                                                           <select name="tlflcl" id="input16" class="form-control userEmail">
                                                                               <option value="">-</option>
                                                                               <option value="0212">0212</option>
                                                                           </select><i class="fa fa-hashtag" id="icc16"></i>
                                                                       </div>
                                                                   </div>
                                                                   <div class="col-md-7">
                                                                       <div class="form-group">
                                                                           <input type="text" name="tcl" id="input17" class="form-control typeTlfNumber col-md-12" /><i class="fa fa-phone" id="icc17"></i>
                                                                       </div>
                                                                   </div>
                                                               </div>
                                                            </div>
                                                            <div class="row">
                                                                <div id="ctoc2">
                                                                    <div class="col-md-12">
                                                                        <label for="tlfmvl">N° Móvil</label><span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                                    </div>
                                                                    <div class="col-md-5">
                                                                        <div class="form-group">
                                                                            <select name="tlfmvl" id="input18" class="form-control userEmail">
                                                                                <option value="">-</option>
                                                                                <option value="0416">0416</option>
                                                                            </select><i class="fa fa-hashtag" id="icc18"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-7">
                                                                        <div class="form-group">        
                                                                            <input type="text" name="tmvl" id="input19" class="form-control typeTlfNumber" /><i class="fa fa-mobile" id="icc19"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12" id="ctoc3">
                                                                    <div class="form-group">
                                                                        <label for="mail">Correo Electrónico</label>
                                                                        <input type="text" name="mail" id="input20" class="form-control typeEmail">
                                                                        <i class="fa fa-envelope" id="icc20"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                              
                                        <div class="modal-footer">
                                            <button type="button" class="bttnMd" id="btnAn">Anterior <i class="fa fa-times"></i></button>
                                            <button type="button" class="bttnMd" id="btnSv">Siguiente <i class="fa fa-hand-o-right"></i></button>   
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
                                        <h4 class="modal-title" id="myModalLabel2">Modificar Sucursal</h4>
                                    </div>
                                    <form method="post" class="form-horizontal Validacion" id="Formclientem" action="">
                                        {{ csrf_field() }}
                                        <div class="modal-body">                        
                                            <ul class="nav nav-tabs not-active" role="tablist">
                                                <li role="presentation" class="active" ><a href="#dbm" id="am1" aria-controls="dbm" role="tab" data-toggle="tab">Datos basicos</a></li>
                                                <li role="presentation" ><a href="#dfm" id="am2" aria-controls="dfm" role="tab" data-toggle="tab">Dirección Fiscal </a></li>
                                                <li role="presentation" ><a href="#dcm" id="am3" aria-controls="dcm" role="tab" data-toggle="tab">Direccion Comercial</a></li>
                                                <li role="presentation" ><a href="#cttm" id="am4" aria-controls="cttm" role="tab" data-toggle="tab">Contacto</a></li>
                                            </ul>
                                            <div class="container-fluid">
                                                <div class="tab-content">

                                                    <div role="tabpanel" class="tab-pane active" id="dbm">
                                                        <div class="container-fluid" id="contDbm">
                                                            <br>
                                                            <div class="col-md-12" id="dbcm1">
                                                                <div class="form-group col-md-12">
                                                                    <label for="rs">Razon Social:</label>                           
                                                                    <input type="text" name="rs" class="form-control userEmail"  id="inputm1"/>
                                                                    <i class="fa fa-university" id="micc1"></i>                              
                                                                </div>                                                          
                                                                <div class="form-group col-md-12">

                                                                    <label for="nc">Nombre Comercial:</label>
                                                                    <input type="text" name="nc" id="inputm2" class="form-control userEmail" />
                                                                    <i class="fa fa-building" id="micc2"></i>

                                                                </div>
                                                            </div>
                                                            <div class="col-md-12" id="dbcm2">   
                                                                <label for="rif" class="col-md-12">Rif:</label><span class="ic"><i class="fa fa-chevron-down"></i></span>                                   
                                                                <div class="form-group col-md-4" id="sepm">
                                                                    <select name="rif" id="inputm3" class="form-control userEmail">
                                                                        <option value="">-</option>
                                                                        <option value="1">J-</option>
                                                                        <option value="2">G-</option>
                                                                    </select><i class="fa fa-clipboard" id="micc3"></i>
                                                                </div>  
                                                                <div class="form-group col-md-8">                                   
                                                                    <input type="text" id="inputm4" class="form-control typeRifNumber" name="df"/>
                                                                    <i class="fa fa-address-card" id="micc4"></i>
                                                                </div>  
                                                            </div>                                                          
                                                            <div class="col-md-12" id="dbcm3">   
                                                                <div class="form-group col-md-12">                                                  
                                                                    <label for="tipCon">Contribuyente</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                                    <select name="tipCon" id="inputm5" class="form-control userEmail" >
                                                                        <option value="">-</option>
                                                                        <option value="1">asdas</option>
                                                                        <option value="2">sada</option>
                                                                    </select><i class="fa fa-clipboard" id="micc5"></i>                                                      
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div role="tabpanel" class="tab-pane" id="dfm">
                                                        <div class="container-fluid" id="contdfm">
                                                            <br>
                                                            <div class="form-group col-md-6" id="dfcm1">
                                                                <label for="paisdf">País</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                                <select name="paisdf" id="inputm6" class="form-control userEmail">
                                                                    <option value="">-</option>
                                                                    <option value="caracas">caracas</option>    
                                                                </select><i class="fa fa-globe" id="micc6"></i>
                                                            </div>
                                                            <div class="form-group col-md-7" id="dfcm2">
                                                                <div class="col-md-offset-2">
                                                                    <label for="regiondf">Región</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                                    <select name="regiondf" id="inputm7" class="form-control userEmail">
                                                                        <option value="">-</option>
                                                                        <option value="caracas">caracas</option>
                                                                    </select><i class="fa fa-map" id="micc7"></i>
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-6" id="dfcm3">
                                                                <label for="edodf">Estado</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                                <select name="edodf" id="inputm8" class="form-control userEmail">
                                                                    <option value="">-</option>
                                                                    <option value="caracas">caracas</option>
                                                                </select><i class="fa fa-map-pin" id="micc8"></i>
                                                            </div>
                                                            <div class="form-group col-md-7" id="dfcm4">
                                                                <div class="col-md-offset-2">
                                                                    <label for="mundf">Municipio</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                                    <select name="mundf" id="inputm9" class="form-control userEmail">
                                                                        <option value="">-</option>
                                                                        <option value="caracas">caracas</option>
                                                                    </select><i class="fa fa-map-signs" id="micc9"></i>
                                                                </div>  
                                                            </div>
                                                            <div class="form-group col-md-12" id="dfcm5">
                                                                <label for="descDirdf">Descripción de la dirección</label>
                                                                <textarea type="text" name="descDirdf" id="inputm10" class="form-control userEmail"></textarea><i class="fa fa-map-marker" id="micc10"></i>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div role="tabpanel" class="tab-pane" id="dcm">
                                                        <div class="container-fluid" id="contdcm">
                                                            <br>                                    
                                                            <div class="form-group col-md-6" id="dccm1">
                                                                <label for="paisdc">País</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                                <select name="paisdc" id="inputm11" class="form-control userEmail">
                                                                    <option value="">-</option>
                                                                    <option value="caracas">caracas</option>    
                                                                </select><i class="fa fa-globe" id="micc11"></i>
                                                            </div>
                                                            <div class="form-group col-md-7" id="dccm2">
                                                                <div class="col-md-offset-2">
                                                                    <label for="regiondc">Región</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                                    <select name="regiondc" id="inputm12" class="form-control userEmail">
                                                                        <option value="">-</option>
                                                                        <option value="caracas">caracas</option>
                                                                    </select><i class="fa fa-map" id="micc12"></i>
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-6" id="dccm3">
                                                                <label for="edodc">Estado</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                                <select name="edodc" id="inputm13" class="form-control userEmail">
                                                                    <option value="">-</option>
                                                                    <option value="caracas">caracas</option>
                                                                </select><i class="fa fa-map-pin" id="micc13"></i>
                                                            </div>
                                                            <div class="form-group col-md-7" id="dccm4">
                                                                <div class="col-md-offset-2">
                                                                    <label for="mundc">Municipio</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                                    <select name="mundc" id="inputm14" class="form-control userEmail">
                                                                        <option value="">-</option>
                                                                        <option value="caracas">caracas</option>
                                                                    </select><i class="fa fa-map-signs" id="micc14"></i>
                                                                </div>  
                                                            </div>                                                  
                                                            <div class="form-group col-md-12" id="dccm5">
                                                                <label for="descDirdc">Descripción de la dirección</label>
                                                                <textarea type="text" name="descDirdc" id="inputm15" class="form-control userEmail"></textarea><i class="fa fa-map-marker" id="micc15"></i>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div role="tabpanel" class="tab-pane" id="cttm">
                                                        <div class="container-fluid" id="contcttm">
                                                            <br>                                                            
                                                            <div class="row">
                                                                <div id="ctocm1">
                                                                    <div class="col-md-12">
                                                                        <label for="tlflcl">N° Local:</label><span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                                    </div>
                                                                    <div class="col-md-5">
                                                                        <div class="form-group">
                                                                            <select name="tlflcl" id="inputm16" class="form-control userEmail">
                                                                                <option value="">-</option>
                                                                                <option value="0212">0212</option>
                                                                            </select><i class="fa fa-hashtag" id="micc16"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-7">
                                                                        <div class="form-group">
                                                                            <input type="text" name="tcl" id="inputm17" class="form-control typeTlfNumber col-md-12" /><i class="fa fa-phone" id="micc17"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div id="ctocm2">
                                                                    <div class="col-md-12">
                                                                        <label for="tlfmvl">N° Móvil</label><span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                                    </div>
                                                                    <div class="col-md-5">
                                                                        <div class="form-group">
                                                                            <select name="tlfmvl" id="inputm18" class="form-control userEmail">
                                                                                <option value="">-</option>
                                                                                <option value="0416">0416</option>
                                                                            </select><i class="fa fa-hashtag" id="micc18"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-7">
                                                                        <div class="form-group">        
                                                                            <input type="text" name="tmvl" id="inputm19" class="form-control typeTlfNumber" /><i class="fa fa-mobile" id="micc19"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12" id="ctocm3">
                                                                    <div class="form-group">
                                                                        <label for="mail">Correo Electrónico</label>
                                                                        <input type="text" name="mail" id="inputm20" class="form-control typeEmail">
                                                                        <i class="fa fa-envelope" id="micc20"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                              
                                        <div class="modal-footer">
                                            <button type="button" class="bttnMd" id="btnAnm">Anterior <i class="fa fa-times"></i></button>
                                            <button type="button" class="bttnMd" id="btnSvm">Siguiente <i class="fa fa-hand-o-right"></i></button>   
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                </div>   
    @endsection
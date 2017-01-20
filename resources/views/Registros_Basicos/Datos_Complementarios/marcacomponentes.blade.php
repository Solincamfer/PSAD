@extends('admin.basesys')
    @section('contenido')
        @section('title')
            Datos Complementarios
        @endsection
            @include('layout/header')
                @include('layout/sidebar')
                    <div class="contenido">
                        <div class="container ">
                            <div class="row">
                                <div class="col-md-3 ttlp">
                                    <h1 id="encabezado">Datos Complementarios</h1>
                                </div>
                                <input type="hidden" value="" id="idPerfil">
                            </div>
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-2" align="left">
                                    <a href="/menu/registros/datos/"><button id="btnBk" type="button" class="btnBk" href="#"><i class="fa fa-chevron-left"></i> VOLVER</button></a>
                                </div>
                            
                            </div>
                        </div>

                        <div class="container centrado">
                           
                            <div class="row">
                                <div class="col-md-3 spcm">
                                    <div class="row">
                                         <div class="etqSideBack1"></div>
                                         <div class="etqSideFront1">
                                            <span class="tiposE" >Componentes</span>
                                        </div>
                                    </div>
                                     <div class="row ">
                                         <div class="col-md-3 spcm">
                                           <div class="busQ"><input  type="search" placeholder="Buscar" class="BUSE" id="tpE" data-inputbus="0" data-dependencia="0"></div>
                                        </div> 
                                    </div>
                                   
                                    
                                </div>
                                <div class="col-md-3 spcm">
                                    <div class="etqSideBack1"></div>
                                    <div class="etqSideFront1">
                                        <span class="spttl2">Marca</span>
                                    </div>
                                     <div class="row ">
                                         <div class="col-md-3 spcm">
                                           <div class="busQ" id="inputComponente">  </div>
                                        </div> 
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="etqSideBack1"></div>
                                    <div class="etqSideFront1">
                                        <span class="spttl1">Modelo</span>
                                    </div>
                                    <div class="row ">
                                         <div class="col-md-3 spcm">
                                           <div class="busQ" id="inputPiezas"><!-- <input type="search" placeholder="Buscar " class="BUSE" id="tpEP" data-ecomponente="0" > --></div>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                            <div class="row spm">
                                <div class="col-md-4 ">
                                    <div class="tarjeta1" id="tarjetaEquipos_">
                                        
                                          <ul>
                                                @foreach($consulta as $equipo)
                                                        <li class="lista__">
                                                            <div class="container-fluid  ">
                                                                <div class="row nuevo">
                                                                    <div class="col-md-6">
                                                                        <div class="tl1"><span>{{$equipo->descripcion}}</span></div>
                                                                    </div>

                                                                    <div class="col-md-1 col-md-push-3">
                                                                        <div class="iclst" id="_tarjetaEquipos_"> <i class="fa fa-eye consultarComponentes gestionar" id="Tequipo{{$equipo->id}}" data-dependencia="{{$equipo->id}}"></i>     </div>
                                                                    </div>
                                                                    <div class="col-md-2 col-md-push-3"  border>
                                                                        <div class="iclst" id="EliminarEquipo_{{$equipo->id}}"><i class="fa fa-trash-o EliminarEquipo gestionar" id="EliminarEq{{$equipo->id}}" data-registro="{{$equipo->id}}" data-registro_="{{$equipo->id}}"></i></div>   
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                @endforeach                                  
                                        </ul>

                                    </div>
                                       
                                </div>
                                <div class="col-md-4 ">
                                     <div class=" tarjeta1" id="tarjetaComponentes_">
                                       <ul>
                                           

                                       </ul>
                                        
                                    </div>

                                </div>
                                <div class="col-md-4 ">
                                    <div class="tarjeta1" id="tarjetaPiezas_">
                                        
                                        <ul>
                                            

                                        </ul>

                                    </div>
                                </div>
                            </div>
                            <!-- <div class="row spm">
                                <div class="col-md-3 dist">
                                    <div class="card1" id="targeta1">
                                        <ul>
                                         
                                        
                                            <li>
                                                <div class="container-fluid cont">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="tl1">
                                                                <span></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1 col-md-push-2">
                                                            <div class="iclst">
                                                                <i class="" </i>
                                                            </div>
                                                            <input type="hidden" id="Perfilidm">
                                                        </div>
                                                        <div class="col-md-2 col-md-push-3" border>
                                                            <div class="chbx1x">
                                                                 <input type="checkbox" value="" class="configurarPer" id="cckM" name="cck"checked><label for="cckM"></label>
                                                            </div>
                                                       
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                         
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-3 dist">
                                    <div class="card1" id="targeta2">                                        
                                         <ul >
                                             
                                         </ul>
                                    </div>
                                </div>
                                <div class="col-md-3 dist">
                                    <div class="card1" id="targeta3">
                                        <ul> 
                                            
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div> 
    @endsection
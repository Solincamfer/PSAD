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
                                    <a href="#"><button id="btnBk" type="button" class="btnBk" href="#"><i class="fa fa-chevron-left"></i> VOLVER</button></a>
                                </div>
                            
                            </div>
                        </div>

                        <div class="container centrado">
                           
                            <div class="row">
                                <div class="col-md-3 spcm">
                                    <div class="row">
                                         <div class="etqSideBack1"></div>
                                         <div class="etqSideFront1">
                                            <span class="tiposE" >Tipo de Equipo</span>
                                        </div>
                                    </div>
                                     <div class="row ">
                                         <div class="col-md-3 spcm">
                                           <div class="busQ"><input class="tipoEI" type="search" placeholder="Buscar" id="tpE"></div>
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
                                           <div class="busQ"><input type="search" placeholder="Buscar"></div>
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
                                           <div class="busQ"><input type="search" placeholder="Buscar "></div>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                            <div class="row spm">
                                <div class="col-md-4 ">
                                    <div class="tarjeta1" id="tarjetaEquipos_">
                                        
                                          <ul>
                                           
                                        <!-- 
                                            <li>
                                                <div class="container-fluid ">
                                                    <div class="row nuevo">
                                                        <div class="col-md-6">
                                                            <div class="tl1">
                                                                <span>Registro--1asasa aasasa</span>

                                                            </div>
                                                        </div>
                                                        <div class="col-md-1 col-md-push-2">
                                                            <div class="iclst">
                                                                    <i class="fa fa-eye consultarSubmodulo" id=""></i>
                                                            </div>
                                                            <input type="hidden" id=" " value=" ">
                                                        </div>
                                                        <div class="col-md-2 col-md-push-3" id="checklistE" border>
                                                           



                                                            <div class="chbx1x">
                                               
                                                                    <input type="checkbox" value="1" class="configurarPer" id="cckM" name="cck"checked><label for="cckM"></label>
                                                         
                                                              
                                                               

                                                         </div>
                                                         <div class="col-md-2 col-md-push-3>
                                                            <div class="eliminar">
                                                                    <i class=" fa fa-trash-o " id=""></i>
                                                            </div>
                                                         </div>
                                                       
                                                        </div>
                                                    </div>
                                                </div>
                                            </li> -->
                                            
                                          
                                        </ul>

                                    </div>
                                       
                                </div>
                                <div class="col-md-4 ">
                                     <div class="col-md-12 tarjeta1">
                                        
                                        <div class="row">
                                            <div class="col-md-6 registro">
                                              <!--   <p>aaaaaaaaaa</p> -->

                                            </div>
                                            <div class="col-md-3 registro">
                                              <!--   <p>bbbb</p> -->

                                            </div>
                                            <div class="col-md-3 registro">
                                               <!--  <p>c</p> -->

                                            </div>

                                        </div>
                                        <!--  <p>hiashaishaihsa sashaishahsiahsais ashiahsiahsia sia sahsiahsiha is ais aishaishiashais aisia jkdjfjdkfjdf dfjdf dkfjdk fkdjfkdjfkj fdkjfdk fjdkfjd fkdfj dkfjdkfj dfkdf jdkfjdkfjdkf dkfjdkfjdkf dfkd fkdjfkdjf</p> -->
                                    </div>

                                </div>
                                <div class="col-md-4 ">
                                    <div class="tarjeta1">
                                        
                                        <!--  <p>hiashaishaihsa sashaishahsiahsais ashiahsiahsia sia sahsiahsiha is ais aishaishiashais aisia jkdjfjdkfjdf dfjdf dkfjdk fkdjfkdjfkj fdkjfdk fjdkfjd fkdfj dkfjdkfj dfkdf jdkfjdkfjdkf dkfjdkfjdkf dfkd fkdjfkdjf</p> -->
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
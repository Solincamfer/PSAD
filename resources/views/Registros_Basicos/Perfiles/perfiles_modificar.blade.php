@extends('admin.basesys')
    @section('contenido')
        @section('title')
            Asignacion de Permisología
        @endsection
            @include('layout/header')
                @include('layout/sidebar')
                    <div class="contenido">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-4 ttlp">
                                    <h1>{{$datosC1}} - Permisos</h1>
                                </div>
                                <input type="hidden" value="{{$extra}}" id="idPerfil">
                            </div>
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-2" align="left">
                                    <a href="/menu/registros/perfiles/"><button id="btnBk" type="button" class="btnBk" href="#"><i class="fa fa-chevron-left"></i> VOLVER</button></a>
                                </div>
                              <!--   <div class="col-md-2 col-md-offset-3 pnlUs">
                                     <span class="pnlttl"><i class="fa fa-user-circle"></i> {{$datosC1}}</span>
                                </div> -->
                            </div>
                        </div>
                        <div class="container centrado">
                            <div class="row">
                                <div class="col-md-3 spcm">
                                    <div class="etqSideBack1"></div>
                                    <div class="etqSideFront1">
                                        <span class="spttl1">Modulos</span>
                                    </div>
                                </div>
                                <div class="col-md-3 spcm">
                                    <div class="etqSideBack1"></div>
                                    <div class="etqSideFront1">
                                        <span class="spttl2">Submodulos</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="etqSideBack1"></div>
                                    <div class="etqSideFront1">
                                        <span class="spttl1">Acciones</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row spm">
                                <div class="col-md-3 dist">
                                    <div class="card1" id="targeta1">
                                        <ul>
                                            @foreach($consulta as $registros)
                                        
                                            <li>
                                                <div class="container-fluid cont">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="tl1">
                                                                <span>{{$registros->moduloNom}}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1 col-md-push-2">
                                                            <div class="iclst">
                                                                    <i class="fa fa-eye consultarSubmodulo" id="m{{$registros->moduloId}}"></i>
                                                            </div>
                                                            <input type="hidden" id="Perfilidm{{$registros->moduloId}}" value="{{$registros->moduloId}}">
                                                        </div>
                                                        <div class="col-md-2 col-md-push-3" border>
                                                            <div class="chbx1x">
                                                                @if($registros->status==1)
                                                                    <input type="checkbox" value="{{$registros->status}}" class="configurarPer" id="cckM{{$registros->registroId}}" name="cck{{$registros->moduloId}}"checked><label for="cckM{{$registros->registroId}}"></label>
                                                                @elseif($registros->status==0)
                                                                    <input type="checkbox" value="{{$registros->status}}" class="configurarPer" id="cckM{{$registros->registroId}}" name="cck{{$registros->moduloId}}" ><label for="cckM{{$registros->registroId}}"></label>
                                                                @endif

                                                            </div>
                                                       
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            @endforeach
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
                        </div>
                    </div> 
    @endsection
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
                                <div class="col-md-2 ttlp">
                                    <h1>Perfil</h1>
                                </div>
                                <input type="hidden" value="{{$extra}}" id="idPerfil">
                            </div>
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-2" align="left">
                                    <a href="/menu/registros/perfiles/"><button id="btnBk" type="button" class="btnBk" href="#"><i class="fa fa-chevron-left"></i> VOLVER</button></a>
                                </div>
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
                                            @foreach($consulta as $modulos)
                                            <li>
                                                <div class="container-fluid cont">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="tl1">
                                                                <span>{{$modulos->descripcion}}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1 col-md-push-2">
                                                            <div class="iclst">
                                                                    <i class="fa fa-eye consultarSubmodulo" id="m{{$modulos->id}}"></i>
                                                            </div>
                                                            <input type="hidden" id="Perfilidm{{$modulos->id}}" value="{{$modulos->id}}">
                                                        </div>
                                                        <div class="col-md-2 col-md-push-3">
                                                            <div class="chbx1x">
                                                                <input type="checkbox" value="None" id="cck" name="cck" checked><label for="cck"></label>
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
                                         <ul>
                                             
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
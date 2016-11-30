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
                            <div class="row spm">
                                <div class="col-md-3 dist1">
                                    <div class="tlt1x">
                                        <span>Modulos</span>
                                    </div>
                                </div>
                                <div class="col-md-3 dist2">
                                    <div class="tlt1x">
                                        <span>Submodulos</span>
                                    </div>
                                </div>
                                <div class="col-md-3 dist3">
                                    <div class="tlt1x">
                                        <span>Acciones</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row spm">
                                <div class="col-md-3 dist">
                                    <div class="card1">
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
                                                            <input type="text" id="Perfilidm{{$modulos->id}}" value="{{$modulos->id}}">
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
                                    <div class="card1">
                                        <ul>
                                            <li>
                                                <div class="container-fluid cont">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="tl1">
                                                                <span>Registro Básicos</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1 col-md-push-2">
                                                            <div class="iclst">
                                                                <a href="">
                                                                    <i class="fa fa-eye"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2 col-md-push-3">
                                                            <div class="chbx1x">
                                                                <input type="checkbox" value="None" id="cck" name="cck" checked><label for="cck"></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-3 dist">
                                    <div class="card1">
                                        <ul>
                                            <li>
                                                <div class="container-fluid cont">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="tl1">
                                                                <span>Registro Básicos</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2 col-md-push-4">
                                                            <div class="chbx1x">
                                                                <input type="checkbox" value="None" id="cck" name="cck" checked><label for="cck"></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>   
    @endsection
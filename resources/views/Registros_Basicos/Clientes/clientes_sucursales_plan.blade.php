@extends('admin.basesys')
   @section('contenido')
       @section('title')
           Seleccionar Plan -Sucursales
       @endsection
           @include('layout/header')
               @include('layout/sidebar')
                   <div class="contenido">
                       <div class="container">
                           <div class="row">
                               <div class="col-md-4 ttlp">
                                   <h1>Sucursales - Plan</h1>
                               </div>
                           </div>
                       </div>
                       <div class="col-xs-5 col-sm-5 col-md-6 col-md-offset-3"> 
                           @if($agregar!=false) 
                               <div class="container">
                                   <div class="row">
                                       <div class="col-md-2" align="left">
                                           <a href="/menu/registros/clientes/categorias/sucursales"><button id="btnBk" type="button" class="btnBk" href="#"><i class="fa fa-chevron-left"></i> VOLVER</button></a>
                                       </div>
                                   </div>
                               </div>
                           @endif
                               <div class="contMd">
                                   <div class="icl">
                                       @foreach($acciones as $accion)
                                           @if($accion->descripcion!="Status")
                                               <span class="iclsp">
                                                   <a href="{{$accion->url}}" class="tltp" data-ttl="{{$accion->descripcion}}">
                                                       <i class="{{$accion->clase_css}}"></i>
                                                   </a>
                                               </span>
                                           @endif
                                       @endforeach
                                   </div>
                                   <span class="ttlMd"><input type="radio" name="planes" id="" value=""> <label for="planes"><strong>REGISTRO</strong></label></span>
                               </div>
                       
                       </div>
                   </div>   
   @endsection
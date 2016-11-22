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
                       <div class="col-xs-5 col-sm-5 col-md-6 col-md-offset-3" style="margin-top: 2em;"> 
                       
                               <div class="contMd">
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
                                   <span class="ttlMd"><input type="radio" name="planes" id="" value=""> <label for="planes"><strong>REGISTRO</strong></label></span>
                               </div>
                       
                       </div>
                   </div>   
   @endsection
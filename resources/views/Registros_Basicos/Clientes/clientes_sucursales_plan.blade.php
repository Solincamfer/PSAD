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
                        
                             <div class="container">
                                 <div class="row">
                                     <div class="col-md-2" align="left">
                                         <a href="/menu/registros/clientes/categorias/sucursales/{{$datosC1}}"><button id="btnBk" type="button" class="btnBk" href="#"><i class="fa fa-chevron-left"></i> VOLVER</button></a>
                                     </div>
                                 </div>
                             </div>
                        @foreach($consulta as $plan)
                             <div class="contMd">
                                 <div class="icl">
                                     @foreach($acciones as $accion)
                                         @if($accion->descripcion!="Status")
                                             <span class="iclsp">
                                                 <a href="#myModal" class="tltp" data-ttl="{{$accion->descripcion}}" data-toggle="modal" data-target="#myModal" data-id="{{$plan->id}}">
                                                     <i class="{{$accion->clase_css}}"></i>
                                                 </a>
                                             </span>
                                         @endif
                                     @endforeach
                                 </div>
                                 <span class="ttlMd1"><input type="radio" name="planes" id="" value=""> <label for="planes"><strong>{{$plan->nombreP}}</strong></label></span>
                             </div>
                     @endforeach
                      </div>

<!-- //////// MODAL INFORMACION DE LOS SERVICIOS QUE TIENE EL PLAN //////////////////////// -->
                       
                      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel"><strong class="titulo"></strong></h4>
                                </div>
                                <div class="modal-body">
                                    <div class="container-fluid" id="contdpto">
                                      <div class="col-md-8 col-md-offset-2 servicios">
                                      </div>
                                    </div> 
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="bttnMd bttminimizar" data-dismiss="modal" id="btnCs">Cerrar <i class="fa fa-times"></i></button>
                                </div>
                            </div>                           
                        </div>
                      </div>
                  </div>  
   @endsection
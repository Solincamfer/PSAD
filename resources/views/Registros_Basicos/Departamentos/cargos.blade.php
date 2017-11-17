@extends('admin.basesys')
    @section('contenido')
        @section('title')
            Registro Cargos -Departamentos
        @endsection
        @include('layout/header')
                @include('layout/sidebar')
            <div class="contenido">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-4 ttlp">
                            <h1>{{$datosC2}} - Cargos</h1>
                        </div>
                    </div>
                    <div class="row sep-div">
                        <div class="col-md-2 despl-bttn">
                            @if($agregar)
                            <div class="bttn-agregar">
                                <button id="btnAdd" type="button" class="bttn-agr" data-toggle="modal" data-target="#myModal" href="#myModal"><span class="fa fa-plus"></span><span class="txt-bttn">AGREGAR</span></button>
                            </div>
                            @endif 
                        </div>
                        <div  class="col-md-4 despl-bttn">
                            <div class="search-cont" id="scnt">
                                <form action="" method="">
                                    <div class="input-group sci">
                                        <input type="search" class="form-control filtro" placeholder="Buscar cargo..." data-tabla="cargos" data-submodulo="2" data-vista="2" id="busCar"><span class="fa fa-search"></span>
                                    </div>
                                </form> 
                                <a class="bttn-search">
                                    <span class="fa fa-search"></span>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-2 despl-bttn">
                            <a href="/menu/registros/departamentos">
                               <div class="bttn-volver">
                                   <button id="btnBk" type="button" href="#" class="bttn-vol"><span class="fa fa-chevron-left"></span><span class="txt-bttn">Volver</span></button>
                               </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xs-5 col-sm-5 col-md-6 col-md-offset-3" id="areaResultados" data-tab={{$extra}} >
                <div >
                        @foreach($consulta as $cargo)
                            <div class="contMd" >
                                <div class="icl">
                                    @foreach($acciones as $accion)

                                        @if($accion->desci!='status' && $accion->desci!='radio')
                                            @if($accion->desci=='modificar')
                                                <span class="{{$accion->clase_cont}}">
                                                    <a  class="{{$accion->clase_elem}}" id="{{$accion->identificador.$cargo->id}}" data-reg="{{$cargo->id}}" data-ttl="{{$accion->descripcion}}" data-toggle="modal" > 
                                                        <i class="{{$accion->clase_css}}"></i>
                                                    </a>
                                                </span>
                                            @elseif($accion->desci!='modificar')

                                                <span class="{{$accion->clase_cont}}">
                                                    <a href="{{$accion->url}}" class="{{$accion->clase_elem}}" data-ttl="{{$accion->descripcion}}" id="{{$accion->identificador.$cargo->id}}"  >
                                                        <i class="{{$accion->clase_css}}"></i>
                                                    </a>
                                                </span>
                                            @endif
                                        @elseif($accion->desci=='status' || $accion->desci=='radio')
                                            @if($accion->desci=='status')
                                                <div class="{{$accion->clase_cont}}">
                                                     <input type="checkbox" class="{{$accion->clase_elem}}" name="status" id="{{'inchbx'. $cargo->id}}" value="{{$cargo->status}}"><label for="{{'inchbx'. $cargo->id}}"  data-ttl="{{$accion->descripcion}}"></label>
                                                </div>
                                               
                                            @endif
                                        @endif
                                    @endforeach
                            </div>
                            <p class="ttlMd"><strong>{{$cargo->descripcion}}</strong></p>
                           
                        </div>
                    @endforeach
                    </div>
                    <div class="paginador" id="paginador">
                        {{ $consulta->links() }}
                    </div>
                      <input type="text"   name="TND"  value="{{$extra}}">
                </div>
                
                <!-- Modal Agregar -->

                @if($agregar)
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel"><strong>Agregar Cargo</strong></h4>
                            </div>
                            <div class="modal-body">

                                <form method="post" class="form-horizontal DepCarPer" id="NewCarg" >
                                    <input type="hidden"   name="depID" id="depID" value="{{$datosC1}}">
                                    {{ csrf_field() }}
                                    <div class="container-fluid" id="contcgo">
                                        
                                        <div id="cgo">
                                           <div class="col-md-8 col-md-offset-2">
                                               <div class="form-group row">
                                                   <label for="nomCgo_">Nombre del cargo</label>
                                                   <input type="text" class="form-control" name="textCgo" id="nomCgo_" /><i class="fa fa-id-badge" id="iccg1"></i>                     
                                               </div>
                                           </div>
                                           <div class="col-md-8 col-md-offset-2">
                                               <div class="form-group row">
                                                   <label for="stCgo_">Estatus del Cargo</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                   <select id="stCgo_" class="form-control Empty" name="comboCgo">
                                                        <option value="">-</option>
                                                        <option value="1">ACTIVO</option>
                                                        <option value="0">INACTIVO</option>
                                                   </select><i class="fa fa-check" id="iccg2"></i>
                                               </div>
                                           </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" id="saveCargo" class="bttnMd" >Guardar <i class="fa fa-floppy-o"></i></button>
                                    </div>
                                </form>
                            </div>
                            
                        </div>
                    </div>
                </div>
                @endif
                
                <!-- Modal Modificar-->
                <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" >
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel2" data-department="{{$datosC1}}"><strong>Modificar Cargo</strong></h4>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal DepCarPer" >
                                    {{ csrf_field() }}
                                    <div class="container-fluid" id="contcgo" >

                                        <div id="cgom">
                                            <div class="col-md-8 col-md-offset-2">
                                                <div class="form-group row">
                                                    <label for="nomCgom_">Nombre del cargo</label>
                                                    <input type="text" class="form-control descripcion" name="Descripcion" id="caText" /><i class="fa fa-id-badge " id="miccg1"></i>                     
                                                </div>
                                            </div>
                                            <div class="col-md-8 col-md-offset-2">
                                                <div class="form-group row">
                                                    <label for="stCgom_">Estatus del Cargo</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                    <select id="caStatus" class="form-control status" name="Status">
                                                        <option value="1">ACTIVO</option>
                                                        <option value="0">INACTIVO</option>
                                                    </select><i class="fa fa-check" id="miccg2"></i>
                                                </div>
                                            </div>

                                        </div>
                                         <input type="text" value="" id="MIndexC" name="MIndex">
                                         <input type="text" value="{{$datosC1}}" id="DCargo" name="DCargo">


                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="bttnMd" id="mDepCarPer">Guardar <i class="fa fa-floppy-o"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    @endsection    
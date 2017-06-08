@extends('admin.basesys')
    @section('contenido')
        @section('title')
            Registro Departamento
        @endsection
        @include('layout/header')
                @include('layout/sidebar')
            <div class="contenido">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-2 ttlp">
                            <h1>Departamentos</h1>
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
                                        <input type="search" class="form-control filtro" placeholder="Buscar departamento..."><span class="fa fa-search"></span>
                                    </div>
                                </form> 
                                <a class="bttn-search">
                                    <span class="fa fa-search"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-5 col-sm-5 col-md-6 col-md-offset-3">  
                    @foreach($consulta as $departamento)

                        <div class="contMd" >

                            <div class="icl">

                                @foreach($acciones as $accion)
                                    @if($accion->id!=1 )
                                        @if($accion->id==2)
                                            <span class="iclsp">
                                                <a href="#myModal2" class="tltp ModificaR" id="ModificaDepar{{$departamento->id}}" data-ttl="{{$accion->descripcion}}" data-toggle="modal" data-target="#myModal2"> 
                                                    <i class="{{$accion->clase_css}}"></i>
                                                </a>
                                            </span>
                                        @elseif($accion->id==3)
                                            <span class="iclsp">
                                                <a href="{{$accion->url.$departamento->id}}" class="tltp"  data-ttl="{{$accion->descripcion}}">
                                                    <i class="{{$accion->clase_css}}"></i>
                                                </a>
                                            </span>
                                        @endif
                                    @elseif($accion->id==1 )
                                        @if($departamento->status==1)
                                            <div class="chbx">
                                                <input type="checkbox" class="btnAcc" name="status" id="{{'inchbx'. $departamento->id}}" value="{{$departamento->status}}" checked><label for="{{'inchbx'. $departamento->id}}" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
                                            </div>
                                        @elseif($departamento->status==0)
                                            <div class="chbx">
                                                <input type="checkbox" class="btnAcc" name="status" id="{{'inchbx'. $departamento->id}}" value="{{$departamento->status}}"><label for="{{'inchbx'. $departamento->id}}" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
                                            </div>
                                        @endif
                                    @endif
                                @endforeach

                            </div>
                            <p class="ttlMd"><strong>{{$departamento->descripcion}}</strong></p>
                            

                        </div>

                    @endforeach
                    <div class="paginador">
                        {{ $consulta->links() }}
                    </div>
                  <input type="hidden"   name="TND"  value="{{$extra}}">

                </div>
                
                <!-- Modal AGREGAR-->

                @if($agregar)
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel"><strong>Agregar Departamento</strong></h4>
                            </div>
                            <div class="modal-body">
                                <form method="post" class="form-horizontal DepCarPer" id="NewDep">
                                    {{ csrf_field() }}
                                    <div class="container-fluid" id="contdpto">
                                        <div class="row">
                                            <div id="dpto">
                                               <div class="col-md-8 col-md-offset-2">
                                                   <div class="form-group row">
                                                       <label for="nomDpto">Nombre del Departamento</label>
                                                       <input type="text" name="textDpto" class="form-control " id="nomDpto"/><i class="fa fa-briefcase" id="icdp1"></i>
                                                   </div>
                                               </div>
                                               <div class="col-md-8 col-md-offset-2">
                                                   <div class="form-group row">
                                                       <label for="stDpto">Estatus del Departamento</label><span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                       <select name="comboDpto" class="form-control" id="stDpto">
                                                            <option value="">-</option>
                                                            <option value="1">Activo</option>
                                                            <option value="0">Inactivo</option>
                                                       </select><i class="fa fa-check" id="icdp2"></i>
                                                   </div>
                                               </div> 
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="bttnMd" id="btnSv">Guardar <i class="fa fa-floppy-o"></i></button>
                                    </div>
                                </form>
                            </div>                           
                        </div>
                    </div>
                </div> 
               @endif
               
                <!-- Modal Modificar -->
                <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel2"><strong>Modificar Departamento</strong></h4>
                            </div>
                            <div class="modal-body">
                                <form method="post" class="form-horizontal DepCarPer" action=>
                                    {{ csrf_field() }}
                                    <div class="container-fluid" id="contdpto">
                                        <div class="row">
                                            <div id="dptom">
                                                <div class="col-md-8 col-md-offset-2">
                                                    <div class="form-group row">
                                                        <label for="nomDptom_">Nombre del Departamento</label>
                                                        <input type="text" name="Descripcion" class="form-control descripcion" id="nomDptom_"/><i class="fa fa-briefcase " id="micdp1"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-md-offset-2">
                                                    <div class="form-group row">
                                                        <label for="stDptom_">Estatus del Departamento</label><span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                        <select name="Status" class="form-control status" id="stDptom_">
                                                            <option value="1">Activo</option>
                                                            <option value="0">Inactivo</option>
                                                        </select><i class="fa fa-check" id="micdp2"></i>
                                                    </div>
                                                </div> 
                                            </div> 
                                        </div>
                                        <input type="hidden" value="" id="MIndexD" name="MIndex">

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

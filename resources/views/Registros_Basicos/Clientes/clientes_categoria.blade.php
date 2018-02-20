@extends('admin.basesys')
    @section('contenido')
        @section('title')
            Registro Cliente - Categoría
        @endsection
            @include('layout/header')
                @include('layout/sidebar')
                    <div class="contenido">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-4 ttlp">
                                    <h1>{{$extra->nombreComercial}} - Categorías</h1>
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
                                                <input type="search" class="form-control filtro" placeholder="Buscar categoría..."><span class="fa fa-search"></span>
                                            </div>
                                        </form> 
                                        <a class="bttn-search">
                                            <span class="fa fa-search"></span>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-2 despl-bttn">
                                    <a href="/menu/registros/clientes">
                                        <div class="bttn-volver">
                                            <button id="btnBk" type="button" href="#" class="bttn-vol"><span class="fa fa-chevron-left"></span><span class="txt-bttn">VOLVER</span></button>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-5 col-sm-5 col-md-6 col-md-offset-3" id="areaResultados" > 
                         
                        @foreach($consulta as $categoria)   
                                <div class="contMd" style="">
                                   <div class="icl">
                                       @foreach($acciones as $accion)
                                           @if($accion->id!=18)
                                               @if($accion->id==16)
                                                   <span class="iclsp">
                                                       <a  class="tltp ModificarCategoria" data-ttl="{{$accion->descripcion}}" data-reg="{{$categoria->id}}"data-toggle="modal" id="m{{$categoria->id}}" >
                                                           <i class="{{$accion->clase_css}}"></i>
                                                       </a>
                                                    </span>
                                               @elseif($accion->id!=16)
                                                    <span class="iclsp">
                                                        <a href="{{$accion->url.$categoria->id}}" class="tltp" data-ttl="{{$accion->descripcion}}">
                                                           <i class="{{$accion->clase_css}}"></i>
                                                        </a>
                                                    </span>
                                               @endif
                                           @elseif($accion->id==18)
                                               @if($categoria->status==1)
                                                   <div class="chbx">
                                                       <input type="checkbox" class="btnAcc checkCategoria" name="status" id="{{'inchbx'. $categoria->id}}" value="{{$categoria->status}}" data-reg="{{$categoria->id}}" checked><label for="{{'inchbx'. $categoria->id}}" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
                                                   </div>
                                                @elseif($categoria->status==0)
                                                   <div class="chbx">
                                                       <input type="checkbox" class="btnAcc checkCategoria" name="status" id="{{'inchbx'. $categoria->id}}" value="{{$categoria->status}}" data-reg="{{$categoria->id}}"><label for="{{'inchbx'. $categoria->id}}" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
                                                   </div>
                                               @endif
                                           @endif
                                       @endforeach
                                   </div>
                                    <p class="ttlMd"><strong>{{$categoria->nombre}}</strong></p>
                                    <input type="hidden" name="idcateg{{$categoria->id}}" value="{{$categoria->id}}" id="idcategm{{$categoria->id}}">
                                </div>
                          @endforeach
							
                        </div>
                        <!-- 	Registro -->


                        <!-- Modal -->
                        @if($agregar)
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">{{$extra->nombreComercial}} Agregar Categoría</h4>
                                    </div>
                                    <form method="post" id="agregarCategoria__" class="Validacion">
                                    <div class="modal-body">
                                        
                                            {{ csrf_field() }}
                                            <div class="container-fluid" id="contcat">
                                                <div class="row" id="rCat">
                                                    <div class="col-md-10 ">
                                                    <div class="form-group col-md-offset-2">
                                                        <label for="nomCat">Nombre de la Categoría</label>
                                                        <input type="text" name="nomCat" class="form-control userEmail" id="Cat1"><i class="fa fa-briefcase" id="icct1"></i>
                                                    </div>
                                                    </div>
                                                    <div class="col-md-10 ">
                                                    <div class="form-group col-md-offset-2">
                                                        <label for="stCat">Estatus de la Categoría</label><span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                        <select name="stCat" class="form-control userEmail" id="Cat2">
                                                            <option value="">-</option>
                                                            <option value="1">Activo</option>
                                                            <option value="0">Inactivo</option>
                                                        </select><i class="fa fa-check" id="icct2"></i>
                                                    </div>
                                                    </div>
                                                </div>
                                        
                                    </div>
                                    <input type="hidden" name="cliente_id__" id="cliente_id__" value="{{$extra->id}}">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary" id="btnGuardarCategoria">Guardar<i class="fa fa-floppy-o"></i></button>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                       @endif 
                        <!--Modificar Categoria-->
                            <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel2">{{$extra->nombreComercial}} Modificar Categoría</h4>
                                        </div>
                                        <form id="categoriaActualizar" class="Validacion">
                                            <div class="modal-body">

                                                {{ csrf_field() }}
                                                <div class="container-fluid" id="contcatm">
                                                    <div class="row" id="rCatm">
                                                        <div class="col-md-10 ">
                                                            <div class="form-group col-md-offset-2">
                                                                <label for="nomCat">Nombre de la Categoría</label>
                                                                <input type="text" name="nomCat" class="form-control userEmail" id="catText"><i class="fa fa-briefcase" id="micct1"></i>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-10 ">
                                                            <div class="form-group col-md-offset-2">
                                                                <label for="stCat">Estatus de la Categoría</label><span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                                <select name="stCat" class="form-control userEmail" id="catStatus">
                                                                    <option value="">-</option>
                                                                    <option value="1">Activo</option>
                                                                    <option value="0">Inactivo</option>
                                                                </select><i class="fa fa-check" id="micct2"></i>
                                                               
                                                            </div>
                                                        </div>
                                                    </div>
                                                        <input type="hidden" name="_idCategoria_" id="_idCategoria_" value="">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary" id="btnModificarCategoria">Modificar<i class="fa fa-floppy-o"></i></button>
                                                </div>
                                                </form>
                                            </div>
                                    </div>
                                </div>
                    </div>   
@endsection
@section('js')
    <script src="{{asset('js/vistaCategoriaMatriz.js')}}"></script>
@endsection
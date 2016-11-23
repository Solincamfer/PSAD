@extends('admin.basesys')
	@section('contenido')
		@section('title')
			Registro Cliente
		@endsection
			 @include('layout/header')
                @include('layout/sidebar')
				<div class="contenido">
					<div class="container">
						<div class="row">
							<div class="col-md-2 ttlp">
								<h1>Cliente Matriz</h1>
							</div>
						</div>
					</div>
				<!-- Registro -->
					<div class="col-xs-5 col-sm-5 col-md-6 col-md-offset-3" style=""> 
						@if($agregar)
							<button id="btnAdd" type="button" class="btnAdc col-md-offset-11" data-toggle="modal" data-target="#myModal" href="#myModal"><i class="fa fa-plus"></i> AGREGAR</button>
						@endif
						@foreach($consulta as $clientes)
							<div class="contMd" style="">
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
													<input type="checkbox" class="btnAcc" name="inchbx1" id="{{'inchbx'. $clientes->id}}" value="{{$accion->status_ac}}" checked><label for="{{'inchbx'. $clientes->id}}" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
												</div>
											@elseif($accion->staus_ac==0)
												<div class="chbx">
													<input type="checkbox" class="btnAcc" name="status" id="{{'inchbx'. $clientes->id}}" value="{{$accion->status_ac}}"><label for="{{'inchbx'. $clientes->id}}" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
												</div>
											@endif
										@endif
									@endforeach
								</div>
								<p class="ttlMd" style="display: inline-block;"><strong>{{$clientes->razon_s}}</strong></p>
							
							</div>
						@endforeach
					</div>

				<!-- 	Registro -->


					<!-- Modal Agregar-->
					<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="myModalLabel">Agregar nuevo cliente</h4>
								</div>
								
									<form method="post" class="form-horizontal Validacion" id="Formclientemd" action="/menu/registros/clientes/insertar">
										{{ csrf_field() }}
										<div class="modal-body">						
											 <ul class="nav nav-tabs" role="tablist">
                                                <li role="presentation" class="active" ><a href="#panelsv1" id="am0" aria-controls="panelmd1" role="tab" data-toggle="tab">Datos basicos</a></li>
                                                <li role="presentation" ><a href="#panelsv2" id="am1" aria-controls="panelmd2" role="tab" data-toggle="tab">Dirección Fiscal</a></li>
                                                <li role="presentation" ><a href="#panelsv3" id="am2" aria-controls="panelmd3" role="tab" data-toggle="tab">Direccion Comercial</a></li>
                                                <li role="presentation" ><a href="#panelsv4" id="am3" aria-controls="panelmd4" role="tab" data-toggle="tab">Contacto</a></li>
                                            </ul>
										<div class="container-fluid">
											<div class="tab-content">

												<div role="tabpanel" class="tab-pane active" id="panelsv1">
													<div class="container-fluid" id="contDb">
													<br>
														<div class="col-md-12" id="dbc1">
															<div class="form-group col-md-12">
																<label for="rs">Razon Social:</label>							
																<input type="text" name="rs" class="form-control userEmail"  id="in1"/>
																<i class="fa fa-university" id="icc1"></i>								
															</div>															
															<div class="form-group col-md-12">
															
																<label for="nc">Nombre Comercial:</label>
																<input type="text" name="nc" id="in2" class="form-control userEmail" />
																<i class="fa fa-building" id="icc2"></i>
															
															</div>
														</div>
														<div class="col-md-12" id="dbc2">	
															<label for="rif" class="col-md-12">Rif:</label><span class="ic"><i class="fa fa-chevron-down"></i></span>									
															<div class="form-group col-md-4" id="sep">
																<select name="rif" id="in3" class="form-control userEmail">
																	<option value="">-</option>
																@foreach($tipoR as $rif)
																	<option value="{{$rif->id}}">{{$rif->descripcion}}</option>
																@endforeach
																
																	<!-- <option value="1">J-</option>
																	<option value="2">G-</option> -->
																</select><i class="fa fa-clipboard" id="icc3"></i>
															</div>	
															<div class="form-group col-md-8">									
																<input type="text" id="in4" class="form-control typeRifNumber" name="df"/>
																<i class="fa fa-address-card" id="icc4"></i>
															</div>	
														</div>															
														<div class="col-md-12" id="dbc3">	
															<div class="form-group col-md-12">													
																<label for="tipCon">Contribuyente</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
																<select name="tipCon" id="in5" class="form-control userEmail" >
																<option value="">-</option>
																	@foreach($tipoC as $contribuyente)
																		<option value="{{$contribuyente->id}}">{{$contribuyente->descripcion}}</option>
																	@endforeach
																</select><i class="fa fa-clipboard" id="icc5"></i>														
														</div>
														</div>
													</div>
												</div>

													<div role="tabpanel" class="tab-pane" id="panelsv2">
													<div class="container-fluid" id="contdf">
													<br>
														<div class="form-group col-md-6" id="dfc1">
															<label for="paisdf">País</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
															<select name="paisdf" id="inn1" class="form-control userEmail">
															<option value="">-</option>
																@foreach($paises as $pais)
																		<option value="{{$pais->id}}">{{$pais->id}}</option>
																@endforeach
															</select><i class="fa fa-globe" id="icc6"></i>
														</div>
														<div class="form-group col-md-7" id="dfc2">
															<div class="col-md-offset-2">
																<label for="regiondf">Región</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
																<select name="regiondf" id="inn2" class="form-control userEmail">
																<option value="">-</option>
																	@foreach($regiones as $region)
																		<option value="{{$region->id}}">{{$region->descripcion}}</option>
																   @endforeach
																</select><i class="fa fa-map" id="icc7"></i>
															</div>
														</div>
														<div class="form-group col-md-6" id="dfc3">
															<label for="edodf">Estado</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
															<select name="edodf" id="inn3" class="form-control userEmail">
															<option value="">-</option>
																@foreach($estados as $estado)
																	<option value="{{$estado->id}}">{{$estado->descripcion}}</option>
																@endforeach
															</select><i class="fa fa-map-pin" id="icc8"></i>
														</div>
														<div class="form-group col-md-7" id="dfc4">
															<div class="col-md-offset-2">
																<label for="mundf">Municipio</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
																<select name="mundf" id="inn4" class="form-control userEmail">
																<option value="">-</option>
																	@foreach($municipios as $municipio)
																		<option value="{{$municipio->id}}">{{$municipio->descripcion}}</option>
																    @endforeach
																</select><i class="fa fa-map-signs" id="icc9"></i>
														</div>	
														</div>
														<div class="form-group col-md-12" id="dfc5">
																<label for="descDirdf">Descripción de la dirección</label>
															<textarea type="text" name="descDirdf" id="inn5" class="form-control userEmail"></textarea><i class="fa fa-map-marker" id="icc10"></i>
														</div>
													</div>
												
												</div>	



												<div role="tabpanel" class="tab-pane" id="panelsv3">
													<div class="container-fluid" id="contdf">
													<br>
														<div class="form-group col-md-6" id="dfc1">
															<label for="paisdc">País</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
															<select name="paisdc" id="innn1" class="form-control userEmail">
															<option value="">-</option>
																@foreach($paises as $pais)
																		<option value="{{$pais->id}}">{{$pais->descripcion}}</option>
																@endforeach
															</select><i class="fa fa-globe" id="icc6"></i>
														</div>
														<div class="form-group col-md-7" id="dfc2">
															<div class="col-md-offset-2">
																<label for="regiondc">Región</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
																<select name="regiondc" id="innn2" class="form-control userEmail">
																<option value="">-</option>
																	@foreach($regiones as $region)
																		<option value="{{$region->id}}">{{$region->descripcion}}</option>
																   @endforeach
																</select><i class="fa fa-map" id="icc7"></i>
															</div>
														</div>
														<div class="form-group col-md-6" id="dfc3">
															<label for="edodc">Estado</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
															<select name="edodc" id="innn3" class="form-control userEmail">
															<option value="">-</option>
																@foreach($estados as $estado)
																	<option value="{{$estado->id}}">{{$estado->descripcion}}</option>
																@endforeach
															</select><i class="fa fa-map-pin" id="icc8"></i>
														</div>
														<div class="form-group col-md-7" id="dfc4">
															<div class="col-md-offset-2">
																<label for="mundc">Municipio</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
																<select name="mundc" id="innn4" class="form-control userEmail">
																<option value="">-</option>
																	@foreach($municipios as $municipio)
																		<option value="{{$municipio->id}}">{{$municipio->descripcion}}</option>
																    @endforeach
																</select><i class="fa fa-map-signs" id="icc9"></i>
														</div>	
														</div>
														<div class="form-group col-md-12" id="dfc5">
																<label for="descDirdc">Descripción de la dirección</label>
															<textarea type="text" name="descDirdc" id="innn5" class="form-control userEmail"></textarea><i class="fa fa-map-marker" id="icc10"></i>
														</div>
													</div>	
														</div>													
														
													

												<div role="tabpanel" class="tab-pane" id="panelsv4">
													<div class="container-fluid" id="contctt">

														<br>
														<div class="row">
															<div id="ctoc1">
																<div class="col-md-12">
																	<label for="tlflcl">N° Local:</label><span class="ic"><i class="fa fa-chevron-down"></i></span>
																</div>
																<div class="col-md-5">
																	<div class="form-group">
																		<select name="tlflcl" id="innnn1" class="form-control userEmail">
																				<option value="">-</option>
																			@foreach($codigoL as $local)
																			<option value="{{$local->id}}">{{$local->descripcion}}</option>
																			@endforeach
																		</select><i class="fa fa-hashtag" id="icc16"></i>
																	</div>
																</div>
																<div class="col-md-7">
																	<div class="form-group">
																		<input type="text" name="tcl" id="innnn2" class="form-control typeTlfNumber col-md-12" /><i class="fa fa-phone" id="icc17"></i>
																	</div>
																</div>

															</div>
														</div>
														<div class="row">
															<div id="ctoc2">
																<div class="col-md-12">
																	<label for="tlfmvl">N° Móvil</label><span class="ic"><i class="fa fa-chevron-down"></i></span>
																</div>
																<div class="col-md-5">
																	<div class="form-group">
																		<select name="tlfmvl" id="innnn3" class="form-control userEmail">
																		<option value="">-</option>
																			@foreach($codigoC as $celular)
																			<option value="{{$celular->id}}">{{$celular->descripcion}}</option>
																			@endforeach
																		</select><i class="fa fa-hashtag" id="icc18"></i>
																	</div>
																</div>
																<div class="col-md-7">
																	<div class="form-group">        
																		<input type="text" name="tmvl" id="innnn4" class="form-control typeTlfNumber" /><i class="fa fa-mobile" id="icc19"></i>
																	</div>
																</div>
															</div>
														</div>
														<div class="row">
															<div class="col-md-12" id="ctoc3">
																<div class="form-group">
																	<label for="mail">Correo Electrónico</label>
																	<input type="text" name="mail" id="innnn5" class="form-control typeEmail">
																	<i class="fa fa-envelope" id="icc20"></i>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										</div>								
										<div class="modal-footer">
											<button type="button" class="btn btn-primary" id="btnGuardarCliente">Siguiente<i class="fa fa-hand-o-right"></i></button>	
										</div>
								</form>
															
							</div>
						</div>
					</div>
			   
					<!-- Modal modificar-->
					<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="myModalLabel2">Modificar</h4>
								</div>
							<form method="post" class="form-horizontal Validacion" id="Formclientemd" action="">
										{{ csrf_field() }}
										<div class="modal-body">						
											 <ul class="nav nav-tabs" role="tablist">
                                                <li role="presentation" class="active" ><a href="#panelmd1" id="am10" aria-controls="panelmd1" role="tab" data-toggle="tab">Datos basicos</a></li>
                                                <li role="presentation" ><a href="#panelmd2" id="am11" aria-controls="panelmd2" role="tab" data-toggle="tab">Dirección Fiscal</a></li>
                                                <li role="presentation" ><a href="#panelmd3" id="am12" aria-controls="panelmd3" role="tab" data-toggle="tab">Direccion Comercial</a></li>
                                                <li role="presentation" ><a href="#panelmd4" id="am13" aria-controls="panelmd4" role="tab" data-toggle="tab">Contacto</a></li>
                                            </ul>
										<div class="container-fluid">
											<div class="tab-content">

												<div role="tabpanel" class="tab-pane active" id="panelmd1">
													<div class="container-fluid" id="contDb">
													<br>
														<div class="col-md-12" id="dbc1">
															<div class="form-group col-md-12">
																<label for="rs">Razon Social:</label>							
																<input type="text" name="rs" class="form-control userEmail"  id="in11"/>
																<i class="fa fa-university" id="icc1"></i>								
															</div>															
															<div class="form-group col-md-12">
															
																<label for="nc">Nombre Comercial:</label>
																<input type="text" name="nc" id="in12" class="form-control userEmail" />
																<i class="fa fa-building" id="icc2"></i>
															
															</div>
														</div>
														<div class="col-md-12" id="dbc2">	
															<label for="rif" class="col-md-12">Rif:</label><span class="ic"><i class="fa fa-chevron-down"></i></span>									
															<div class="form-group col-md-4" id="sep">
																<select name="rif" id="in13" class="form-control userEmail">
																	<option value="">-</option>
																@foreach($tipoR as $rif)
																	<option value="{{$rif->id}}">{{$rif->descripcion}}</option>
																@endforeach
																
																	<!-- <option value="1">J-</option>
																	<option value="2">G-</option> -->
																</select><i class="fa fa-clipboard" id="icc3"></i>
															</div>	
															<div class="form-group col-md-8">									
																<input type="text" id="in14" class="form-control typeRifNumber" name="df"/>
																<i class="fa fa-address-card" id="icc4"></i>
															</div>	
														</div>															
														<div class="col-md-12" id="dbc3">	
															<div class="form-group col-md-12">													
																<label for="tipCon">Contribuyente</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
																<select name="tipCon" id="in15" class="form-control userEmail" >
																<option value="">-</option>
																	@foreach($tipoC as $contribuyente)
																		<option value="{{$contribuyente->id}}">{{$contribuyente->descripcion}}</option>
																	@endforeach
																</select><i class="fa fa-clipboard" id="icc5"></i>														
														</div>
														</div>
													</div>
												</div>

													<div role="tabpanel" class="tab-pane" id="panelmd2">
													<div class="container-fluid" id="contdf">
													<br>
														<div class="form-group col-md-6" id="dfc1">
															<label for="paisdf">País</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
															<select name="paisdf" id="inn11" class="form-control userEmail">
															<option value="">-</option>
																@foreach($paises as $pais)
																		<option value="{{$pais->id}}">{{$pais->descripcion}}</option>
																@endforeach
															</select><i class="fa fa-globe" id="icc6"></i>
														</div>
														<div class="form-group col-md-7" id="dfc2">
															<div class="col-md-offset-2">
																<label for="regiondf">Región</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
																<select name="regiondf" id="inn12" class="form-control userEmail">
																<option value="">-</option>
																	@foreach($regiones as $region)
																		<option value="{{$region->id}}">{{$region->descripcion}}</option>
																   @endforeach
																</select><i class="fa fa-map" id="icc7"></i>
															</div>
														</div>
														<div class="form-group col-md-6" id="dfc3">
															<label for="edodf">Estado</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
															<select name="edodf" id="inn13" class="form-control userEmail">
															<option value="">-</option>
																@foreach($estados as $estado)
																	<option value="{{$estado->id}}">{{$estado->descripcion}}</option>
																@endforeach
															</select><i class="fa fa-map-pin" id="icc8"></i>
														</div>
														<div class="form-group col-md-7" id="dfc4">
															<div class="col-md-offset-2">
																<label for="mundf">Municipio</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
																<select name="mundf" id="inn14" class="form-control userEmail">
																<option value="">-</option>
																	@foreach($municipios as $municipio)
																		<option value="{{$municipio->id}}">{{$municipio->descripcion}}</option>
																    @endforeach
																</select><i class="fa fa-map-signs" id="icc9"></i>
														</div>	
														</div>
														<div class="form-group col-md-12" id="dfc5">
																<label for="descDirdf">Descripción de la dirección</label>
															<textarea type="text" name="descDirdf" id="inn15" class="form-control userEmail"></textarea><i class="fa fa-map-marker" id="icc10"></i>
														</div>
													</div>
												
												</div>	



												<div role="tabpanel" class="tab-pane" id="panelmd3">
													<div class="container-fluid" id="contdf">
													<br>
														<div class="form-group col-md-6" id="dfc1">
															<label for="paisdf">País</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
															<select name="paisdf" id="innn11" class="form-control userEmail">
															<option value="">-</option>
																@foreach($paises as $pais)
																		<option value="{{$pais->id}}">{{$pais->descripcion}}</option>
																@endforeach
															</select><i class="fa fa-globe" id="icc6"></i>
														</div>
														<div class="form-group col-md-7" id="dfc2">
															<div class="col-md-offset-2">
																<label for="regiondf">Región</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
																<select name="regiondf" id="innn12" class="form-control userEmail">
																<option value="">-</option>
																	@foreach($regiones as $region)
																		<option value="{{$region->id}}">{{$region->descripcion}}</option>
																   @endforeach
																</select><i class="fa fa-map" id="icc7"></i>
															</div>
														</div>
														<div class="form-group col-md-6" id="dfc3">
															<label for="edodf">Estado</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
															<select name="edodf" id="innn13" class="form-control userEmail">
															<option value="">-</option>
																@foreach($estados as $estado)
																	<option value="{{$estado->id}}">{{$estado->descripcion}}</option>
																@endforeach
															</select><i class="fa fa-map-pin" id="icc8"></i>
														</div>
														<div class="form-group col-md-7" id="dfc4">
															<div class="col-md-offset-2">
																<label for="mundf">Municipio</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
																<select name="mundf" id="innn14" class="form-control userEmail">
																<option value="">-</option>
																	@foreach($municipios as $municipio)
																		<option value="{{$municipio->id}}">{{$municipio->descripcion}}</option>
																    @endforeach
																</select><i class="fa fa-map-signs" id="icc9"></i>
														</div>	
														</div>
														<div class="form-group col-md-12" id="dfc5">
																<label for="descDirdf">Descripción de la dirección</label>
															<textarea type="text" name="descDirdf" id="innn15" class="form-control userEmail"></textarea><i class="fa fa-map-marker" id="icc10"></i>
														</div>
													</div>	
														</div>													
														
													

												<div role="tabpanel" class="tab-pane" id="panelmd4">
													<div class="container-fluid" id="contctt">

														<br>
														<div class="row">
															<div id="ctoc1">
																<div class="col-md-12">
																	<label for="tlflcl">N° Local:</label><span class="ic"><i class="fa fa-chevron-down"></i></span>
																</div>
																<div class="col-md-5">
																	<div class="form-group">
																		<select name="tlflcl" id="innnn11" class="form-control userEmail">
																				<option value="">-</option>
																			@foreach($codigoL as $local)
																			<option value="{{$local->id}}">{{$local->descripcion}}</option>
																			@endforeach
																		</select><i class="fa fa-hashtag" id="icc16"></i>
																	</div>
																</div>
																<div class="col-md-7">
																	<div class="form-group">
																		<input type="text" name="tcl" id="innnn12" class="form-control typeTlfNumber col-md-12" /><i class="fa fa-phone" id="icc17"></i>
																	</div>
																</div>

															</div>
														</div>
														<div class="row">
															<div id="ctoc2">
																<div class="col-md-12">
																	<label for="tlfmvl">N° Móvil</label><span class="ic"><i class="fa fa-chevron-down"></i></span>
																</div>
																<div class="col-md-5">
																	<div class="form-group">
																		<select name="tlfmvl" id="innnn13" class="form-control userEmail">
																		<option value="">-</option>
																			@foreach($codigoC as $celular)
																			<option value="{{$celular->id}}">{{$celular->descripcion}}</option>
																			@endforeach
																		</select><i class="fa fa-hashtag" id="icc18"></i>
																	</div>
																</div>
																<div class="col-md-7">
																	<div class="form-group">        
																		<input type="text" name="tmvl" id="innnn14" class="form-control typeTlfNumber" /><i class="fa fa-mobile" id="icc19"></i>
																	</div>
																</div>
															</div>
														</div>
														<div class="row">
															<div class="col-md-12" id="ctoc3">
																<div class="form-group">
																	<label for="mail">Correo Electrónico</label>
																	<input type="text" name="mail" id="innnn15" class="form-control typeEmail">
																	<i class="fa fa-envelope" id="icc20"></i>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										</div>								
										<div class="modal-footer">
											<button type="button" class="btn btn-primary" id="btnModificarCliente">Siguiente<i class="fa fa-hand-o-right"></i></button>	
										</div>
								</form>
								

							</div>
						</div>
					</div>
				</div>   
	@endsection
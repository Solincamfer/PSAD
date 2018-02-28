@extends('admin.basesys')
	@section('contenido')
		@section('title')
			Registro Cliente
		@endsection
			 @include('layout/header')
                @include('layout/sidebar')
				<div class="contenido">
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-2 ttlp">
								<h1>Cliente Matriz</h1>
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
											<input type="search" class="form-control filtro" placeholder="Buscar cliente..."><span class="fa fa-search"></span>
										</div>
									</form> 
									<a class="bttn-search">
										<span class="fa fa-search"></span>
									</a>
								</div>
							</div>
						</div>
					</div>
				<!-- Registro -->
					<div class="col-xs-5 col-sm-5 col-md-6 col-md-offset-3" id="areaResultados" data-tab="{{$extra}}"> 
						
						@foreach($consulta as $clientes)
							<div class="contMd">
								<div class="icl">
									
									@foreach($acciones as $accion)
										@if($accion->id!=12)
											@if($accion->id==9)
											<span class="iclsp">
												<a  class="tltp ModificarCliente" data-reg="{{$clientes->id}}" id="m{{$clientes->id}}" data-ttl="{{$accion->descripcion}}" data-toggle="modal" > 
													<i class="{{$accion->clase_css}}"></i>
												</a>
											</span>
											@elseif($accion->id!=9)
											<span class="iclsp">
												<a href="{{$accion->url.$clientes->id}}" class="tltp responsableMatriz" data-ttl="{{$accion->descripcion}}" data-reg="{{$clientes->id}}">
													<i class="{{$accion->clase_css}}"></i>
												</a>
											</span>
											@endif
										@elseif($accion->id==12)
											@if($clientes->status==1)
												<div class="chbx">
													<input type="checkbox" class="checkClientes" name="status" id="{{'inchbx'. $clientes->id}}" value="{{$clientes->status}}" data-reg="{{$clientes->id}}" checked><label for="{{'inchbx'. $clientes->id}}" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
												</div>
											@elseif($clientes->status==0)
												<div class="chbx">
													<input type="checkbox" class="checkClientes" name="status" id="{{'inchbx'. $clientes->id}}" value="{{$clientes->status}}" data-reg="{{$clientes->id}}"><label for="{{'inchbx'. $clientes->id}}" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
												</div>
											@endif
											
										@endif

									@endforeach
									<div class="paginador">
                         				 {{ $consulta->links() }}
                        			</div>
                       
								</div>
								<p class="ttlMd" style="display: inline-block;"><strong>{{$clientes->nombreComercial}}</strong></p>
								
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
							<form method="post" class="form-horizontal Validacion" id="Formclientesv" >
										{{ csrf_field() }}
										<div class="modal-body">						
											 <ul class="nav nav-tabs" role="tablist">
                                                <li role="presentation" class="active" ><a href="#panelsv1" id="am0" aria-controls="" role="tab" data-toggle="tab">Datos basicos</a></li>
                                                <li role="presentation" ><a href="#panelsv2" id="am1" aria-controls="" role="tab" data-toggle="tab">Dirección Fiscal</a></li>
                                                <li role="presentation" ><a href="#panelsv3" id="am2" aria-controls="panelsv3" role="tab" data-toggle="tab">Direccion Comercial</a></li>
                                                <li role="presentation" ><a href="#panelsv4" id="am3" aria-controls="panelsv4" role="tab" data-toggle="tab">Contacto</a></li>
                                            </ul>
										<div class="container-fluid">
											<div class="tab-content">

												<div role="tabpanel" class="tab-pane active" id="panelsv1">
													<div class="container-fluid" id="contDb">
													<br>
														<div class="col-md-12" id="dbc1">
															<div class="form-group col-md-12">
																<label for="rs">Razon Social:</label>							
																<input type="text" name="rsnew" class="form-control userEmail"  id="ip1"/>
																<i class="fa fa-university" id="icc1"></i>								
															</div>															
															<div class="form-group col-md-12">
															
																<label for="nc">Nombre Comercial:</label>
																<input type="text" name="ncnew" id="ip2" class="form-control userEmail" />
																<i class="fa fa-building" id="icc2"></i>
															
															</div>
														</div>
														<div class="col-md-12" id="dbc2">	
															<label for="rif" class="col-md-12">Rif:</label><span class="ic"><i class="fa fa-chevron-down"></i></span>									
															<div class="form-group col-md-4" id="sep">
																<select name="tiporif" id="ip3" class="form-control userEmail">
																	<option value=" ">-</option>
																@foreach($tipoR as $rif)
																	<option value="{{$rif->id}}">{{$rif->descripcion}}</option>
																@endforeach
																
																	<!-- <option value="1">J-</option>
																	<option value="2">G-</option> -->
																</select><i class="fa fa-clipboard" id="icc3"></i>
															</div>	
															<div class="form-group col-md-8">									
																<input type="text" id="ip4" class="form-control typeRifNumber" name="numerorif"/>
																<i class="fa fa-address-card" id="icc4"></i>
															</div>	
														</div>															
														<div class="col-md-12" id="dbc3">	
															<div class="form-group col-md-12">													
																<label for="tipCon">Contribuyente</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
																<select name="tipConnew" id="ip5" class="form-control userEmail" >
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
															<select name="paisdf" id="ipp1" class="form-control userEmail dirCliente" data-caso="0" data-grupo="0">
															<option value="">-</option>
																@foreach($paises as $pais)
																		<option value="{{$pais->id}}">{{$pais->descripcion}}</option>
																@endforeach
															</select><i class="fa fa-globe" id="icc6"></i>
														</div>
														<div class="form-group col-md-7" id="dfc2">
															<div class="col-md-offset-2">
																<label for="regiondf">Región</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
																<select name="regiondf" id="ipp2" class="form-control userEmail dirCliente" data-caso="1" data-grupo="0">
																<option value="">-</option>
																</select><i class="fa fa-map" id="icc7"></i>
															</div>
														</div>
														<div class="form-group col-md-6" id="dfc3">
															<label for="edodf">Estado</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
															<select name="edodf" id="ipp3" class="form-control userEmail dirCliente" data-caso="2" data-grupo="0">
															<option value="">-</option>
															</select><i class="fa fa-map-pin" id="icc8"></i>
														</div>
														<div class="form-group col-md-7" id="dfc4">
															<div class="col-md-offset-2">
																<label for="mundf">Municipio</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
																<select name="mundf" id="ipp4" class="form-control userEmail dirCliente" data-caso="3" data-grupo="0">
																<option value="">-</option>
																</select><i class="fa fa-map-signs" id="icc9"></i>
														</div>	
														</div>
														<div class="form-group col-md-12" id="dfc5">
																<label for="descDirdf">Descripción de la dirección</label>
															<textarea type="text" name="descDirdf" id="ipp5" class="form-control userEmail"></textarea><i class="fa fa-map-marker" id="icc10"></i>
														</div>
													</div>
												
												</div>	



												<div role="tabpanel" class="tab-pane" id="panelsv3">
													<div class="container-fluid" id="contdf">
													<br>
														<div class="form-group col-md-6" id="dfc1">
															<label for="paisdc">País</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
															<select name="paisdc" id="ippp1" class="form-control userEmail dirCliente" data-caso="0" data-grupo="1">
															<option value="">-</option>
																@foreach($paises as $pais)
																		<option value="{{$pais->id}}">{{$pais->descripcion}}</option>
																@endforeach
															</select><i class="fa fa-globe" id="icc6"></i>
														</div>
														<div class="form-group col-md-7" id="dfc2">
															<div class="col-md-offset-2">
																<label for="regiondc">Región</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
																<select name="regiondc" id="ippp2" class="form-control userEmail dirCliente" data-caso="1" data-grupo="1" >
																<option value="">-</option>
																</select><i class="fa fa-map" id="icc7"></i>
															</div>
														</div>
														<div class="form-group col-md-6" id="dfc3">
															<label for="edodc">Estado</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
															<select name="edodc" id="ippp3" class="form-control userEmail dirCliente" data-caso="2" data-grupo="1">
															<option value="">-</option>
															</select><i class="fa fa-map-pin" id="icc8"></i>
														</div>
														<div class="form-group col-md-7" id="dfc4">
															<div class="col-md-offset-2">
																<label for="mundc">Municipio</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
																<select name="mundc" id="ippp4" class="form-control userEmail dirCliente" data-caso="3" data-grupo="1">
																<option value="">-</option>
																</select><i class="fa fa-map-signs" id="icc9"></i>
															</div>	
														</div>
														<div class="form-group col-md-12" id="dfc5">
																<label for="descDirdc">Descripción de la dirección</label>
															<textarea type="text" name="descDirdc" id="ippp5" class="form-control userEmail"></textarea><i class="fa fa-map-marker" id="icc10"></i>
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
																		<select name="tlflsv" id="ipppp1" class="form-control userEmail">
																			<option value="">-</option>
																			@foreach($codigoL as $local)
																			<option value="{{$local->id}}">{{$local->descripcion}}</option>
																			@endforeach
																		</select><i class="fa fa-hashtag" id="icc16"></i>
																	</div>
																</div>
																<div class="col-md-7">
																	<div class="form-group">
																		<input type="text" name="tclsv" id="ipppp2" class="form-control typeTlfNumber col-md-12" /><i class="fa fa-phone" id="icc17"></i>
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
																		<select name="tlfmvlsv" id="ipppp3" class="form-control userEmail">
																		<option value="">-</option>
																			@foreach($codigoC as $celular)
																			<option value="{{$celular->id}}">{{$celular->descripcion}}</option>
																			@endforeach
																		</select><i class="fa fa-hashtag" id="icc18"></i>
																	</div>
																</div>
																<div class="col-md-7">
																	<div class="form-group">        
																		<input type="text" name="tmvlsv" id="ipppp4" class="form-control typeTlfNumber" /><i class="fa fa-mobile" id="icc19"></i>
																	</div>
																</div>
															</div>
														</div>
														<div class="row">
															<div class="col-md-12" id="ctoc3">
																<div class="form-group">
																	<label for="mail">Correo Electrónico</label>
																	<input type="text" name="mailsv" id="ipppp5" class="form-control typeEmail">
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
											<button type="submit" class="btn btn-primary" id="btnGuardarCliente">Guardar <i class="fa fa-floppy-o"></i></button>	
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
									<h4 class="modal-title" id="myModalLabel2">Modificar nuevo cliente</h4>
								</div>
							<form method="post" class="form-horizontal Validacion" id="Formclientemd" >
									{{ csrf_field() }}	
										<div class="modal-body">						
											 <ul class="nav nav-tabs" role="tablist">
                                                <li role="presentation" class="active" ><a href="#panelmd1" id="amm0" aria-controls="panelmd1" role="tab" data-toggle="tab">Datos basicos</a></li>
                                                <li role="presentation" ><a href="#panelmd2" id="amm1" aria-controls="panelmd2" role="tab" data-toggle="tab">Dirección Fiscal</a></li>
                                                <li role="presentation" ><a href="#panelmd3" id="amm2" aria-controls="panelmd3" role="tab" data-toggle="tab">Direccion Comercial</a></li>
                                                <li role="presentation" ><a href="#panelmd4" id="amm3" aria-controls="panelmd4" role="tab" data-toggle="tab">Contacto</a></li>
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
															<select name="paisdf" id="inn1" class="form-control userEmail dirCliente" data-caso="0" data-grupo="2">
															<option value="">-</option>
																@foreach($paises as $pais)
																		<option value="{{$pais->id}}">{{$pais->descripcion}}</option>
																@endforeach
															</select><i class="fa fa-globe" id="icc6"></i>
														</div>
														<div class="form-group col-md-7" id="dfc2">
															<div class="col-md-offset-2">
																<label for="regiondf">Región</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
																<select name="regiondf" id="inn2" class="form-control userEmail dirCliente" data-caso="1" data-grupo="2">
																<option value="">-</option>
																</select><i class="fa fa-map" id="icc7"></i>
															</div>
														</div>
														<div class="form-group col-md-6" id="dfc3">
															<label for="edodf">Estado</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
															<select name="edodf" id="inn3" class="form-control userEmail dirCliente" data-caso="2" data-grupo="2">
															<option value="">-</option>
															</select><i class="fa fa-map-pin" id="icc8"></i>
														</div>
														<div class="form-group col-md-7" id="dfc4">
															<div class="col-md-offset-2">
																<label for="mundf">Municipio</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
																<select name="mundf" id="inn4" class="form-control userEmail dirCliente" data-caso="3" data-grupo="2">
																<option value="0">-</option>
																</select><i class="fa fa-map-signs" id="icc9"></i>
														</div>	
														</div>
														<div class="form-group col-md-12" id="dfc5">
																<label for="descDirdf">Descripción de la dirección</label>
															<textarea type="text" name="descDirdf" id="inn5" class="form-control userEmail"></textarea><i class="fa fa-map-marker" id="icc10"></i>
														</div>
													</div>
												
												</div>	



												<div role="tabpanel" class="tab-pane" id="panelmd3">
													<div class="container-fluid" id="contdf">
													<br>
														<div class="form-group col-md-6" id="dfc1">
															<label for="paisdc">País</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
															<select name="paisdc" id="innn11" class="form-control userEmail dirCliente" data-caso="0" data-grupo="3">
															<option value="">-</option>		
															@foreach($paises as $pais)
																		<option value="{{$pais->id}}">{{$pais->descripcion}}</option>
																@endforeach							
															</select><i class="fa fa-globe" id="icc6"></i>
														</div>
														<div class="form-group col-md-7" id="dfc2">
															<div class="col-md-offset-2">
																<label for="regiondc">Región</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
																<select name="regiondc" id="innn12" class="form-control userEmail dirCliente" data-caso="1" data-grupo="3">
																<option value="">-</option>
																</select><i class="fa fa-map" id="icc7"></i>
															</div>
														</div>
														<div class="form-group col-md-6" id="dfc3">
															<label for="edodc">Estado</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
															<select name="edodc" id="innn13" class="form-control userEmail dirCliente" data-caso="2" data-grupo="3">
															<option value="">-</option>
															</select><i class="fa fa-map-pin" id="icc8"></i>
														</div>
														<div class="form-group col-md-7" id="dfc4">
															<div class="col-md-offset-2">
																<label for="mundc">Municipio</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
																<select name="mundc" id="innn14" class="form-control userEmail dirCliente" data-caso="3" data-grupo="3">
																<option value="">-</option>
																</select><i class="fa fa-map-signs" id="icc9"></i>
															</div>	
														</div>
														<div class="form-group col-md-12" id="dfc5">
																<label for="descDirdc">Descripción de la dirección</label>
															<textarea type="text" name="descDirdc" id="innn15" class="form-control userEmail"></textarea><i class="fa fa-map-marker" id="icc10"></i>
															
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
										<input type="hidden" id="_idCliente_" name="_idCliente_" value="">
										</div>								
										<div class="modal-footer">
											<button type="submit" class="btn btn-primary" id="btnModificarCliente">Guardar <i class="fa fa-floppy-o"></i></button>	
										</div>
								</form>
								

							</div>
						</div>
					</div>
				</div>   
	@endsection
	@section('js')
		<script type="text/javascript" src="{{ asset('js/vista_clientes.js') }}"></script>
	@endSection
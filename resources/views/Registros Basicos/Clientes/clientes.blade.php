@extends('admin.basesys')
	@section('contenido')
		@section('title')
			Registro Cliente
		@endsection
			 @include('layout/header')
                @include('layout/sidebar')
				<div class="contenido">

				<!-- Registro -->
					<div class="col-xs-5 col-sm-5 col-md-6 col-md-offset-3" style=""> 
						@if($agregar)
							<button id="btnAdd" type="button" class="btnAd col-md-offset-10" data-toggle="modal" data-target="#myModal" href="#myModal">AGREGAR <i class="fa fa-plus-circle"></i></button>
						@endif
						
							<div class="contMd" style="">
								@foreach($acciones as $accion)
									@if($accion->descripcion!="Status")
										<span style="display: inline-block; float: right;"><a href="{{$accion->url}}"><i class="{{$accion->clase_css}}"></i></a></span>
								
									@elseif($accion->descripcion=="Status")

										@if($accion->status_ac==1)
											 <input type="checkbox" class="btnAcc" name="status" value="{{$accion->status_ac}}" checked>
										
										@elseif($accion->staus_ac==0)
											 <input type="checkbox" class="btnAcc" name="status" value="{{$accion->status_ac}}" >
										@endif


									@endif
								@endforeach
								<p class="ttlMd" style="display: inline-block;"><strong>REGISTRO</strong></p>
							</div>
					
					</div>

				<!-- 	Registro -->


					<!-- Modal -->
					<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="myModalLabel">Agregar Cliente Matriz</h4>
								</div>
								
									<form method="post" class="form-horizontal Validacion" id="Formcliente" action="">
									<div class="modal-body">						
										<ul class="nav nav-tabs" role="tablist">
											<li role="presentation" class="active" ><a href="#db" id="a1" aria-controls="db" role="tab" data-toggle="tab" style="display: none;">Datos basicos</a></li>
											<li role="presentation" ><a href="#df" id="a2" aria-controls="df" role="tab" data-toggle="tab" style="display: none;">Dirección Fiscal</a></li>
											<li role="presentation" ><a href="#dc" id="a3" aria-controls="dc" role="tab" data-toggle="tab" style="display: none;">Direccion Comercial</a></li>
											<li role="presentation" ><a href="#ctt" id="a4" aria-controls="ctt" role="tab" data-toggle="tab" style="display: none;">Contacto</a></li>
										</ul>
										<div class="container-fluid">
											<div class="tab-content">

												<div role="tabpanel" class="tab-pane active" id="db">
													<div class="container-fluid" id="contDb">
													<center><u><p>DATOS BASICOS</p></u></center>
													<br>
														<div class="col-md-12">
															<div class="form-group col-md-12">
																<label for="rs">Razon Social:</label>							
																<input type="text" name="rs" class="form-control"  id="input1"/>
																<i class="fa fa-university"></i>								
															</div>															
															<div class="form-group col-md-12">
															
																<label for="nc">Nombre Comercial:</label>
																<input type="text" name="nc" id="input2" class="form-control" />
																<i class="fa fa-building"></i>
															
															</div>
														</div>
														<div class="col-md-6">	
														<label for="rif" class="col-md-12">Rif:</label>										
															<div class="form-group col-md-6">
																<select name="rif" id="input3" class="form-control ">
																	<option value="">-</option>
																	<option value="1">J-</option>
																	<option value="2">G-</option>
																</select>
															</div>	
															<div class="form-group col-md-8">									
																<input type="text" id="input4" class="form-control" name="df"/>
																<i class="fa fa-address-card"></i>
															</div>	
														</div>															
														<div class="col-md-6 ">	
															<div class="form-group col-md-12">													
																<label for="tipCon">Contribuyente</label>
																<br>
																<select name="tipCon" id="input5" class="form-control" >
																	<option value="">-</option>
																	<option value="1">asdas</option>
																	<option value="2">sada</option>
																</select>															
														</div>
														</div>
													</div>
												</div>

												<div role="tabpanel" class="tab-pane" id="df">
													<div class="container-fluid" id="contdf">
													<center><u><p>DIRECCION FISCAL</p></u></center>
													<br>
														<div class="form-group col-md-6">
															<label for="paisdf">País</label>
															<br>
															<select name="paisdf" id="input6" class="form-control">
																<option value="">-</option>
																<option value="caracas">caracas</option>											
															</select>
														</div>
														<div class="form-group col-md-7">
															<div class="col-md-offset-2">
															<label for="regiondf">Región</label>
															<br>
															<select name="regiondf" id="input7" class="form-control">
																<option value="">-</option>
																<option value="caracas">caracas</option>
															</select>
															</div>
														</div>
														<div class="form-group col-md-6">
															<label for="edodf">Estado</label>
															<br>
															<select name="edodf" id="input8" class="form-control">
																<option value="">-</option>
																<option value="caracas">caracas</option>
															</select>
														</div>
														<div class="form-group col-md-7">
															<div class="col-md-offset-2">
															<label for="mundf">Municipio</label>
															<br>
															<select name="mundf" id="input9" class="form-control">
																<option value="">-</option>
																<option value="caracas">caracas</option>
															</select>
														</div>	
														</div>
														<div class="form-group col-md-12">
															<i class="fa fa-map-marker"></i>
																<label for="descDirdf">Descripción de la dirección</label>
																<textarea type="text" name="descDirdf" id="input10" class="form-control"></textarea> 
															</div>
													</div>
												</div>

												<div role="tabpanel" class="tab-pane" id="dc">
													<div class="container-fluid" id="contdc">
													<center><u><p>DIRECCION COMERCIAL</p></u></center>
													<br>									
														<div class="form-group col-md-6">
															<label for="paisdc">País</label>
															<br>
															<select name="paisdc" id="input11" class="form-control">
																<option value="">-</option>
																<option value="caracas">caracas</option>											
															</select>
														</div>
														<div class="form-group col-md-7">
															<div class="col-md-offset-2">
															<label for="regiondc">Región</label>
															<br>
															<select name="regiondc" id="input12" class="form-control">
																<option value="">-</option>
																<option value="caracas">caracas</option>
															</select>
															</div>
														</div>
														<div class="form-group col-md-6">
															<label for="edodc">Estado</label>
															<br>
															<select name="edodc" id="input13" class="form-control">
																<option value="">-</option>
																<option value="caracas">caracas</option>
															</select>
														</div>
														<div class="form-group col-md-7">
															<div class="col-md-offset-2">
															<label for="mundc">Municipio</label>
															<br>
															<select name="mundc" id="input14" class="form-control">
																<option value="">-</option>
																<option value="caracas">caracas</option>
															</select>
														</div>	
														</div>													
														
															<div class="form-group col-md-12">
															<i class="fa fa-map-marker"></i>
																<label for="descDirdc">Descripción de la dirección</label>
																<textarea type="text" name="descDirdc" id="input15" class="form-control"></textarea> 
															</div>
														
													</div>
													
												</div>

												<div role="tabpanel" class="tab-pane" id="ctt">
													<div class="container-fluid" id="contctt">
														<center><u><p>FORMAS DE CONTACTO</p></u></center>
														<br>															
															<label for="tlflcl" class="col-md-12">N° Local:</label>	
															<div class="form-group col-md-4">
															<div class="col-md-offset-1">										
																<select name="tlflcl" id="input16" class="form-control">
																	<option value="">-</option>
																	<option value="0212">0212</option>
																</select>
															</div>	
															</div>
															<div class="form-group col-md-8">													
																<input type="text" name="tcl" id="input17" class="form-control col-md-12" />					
															</div>
															
															
															<label for="tlfmvl" class="col-md-12">N° Móvil</label>
															<div class="form-group col-md-4 ">
															<div class="col-md-offset-1">											
																<select name="tlfmvl" id="input18" class="form-control">
																	<option value="">-</option>
																	<option value="0416">0416</option>
																</select>
															</div>
															</div>
															<div class="form-group col-md-8">											
																<input type="text" name="tmvl" id="input19" class="form-control" />
																<i class="fa fa-mobile"></i>
															</div>
															</div>
															<div class="form-group col-md-12 ">
																
																	<label for="mail">Correo Electrónico</label>
																	<input type="email" name="mail" id="input20" class="form-control">
																	<i class="fa fa-envelope"></i>
																
															</div>
														
													</div>
												</div>
											</div>
										</div>								
										<div class="modal-footer">
											<button type="button" class="bttnMd" id="btnAn">Anterior <i class="fa fa-times"></i></button>
											<button type="button" class="bttnMd" id="btnSv">Siguiente <i class="fa fa-hand-o-right"></i></button>	
										</div>
								</form>
															
							</div>
						</div>
					</div>
				   
				</div>   
	@endsection
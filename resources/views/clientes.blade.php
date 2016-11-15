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
						<button id="btnAdd" type="button" class="btnAd col-md-offset-10" data-toggle="modal" data-target="#myModal" href="#myModal">AGREGAR <i class="fa fa-plus-circle"></i></button>
						@for($i=0; $i < 5; $i++)
							<div class="contMd" style="">
								@for($j=0; $j < 5; $j++)
									<button class="btnAcc" type="submit">Modificar</button>
								@endfor
								<p class="ttlMd"><strong>REGISTRO</strong></p>
							</div>
						@endfor
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
								
									<form method="post" class="form-horizontal Validacion" action="#">
									<div class="modal-body">						
										<ul class="nav nav-tabs" role="tablist">
											<li role="presentation" class="active"><a href="#db" aria-controls="db" role="tab" data-toggle="tab">Datos basicos</a></li>
											<li role="presentation"><a href="#df" aria-controls="df" role="tab" data-toggle="tab">Dirección Fiscal</a></li>
											<li role="presentation"><a href="#dc" aria-controls="dc" role="tab" data-toggle="tab">Direccion Comercial</a></li>
											<li role="presentation"><a href="#ctt" aria-controls="ctt" role="tab" data-toggle="tab">Contacto</a></li>
										</ul>
										<div class="container-fluid">
											<div class="tab-content">

												<div role="tabpanel" class="tab-pane active" id="db">
													<div class="container-fluid" id="contDb">
														<div class="col-md-12">
															<div class="form-group col-md-12">
																<label for="rs">Razon Social:</label>							
																<input type="text" name="rs" class="form-control"  id="rz"/>
																<i class="fa fa-university"></i>								
															</div>															
															<div class="form-group col-md-12">
															
																<label for="nc">Nombre Comercial:</label>
																<input type="text" name="nc" class="form-control" />
																<i class="fa fa-building"></i>
															
															</div>
														</div>
														<div class="col-md-6">	
														<label for="rif" class="col-md-12">Rif:</label>										
															<div class="form-group col-md-6">
																<select name="rif" id="" class="form-control ">
																	<option value="">-</option>
																	<option value="1">J-</option>
																	<option value="2">G-</option>
																</select>
															</div>	
															<div class="form-group col-md-8">									
																<input type="text" id="" class="form-control" name="df" />
																<i class="fa fa-address-card"></i>
															</div>	
														</div>															
														<div class="col-md-6 ">	
															<div class="form-group col-md-12">													
																<label for="tipCon">Contribuyente</label>
																<br>
																<select name="tipCon" id="" class="form-control" >
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
														<div class="form-group col-md-6">
															<label for="paisdf">País</label>
															<br>
															<select name="paisdf" id="paisdf" class="form-control">
																<option value="">-</option>
																<option value="caracas">caracas</option>											
															</select>
														</div>
														<div class="form-group col-md-7">
															<div class="col-md-offset-2">
															<label for="regiondf">Región</label>
															<br>
															<select name="regiondf" id="regiondf" class="form-control">
																<option value="">-</option>
																<option value="caracas">caracas</option>
															</select>
															</div>
														</div>
														<div class="form-group col-md-6">
															<label for="edodf">Estado</label>
															<br>
															<select name="edodf" id="edodf" class="form-control">
																<option value="">-</option>
																<option value="caracas">caracas</option>
															</select>
														</div>
														<div class="form-group col-md-7">
															<div class="col-md-offset-2">
															<label for="mundf">Municipio</label>
															<br>
															<select name="mundf" id="mundf" class="form-control">
																<option value="">-</option>
																<option value="caracas">caracas</option>
															</select>
														</div>	
														</div>
														<div class="form-group col-md-12">
															<i class="fa fa-map-marker"></i>
																<label for="descDirdf">Descripción de la dirección</label>
																<textarea type="text" name="descDirdf" class="form-control"></textarea> 
															</div>
													</div>
												</div>

												<div role="tabpanel" class="tab-pane" id="dc">
													<div class="container-fluid" id="contdc">									
														<div class="form-group col-md-6">
															<label for="paisdc">País</label>
															<br>
															<select name="paisdc" id="paisdc" class="form-control">
																<option value="">-</option>
																<option value="caracas">caracas</option>											
															</select>
														</div>
														<div class="form-group col-md-7">
															<div class="col-md-offset-2">
															<label for="regiondc">Región</label>
															<br>
															<select name="regiondc" id="regiondc" class="form-control">
																<option value="">-</option>
																<option value="caracas">caracas</option>
															</select>
															</div>
														</div>
														<div class="form-group col-md-6">
															<label for="edodc">Estado</label>
															<br>
															<select name="edodc" id="edodc" class="form-control">
																<option value="">-</option>
																<option value="caracas">caracas</option>
															</select>
														</div>
														<div class="form-group col-md-7">
															<div class="col-md-offset-2">
															<label for="mundc">Municipio</label>
															<br>
															<select name="mundc" id="mundc" class="form-control">
																<option value="">-</option>
																<option value="caracas">caracas</option>
															</select>
														</div>	
														</div>													
														
															<div class="form-group col-md-12">
															<i class="fa fa-map-marker"></i>
																<label for="descDirdc">Descripción de la dirección</label>
																<textarea type="text" name="descDirdc" class="form-control"></textarea> 
															</div>
														
													</div>
													
												</div>

												<div role="tabpanel" class="tab-pane" id="ctt">
													<div class="container-fluid" id="contctt">
														
															
															
															<label for="tlflcl" class="col-md-12">N° Local:</label>	
															<div class="form-group col-md-4">
															<div class="col-md-offset-1">										
																<select name="tlflcl" id="" class="form-control">
																	<option value="">-</option>
																	<option value="0212">0212</option>
																</select>
															</div>	
															</div>
															<div class="form-group col-md-8">													
																<input type="text" name="tcl" class="form-control col-md-12" />					
															</div>
															
															
															<label for="tlfmvl" class="col-md-12">N° Móvil</label>
															<div class="form-group col-md-4 ">
															<div class="col-md-offset-1">											
																<select name="tlfmvl" id="" class="form-control">
																	<option value="">-</option>
																	<option value="0416">0416</option>
																</select>
															</div>
															</div>
															<div class="form-group col-md-8">											
																<input type="text" name="tmvl" class="form-control" />
																<i class="fa fa-mobile"></i>
															</div>
															</div>
															<div class="form-group col-md-12 " id="">
																
																	<label for="mail">Correo Electrónico</label>
																	<input type="email" name="mail" class="form-control">
																	<i class="fa fa-envelope"></i>
																
															</div>
														
													</div>
												</div>
											</div>
										</div>								
										<div class="modal-footer">
											<button type="submit" class="bttnMd" id="btnSv">Guardar<i class="fa fa-floppy-o"></i></button>
											<button type="button" class="bttnMd" data-dismiss="modal" id="btnCs">Cerrar <i class="fa fa-times"></i></button>
										</div>
								</form>
															
							</div>
						</div>
					</div>
				</div>   
	@endsection
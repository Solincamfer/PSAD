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
									<h4 class="modal-title" id="myModalLabel">Agregar Modulo</h4>
								</div>
								<div class="modal-body">
									<form>
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
														<div class="row" id="rDb">
															<div class="form-group col-md-5 col-md-offset-1">
																<label for="rs">Razon Social:</label>
																<input type="text" name="rs" class=" .inp" id="rz"><i class="fa fa-university"></i>
															</div>
															<div class="form-group col-md-5">
																<label for="nc">Nombre Comercial:</label>
																<input type="text" name="nc" class=" .inp"><i class="fa fa-building"></i>
															</div>
														</div>
														<div class="row">
															<div class="form-group col-md-5 col-md-offset-1">
																<label for="rif">Rif:</label>
																<br>
																<select name="rif" id="rif">
																	<option value="0" selected>-</option>
																	<option value="1">J-</option>
																	<option value="2">G-</option>
																</select>
																<input type="tel" placeholder="Doc. Fiscal" id="einp"><i class="fa fa-address-card"></i>
															</div>
															<div class="form-group col-md-5">
																<label for="tipCon">Tipo de Contribuyente</label>
																<br>
																<select name="tipCon" id="tipCon">
																	<option value="0">-</option>
																</select>
															</div>
														</div>
													</div>
												</div>

												<div role="tabpanel" class="tab-pane" id="df">
													<div class="container-fluid" id="contdf">
														<div class="row" id="locDf">
															<div class="col-md-5 col-md-offset-1">
																<label for="paisdf">País</label>
																<br>
																<select name="paisdf" id="paisdf">
																	<option value="0">-</option>
																</select>
															</div>
															<div class="col-md-5">
																<label for="regiondf">Región</label>
																<br>
																<select name="regiondf" id="regiondf">
																	<option value="0">-</option>
																</select>
															</div>
															<div class="col-md-5 col-md-offset-1">
																<label for="edodf">Estado</label>
																<br>
																<select name="edodf" id="edodf">
																	<option value="0">-</option>
																</select>
															</div>
															<div class="col-md-5">
																<label for="mundf">Municipio</label>
																<br>
																<select name="mundf" id="mundf">
																	<option value="0">-</option>
																</select>
															</div>
														</div>
														<div class="row" id="locDfdd">
															<div class="col-md-10 col-md-offset-1">
																<label for="descDirdf">Descripción de la dirección</label>
																<input type="text" name="descDirdf"><i class="fa fa-map-marker"></i>
															</div>
														</div>
													</div>
												</div>

												<div role="tabpanel" class="tab-pane" id="dc">
													<div class="container-fluid" id="contdc">
														<div class="row" id="locDc">
															<div class="col-md-5 col-md-offset-1">
																<label for="paisdc">País</label>
																<br>
																<select name="paisdc" id="paisdc">
																	<option value="0">-</option>
																</select>
															</div>
															<div class="col-md-5">
																<label for="regiondc">Región</label>
																<br>
																<select name="regiondc" id="regiondc">
																	<option value="0">-</option>
																</select>
															</div>
															<div class="col-md-5 col-md-offset-1">
																<label for="edodc">Estado</label>
																<br>
																<select name="edodc" id="edodc">
																	<option value="0">-</option>
																</select>
															</div>
															<div class="col-md-5">
																<label for="mundc">Municipio</label>
																<br>
																<select name="mundc" id="mundc">
																	<option value="0">-</option>
																</select>
															</div>
														</div>
														<div class="row" id="locDcdd">
															<div class="col-md-10 col-md-offset-1">
																<label for="descDirdc">Descripción de la dirección</label>
																<input type="text" name="descDirdc"><i class="fa fa-map-marker"></i>
															</div>
														</div>
													</div>
												</div>

												<div role="tabpanel" class="tab-pane" id="ctt">
													<div class="container-fluid" id="contctt">
														<div class="row">
															<div class="col-md-5 col-md-offset-1">
																<label for="tlflcl">Teléfono Local</label>
																<br>
																<select name="tlflcl" id="tlflcl">
																	<option value="0" selected>-</option>
																</select>
																<input type="tel" id="einp1"><i class="fa fa-phone"></i>
															</div>
															<div class="col-md-5">
																<label for="tlfmvl">Teléfono Móvil</label>
																<br>
																<select name="tlfmvl" id="tlfmvl">
																	<option value="0" selected>-</option>
																</select>
																<input type="tel" id="einp2"><i class="fa fa-mobile"></i>
															</div>
															<div class="row" id="correo">
																<div class="col-md-10 col-md-offset-1">
																	<label for="mail">Correo Electrónico</label>
																	<input type="email" name="mail"><i class="fa fa-envelope"></i>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</form>
								</div>
								<div class="modal-footer">
									<button type="button" class="bttnMd" id="btnSv">Guardar <i class="fa fa-floppy-o"></i></button>
									<button type="button" class="bttnMd" data-dismiss="modal" id="btnCs">Cerrar <i class="fa fa-times"></i></button>
								</div>
							</div>
						</div>
					</div>
				</div>   
	@endsection
@extends('admin.basesys')
	@section('contenido')
		@section('title')
			Registro Cliente
		@endsection
				<div class="contenido">
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
					<!-- Modal -->
					<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="myModalLabel">Agregar Modulo</h4>
								</div>
								<div class="modal-body">
									<form action="#" data-toggle="validator">
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
																<input type="text" name="rs" class="form-control"  id="rz" required><i class="fa fa-university"></i>
															</div>
															<div class="form-group col-md-5">
																<label for="nc">Nombre Comercial:</label>
																<input type="text" name="nc" class="form-control" required><i class="fa fa-building"></i>
															</div>
														</div>
														<div class="row" id="rDb">
															<div class="form-group col-md-2 col-md-offset-1">
																<label for="rif">Rif:</label>
																<br>
																<select name="rif" id="rif" class="form-control" required>
																	<option value="">-</option>
																	<option value="1">J-</option>
																	<option value="2">G-</option>
																</select>
															</div>
															<div class="form-group col-md-4">
															<br>
																<input type="tel" id="xx" class="form-control" name="df" required><i class="fa fa-address-card"></i>
															</div>
															<div class="form-group col-md-5">
																<label for="tipCon">Tipo de Contribuyente</label>
																<br>
																<select name="tipCon" id="tipCon" class="form-control" required>
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
														<div class="row" id="locDf">
															<div class="form-group col-md-5 col-md-offset-1">
																<label for="paisdf">País</label>
																<br>
																<select name="paisdf" id="paisdf" class="form-control" required>
																	<option value="">-</option>
																	<option value="caracas">caracas</option>
																	
																</select>
															</div>
															<div class="form-group col-md-5">
																<label for="regiondf">Región</label>
																<br>
																<select name="regiondf" id="regiondf" class="form-control" required>
																	<option value="">-</option>
																	<option value="caracas">caracas</option>
																</select>
															</div>
															<div class="form-group col-md-5 col-md-offset-1">
																<label for="edodf">Estado</label>
																<br>
																<select name="edodf" id="edodf" class="form-control" required>
																	<option value="">-</option>
																	<option value="caracas">caracas</option>
																</select>
															</div>
															<div class="form-group col-md-5">
																<label for="mundf">Municipio</label>
																<br>
																<select name="mundf" id="mundf" class="form-control" required>
																	<option value="">-</option>
																	<option value="caracas">caracas</option>
																</select>
															</div>
														</div>
														<div class="form-group row" id="locDfdd">
															<div class="col-md-10 col-md-offset-1">
																<i class="fa fa-map-marker"></i>
																<label for="descDirdf">Descripción de la dirección</label>
																<textarea type="text" name="descDirdf" class="form-control" required></textarea>
															</div>
														</div>
													</div>
												</div>

												<div role="tabpanel" class="tab-pane" id="dc">
													<div class="container-fluid" id="contdc">
														<div class="row" id="locDc">
														<div class="form-group col-md-5 col-md-offset-1">
																<label for="paisdc">País</label>
																<br>
																<select name="paisdc" id="paisdf" class="form-control" required>
																	<option value="">-</option>
																	<option value="caracas">caracas</option>
																	
																</select>
															</div>
															<div class="form-group col-md-5">
																<label for="regiondc">Región</label>
																<br>
																<select name="regiondc" id="regiondf" class="form-control" required>
																	<option value="">-</option>
																	<option value="caracas">caracas</option>
																</select>
															</div>
															<div class="form-group col-md-5 col-md-offset-1">
																<label for="edodc">Estado</label>
																<br>
																<select name="edodc" id="edodf" class="form-control" required>
																	<option value="">-</option>
																	<option value="caracas">caracas</option>
																</select>
															</div>
															<div class="form-group col-md-5">
																<label for="mundc">Municipio</label>
																<br>
																<select name="mundc" id="mundf" class="form-control" required>
																	<option value="">-</option>
																	<option value="caracas">caracas</option>
																</select>
															</div>
														</div>
														<div class="form-group row" id="locDfdd">
															<div class="col-md-10 col-md-offset-1">
															<i class="fa fa-map-marker"></i>
																<label for="descDirdc">Descripción de la dirección</label>
																<textarea type="text" name="descDirdc" class="form-control" required></textarea> 
															</div>
														</div>
													</div>
												</div>

												<div role="tabpanel" class="tab-pane" id="ctt">
													<div class="container-fluid" id="contctt">
														
															
															<div class="form-group col-md-2">
																<label for="tlflcl">N° Local:</label>
																<br>																
																<select name="tlflcl" id="tlflcl" class="form-control" required>
																	<option value="">-</option>
																	<option value="0212">0212</option>
																</select>
															</div>
															<div class="form-group col-md-4">	
																<br>																
																<input type="tel" id="einp1" class="form-control"required><i class="fa fa-phone"></i>															
															</div>
															
															<div class="form-group col-md-2">
																<label for="tlfmvl">N° Móvil</label>
																<br>
																<select name="tlfmvl" id="tlfmvl" class="form-control" required>
																	<option value="">-</option>
																	<option value="0416">0416</option>
																</select>
																</div>
															<div class="form-group col-md-4">	
															<br>	
																<input type="tel" id="einp2" class="form-control" required><i class="fa fa-mobile"></i>
															</div>
															
															<div class="form-group row" id="correo">
																<div class="col-md-12 ">
																	<label for="mail">Correo Electrónico</label>
																	<input type="email" name="mail" class="form-control" required><i class="fa fa-envelope"></i>
																</div>
															</div>
														
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
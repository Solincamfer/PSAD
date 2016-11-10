@extends('admin.basesys')
	@section('contenido')
		@section('title')
			Registro Cliente
		@endsection        
			@include('layout/header')
				@include('layout/sidebar')
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
								<form>
									<div class="form-group">
										<label for="exampleInputEmail1">Nombre del modulo:</label>
										<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Modulo.....">
									</div>
									<div class="form-group">
										<label for="exampleInputPassword1">URL modulo padre:</label>
										<input type="text" class="form-control" id="exampleInputPassword1" placeholder="URL......">
									</div>
									<div class="form-group">
										<label for="exampleselect">Seleccione estatus:</label>
										<select class="form-control" id="exampleselect">
											<option>Activo</option>
											<option>Desactivo</option>                        
										</select>
									</div>
								</form>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
								<button type="button" class="btn btn-primary">Guardar</button>
							</div>
						</div>
					</div>
				</div>
			</div>
	@endsection


@extends('admin.basesys')
<style type="text/css">
	.contenedorModulo{
		height: 50px; 
		background: white; 
		margin-top: 4px; 
		border-radius: 10px 10px 10px 10px; 
		border-bottom:7px solid black;
		border-right:5px solid black; 
		border-top:1px solid black; 
		border-left:1px solid black;
	}
	.botonAcciones{
		margin-top:5px; 
		margin-right:6px; 
		float: right;
	}
	.tituloModulo{
		margin-top:12px; 
		margin-left:30px;
		font-size: 15px;
	}
</style>
<div class="col-xs-5 col-sm-5 col-md-6 col-md-offset-3" style="margin-top: 10em;"> 
		<button id="botonAgregar" type="button" class="btn" data-toggle="modal" data-target="#myModal">AGREGAR</button>
		<?php 
		$filas=1;
		for ($i=1; $i <=$filas; $i++) {

		 ?>
		
		<div class="contenedorModulo" style="" >
		<?php 
		$acciones=2;
		for ($j=1; $j<= $acciones; $j++) { 
		
		?>
			<button class="botonAcciones btn btn-default" type="submit" >Modificar</button>
		<?php   
		 } 
		?>
			<p class="tituloModulo"><strong>REGISTRO</strong></p>
		</div>
		<?php 
			}

		 ?>

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

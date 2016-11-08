<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<div class="col-xs-5 col-sm-5 col-md-6" style="margin-top: 10em;"> 
		<button id="botonAgregar" type="button" class="btn" data-toggle="modal" data-target="#myModal">AGREGAR</button>
		<?php 
		$filas=5;
		for ($i=0; $i <=$filas; $i++) { 
		
		 ?>
		
		<div class="" style="height: 50px; background: white; margin-top: 20px; border-radius: 10px 10px 10px 10px; border-bottom:2px solid black; border-right:5px solid black; border-top:1px solid black; border-left:1px solid black;" >
		<?php 
		$acciones=5;
		for ($i=1; $i <= $acciones; $i++) { 
		
		?>
			<button class="btn btn-default" type="submit" style="margin-top:6px; margin-right:6px; float: right;">Modificar</button>
		<?php 
		 } 
		}
		 ?>	
			<p style="margin-top:12px; margin-left:30px;font-size: 15px;"><strong>REGISTRO</strong></p>
		</div>


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
</body>
</html>
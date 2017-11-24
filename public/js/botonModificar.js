
//Script utilizado para llevar el control del boton modificar


$(document).ready(function()
{

	//Funcion que llena el modal modificar con los valores retornados por la consulta a la tabla correspondiente 
	//Args: prefix contiene el registro que indica sobre que vista se esta trabajando, registry: contiene los datos 
	//obtenidos de la consulta.

 	function modalCarDepPer(prefix,registry,modalId)
 	{
 		var description='Text';
		var status='Status';
		

 		$('#'+prefix+description).val(registry.descripcion);
		$('#'+prefix+status).val(registry.status);
		$(modalId).modal('show');

		return 0;

 	}
	
	
 	//Funcion, limpia las listas antes de se cargadas 

	

 	//Funcion que se encarga de cargar una lista que depende de la seleccion de la lista anterior, 
 	//Args: registroPadreId (pasa el id del registro del cual depende la lista que se desea cargar, aplica a cargos: 
 	//		regiones,estados,municipios), categoriaConsultar : es un entero que indica la opcion de consulta que se desea consultar 
 	//en el metodo RegistrosBasicos@cargar_combos  (1: tabla cargos, 2:regiones, 3: estados, 4: municipios), 
 	//listaModificarId: contiene el id de la lista para la cual se desea cargar las opciones dinamicamente,
 	//opcionDefaultId: contiene la opcion que se desea seleccionar de la lista en caso de no aplicar toma por defecto la opcion default
 	//mostrarDefault: indica si desea mostrar un valor por default, el valor por default se muestra cuando se tiene un valor asignado.


 	function cargarListaDependiente(registroPadreId,categoriaConsultar,listaModificarId,clase='',opcionDefaultId=false,mostrarDefault=false)
 	{
 		$.getJSON('/menu/registros/empleados/cargar', {opcion:categoriaConsultar,padreId:registroPadreId})
 		.done(function(opciones)
 		{
 			var longitud=opciones.length;
 			$('.'+categoriaConsultar).remove();
 			
 			for (var i = 0; i <longitud; i++) 
 			{
 				$(listaModificarId).append(' <option class="'+categoriaConsultar+clase+'" value="'+opciones[i].id+'" id="'+opciones[i].id+'">'+opciones[i].descripcion+'</option>')
 			}
 			if(mostrarDefault==true)
 			{
 				$(listaModificarId+' option[value="'+opcionDefaultId+'"]').attr('selected',true);
 			}

 		})
 		.fail(function()
 		{
 			swal("Error Inesperado !!", "Comuniquese con el administrador", "error");
 		});

 		return 0;
 	}




 	//Funcion que llena el modal modificar con las datos correspondientes al empleado seleccionado
 	//Args:registry es el registro correspondiente al empleado consultado y es un objeto JSON
 	//modadId: representa el id del modal modificar

	function modalEmpleados(registry,modalId)
	{
		$('#nomEmpm1').val(registry.primerNombre);
		$('#nomEmpm2').val(registry.segundoNombre);
		$('#apellEmpm1').val(registry.primerApellido);
		$('#apellEmpm2').val(registry.segundoApellido);
		$('#selRifEmpm').val(registry.rifId);
		$('#numRifEmpm').val(registry.numeroRif);
		$('#selCiEmpm').val(registry.tipoCedulaId);
		$('#numCiEmpm').val(registry.numeroCedula);
		$('#fnEmpm').val(registry.fechaNacimiento);
		$('#tlflclem').val(registry.tipoCodigoFij);
		$('#numtlflclem').val(registry.telefonoLocal);
		$('#tlfmvlem').val(registry.tipoCodigoCel);
		$('#numtlfmvlem').val(registry.numeroCel);
		$('#mailem').val(registry.correoUsuario);
		$('#nomUsm').val(registry.nombreUsuario);
		$('#pwUs1mm').val(registry.claveUsuario);
		$('#stUsm').val(registry.statusUsuario);
		$('#pdhem').val(registry.paisId);
		$('#descpdhem').val(registry.descripcionDireccion);
		$('#dptoEmpm').val(registry.departamentoId);
		//cargar cargos asociados al departamento del empleado y seleccionar el correspondiente
		//pasa como arumento el id del departamento al cual pertenece el cargo del empleado, el 1 indica que se desean 
		//consultar cargos,'#cgoEmpm' es el id de la lista que se desea modificar, registry.cagoId , muestra el id del cargo del empleado
		//mostrarDefault indica si se desea seleccionar una opcion por defaul, que en este caso es el cargo del empleado.
		cargarListaDependiente(registry.departamentoId,1,'#cgoEmpm','',registry.cargoId,mostrarDefault=true)
		//Cargar regiones que pertenecen al pais selecciones 
		cargarListaDependiente(registry.paisId,2,'#rgdhem','0',registry.regionId,mostrarDefault=true)
		//Cargar estados asociados a una region
		cargarListaDependiente(registry.regionId,3,'#edodhem','0',registry.estadoId,mostrarDefault=true)
		//Cargar municipios asociados a un estado
		cargarListaDependiente(registry.estadoId,4,'#mundhem','0',registry.municipioId,mostrarDefault=true)
		//
		$(modalId).modal('show');

		return 0;
	}


	///Funcion: que carga los datos de un cliente en un modal 

	function modalClientes(registry,modalId)
	{
		$('#in11').val(registry.razonS);
		$('#in12').val(registry.nombreC);
		$('#in13').val(registry.tipoRif);
		$('#in14').val(registry.numeroRif);
		$('#in15').val(registry.idTipoContribuyente);
		$('#inn1').val(1);//pais Fiscal
		$('#innn11').val(1);//pais Comercial
		$('#inn5').val(registry.direccionFiscal);
		$('#innn15').val(registry.direccionC);
		$('#innnn15').val(registry.correoUsuario);
		$('#innnn11').val(registry.codigoLocal);
		$('#innnn13').val(registry.codigoCelular);
		$('#innnn12').val(registry.telefonoFijo);
		$('#innnn14').val(registry.telefonoCelular);
		/////////////DIRECCION FISCAL ////////////////////////////////////////////////////////////////
		//Cargar regiones que pertenecen al pais selecciones 
		cargarListaDependiente(registry.paisId,2,'#inn2','1',registry.regionIdF,mostrarDefault=true)

		// //Cargar estados asociados a una region
		cargarListaDependiente(registry.regionIdF,3,'#inn3','1',registry.estadoIdF,mostrarDefault=true)
		//alert('estado: '+registry.estadoF+' municipio: '+registry.municipiosF+' estado Id: '+registry.estadoIdF+' municipioId: '+registry.municipioidF);
		// //Cargar municipios asociados a un estado1
		cargarListaDependiente(registry.estadoIdF,4,'#inn4','1',registry.municipioidF,mostrarDefault=true)


		// ///////////////DIRECCION COMERCIAL //////////////////////////////////////////////////////////////

		// //Cargar regiones que pertenecen al pais selecciones 
		cargarListaDependiente(registry.paisId,2,'#innn12','2',registry.regionIdF,mostrarDefault=true)

		// // //Cargar estados asociados a una region
		cargarListaDependiente(registry.regionIdF,3,'#innn13','2',registry.estadoIdF,mostrarDefault=true)
		
		// // //Cargar municipios asociados a un estado
		cargarListaDependiente(registry.estadoIdF,4,'#innn14','2',registry.municipioidF,mostrarDefault=true)
		$(modalId).modal('show');
	}


	///Funcion que carga los datos de un plan en el modal

	function modalPlanes(registry,modalId)
	{

		$('#nomPnm').val(registry.descripcion);
		$('#porDesm').val(registry.descuento);
		$('#stPnm').val(registry.status);
		$(modalId).modal('show');

		return 0;
	}

	function modalSucursales(registry,modalId)
	{


		$('#razonSs').val(registry.razonS);
		$('#nombreCs').val(registry.nombreC);
		$('#inputm3').val(registry.tipoRif);
		$('#inputm4').val(registry.numeroRif);
		$('#inputm5').val(registry.tipoContribuyente);
		$('#inputm6').val(registry.idPaisF);
		$('#inputm10').val(registry.direccionF);
		$('#inputm11').val(registry.idPaisC);
		$('#inputm15').val(registry.direccionC);
		$('#inputm16').val(registry.idCodigoFij);
		$('#inputm17').val(registry.telefonoFij);
		$('#inputm18').val(registry.idCodigoCel);
		$('#inputm19').val(registry.telefonoCel);
		$('#inputm20').val(registry.correoUsuario);

		/////////////////////DIRECCION FISCAL /////////////////////////////////////////////////

		//////////////////cargar regiones que pertenecen al pais seleccionado ////////////////////////
		cargarListaDependiente(registry.idPaisF,2,'#inputm7','3',registry.idRegionF,mostrarDefault=true)

		//////////////////cargar estados de la region seleccionada ////////////////////////
		cargarListaDependiente(registry.idRegionF,3,'#inputm8','3',registry.idEstadoF,mostrarDefault=true)

		//////////////////cargar municipios del estado seleccionado////////////////////////
		cargarListaDependiente(registry.idEstadoF,4,'#inputm9','3',registry.idMunicipioF,mostrarDefault=true)


		/////////////////////DIRECCION COMERCIAL /////////////////////////////////////////////////

		//////////////////cargar regiones que pertenecen al pais seleccionado ////////////////////////
		cargarListaDependiente(registry.idPaisC,2,'#inputm12','3',registry.idRegionC,mostrarDefault=true)

		//////////////////cargar estados de la region seleccionada ////////////////////////
		cargarListaDependiente(registry.idRegionC,3,'#inputm13','3',registry.idEstadoC,mostrarDefault=true)

		//////////////////cargar municipios del estado seleccionado////////////////////////
		cargarListaDependiente(registry.idEstadoC,4,'#inputm14','3',registry.idMunicipioC,mostrarDefault=true)






		$(modalId).modal('show');
		return 0;
	}

	///////Metodo que detecta cuando se presiona un boton modificar 
	//////Args que captura: Tabla(table) donde se encuentra el registro a modificar y id del registro(registry) seleccionado, modalId: Id del modal modificar
	//////Alcance: captura los datos y los envia al metodo de php encargado de coordinar las consultas a las tablas 
    //////prefixes: muestra los prefijos que identifican a las tablas cargos de partamentos y perfiles (ca,dep y per)


	$('.ModificaR').click(function() 
	{
		

		var prefixes=['dep','ca','per','cat'];
		var modalId='#myModal2';
		var route='/menu/modificar/registros'
		var table=$('#areaResultados').attr('data-tab');
		var registry=$(this).attr('data-reg');
	
		
		
		$.getJSON(route, {table:table,registry:registry})

		
			.done(function(registry)
			{
				
				
				if (table==0||table==1||table==2||table==3) //cuando se usan las tablas: departamentos, cargos, perfiles y categorias 
				{
					modalCarDepPer(prefixes[table],registry,modalId);

				}
				else if(table==4)
				{
					modalEmpleados(registry,modalId);

				}
				else if(table==5)
				{

					modalPlanes(registry,modalId);
				}
				else if(table==6)
				{

					modalClientes(registry,modalId);
				}
				else if(table==7)
				{
					modalSucursales(registry,modalId);
				}

		
			})

			.fail(function()
			{
				swal("Error Inesperado !!", "Comuniquese con el administrador", "error");
			});





	});



	////////////////Evento para reconocer el cambio de  departamento y crear la lista con los cargos dependientes del departamentos////////////////
	
 //   //////////////////    Detecta el evento de cuando se cambia un departamento /////////////////////////////////////////////
	
 	$(".form-control").change(function()
 		{
 			
 			var lista=$(this).attr('data-lista');//identifica que select se selecciono 0: departamentos, 1: Pais , 2: Region, 3: Estado, 4: Municipio
 			var clase=$(this).attr('data-clase');//indica a que grupo pertenece
 			var regiones=['#rgdhem','#inn2','#innn12','#inputm7','#inputm12'];
 			var estados=['#edodhem','#inn3','#innn13','#inputm8','#inputm13'];
 			var municipios=['#mundhem','#inn4','#innn14','#inputm9','#inputm14'];
 			var id=$(this).val();
 			
 			if(lista==0)
 			{
 				cargarListaDependiente(id,1,'#cgoEmpm','');
 			}
 			else if(lista==1)//si se cambia el select de paises
 			{
 				$('.2'+clase).remove();//limpia la lista de regiones
				$('.3'+clase).remove();//limpia la lista de estados
				$('.4'+clase).remove();//limpia la lista de municipios
 				cargarListaDependiente(id,2,regiones[clase],clase);
 				
 			}
 			else if(lista==2)//si se cambia el select de regiones
 			{
 				
 				$('.3'+clase).remove();//limpia la lista de estados
				$('.4'+clase).remove();//limpia la lista de municipios 
				cargarListaDependiente(id,3,estados[clase],clase);
 			}
 			else if(lista==3)//si se cambia el select de estados 
 			{
 				$('.4'+clase).remove();//limpia los municipios  que se encontraban cargados
				cargarListaDependiente(id,4,municipios[clase],clase);//carga los municipios correspondientes a un estado
 			}
 		});
 	


});
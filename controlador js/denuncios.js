/*----------Código Generado por --------------*/
/*-- Fecha : 22/11/2016 21:47:53--*/
/*-- Autores : Roy Alex Standen Barraza - Edson Carrasco Gonzales--*/
/*-- Contacto : roystandenb@gmail.com / edsoncarrascogonzalez@gmail.com --*/
$(document).ready(function () {
	//jTable 
	var carpeta = '../controlador/';
	var nombreContenedor = '#Contenedor';
	var nombreBoton = '#botonCargarRegistros';
	$(nombreContenedor).jtable({
		title: 'Tabla de denuncios',
		paging: true,
		sorting: true,
		useBootstrap: true,
		//jqueryuiTheme: true, 
		defaultSorting: '`denuncio`.`ID_DENUNCIO` DESC',
		actions: {
			listAction: carpeta+'denuncios.php?accion=mostrar',
			createAction: carpeta+'denuncios.php?accion=crear',
			updateAction: carpeta+'denuncios.php?accion=modificar',
			deleteAction: carpeta+'denuncios.php?accion=eliminar'
		},
		rowInserted: function (event, data) {
			permitir($(nombreContenedor).find('.jtable-toolbar-item.jtable-toolbar-item-add-record'),data.row.find('.jtable-edit-command-button'),data.row.find('.jtable-delete-command-button'),$(nombreContenedor));	
		},
		deleteConfirmation: function (data) {
			data.deleteConfirmMessage = 'Desea Eliminar el Denuncio  <strong>' + data.record.ID_DENUNCIO + '</strong>';
		},
		fields: {
			ID_DENUNCIO: {
                key: true,
                title: 'Id',
                width: '5%',
                list: true,
                edit: false,
                create: false
            },
			NUMERO_BOLETA_TALONARIO: {
                title: 'N° Boleta Talonario',
                width: '10%',
                edit: true,
                create: true,
				inputClass: 'validate[required]'
            },
            NOMBRE_TALONARIO: {
                title: 'Talonario',
                width: '10%',
                edit: false,
				list: true,
                create: false
            },
			ID_INSPECTOR: {
                title: 'Inspector',
                width: '10%',
                edit: true,
                create: true,
				list: true,
				options: carpeta+'denuncios.php?accion=comboboxInspector'
            },
			ID_JUZGADO: {
                title: 'Juzgado',
                width: '5%',
                edit: true,
                create: true,
				options: carpeta+'denuncios.php?accion=comboboxJuzgado'
            },
			NUMERO_LEY: {
                title: 'Ley',
                width: '10%',
                edit: true,
                create: true,
				inputClass: 'validate[required]'
            },
			ARTICULO_LEY: {
                title: 'Artículo Ley',
                width: '10%',
                edit: true,
                create: true,
				inputClass: 'validate[required]'
            },
            RUT_INFRACTOR: {
                title: 'Rut Infractor',
                width: '10%',
                edit: true,
                create: true
            },
			NOMBRE_INFRACTOR: {
                title: 'Nombre Infractor',
                width: '10%',
                edit: true,
                create: true,
				list: false
            },
			DIRECCION_INFRACTOR: {
                title: 'Dirección Infractor',
                width: '10%',
                edit: true,
				list: false,
                create: true
            },
			ES_EMPRESA: {
                title: 'Es empresa?',
                width: '10%',
                edit: true,
				list: false,
                create: true,
				type: 'radiobutton',
				options: { 'SI': 'SI', 
						   'NO': 'NO'}
            },
			ROL_EMPRESA_INFRACCION: {
                title: 'Rol Empresa Infractor',
                width: '10%',
                edit: true,
                create: true
            },
			PATENTE_AUTO: {
                title: 'Patente',
                width: '10%',
                edit: true,
                create: true
            },
			COLOR_AUTO: {
                title: 'Color Auto',
                width: '10%',
				list: false,
                edit: true,
                create: true
            },
			TIPO_VEHICULO: {
                title: 'Tipo de Vehículo',
                width: '10%',
                edit: true,
				list: false,
                create: true
            },
			NOMBRE_MARCA: {
                title: 'Marca',
                width: '10%',
                edit: true,
				list: false,
                create: true
            },
			FECHA_INFRACCION: {
                title: 'Fecha Infracción',
                width: '10%',
                edit: true,
                create: true,
				type: 'date',
				displayFormat: 'dd-mm-yy',
				inputClass: 'validate[required]'
            },
			HORA_INFRACCION: {
                title: 'Hora Infracción',
                width: '10%',
                edit: true,
                create: true,
				input: function (data) {
					if (data.record) {
						return '<input type="time" id="Edit-HORA_INFRACCION" name="HORA_INFRACCION" value="' + data.record.HORA_INFRACCION + '" />';
					} else {
						return '<input type="time" id="Edit-HORA_INFRACCION" name="HORA_INFRACCION"/>';
					}
				},
				inputClass: 'validate[required]'
            },
			SECTOR: {
                title: 'Sector de la Infracción',
                width: '10%',
                edit: true,
                create: true,
				inputClass: 'validate[required]'
            },
			LUGAR_INFRACCION: {
                title: 'Lugar de la Infracción',
                width: '10%',
                edit: true,
                create: true,
				list: false,
				inputClass: 'validate[required]'
            },
			FECHA_LIMITE: {
                title: 'Fecha Límite',
                width: '10%',
                edit: true,
				list: false,
                create: true,
				type: 'date',
				displayFormat: 'dd-mm-yy',
				inputClass: 'validate[required]'
            },
			FORMA_DE_NOTIFICACION: {
                title: 'Forma de Notificación',
                width: '10%',
                edit: true,
				list: false,
                create: true,
				type: 'radiobutton',
				options: { 'PERSONAL': 'PERSONAL', 
						   'POR ESCRITO': 'POR ESCRITO'},
				inputClass: 'validate[required]'
            },
			MOTIVO_INFRACCION: {
                title: 'Motivo',
                width: '10%',
                edit: true,
				list: false,
                create: true,
				type: 'textarea',
				inputClass: 'validate[required]'
            },
			OBSERVACIONES_DENUNCIO: {
                title: 'Observaciones',
                width: '10%',
                edit: true,
				list: false,
                create: true,
				type: 'textarea'
            },
			ID_USUARIO: {
                title: 'Responsable',
                width: '10%',
                edit: true,
                create: false,
				list: true,
				type: 'hidden',
				options: carpeta+'denuncios.php?accion=comboboxResponsable'
            },
			IMPRIMIR: {
				title: '',
				width: '15%',
				edit: false,
				create: false,
				sorting: false,
				display: function (data) {
					var onclick = "window.open('formato_denuncio/formato_denuncio.php?id="+data.record.ID_DENUNCIO+"','popup','width=700,height=700')";
					return '<button type="button" onClick="'+onclick+'" class="btn btn-default"><span class="glyphicon glyphicon-print" aria-hidden="true"></span></button>';
				}
			   }
        },
		//Iniciar las validaciones cuando el formulario es creado
		formCreated: function (event, data) {
			var datos_autocompletado_infractor = new Array();
			//---autocompletar motivo
			 var cache = {};
			$( "#Edit-SECTOR" ).autocomplete({
			  minLength: 2,
			  source: function( request, response ) {
				var term = request.term;
				if ( term in cache ) {
				  response( cache[ term ] );
				  return;
				}
		 
				$.getJSON( carpeta+'denuncios.php?accion=autocompletar_sector', request, function( data, status, xhr ) {
				  cache[ term ] = data;
				  response( data );
				});
			  }
			});
			//---Autocompletar rut
			var cache = {};
			$( "#Edit-RUT_INFRACTOR" ).autocomplete({
			  minLength: 2,
			  source: function( request, response ) {
				var term = request.term;
				if ( term in cache ) {
				  response( cache[ term ] );
				  return;
				}
		 
				$.getJSON( carpeta+'denuncios.php?accion=autocompletar_RUT_INFRACTOR', request, function( data, status, xhr ) {
				  cache[ term ] = data;
				  datos_autocompletado_infractor.length = 0;
				  for(var x=0;x<data.length;x++){
					  datos_autocompletado_infractor.push({rut :data[x].label, nombre: data[x].nombres, direccion: data[x].direccion, es_empresa: data[x].es_empresa});
				  }
				  response( data );
				});
			  }
			});
			$("#Edit-RUT_INFRACTOR").focusout(function(){
				console.log(datos_autocompletado_infractor);
				for(var x=0;x<datos_autocompletado_infractor.length;x++){
					console.log(datos_autocompletado_infractor[x].rut+'=='+$("#Edit-RUT_INFRACTOR").val());
					if($("#Edit-RUT_INFRACTOR").val()==datos_autocompletado_infractor[x].rut){
						$("#Edit-NOMBRE_INFRACTOR").val(datos_autocompletado_infractor[x].nombre);
						$("#Edit-DIRECCION_INFRACTOR").val(datos_autocompletado_infractor[x].direccion);
						if(datos_autocompletado_infractor[x].es_empresa=='NO'){
							$("#Edit-ES_EMPRESA-1").prop("checked",true);
						}else{
							$("#Edit-ES_EMPRESA-0").prop("checked",true);
						}
						break;
					}
				}
			});
			$("#Edit-NUMERO_BOLETA_TALONARIO").focusout(function(){
				if($("#Edit-NUMERO_BOLETA_TALONARIO").val()==''){
				}else{
					var numero_boleta_rescatado = $.ajax({
							url: carpeta+'denuncios.php?accion=comprobarNumeroBoleta&num='+$("#Edit-NUMERO_BOLETA_TALONARIO").val()+'&id_usuario='+$("#Edit-ID_USUARIO").val(),
							type:'post',
							dataType:'json',
							async:false    		
						}).responseText;
					numero_boleta_rescatado = JSON.parse(numero_boleta_rescatado);
					if(numero_boleta_rescatado[0].existe=='si'){
						bootbox.alert("El número de boleta se encuentra registrado.");
					}
				}
			});
			//---Autocompletar TIPO  VEHICULO
			var cache = {};
			$( "#Edit-NOMBRE_TIPO_VEHICULO" ).autocomplete({
			  minLength: 2,
			  source: function( request, response ) {
				var term = request.term;
				if ( term in cache ) {
				  response( cache[ term ] );
				  return;
				}
		 
				$.getJSON( carpeta+'denuncios.php?accion=autocompletar_TIPO_VEHICULO', request, function( data, status, xhr ) {
				  cache[ term ] = data;
				  response( data );
				});
			  }
			});
			//---Autocompletar MARCA
			var cache = {};
			$( "#Edit-NOMBRE_MARCA" ).autocomplete({
			  minLength: 2,
			  source: function( request, response ) {
				var term = request.term;
				if ( term in cache ) {
				  response( cache[ term ] );
				  return;
				}
		 
				$.getJSON( carpeta+'denuncios.php?accion=autocompletar_MARCA_VEHICULO', request, function( data, status, xhr ) {
				  cache[ term ] = data;
				  response( data );
				});
			  }
			});
			
			data.form.validationEngine();
		},
		//Validar el formulario cuando ha sido enviado
		formSubmitting: function (event, data) {
			return data.form.validationEngine('validate');
		},
		//Desechar la validación cuando se cierre el formulario
		formClosed: function (event, data) {
			data.form.validationEngine('hide');
			data.form.validationEngine('detach');
		}
	});
	$(nombreBoton).click(function (e) {
		e.preventDefault();
		$(nombreContenedor).jtable('load', {
			buscar_numero_boleta : $("#buscar_numero_boleta").val(),
			buscar_rut_infractor : $("#buscar_rut_infractor").val(),
			buscar_inspector : $("#buscar_inspector").val(),
			buscar_usuario : $("#buscar_usuario").val(),
			Fecha_inicio : $("#Fecha_inicio").val(),
			Hora_inicio : $("#Hora_inicio").val(),
			Fecha_final : $("#Fecha_final").val(),
			Hora_final : $("#Hora_final").val(),
			buscar_sector : $("#buscar_sector").val(),
			buscar_calle : $("#buscar_calle").val(),
			buscar_detalle_denuncios : $("#buscar_detalle_denuncios").val()
		});
	});
	$(nombreBoton).click();
});

$( function() {
    
  } );
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
		title: 'Tabla de Talonario',
		paging: true,
		sorting: true,
		useBootstrap: true,
		//jqueryuiTheme: true, 
		defaultSorting: 'ID_TALONARIO DESC',
		actions: {
			listAction: carpeta+'talonario.php?accion=mostrar',
			createAction: carpeta+'talonario.php?accion=crear',
			updateAction: carpeta+'talonario.php?accion=modificar',
			deleteAction: carpeta+'talonario.php?accion=eliminar'
		},
		rowInserted: function (event, data) {
			permitir($(nombreContenedor).find('.jtable-toolbar-item.jtable-toolbar-item-add-record'),data.row.find('.jtable-edit-command-button'),data.row.find('.jtable-delete-command-button'),$(nombreContenedor));	
		},
		deleteConfirmation: function (data) {
			data.deleteConfirmMessage = 'Desea Eliminar el talonario  <strong>' + data.record.ID_TALONARIO + '</strong>';
		},
		fields: {
			ID_TALONARIO: {
                key: true,
                title: 'Id',
                width: '40%',
                list: false,
                edit: false,
                create: false
            },
            ID_INSPECTOR: {
                title: 'Inspector',
                width: '15%',
                edit: true,
                create: true,
				options: carpeta+'talonario.php?accion=comboboxTalonario'
            },
			NOMBRE_TALONARIO: {
                title: 'Nombre',
                width: '15%',
                edit: true,
                create: true
            },
			NUMERO_INICIAL: {
                title: 'Número Inicio',
                width: '15%',
                edit: true,
                create: true
            },
            NUMERO_FINAL: {
                title: 'Número Término',
                width: '15%',
                edit: true,
                create: true
            },
            CANTIDAD_DE_BOLETAS: {
                title: 'Cantidad de Boletas',
                width: '15%',
                edit: false,
                create: false
            },
            CANTIDAD_DENUNCIOS_REALIZADOS: {
                title: 'Cantidad de denuncios',
                width: '15%',
                edit: false,
                create: false
            },
			BOLETAS_PENDIENTES: {
				title: 'Verificar',
				width: '15%',
				edit: false,
				create: false,
				sorting: false,
				display: function (data) {
					var onclick = "window.open('formato_denuncio/boletas_pendientes.php?id="+data.record.ID_TALONARIO+"','popup','fullscreen=yes')";
					return '<button type="button" onClick="'+onclick+'" class="btn btn-default"><span class="glyphicon glyphicon-eye-open"></span></button>';
				}
			   }
        },
		//Iniciar las validaciones cuando el formulario es creado
		formCreated: function (event, data) {
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
			buscar_numero_talonario : $("#buscar_numero_talonario").val()
		});
	});
	$(nombreBoton).click();
});

$( function() {
    
  } );
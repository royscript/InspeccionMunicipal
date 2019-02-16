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
		title: 'Tabla de Operativos',
		paging: true,
		sorting: true,
		useBootstrap: true,
		//jqueryuiTheme: true, 
		defaultSorting: 'ID_OPERATIVO DESC',
		actions: {
			listAction: carpeta+'operativo.php?accion=mostrar',
			createAction: carpeta+'operativo.php?accion=crear',
			updateAction: carpeta+'operativo.php?accion=modificar',
			deleteAction: carpeta+'operativo.php?accion=eliminar'
		},
		rowInserted: function (event, data) {
			permitir($(nombreContenedor).find('.jtable-toolbar-item.jtable-toolbar-item-add-record'),data.row.find('.jtable-edit-command-button'),data.row.find('.jtable-delete-command-button'),$(nombreContenedor));	
		},
		deleteConfirmation: function (data) {
			data.deleteConfirmMessage = 'Desea Eliminar el Juzgado  <strong>' + data.record.ID_OPERATIVO + '</strong>';
		},
		fields: {
			ID_OPERATIVO: {
                key: true,
                title: 'Id',
                width: '40%',
                list: false,
                edit: false,
                create: false
            },
            NOMBRE_OPERATIVO: {
                title: 'Nombre',
                width: '15%',
                edit: true,
                create: true
            },
			FECHA_OPERATIVO: {
                title: 'Fecha',
                width: '15%',
                edit: true,
                create: true,
				type: 'date',
				displayFormat: 'dd-mm-yy',
				inputClass: 'validate[required]'
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
		});
	});
	$(nombreBoton).click();
});

$( function() {
    
  } );
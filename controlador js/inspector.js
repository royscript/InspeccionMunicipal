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
		title: 'Tabla de inspectores',
		paging: true,
		sorting: true,
		useBootstrap: true,
		//jqueryuiTheme: true, 
		defaultSorting: 'ID_INSPECTOR DESC',
		actions: {
			listAction: carpeta+'inspector.php?accion=mostrar',
			createAction: carpeta+'inspector.php?accion=crear',
			updateAction: carpeta+'inspector.php?accion=modificar',
			deleteAction: carpeta+'inspector.php?accion=eliminar'
		},
		rowInserted: function (event, data) {
			permitir($(nombreContenedor).find('.jtable-toolbar-item.jtable-toolbar-item-add-record'),data.row.find('.jtable-edit-command-button'),data.row.find('.jtable-delete-command-button'),$(nombreContenedor));	
		},
		deleteConfirmation: function (data) {
			data.deleteConfirmMessage = 'Desea Eliminar el Permiso  <strong>' + data.record.ID_INSPECTOR + '</strong>';
		},
		fields: {
			ID_INSPECTOR: {
                key: true,
                title: 'Id',
                width: '40%',
                list: false,
                edit: false,
                create: false
            },
            ID_INSPECTOR_A_CARGO: {
                title: 'Coordinador',
                width: '40%',
                edit: true,
                create: true,
				options: carpeta+'inspector.php?accion=comboboxInspectorACargo'
            },
            NOMBRE_INSPECTOR: {
                title: 'Nombre Inspector',
                width: '40%',
                edit: true,
                create: true
            },
            RUT_INSPECTOR: {
                title: 'Rut Inspector',
                width: '40%',
                edit: true,
                create: true,
				list: true
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
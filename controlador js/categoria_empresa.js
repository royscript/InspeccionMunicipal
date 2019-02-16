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
		title: 'Tabla de Clase de Negocios',
		paging: true,
		sorting: true,
		useBootstrap: true,
		//jqueryuiTheme: true, 
		defaultSorting: 'ID_CATEGORIA_EMPRESA DESC',
		actions: {
			listAction: carpeta+'categoria_empresa.php?accion=mostrar',
			createAction: carpeta+'categoria_empresa.php?accion=crear',
			updateAction: carpeta+'categoria_empresa.php?accion=modificar',
			deleteAction: carpeta+'categoria_empresa.php?accion=eliminar'
		},
		rowInserted: function (event, data) {
			permitir($(nombreContenedor).find('.jtable-toolbar-item.jtable-toolbar-item-add-record'),data.row.find('.jtable-edit-command-button'),data.row.find('.jtable-delete-command-button'),$(nombreContenedor));	
		},
		deleteConfirmation: function (data) {
			data.deleteConfirmMessage = 'Desea Eliminar el Permiso  <strong>' + data.record.ID_CATEGORIA_EMPRESA + '</strong>';
		},
		fields: {
			ID_CATEGORIA_EMPRESA: {
                key: true,
                title: 'Id',
                width: '40%',
                list: false,
                edit: false,
                create: false
            },
            NOMBRE_CATEGORIA_EMPRESA: {
                title: 'Nombre',
                width: '40%',
                edit: true,
                create: true
            },
            DESCRIPCION_CATEGORIA_EMPRESA: {
                title: 'Descripción',
                width: '40%',
                edit: true,
                create: true,
				list: true,
				type: 'textarea'
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
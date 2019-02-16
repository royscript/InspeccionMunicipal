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
		title: 'Tabla de Usuarios',
		paging: true,
		sorting: true,
		useBootstrap: true,
		//jqueryuiTheme: true, 
		defaultSorting: 'ID_USUARIO DESC',
		actions: {
			listAction: carpeta+'usuarios.php?accion=mostrar',
			createAction: carpeta+'usuarios.php?accion=crear',
			updateAction: carpeta+'usuarios.php?accion=modificar',
			deleteAction: carpeta+'usuarios.php?accion=eliminar'
		},
		rowInserted: function (event, data) {
			permitir($(nombreContenedor).find('.jtable-toolbar-item.jtable-toolbar-item-add-record'),data.row.find('.jtable-edit-command-button'),data.row.find('.jtable-delete-command-button'),$(nombreContenedor));	
		},
		deleteConfirmation: function (data) {
			data.deleteConfirmMessage = 'Desea Eliminar el Permiso  <strong>' + data.record.ID_USUARIO + '</strong>';
		},
		fields: {
			ID_USUARIO: {
                key: true,
                title: 'Id',
                width: '40%',
                list: false,
                edit: false,
                create: false
            },
            ID_PERMISO: {
                title: 'Permiso',
                width: '40%',
                edit: true,
                create: true,
				options: carpeta+'usuarios.php?accion=comboboxTipoPermiso'
            },
            USUARIO_USUARIO: {
                title: 'Usuario',
                width: '40%',
                edit: true,
                create: true
            },
            CONTRASENA_USUARIO: {
                title: 'Contraseña',
                width: '40%',
                edit: true,
                create: true,
				list: false
            },
            TIPO_USUARIO: {
                title: 'Grupo',
                width: '40%',
                edit: true,
                create: true,
				type: 'radiobutton',
				options: { '1': 'COSTA', 
						   '2': 'CORDILLERA', 
						   '3': 'NINGUNO' }
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
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
		title: 'Tabla de Juzgado',
		paging: true,
		sorting: true,
		useBootstrap: true,
		//jqueryuiTheme: true, 
		defaultSorting: 'ID_JUZGADO DESC',
		actions: {
			listAction: carpeta+'juzgado.php?accion=mostrar',
			createAction: carpeta+'juzgado.php?accion=crear',
			updateAction: carpeta+'juzgado.php?accion=modificar',
			deleteAction: carpeta+'juzgado.php?accion=eliminar'
		},
		rowInserted: function (event, data) {
			permitir($(nombreContenedor).find('.jtable-toolbar-item.jtable-toolbar-item-add-record'),data.row.find('.jtable-edit-command-button'),data.row.find('.jtable-delete-command-button'),$(nombreContenedor));	
		},
		deleteConfirmation: function (data) {
			data.deleteConfirmMessage = 'Desea Eliminar el Juzgado  <strong>' + data.record.ID_JUZGADO + '</strong>';
		},
		fields: {
			ID_JUZGADO: {
                key: true,
                title: 'Id',
                width: '40%',
                list: false,
                edit: false,
                create: false
            },
            NOMBRE: {
                title: 'Nombre',
                width: '15%',
                edit: true,
                create: true
            },
			NUMERO: {
                title: 'Número',
                width: '15%',
                edit: true,
                create: true
            },
			DIRECCION: {
                title: 'Direccion',
                width: '15%',
                edit: true,
                create: true
            },
            HORARIO_DE_ATENCION: {
                title: 'Horario de Atención',
                width: '15%',
                edit: true,
                create: true,
				input: function (data) {
					if (data.record) {
						return '<input type="time" id="Edit-HORARIO_DE_ATENCION" name="HORARIO_DE_ATENCION" value="' + data.record.HORARIO_DE_ATENCION + '" />';
					} else {
						return '<input type="time" id="Edit-HORARIO_DE_ATENCION" name="HORARIO_DE_ATENCION"/>';
					}
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
		});
	});
	$(nombreBoton).click();
});

$( function() {
    
  } );
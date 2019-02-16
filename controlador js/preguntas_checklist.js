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
		title: 'Tabla de Preguntas Checklist',
		paging: true,
		sorting: true,
		useBootstrap: true,
		//jqueryuiTheme: true, 
		defaultSorting: 'ID_PREGUNTAS_CHECKLIST DESC',
		actions: {
			listAction: carpeta+'preguntas_checklist.php?accion=mostrar',
			createAction: carpeta+'preguntas_checklist.php?accion=crear',
			updateAction: carpeta+'preguntas_checklist.php?accion=modificar',
			deleteAction: carpeta+'preguntas_checklist.php?accion=eliminar'
		},
		rowInserted: function (event, data) {
			permitir($(nombreContenedor).find('.jtable-toolbar-item.jtable-toolbar-item-add-record'),data.row.find('.jtable-edit-command-button'),data.row.find('.jtable-delete-command-button'),$(nombreContenedor));	
		},
		deleteConfirmation: function (data) {
			data.deleteConfirmMessage = 'Desea Eliminar el Juzgado  <strong>' + data.record.ID_PREGUNTAS_CHECKLIST + '</strong>';
		},
		fields: {
			ID_PREGUNTAS_CHECKLIST: {
                key: true,
                title: 'Id',
                width: '40%',
                list: false,
                edit: false,
                create: false
            },
			ID_OPERATIVO: {
                title: 'Operativo',
                width: '15%',
                edit: true,
                create: true,
				options: carpeta+'preguntas_checklist.php?accion=comboboxOperativo'
            },
            CONTENIDO_PREGUNTAS_CHECKLIST: {
                title: 'Pregunta',
                width: '15%',
                edit: true,
                create: true
            },
			REFERENCIA_LEGAL_PREGUNTAS_CHECKLIST: {
                title: 'Referencia Legal',
                width: '15%',
                edit: true,
                create: true
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
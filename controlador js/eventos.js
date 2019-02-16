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
		title: 'Tabla de eventos en la via publica',
		paging: true,
		sorting: true,
		useBootstrap: true,
		//jqueryuiTheme: true, 
		defaultSorting: 'ID_EVENTO_VIA_PUBLICA DESC',
		actions: {
			listAction: carpeta+'eventos.php?accion=mostrar',
			createAction: carpeta+'eventos.php?accion=crear',
			updateAction: carpeta+'eventos.php?accion=modificar',
			deleteAction: carpeta+'eventos.php?accion=eliminar'
		},
		rowInserted: function (event, data) {
			permitir($(nombreContenedor).find('.jtable-toolbar-item.jtable-toolbar-item-add-record'),data.row.find('.jtable-edit-command-button'),data.row.find('.jtable-delete-command-button'),$(nombreContenedor));	 
		},
		deleteConfirmation: function (data) {
			data.deleteConfirmMessage = 'Desea Eliminar el Evento  <strong>' + data.record.ID_EVENTO_VIA_PUBLICA + '</strong>';
		},
		fields: {
			ID_EVENTO_VIA_PUBLICA: {
				title: 'ID',
				key: true,
				width: '10%',
				inputClass: 'validate[required]',
				list: true,
				edit: false,
				create: false
			},
			ID_SECTOR: {
				title: 'Sector',
				width: '10%',
				inputClass: 'validate[required]',
				list: true,
				options: carpeta+'eventos.php?accion=comboboxSector'
			},
			ID_GRUPO: {
				title: 'Grupo',
				width: '10%',
				inputClass: 'validate[required]',
				list: true,
				options: carpeta+'eventos.php?accion=comboboxGrupo'
			},
			ID_ACTIVIDAD: {
				title: 'Actividad',
				width: '10%',
				inputClass: 'validate[required]',
				list: true,
				options: carpeta+'eventos.php?accion=comboboxActividad'
			},
			DIRECCION: {
				title: 'Dirección',
				width: '15%',
				inputClass: 'validate[required]',
				list: true,
				edit: true,
				create: true
			},
			FECHA: {
				title: 'Fecha',
				width: '15%',
				inputClass: 'validate[required]',
				type: 'date',
				displayFormat: 'dd-mm-yy',
				list: true,
				edit: true,
				create: true
			},
			DETALLE: {
				title: 'Detalle',
				width: '15%',
				inputClass: 'validate[required]',
				type: 'textarea',
				list: true,
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
			Fecha_inicio: $('#Fecha_inicio').val(),
			Fecha_final: $('#Fecha_final').val(),
			buscar_grupo: $('#buscar_grupo').val()
		});
	});
	$(nombreBoton).click();
});
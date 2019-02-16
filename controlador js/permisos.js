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
		title: 'Tabla de Permisos',
		paging: true,
		sorting: true,
		useBootstrap: true,
		//jqueryuiTheme: true, 
		defaultSorting: 'ID_PERMISO DESC',
		actions: {
			listAction: carpeta+'permisos.php?accion=mostrar',
			createAction: carpeta+'permisos.php?accion=crear',
			updateAction: carpeta+'permisos.php?accion=modificar',
			deleteAction: carpeta+'permisos.php?accion=eliminar'
		},
		rowInserted: function (event, data) {
			permitir($(nombreContenedor).find('.jtable-toolbar-item.jtable-toolbar-item-add-record'),data.row.find('.jtable-edit-command-button'),data.row.find('.jtable-delete-command-button'),$(nombreContenedor));	 
		},
		deleteConfirmation: function (data) {
			data.deleteConfirmMessage = 'Desea Eliminar el Permiso  <strong>' + data.record.ID_PERMISO + '</strong>';
		},
		fields: {
			ID_PERMISO: {
                key: true,
                title: 'Id',
                width: '40%',
                list: false,
                edit: false,
                create: false
            },
            //TABLA HIJA MANTENEDORES
            MANTENEDORES: {
                title: 'Formularios',
                width: '5%',
                sorting: false,
                edit: false,
                create: false,
                display: function(datosPermiso) {
                    //Create an image that will be used to open child table
                    var $img = $('<img src="../fotos/list_metro.png" title="Edite los mantenedores del permiso" />');
                    //Open child table when user clicks the image
                    $img.click(function() {
                        $(nombreContenedor).jtable('openChildTable',
                                $img.closest('tr'),
                                {
                                    title: ' Mantenedores del Permiso ' + datosPermiso.record.NOMBRE_PERMISO,
                                    paging: true,
                                    sorting: true,
                                    //jqueryuiTheme: true,
                                    defaultSorting: 'ID_MANTENEDOR_DEL_PERMISO DESC',
                                    actions: {
                                        listAction: carpeta+'permisos.php?accion=listarMantenedorDelPermiso&IdPermiso=' + datosPermiso.record.ID_PERMISO,
                                        deleteAction: carpeta+'permisos.php?accion=eliminarMantenedorDelPermiso',
                                        updateAction: carpeta+'permisos.php?accion=ModificarMantenedorDelPermiso',
                                        createAction: carpeta+'permisos.php?accion=CrearMantenedorDelPermiso'
                                    },
                                    deleteConfirmation: function(data) {
						data.deleteConfirmMessage = 'Estas seguro que deseas eliminar el siguiente registro ? <strong>'+data.record.ID_MANTENEDOR_DEL_PERMISO+'</strong>';
		},
                                    fields: {
                                        ID_PERMISO: {
                                            type: 'hidden',
                                            defaultValue: datosPermiso.record.ID_PERMISO
                                        },
                                        ID_MANTENEDOR_DEL_PERMISO: {
                                            title: '#',
                                            width: '2%',
                                            key: true,
                                            create: false,
                                            edit: false,
                                            list: true
                                        },
                                        ID_MANTENEDOR: {
                                            title: 'Mantenedor',
                                            width: '10%',
                                            inputClass: 'validate[required]',
                                            options: carpeta+'permisos.php?accion=comboboxMantenedor'
                                        },
                                        LISTAR_MANTENEDOR_DEL_PERMISO: {
                                            title: 'Listar',
                                            width: '10%',
                                            edit: true,
                                            create: true,
                                            list: true,
                                            type: 'radiobutton',
                                            inputClass: 'validate[required]',
                                            options: [
                                                {Value: 'SI', DisplayText: 'SI'},
                                                {Value: 'NO', DisplayText: 'NO'}
                                            ]
                                        },
                                        INGRESAR_MANTENEDOR_DEL_PERMISO: {
                                            title: 'Ingresar',
                                            width: '10%',
                                            edit: true,
                                            create: true,
                                            list: true,
                                            type: 'radiobutton',
                                            inputClass: 'validate[required]',
                                            options: [
                                                {Value: 'SI', DisplayText: 'SI'},
                                                {Value: 'NO', DisplayText: 'NO'}
                                            ]
                                        },
                                        MODIFICAR_MANTENEDOR_DEL_PERMISO: {
                                            title: 'Modificar',
                                            width: '10%',
                                            edit: true,
                                            create: true,
                                            list: true,
                                            type: 'radiobutton',
                                            inputClass: 'validate[required]',
                                            options: [
                                                {Value: 'SI', DisplayText: 'SI'},
                                                {Value: 'NO', DisplayText: 'NO'}
                                            ]
                                        },
                                        ELIMINAR_MANTENEDOR_DEL_PERMISO: {
                                            title: 'Eliminar',
                                            width: '10%',
                                            edit: true,
                                            create: true,
                                            list: true,
                                            type: 'radiobutton',
                                            inputClass: 'validate[required]',
                                            options: [
                                                {Value: 'SI', DisplayText: 'SI'},
                                                {Value: 'NO', DisplayText: 'NO'}
                                            ]
                                        }
                                    },
                                    //Initialize validation logic when a form is created
                                    formCreated: function(event, data) {
                                        data.form.validationEngine();
                                    },
                                    //Validate form when it is being submitted
                                    formSubmitting: function(event, data) {
                                        return data.form.validationEngine('validate');
                                    },
                                    //Dispose validation logic when form is closed
                                    formClosed: function(event, data) {
                                        data.form.validationEngine('hide');
                                        data.form.validationEngine('detach');
                                    }
                                }, function(data) { //opened handler
                            data.childTable.jtable('load');
                        });
                    });
                    //Return image to show on the person row
                    return $img;
                }
            },
			//-------FIN TABLA HIJA MANTENEDORES
            NOMBRE_PERMISO: {
                title: 'Nombre',
                width: '40%',
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
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
		title: 'Tabla de Empresas',
		paging: true,
		sorting: true,
		useBootstrap: true,
		//jqueryuiTheme: true, 
		defaultSorting: 'ID_EMPRESAS_A_INTERVENIR DESC',
		actions: {
			listAction: carpeta+'empresas.php?accion=mostrar',
			createAction: carpeta+'empresas.php?accion=crear',
			updateAction: carpeta+'empresas.php?accion=modificar',
			deleteAction: carpeta+'empresas.php?accion=eliminar'
		},
		rowInserted: function (event, data) {
			permitir($(nombreContenedor).find('.jtable-toolbar-item.jtable-toolbar-item-add-record'),data.row.find('.jtable-edit-command-button'),data.row.find('.jtable-delete-command-button'),$(nombreContenedor));	
		},
		deleteConfirmation: function (data) {
			data.deleteConfirmMessage = 'Desea Eliminar  <strong>' + data.record.NOMBRE_FANTASIA_EMPRESAS_A_INTERVENIR + '</strong>';
		},
		fields: {
			ID_EMPRESAS_A_INTERVENIR: {
                key: true,
                title: 'Id',
                width: '40%',
                list: false,
                edit: false,
                create: false
            },
			//TABLA HIJA CLASIFICACION_LOCAL
            CLASIFICACION_LOCAL: {
                title: 'Patentes',
                width: '5%',
                sorting: false,
                edit: false,
                create: false,
                display: function(datosPermiso) {
                    //Create an image that will be used to open child table
                    var $img = $('<img src="../fotos/list_metro.png" title="Edite las clasificaciones del local" />');
                    //Open child table when user clicks the image
                    $img.click(function() {
                        $(nombreContenedor).jtable('openChildTable',
                                $img.closest('tr'),
                                {
                                    title: ' Patentes de la empresa ' + datosPermiso.record.NOMBRE_EMPRESAS_A_INTERVENIR,
                                    paging: true,
                                    sorting: true,
                                    //jqueryuiTheme: true,
                                    defaultSorting: 'ID_EMPRESAS_A_INTERVENIR DESC',
                                    actions: {
                                        listAction: carpeta+'categoria_de_la_empresa.php?accion=mostrar&Id=' + datosPermiso.record.ID_EMPRESAS_A_INTERVENIR,
                                        deleteAction: carpeta+'categoria_de_la_empresa.php?accion=eliminar',
                                        updateAction: carpeta+'categoria_de_la_empresa.php?accion=modificar',
                                        createAction: carpeta+'categoria_de_la_empresa.php?accion=crear'
                                    },
                                    deleteConfirmation: function(data) {
						data.deleteConfirmMessage = 'Estas seguro que deseas eliminar el siguiente registro ? <strong>'+data.record.ID_CATEGORIA_DE_LA_EMPRESA+'</strong>';
		},
                                    fields: {
                                        ID_EMPRESAS_A_INTERVENIR: {
                                            type: 'hidden',
                                            defaultValue: datosPermiso.record.ID_EMPRESAS_A_INTERVENIR
                                        },
                                        ID_CATEGORIA_DE_LA_EMPRESA: {
                                            title: '#',
                                            width: '2%',
                                            key: true,
                                            create: false,
                                            edit: false,
                                            list: true
                                        },
                                        ID_CATEGORIA_EMPRESA: {
                                            title: 'Categoría',
                                            width: '10%',
                                            inputClass: 'validate[required]',
                                            options: carpeta+'categoria_empresa.php?accion=comboboxClaseNegocio'
                                        },
										ROL_CATEGORIA_DE_LA_EMPRESA: {
											title: 'Rol',
											width: '15%',
											edit: true,
											create: true
										},
										ESTADO_CATEGORIA_DE_LA_EMPRESA: {
											title: 'Estado',
											width: '15%',
											edit: true,
											create: true,
											options: {'ACTIVA': 'ACTIVA', 
											          'INACTIVA': 'INACTIVA', 
													  'CLAUSURADO': 'CLAUSURADO'}
										},
										FECHA_REGISTRO_CATEGORIA_DE_LA_EMPRESA: {
											title: 'Fecha Registro',
											width: '10%',
											edit: false,
											create: false,
											type: 'date',
											displayFormat: 'dd-mm-yy',
											inputClass: 'validate[required]'
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
			//-------FIN TABLA HIJA CLASIFICACION_LOCAL
			//TABLA HIJA CLASIFICACION_LOCAL
            ESTADO_LEGAL: {
                title: 'Locales',
                width: '5%',
                sorting: false,
                edit: false,
                create: false,
                display: function(datosPermiso) {
                    //Create an image that will be used to open child table
                    var $img = $('<img src="../fotos/placeholder.png" title="Edite las clasificaciones del local" />');
                    //Open child table when user clicks the image
                    $img.click(function() {
                        $(nombreContenedor).jtable('openChildTable',
                                $img.closest('tr'),
                                {
                                    title: ' Locales de la empresa ' + datosPermiso.record.NOMBRE_EMPRESAS_A_INTERVENIR,
                                    paging: true,
                                    sorting: true,
                                    //jqueryuiTheme: true,
                                    defaultSorting: 'ID_DIRECCION_EMPRESA DESC',
                                    actions: {
                                        listAction: carpeta+'locales_de_la_empresa.php?accion=mostrar&Id=' + datosPermiso.record.ID_EMPRESAS_A_INTERVENIR,
                                        deleteAction: carpeta+'locales_de_la_empresa.php?accion=eliminar',
                                        updateAction: carpeta+'locales_de_la_empresa.php?accion=modificar',
                                        createAction: carpeta+'locales_de_la_empresa.php?accion=crear'
                                    },
                                    deleteConfirmation: function(data) {
						data.deleteConfirmMessage = 'Estas seguro que deseas eliminar el siguiente registro ? <strong>'+datosPermiso.record.ID_EMPRESAS_A_INTERVENIR+'</strong>';
		},
                                    fields: {
										//TABLA HIJA ESTADO LEGAL
										ESTADO_LEGAL: {
											title: 'Estado Legal',
											width: '10%',
											sorting: false,
											edit: false,
											create: false,
											display: function(datosPermiso) {
												//Create an image that will be used to open child table
												var $img = $('<img src="../fotos/weight-balance.png" title="Edite las violaciones legales del local" />');
												//Open child table when user clicks the image
												$img.click(function() {
													$(nombreContenedor).jtable('openChildTable',
															$img.closest('tr'),
															{
																title: ' Violaciones legales de la empresa ' + datosPermiso.record.NOMBRE_EMPRESAS_A_INTERVENIR +' local '+ datosPermiso.record.CALLE_DIRECCION_EMPRESA+' '+datosPermiso.record.NUMERO_DIRECCION_EMPRESA,
																paging: true,
																sorting: true,
																//jqueryuiTheme: true,
																defaultSorting: 'ID_ESTADO_LEGAL DESC',
																actions: {
																	listAction: carpeta+'estadoLegalDelLocal.php?accion=mostrar&id=' + datosPermiso.record.ID_DIRECCION_EMPRESA,
																	deleteAction: carpeta+'estadoLegalDelLocal.php?accion=eliminar',
																	updateAction: carpeta+'estadoLegalDelLocal.php?accion=modificar',
																	createAction: carpeta+'estadoLegalDelLocal.php?accion=crear'
																},
																deleteConfirmation: function(data) {
													data.deleteConfirmMessage = 'Estas seguro que deseas eliminar el siguiente registro ? <strong>'+datosPermiso.record.ID_EMPRESAS_A_INTERVENIR+'</strong>';
									},
																fields: {
																	ID_DIRECCION_EMPRESA: {
																		type: 'hidden',
																		defaultValue: datosPermiso.record.ID_DIRECCION_EMPRESA
																	},
																	ID_EMPRESAS_A_INTERVENIR: {
																		type: 'hidden',
																		defaultValue: datosPermiso.record.ID_EMPRESAS_A_INTERVENIR
																	},
																	ID_ESTADO_LEGAL: {
																		title: '#',
																		width: '2%',
																		key: true,
																		create: false,
																		edit: false,
																		list: true
																	},
																	LEY_ESTADO_LEGAL: {
																		title: 'Ley',
																		width: '15%',
																		edit: true,
																		create: true
																	},
																	ARTICULO_ESTADO_LEGAL: {
																		title: 'Artículo',
																		width: '15%',
																		edit: true,
																		create: true
																	},
																	ORDENANZA_ESTADO_LEGAL: {
																		title: 'Ordenanza',
																		width: '15%',
																		edit: true,
																		create: true
																	},
																	DETALLE_ESTADO_LEGAL: {
																		title: 'Detalle',
																		width: '15%',
																		edit: true,
																		create: true,
																		type: 'textarea',
																		list: false
																	},
																	ESTA_AL_DIA_ESTADO_LEGAL: {
																		title: 'Estado',
																		width: '15%',
																		edit: true,
																		create: true,
																		type: 'radiobutton',
																		options: { 'AL DÍA': 'AL DÍA', 
																				   'INFRINGE': 'INFRINGE',
																				   'LABOR EDUCATIVA' : 'LABOR EDUCATIVA',
																				   'LOCAL CERRADO' : 'LOCAL CERRADO'}
																	},
																	FECHA_ESTADO_LEGAL: {
																		title: 'Fecha Registro',
																		width: '10%',
																		edit: true,
																		create: true,
																		type: 'date',
																		displayFormat: 'dd-mm-yy',
																		inputClass: 'validate[required]'
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
										//-------FIN TABLA HIJA ESTADO LEGAL
										//TABLA HIJA TELEFONO
										TELEFONO: {
											title: 'Teléfono',
											width: '10%',
											sorting: false,
											edit: false,
											create: false,
											display: function(datosPermiso) {
												//Create an image that will be used to open child table
												var $img = $('<img src="../fotos/phone-book.png" title="Edite los teléfonos del local" />');
												//Open child table when user clicks the image
												$img.click(function() {
													$(nombreContenedor).jtable('openChildTable',
															$img.closest('tr'),
															{
																title: ' Teléfonos de la empresa ' + datosPermiso.record.NOMBRE_EMPRESAS_A_INTERVENIR +' local '+ datosPermiso.record.CALLE_DIRECCION_EMPRESA+' '+datosPermiso.record.NUMERO_DIRECCION_EMPRESA,
																paging: true,
																sorting: true,
																//jqueryuiTheme: true,
																defaultSorting: 'ID_TELEFONO_EMPRESA_A_INTERVENIR DESC',
																actions: {
																	listAction: carpeta+'telefono_del_local.php?accion=mostrar&id=' + datosPermiso.record.ID_DIRECCION_EMPRESA,
																	deleteAction: carpeta+'telefono_del_local.php?accion=eliminar',
																	updateAction: carpeta+'telefono_del_local.php?accion=modificar',
																	createAction: carpeta+'telefono_del_local.php?accion=crear'
																},
																deleteConfirmation: function(data) {
													data.deleteConfirmMessage = 'Estas seguro que deseas eliminar el siguiente registro ? <strong>'+datosPermiso.record.ID_EMPRESAS_A_INTERVENIR+'</strong>';
									},
																fields: {
																	ID_DIRECCION_EMPRESA: {
																		type: 'hidden',
																		defaultValue: datosPermiso.record.ID_DIRECCION_EMPRESA
																	},
																	ID_TELEFONO_EMPRESA_A_INTERVENIR: {
																		title: '#',
																		width: '2%',
																		key: true,
																		create: false,
																		edit: false,
																		list: true
																	},
																	NUMERO_TELEFONO_EMPRESA_A_INTERVENIR: {
																		title: 'Número de Teléfono',
																		width: '15%',
																		edit: true,
																		create: true
																	},
																	NOMBRE_CONTACTO_TELEFONO_EMPRESA_A_INTERVENIR: {
																		title: 'Nombre del Contacto',
																		width: '15%',
																		edit: true,
																		create: true
																	},
																	FECHA_REGISTRO_TELEFONO_EMPRESA_A_INTERVENIR: {
																		title: 'Fecha del Registro',
																		width: '15%',
																		edit: false,
																		create: false,
																		type: 'date',
																		displayFormat: 'dd-mm-yy',
																		inputClass: 'validate[required]'
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
										//-------FIN TABLA HIJA TELEFONO
										ID_CATEGORIA_DE_LA_EMPRESA: {
                                            title: 'Categoría',
                                            width: '10%',
                                            inputClass: 'validate[required]',
                                            options: carpeta+'locales_de_la_empresa.php?accion=comboboxCategoriasDelNegocioSeleccionado&ID_EMPRESAS_A_INTERVENIR='+datosPermiso.record.ID_EMPRESAS_A_INTERVENIR
                                        },
                                        ID_DIRECCION_EMPRESA: {
                                            title: '#',
                                            width: '2%',
                                            key: true,
                                            create: false,
                                            edit: false,
                                            list: true
                                        },
                                        CALLE_DIRECCION_EMPRESA: {
                                            title: 'Calle',
                                            width: '15%',
											edit: true,
											create: true
                                        },
										NUMERO_DIRECCION_EMPRESA: {
											title: 'Número calle',
											width: '15%',
											edit: true,
											create: true
										},
										DETALLE_DIRECCION_EMPRESA: {
											title: 'Detalle',
											width: '15%',
											edit: true,
											create: true,
											type: 'textarea',
                    						list: false
										},
										ESTADO_DIRECCION_EMPRESA: {
											title: 'Estado',
											width: '15%',
											edit: true,
											create: true,
											type: 'radiobutton',
											options: { 'ACTIVA': 'ACTIVA', 
													   'INACTIVA': 'INACTIVA',
													   'CLAUSURADO' : 'CLAUSURADO'}
										},
										FECHA_REGISTRO_DIRECCION_EMPRESA: {
											title: 'Fecha Registro',
											width: '10%',
											edit: false,
											create: false,
											type: 'date',
											displayFormat: 'dd-mm-yy',
											inputClass: 'validate[required]'
										},
										LATITUD_DIRECCION_EMPRESA: {
											title: 'Latitud',
											width: '15%',
											edit: true,
											create: true
										},
										LONGITUD_DIRECCION_EMPRESA: {
											title: 'Longitud',
											width: '15%',
											edit: true,
											create: true
										},
										SECTOR_DIRECCION_EMPRESA: {
											title: 'Sector',
											width: '15%',
											edit: true,
											create: true
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
			//-------FIN TABLA HIJA CLASIFICACION_LOCAL
            RUT_EMPRESAS_A_INTERVENIR: {
                title: 'Rut Empresa',
                width: '15%',
                edit: true,
                create: true
            },
			NOMBRE_EMPRESAS_A_INTERVENIR: {
                title: 'Nombre Empresa',
                width: '15%',
                edit: true,
                create: true
            },
			NOMBRE_FANTASIA_EMPRESAS_A_INTERVENIR: {
                title: 'Nombre de Fantasía',
                width: '15%',
                edit: true,
                create: true
            },
			NOMBRE_ADMINISTRADOR_EMPRESAS_A_INTERVENIR: {
                title: 'Nombre del Administrador',
                width: '15%',
                edit: true,
                create: true
            },
			RUT_ADMINISTRADOR_EMPRESAS_A_INTERVENIR: {
                title: 'Rut Administrador',
                width: '15%',
                edit: true,
                create: true
            },
			MONTO_EMPRESAS_A_INTERVENIR: {
                title: 'Monto',
                width: '15%',
                edit: true,
                create: true
            },
			FECHA_REGISTRO_EMPRESAS_A_INTERVENIR: {
                title: 'Fecha del Registro',
                width: '15%',
                edit: false,
                create: false
            }
        },
		//Iniciar las validaciones cuando el formulario es creado
		formCreated: function (event, data) {
			//validar y formatear rut
			$('#Edit-RUT_EMPRESAS_A_INTERVENIR').blur(function (event) {
				valor = $('#Edit-RUT_EMPRESAS_A_INTERVENIR').val();
				//VALIDAMOS Y FORMATERAMOS EL RUT INGRESADO
				validacion_rut_usu_busquedas(valor, 'mensage_error_Rut', 'Edit-RUT_EMPRESAS_A_INTERVENIR');
			});
			//validar y formatear rut
			$('#Edit-RUT_ADMINISTRADOR_EMPRESAS_A_INTERVENIR').blur(function (event) {
				valor = $('#Edit-RUT_ADMINISTRADOR_EMPRESAS_A_INTERVENIR').val();
				//VALIDAMOS Y FORMATERAMOS EL RUT INGRESADO
				validacion_rut_usu_busquedas(valor, 'mensage_error_Rut', 'Edit-RUT_ADMINISTRADOR_EMPRESAS_A_INTERVENIR');
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
			rut_empresa : $("#buscar_rut_empresa").val(),
			nombre_empresa : $("#buscar_nombre_empresa").val(),
			nombre_fantasia_empresa : $("#buscar_nombre_fantasia_empresa").val(),
			estado_legal : $("#buscar_estado_legal").val(),
			sector : $("#buscar_sector").val()
		});
	});
	$(nombreBoton).click();
});

$( function() {
    
  } );
function dia_de_la_semana(numero){
	var dia = '';
	switch(parseInt(numero)) {
		case 1:
			dia = 'Lunes';
			break;
		case 2:
			dia = 'Martes';
			break;
		case 3:
			dia = 'Miercoles';
			break;
		case 4:
			dia = 'Jueves';
			break;
		case 5:
			dia = 'Viernes';
			break;
		case 6:
			dia = 'Sábado';
			break;
		case 7:
			dia = 'Domingo';
			break;
	}
	return dia;
}
$(document).ready(function() {
	var initialLocaleCode = 'es-do';
	var carpeta = '../controlador/calendario/';
	var inspectores = new Array();
	$('#calendar').fullCalendar({
		minTime: "07:30:00",
		maxTime: "22:00:00",
		customButtons: {//comienzan los botones superiores izquierdos
			agregarEvento: {//comienza el boton agregar evento
				text: 'Agregar Evento',
				click: function() {
					sectores_para_combobox = objeto_sectores.devolver();
					var combobox_sectores = '<select id="seleccionar_sector" class="bootbox-input bootbox-input-select form-control">';
					for(var x=0;x<sectores_para_combobox.length;x++){
						combobox_sectores += '<option value="'+sectores_para_combobox[x].id+'">'+sectores_para_combobox[x].nombre+'</option>';
					}
					combobox_sectores += '</select>';
					
					var grupos_para_combobox = objeto_grupo.devolver();
					var combobox_grupos = '<select id="seleccionar_grupo" class="bootbox-input bootbox-input-select form-control">';
					for(var x=0;x<grupos_para_combobox.length;x++){
						combobox_grupos += '<option value="'+grupos_para_combobox[x].id+'">'+grupos_para_combobox[x].nombre+'</option>';
					}
					combobox_grupos += '</select>';
					
					if($("#modificar").val()=='SI'){
						//Si puede modificar podra cambiar el grupo
						bootbox.confirm({
							title: 'Agregar Evento',
							message: '<div class="form-group">'
										+'<label for="exampleInputEmail1">Grupo</label>'
										+combobox_grupos
									  +'</div>'
									 +'<div class="form-group">'
										+'<label for="exampleInputEmail1">Sector</label>'
										+combobox_sectores
									  +'</div>'
									 +'<div class="form-group">'
										+'<label for="exampleInputEmail1">Fecha de Inicio</label>'
										+'<input type="date" class="form-control" id="txt_fecha_inicio" value="'+$('#calendar').fullCalendar('getDate').format("YYYY-MM-DD")+'">'
									  +'</div>'
									 +'<div class="form-group">'
										+'<label for="exampleInputEmail1">Fecha Final</label>'
										+'<input type="date" class="form-control" id="txt_fecha_final" value="'+$('#calendar').fullCalendar('getDate').format("YYYY-MM-DD")+'">'
									  +'</div>'
									 +'<div class="form-group">'
										+'<label for="exampleInputEmail1">Hora de Inicio</label>'
										+'<input type="time" class="form-control" id="txt_hora_inicio">'
									  +'</div>'
									 +'<div class="form-group">'
										+'<label for="exampleInputEmail1">Hora Final</label>'
										+'<input type="time" class="form-control" id="txt_hora_final">'
									  +'</div>'
									  +'<div class="form-group">'
										+'<label for="exampleInputEmail1">Cantidad de Inspectores</label>'
										+'<input type="number" class="form-control" id="txt_cantidad_de_inspectores">'
									  +'</div>'
									  +'<div class="form-group">'
										+'<label for="exampleInputEmail1">Color de Fondo</label>'
										+'<input type="color" class="form-control" id="txt_color_de_fondo" value="#3a87ad">'
									  +'</div>'
									  +'<div class="form-group">'
										+'<label for="exampleInputEmail1">Color de Bordes</label>'
										+'<input type="color" class="form-control" id="txt_color_de_bordes" value="#3a87ad">'
									  +'</div>'
									  +'<div class="form-group">'
										+'<label for="exampleInputEmail1">Color del Texto</label>'
										+'<input type="color" class="form-control" id="txt_color_de_texto" value="#FFFDFD">'
									  +'</div>',
							buttons: {
								cancel: {
									label: '<i class="fa fa-times"></i> Cancelar'
								},
								confirm: {
									label: '<i class="fa fa-check"></i> Agregar'
								}
							},
							callback: function (result) {
								if(result==true){
									$.ajax({
										url: carpeta+'agregar_eventos.php',
										dataType: 'JSON',
										data: {
											// our hypothetical feed requires UNIX timestamps
											grupo: $("#seleccionar_grupo").val(),
											sector: $("#seleccionar_sector").val(),
											fecha_inicio: $("#txt_fecha_inicio").val(),
											hora_inicio: $("#txt_hora_inicio").val(),
											fecha_final: $("#txt_fecha_final").val(),
											hora_final: $("#txt_hora_final").val(),
											cantidad_inspectores: $("#txt_cantidad_de_inspectores").val(),
											color_de_fondo: $("#txt_color_de_fondo").val(),
											color_de_bordes: $("#txt_color_de_bordes").val(),
											color_de_texto: $("#txt_color_de_texto").val()
										},
										complete: function() {       
											refrescar_calendario();
										}
									});
								}
							}
						});
						//Si puede modificar podra cambiar el grupo
					}else{
						//Si NO puede modificar NO podra cambiar el grupo
						//sectores_para_combobox = objeto_sectores.devolver(); esta ya se llamó arriba
						var combobox_grupos = '<select id="seleccionar_grupo" class="bootbox-input bootbox-input-select form-control">';
						for(var x=0;x<grupos_para_combobox.length;x++){
							if($("#grupo_usuario_actual").val()==grupos_para_combobox[x].id){
								combobox_grupos += '<option value="'+grupos_para_combobox[x].id+'">'+grupos_para_combobox[x].nombre+'</option>';
							}
						}
						combobox_grupos += '</select>';
						
						
						
						bootbox.confirm({
							title: 'Agregar Evento',
							message: '<div class="form-group">'
										+'<label for="exampleInputEmail1">Grupo</label>'
										+combobox_grupos
									  +'</div>'
									 +'<div class="form-group">'
										+'<label for="exampleInputEmail1">Sector</label>'
										+combobox_sectores
									  +'</div>'
									 +'<div class="form-group">'
										+'<label for="exampleInputEmail1">Fecha de Inicio</label>'
										+'<input type="date" class="form-control" id="txt_fecha_inicio" value="'+$('#calendar').fullCalendar('getDate').format("YYYY-MM-DD")+'">'
									  +'</div>'
									 +'<div class="form-group">'
										+'<label for="exampleInputEmail1">Fecha Final</label>'
										+'<input type="date" class="form-control" id="txt_fecha_final" value="'+$('#calendar').fullCalendar('getDate').format("YYYY-MM-DD")+'">'
									  +'</div>'
									 +'<div class="form-group">'
										+'<label for="exampleInputEmail1">Hora de Inicio</label>'
										+'<input type="time" class="form-control" id="txt_hora_inicio">'
									  +'</div>'
									 +'<div class="form-group">'
										+'<label for="exampleInputEmail1">Hora Final</label>'
										+'<input type="time" class="form-control" id="txt_hora_final">'
									  +'</div>'
									  +'<div class="form-group">'
										+'<label for="exampleInputEmail1">Cantidad de Inspectores</label>'
										+'<input type="number" class="form-control" id="txt_cantidad_de_inspectores">'
									  +'</div>'
									  +'<div class="form-group">'
										+'<label for="exampleInputEmail1">Color de Fondo</label>'
										+'<input type="color" class="form-control" id="txt_color_de_fondo" value="#3a87ad">'
									  +'</div>'
									  +'<div class="form-group">'
										+'<label for="exampleInputEmail1">Color de Bordes</label>'
										+'<input type="color" class="form-control" id="txt_color_de_bordes" value="#3a87ad">'
									  +'</div>'
									  +'<div class="form-group">'
										+'<label for="exampleInputEmail1">Color del Texto</label>'
										+'<input type="color" class="form-control" id="txt_color_de_texto" value="#FFFDFD">'
									  +'</div>',
							buttons: {
								cancel: {
									label: '<i class="fa fa-times"></i> Cancelar'
								},
								confirm: {
									label: '<i class="fa fa-check"></i> Agregar'
								}
							},
							callback: function (result) {
								if(result==true){
									$.ajax({
										url: carpeta+'agregar_eventos.php',
										dataType: 'JSON',
										data: {
											// our hypothetical feed requires UNIX timestamps
											grupo: $("#seleccionar_grupo").val(),
											sector: $("#seleccionar_sector").val(),
											fecha_inicio: $("#txt_fecha_inicio").val(),
											hora_inicio: $("#txt_hora_inicio").val(),
											fecha_final: $("#txt_fecha_final").val(),
											hora_final: $("#txt_hora_final").val(),
											cantidad_inspectores: $("#txt_cantidad_de_inspectores").val(),
											color_de_fondo: $("#txt_color_de_fondo").val(),
											color_de_bordes: $("#txt_color_de_bordes").val(),
											color_de_texto: $("#txt_color_de_texto").val()
										},
										complete: function() {       
											refrescar_calendario();
										}
									});
								}
							}
						});
						//Si NO puede modificar NO podra cambiar el grupo
					}
				}//termina el boton agregar evento
			},//terminan los botones superiores izquierdos
			refrescar: {
				text: 'Refrescar',
				click: function() {
					refrescar_calendario();
				}
			}
		},
		header: {
			left: 'prev,next today agregarEvento refrescar',
			center: 'title',
			right: 'month,agendaWeek,agendaDay,listMonth'
		},
		defaultDate: moment().format("YYYY-MM-DD"),
		locale: initialLocaleCode,
		buttonIcons: true, // show the prev/next text
		weekNumbers: true,
		navLinks: true, // can click day/week names to navigate views
		editable: false,
		slotEventOverlap: false,
		eventLimit: true, // allow "more" link when too many events
		/*dayClick: function(){
			alert("Isiste click en un día");
		},*/
		eventClick: function(event, element){
			var fecha_actual = $.ajax({
						url: carpeta+'mostrar_fecha.php',
						type:'post',
						async:false    		
					}).responseText;
			if(moment(fecha_actual).format("DD-MM-YYYY")<=moment(event._start._i).format("DD-MM-YYYY")){
				
			}else{
				/*grilla_inspectores.iniciar(event.inspectores);
				setTimeout(function(){ 
					grilla_inspectores.dibujar_sin_eliminar();
				}, 1500);
				bootbox.alert({
					title: "Sector : "+event.sector+', '+event.actividad+'('+dia_de_la_semana(moment(event._start._i).format("d"))+' '+moment(event._start._i).format("HH:mm:ss")+' - '+moment(event._end._i).format("HH:mm:ss")+')<br> Grupo: '+event.nombre_grupo+'.',
					message: "Inspectores <strong>(recomendados "+event.cantidad_inspectores+")</strong> <br> "
							 +'<table class="table">'
								+'<tr>'
									+'<th>Nombre</th>'
									+'<th>Conductor</th>'
								+'</tr>'
								+'<tbody id="grilla_inspectores">'
								+'<tr>'
								+'<td rowspan="2"><p><img src="../fotos/cargando-loading-027.gif"> Cargando...</p></td>'
								+'</tr>'
								+'</tbody>'
							 +'</table>'
				});
				return false;*/
			}
			var combobox_inspectores = '<select id="seleccionar_inspector" class="bootbox-input bootbox-input-select form-control">';
			var inspectores = objeto_inspectores.devolver();
			for(var x=0;x<inspectores.length;x++){
				combobox_inspectores += '<option value="'+inspectores[x].id+'">'+inspectores[x].nombre+'</option>';
			}
			combobox_inspectores += '</select>';
			
			
			var combobox_actividades = '<select id="seleccionar_actividad" class="bootbox-input bootbox-input-select form-control">';
			var actividades = $.ajax({
						url: carpeta+'mostrar_actividades.php',
						type:'post',
						dataType:'json',
						async:false    		
					}).responseText;
			actividades = JSON.parse(actividades);
			for(var x=0;x<actividades.length;x++){
				combobox_actividades += '<option value="'+actividades[x].id+'">'+actividades[x].nombre+'</option>';
			}
			combobox_actividades += '</select>';
			
			
			grilla_inspectores.iniciar(event.inspectores);
			setTimeout(function(){ 
				grilla_inspectores.dibujar();
			}, 1500);
			
			
			grilla_actividades.iniciar(event.actividades);
			setTimeout(function(){ 
				grilla_actividades.dibujar();
			}, 1500);
			bootbox.confirm({
				title: "Sector : "+event.sector+'('+dia_de_la_semana(moment(event._start._i).format("d"))+' '+moment(event._start._i).format("HH:mm:ss")+' - '+moment(event._end._i).format("HH:mm:ss")+')<br> Grupo: '+event.nombre_grupo+'.',
				message: "Seleccione el o los inspectores <strong>(recomendados "+event.cantidad_inspectores+")</strong> <br> "
						 +'<div class="input-group">'
							+'<div class="input-group-btn">'
							 +'<button type="button" class="btn btn-default" onclick="grilla_inspectores.agregar();">'
								+'<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>'
							 +'</button>'
							+'</div>' 
							+combobox_inspectores
						 +'</div><br>'
						 +'<input type="radio" name="conductor" value="SI"> Conductor<br>'
  						 +'<input type="radio" name="conductor" value="NO" checked="checked"> Pasajero<br>'
						 +'<table class="table">'
							+'<tr>'
								+'<th>Nombre</th>'
								+'<th>Conductor</th>'
								+'<th>Eliminar</th>'
							+'</tr>'
							+'<tbody id="grilla_inspectores">'
							+'<tr>'
							+'<td rowspan="3"><p><img src="../fotos/cargando-loading-027.gif"> Cargando...</p></td>'
							+'</tr>'
							+'</tbody>'
						 +'</table><br>'
						 //----------tabla actividades
						 +"<strong>Seleccione la o las actividades</strong> <br> "
						 +'<div class="input-group">'
							+'<div class="input-group-btn">'
							 +'<button type="button" class="btn btn-default" onclick="grilla_actividades.agregar();">'
								+'<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>'
							 +'</button>'
							+'</div>' 
							+combobox_actividades
						 +'</div><br>'
						 +'<table class="table">'
							+'<tr>'
								+'<th>Nombre</th>'
								+'<th>Eliminar</th>'
							+'</tr>'
							+'<tbody id="grilla_actividades">'
							+'<tr>'
							+'<td rowspan="2"><p><img src="../fotos/cargando-loading-027.gif"> Cargando...</p></td>'
							+'</tr>'
							+'</tbody>'
						 +'</table>',
				buttons: {
					cancel: {
						label: '<i class="fa fa-times"></i> Cancelar'
					},
					confirm: {
						label: '<i class="fa fa-check"></i> Agregar'
					}
				},
				callback: function (result) {
					if(result==true){
						var inspectores_evento = grilla_inspectores.devolver();
						var actividades_evento = grilla_actividades.devolver();
						event.title = event.sector;
						for(var x=0;x<inspectores_evento.length;x++){
							event.title += ' \n -'+inspectores_evento[x].nombre +'.';
						}
						event.inspectores = inspectores_evento;
						console.log(event);
						$('#calendar').fullCalendar('updateEvent', event);
						$.ajax({
							url: carpeta+'agregar_inspectores_al_evento.php',
							dataType: 'JSON',
							type: 'POST',
							data: {
								// our hypothetical feed requires UNIX timestamps
								inspectores_evento : inspectores_evento,
								actividades_evento : actividades_evento,
								id: event.id
							},
							complete: function() {       
								refrescar_calendario();
							}
						});
					}
				}
			});
		},
		events: function(start, end, timezone, callback) {
			var verificando_grupo = '';
			if($("#grupo_usuario_actual").val()==3){
				verificando_grupo = $("#select_calendario_grupos").val();
			}else{
				verificando_grupo = $("#grupo_usuario_actual").val();
			}
			$.ajax({
				url: carpeta+'eventos.php',
				dataType: 'JSON',
				data: {
					// our hypothetical feed requires UNIX timestamps
					mes: $('#calendar').fullCalendar('getDate').format("MM"),
					ano: $('#calendar').fullCalendar('getDate').format("YYYY"),
					id: verificando_grupo
				},
				success: function(eventos) {
					callback(eventos);
				}
			});
		},
		eventRender: function(event, element)
		{ 
			event.title = event.title.replace(/\\n/g,"\n");
			element.find('.fc-time').append(' <strong>'+ event.sector+'('+ event.cantidad_inspectores +')</strong>'); 
			
			//Agregando a los inspectores a simple vista de la actividad
			var inspectores_del_evento = event.inspectores;
			element.find('.fc-title').html('');
			element.find('.fc-title').append(' <ul>');
			var es_conductor = '';
			for(var x=0;x<inspectores_del_evento.length;x++){
				if(inspectores_del_evento[x].conductor=='SI'){
					es_conductor = '(Conductor)';
				}else{
					es_conductor = '';
				}
				element.find('.fc-title').append(' <li type="circle"><strong>'+inspectores_del_evento[x].nombre+' '+es_conductor+'</strong></li>');
			}
			element.find('.fc-title').append(' </ul>');
			
			
			//Agregando las actividades a simple vista del evento
			var actividades_del_evento = event.actividades;
			element.find('.fc-title').append('<br><strong>Actividades : ');
			for(var x=0;x<actividades_del_evento.length;x++){
				if((x+1)==actividades_del_evento.length){
					element.find('.fc-title').append(actividades_del_evento[x].nombre+'.');
				}else{
					element.find('.fc-title').append(actividades_del_evento[x].nombre+',');
				}
			}
			element.find('.fc-title').append('</strong>');
			
			
			
			
			var evento = event;
			//Eliminar el evento
			element.bind('mousedown', function (e) {
				document.oncontextmenu = function(){return false}
				if (e.which == 3) {
					//alert('Right mouse button pressed');
					/*var fecha_actual = $.ajax({
											url: carpeta+'mostrar_fecha.php',
											type:'post',
											async:false    		
										}).responseText;
					if(moment(fecha_actual).format("DD-MM-YYYY")<=moment(event._start._i).format("DD-MM-YYYY")){
						
					}else{
						bootbox.alert("No Puede eliminar días pasados.");
						return false;
					}*/
					var vector_actividades = evento.actividades;
					var listado_actividades = '';
					for(var x=0;x<vector_actividades.length;x++){
						if(vector_actividades.length==(x+1)){
							listado_actividades += vector_actividades[x].nombre+'.';
						}else{
							listado_actividades += vector_actividades[x].nombre+', ';
						}
					}
					bootbox.confirm({
						title: 'Eliminar Evento',
						message: '¿Está seguro que desea eliminar el siguiente evento?'
								 +'<br>Actividad : '+listado_actividades
								 +'<br>Sector : '+evento.sector
								 +'<br>Horario : '+dia_de_la_semana(moment(event._start._i).format("d"))+' '+moment(event._start._i).format("HH:mm:ss")+' - '+moment(event._end._i).format("HH:mm:ss"),
						buttons: {
							cancel: {
								label: '<i class="fa fa-times"></i> Cancelar'
							},
							confirm: {
								label: '<i class="fa fa-check"></i> Eliminar'
							}
						},
						callback: function (result) {
							if(result==true){
								$.ajax({
									url: carpeta+'eliminar_evento.php',
									dataType: 'JSON',
									data: {
										// our hypothetical feed requires UNIX timestamps
										id: evento.id
									},
									complete: function() {       
										refrescar_calendario();
									}
								});
							}
						}
					});
				}
			});
		}
	});
	// build the locale selector's options
	/*$.each($.fullCalendar.locales, function(localeCode) {
		$('#locale-selector').append(
			$('<option/>')
				.attr('value', localeCode)
				.prop('selected', localeCode == initialLocaleCode)
				.text(localeCode)
		);
	});*/

	// when the selected option changes, dynamically change the calendar option
	/*$('#locale-selector').on('change', function() {
		if (this.value) {
			$('#calendar').fullCalendar('option', 'locale', this.value);
		}
	});*/
	function refrescar_calendario(){
		$('#calendar').fullCalendar('removeEvents' );
		$('#calendar').fullCalendar('refetchEvents' );
	}
	$("#btn_agregar_inspector").click(function(){
		objeto_inspectores.iniciar();
	});
	$("#btn_agregar_sector").click(function(){
		objeto_sectores.iniciar();
	});
	$("#btn_agregar_materia").click(function(){
		objeto_materias.iniciar();
	});
	$("#btn_ver_horas_de_trabajo").click(function(){
		objeto_horas_extras.mostrar();
	});
	$("#btn_ver_horas_de_trabajo_por_sector").click(function(){
		objeto_horas_sector.mostrar();
	});
	$("#btn_ver_horas_de_trabajo_por_materia").click(function(){
		objeto_horas_materia.mostrar();
	});
	
	
	var grupos_para_combobox = objeto_grupo.devolver();
	var combobox_grupos_calendario = '';
	if($("#grupo_usuario_actual").val()==3){
		combobox_grupos_calendario += '<option value="">Todos los grupos</option>';
	}
	for(var x=0;x<grupos_para_combobox.length;x++){
		combobox_grupos_calendario += '<option value="'+grupos_para_combobox[x].id+'">'+grupos_para_combobox[x].nombre+'</option>';
	}
	$("#select_calendario_grupos").html(combobox_grupos_calendario);
});
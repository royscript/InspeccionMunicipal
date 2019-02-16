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
		customButtons: {//comienzan los botones superiores izquierdos
			refrescar: {
				text: 'Refrescar',
				click: function() {
					refrescar_calendario();
				}
			}
		},
		header: {
			left: 'prev,next today refrescar',
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
			var inspectores = objeto_inspectores.devolver();
			var actividades = $.ajax({
						url: carpeta+'mostrar_actividades.php',
						type:'post',
						dataType:'json',
						async:false    		
					}).responseText;
			actividades = JSON.parse(actividades);
			
			
			
			grilla_inspectores.iniciar(event.inspectores);
			setTimeout(function(){ 
				grilla_inspectores.dibujar_sin_eliminar();
			}, 1500);
			
			
			grilla_actividades.iniciar(event.actividades);
			setTimeout(function(){ 
				grilla_actividades.dibujar_sin_eliminar();
			}, 1500);
			bootbox.alert({
				title: "Sector : "+event.sector+'('+dia_de_la_semana(moment(event._start._i).format("d"))+' '+moment(event._start._i).format("HH:mm:ss")+' - '+moment(event._end._i).format("HH:mm:ss")+')<br> Grupo: '+event.nombre_grupo+'.',
				message: "Inspectores <strong>(recomendados "+event.cantidad_inspectores+")</strong> <br> "
						 +'<br>'
						 +'<table class="table">'
							+'<tr>'
								+'<th>Nombre</th>'
								+'<th>Conductor</th>'
							+'</tr>'
							+'<tbody id="grilla_inspectores">'
							+'<tr>'
							+'<td rowspan="3"><p><img src="../fotos/cargando-loading-027.gif"> Cargando...</p></td>'
							+'</tr>'
							+'</tbody>'
						 +'</table><br>'
						 //----------tabla actividades
						 +"<strong>Actividades</strong> <br> "
						 +'<br>'
						 +'<table class="table">'
							+'<tr>'
								+'<th>Nombre</th>'
							+'</tr>'
							+'<tbody id="grilla_actividades">'
							+'<tr>'
							+'<td rowspan="2"><p><img src="../fotos/cargando-loading-027.gif"> Cargando...</p></td>'
							+'</tr>'
							+'</tbody>'
						 +'</table>'
			});
		},
		events: function(start, end, timezone, callback) {
			$.ajax({
				url: carpeta+'eventos.php',
				dataType: 'JSON',
				data: {
					// our hypothetical feed requires UNIX timestamps
					mes: $('#calendar').fullCalendar('getDate').format("MM"),
					ano: $('#calendar').fullCalendar('getDate').format("YYYY"),
					id: $("#select_calendario_grupos").val()
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
	combobox_grupos_calendario += '<option value="">Todos los grupos</option>';
	for(var x=0;x<grupos_para_combobox.length;x++){
		combobox_grupos_calendario += '<option value="'+grupos_para_combobox[x].id+'">'+grupos_para_combobox[x].nombre+'</option>';
	}
	$("#select_calendario_grupos").html(combobox_grupos_calendario);
});
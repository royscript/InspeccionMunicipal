//-----------------Pseudo Clase Horas Dedicadas a una Materia--------------------------
function Horas_materia(){
	var carpeta = '../controlador/calendario/';
	this.mostrar = function(){
		var mes = $('#calendar').fullCalendar('getDate').format("MM");
		var ano = $('#calendar').fullCalendar('getDate').format("YYYY");
		$.ajax({
			url: carpeta+ 'horas_dedicadas_a_una_materia.php',
			dataType: 'JSON',
			data: {
				// our hypothetical feed requires UNIX timestamps
				mes: mes,
				ano: ano
			},
			success: function(datos) { 
				var html = '';
				for(var x=0;x<datos.length;x++){
					var horas = datos[x].horas;
					if(horas ==null){
						horas = 0;
					}
					html += '<tr>'
					html += 	'<td>'+datos[x].nombre+'</td>'
					html += 	'<td>'+horas+'</td>'
					html += '</tr>'
				}
				moment.lang("es");
				var dialog = bootbox.dialog({
					title: 'Mostrar Horas Trabajadas a una Actividad <strong>'+$('#calendar').fullCalendar('getDate').format("MMMM")+' del '+ano+'</strong>',
					message: '<table class="table">'
								+'<tr>'
									+'<th>Actividad</th>'
									+'<th>Horas</th>'
								+'</tr>'
								+html
							+'</table>'
				});
			},
			complete: function(){
				
			}
		});
	}
}
var objeto_horas_materia = new Horas_materia();
//-----------------/Pseudo Clase Horas Dedicadas a una Materia--------------------------
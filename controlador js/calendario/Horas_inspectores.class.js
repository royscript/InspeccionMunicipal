//-----------------Pseudo Clase Horas Extras--------------------------
function Horas_inspectores(){
	var carpeta = '../controlador/calendario/';
	this.mostrar = function(){
		var mes = $('#calendar').fullCalendar('getDate').format("MM");
		var ano = $('#calendar').fullCalendar('getDate').format("YYYY");
		$.ajax({
			url: carpeta+ 'horas_trabajadas_inspectores.php',
			dataType: 'JSON',
			data: {
				// our hypothetical feed requires UNIX timestamps
				mes: mes,
				ano: ano
			},
			success: function(datos) { 
				var html = '';
				for(var x=0;x<datos.length;x++){
					var horas_diurnas = datos[x].horas_diurnas;
					if(horas_diurnas ==null){
						horas_diurnas = 0;
					}
					var horas_festivas = datos[x].horas_festivas;
					if(horas_festivas ==null){
						horas_festivas = 0;
					}
					html += '<tr>'
					html += 	'<td>'+datos[x].nombre+'</td>'
					html += 	'<td>'+horas_diurnas+'</td>'
					html += 	'<td>'+horas_festivas+'</td>'
					html += '</tr>'
				}
				moment.lang("es");
				var dialog = bootbox.dialog({
					title: 'Mostrar Horas Trabajadas Por Los Inspectores <strong>'+$('#calendar').fullCalendar('getDate').format("MMMM")+' del '+ano+'</strong>',
					message: '<table class="table">'
								+'<tr>'
									+'<th>Empleado</th>'
									+'<th>Horas Diurnas</th>'
									+'<th>Horas Festivas</th>'
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
var objeto_horas_extras = new Horas_inspectores();
//-----------------/Pseudo Clase Horas Extras--------------------------
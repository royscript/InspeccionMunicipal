//-----------------Pseudo Clase Horas Dedicadas a un sector--------------------------
function Horas_sector(){
	var carpeta = '../controlador/calendario/';
	this.mostrar = function(){
		var mes = $('#calendar').fullCalendar('getDate').format("MM");
		var ano = $('#calendar').fullCalendar('getDate').format("YYYY");
		$.ajax({
			url: carpeta+ 'horas_dedicadas_a_un_sector.php',
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
					title: 'Mostrar Horas Trabajadas Por Sectores <strong>'+$('#calendar').fullCalendar('getDate').format("MMMM")+' del '+ano+'</strong>',
					message: '<table class="table">'
								+'<tr>'
									+'<th>Sector</th>'
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
var objeto_horas_sector = new Horas_sector();
//-----------------/Pseudo Clase Horas Dedicadas a un sector--------------------------
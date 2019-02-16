/*----------Código Generado por --------------*/
/*-- Fecha : 22/11/2016 21:47:53--*/
/*-- Autores : Roy Alex Standen Barraza - Edson Carrasco Gonzales--*/
/*-- Contacto : roystandenb@gmail.com / edsoncarrascogonzalez@gmail.com --*/
function checklist(){
	var carpeta = '../controlador/';
	this.dibujar_formulario = function(){
		$.ajax({
			url: carpeta+ 'respuestas_checklist.php?accion=mostrar_cuestionario',
			dataType: 'JSON',
			data: {
				// our hypothetical feed requires UNIX timestamps
				id_operativo: $("#buscar_operativo").val()
			},
			success: function(datos) { 
				var html = '<table width="100%" border="1">'
							  +'<tr>'
								+'<td colspan="3"><strong>Respuesta</strong></td>'
								+'<td width="42%"><strong>Pregunta</strong></td>'
								+'<td width="41%"><strong>Disposición Legal</strong></td>'
							  +'</tr>'; 
				for(var x=0;x<datos.length;x++){
					$("#id_operativo").val(datos[x].ID_OPERATIVO);
					html += '<tr>'
								+'<td width="5%">'
											+'<input type="radio" name="respuesta_'+datos[x].ID_PREGUNTAS_CHECKLIST+'" id="SI" value="SI">'
											+'<label for="respuesta_'+datos[x].ID_PREGUNTAS_CHECKLIST+'">Si: </label>'
								+'</td>'
								+'<td width="6%">'
											+'<input type="radio" name="respuesta_'+datos[x].ID_PREGUNTAS_CHECKLIST+'" id="NO" value="NO">'
											+'<label for="respuesta_'+datos[x].ID_PREGUNTAS_CHECKLIST+'">No: </label>'
								+'</td>'
								+'<td width="6%">'
											+'<input type="radio" name="respuesta_'+datos[x].ID_PREGUNTAS_CHECKLIST+'" id="NA" value="N/A">'
											+'<label for="respuesta_'+datos[x].ID_PREGUNTAS_CHECKLIST+'">N/A: </label>'
								+'</td>'
								+'<td>'+datos[x].CONTENIDO_PREGUNTAS_CHECKLIST+'</td>'
								+'<td>'+datos[x].REFERENCIA_LEGAL_PREGUNTAS_CHECKLIST+'</td>';
					html += '</tr>'
				}
				html += '</table>';
				html += '<br>'
				html += '<br>'
				html += '<button id="procesar_encuesta">Guardar Checklist</button>'
				$("#preguntas_y_respuestas").html(html);
			},
			complete: function(){
				
			}
		});
	}
	this.buscar_empresa = function(rut){
		$.ajax({
			url: carpeta+ 'respuestas_checklist.php',
			dataType: 'JSON',
			data: {
				// our hypothetical feed requires UNIX timestamps
				rut: rut,
				accion : 'buscar_empresa'
			},
			success: function(datos) { 
				for(var x=0;x<datos.length;x++){
					$("#txt_nombre").val(datos[x].NOMBRE);
					$("#txt_nombre_administrador").val(datos[x].NOMBRE_ADMINISTRADOR);
					$("#txt_nombre_de_fantasia").val(datos[x].NOMBRE_FANTASIA);
					$("#id_empresa").val(datos[x].ID);
				}
			},
			complete: function(){
				
			}
		});
	}
}
var objeto = new checklist();
$(document).ready(function () {
	$("#btn_buscar").click(function(){
		objeto.dibujar_formulario();
	});
	$("#txt_rut_empresa").blur(function(){
		objeto.buscar_empresa($("#txt_rut_empresa").val());
	});
	//---autocompletar motivo
	 var cache = {};
	$( "#txt_rut_empresa" ).autocomplete({
	  minLength: 2,
	  source: function( request, response ) {
		var term = request.term;
		if ( term in cache ) {
		  response( cache[ term ] );
		  return;
		}
 
		$.getJSON( carpeta+'respuestas_checklist.php?accion=autocompletar_rut_empresa', request, function( data, status, xhr ) {
		  cache[ term ] = data;
		  response( data );
		});
	  }
	});
	//---Autocompletar rut
});
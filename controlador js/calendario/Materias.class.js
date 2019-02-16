//------------------Pseudo Clase Materia--------------------------
function Materias(){
	var materias = new Array();
	var objeto_actual = this;
	var carpeta = '../controlador/calendario/';
	this.iniciar = function(){
		materias.length = 0;
		$.ajax({
			url: carpeta+ 'mostrar_materias.php',
			dataType: 'JSON',
			success: function(datos) { 
				for(var x=0;x<datos.length;x++){      
					materias.push({id : datos[x].id,nombre : datos[x].nombre});
				}
			}
		});
		setTimeout(function(){
			objeto_actual.dibujar();
		},1500);
		var dialog = bootbox.dialog({
			title: 'Agregar Actividades',
			message: '<div class="form-group">'
						+'<label for="exampleInputEmail1">Nombre</label>'
						+'<input type="text" class="form-control" id="txt_nombre_materia" placeholder="Ej: Feria de Productos Usados">'
					  +'</div>'
					  +'<div class="form-group">'
						+'<button type="button" onclick="objeto_materias.agregar();" class="btn btn-default">Agregar</button>'
					  +'</div>'
					  +'<table class="table">'
						+'<tr>'
							+'<th>Nombre</th>'
							+'<th>Eliminar</th>'
						+'</tr>'
						+'<tbody id="grilla_agregar_materias">'
						+'<tr>'
							+'<td rowspan="2"><p><img src="../fotos/cargando-loading-027.gif"> Cargando...</p></td>'
						+'</tr>'
						+'</tbody>'
					 +'</table>',
				callback: function (result) {
					materias_para_combobox.length = 0;
					materias_para_combobox = objeto_actual.devolver();
				}
		});
	}
	this.agregar = function(){
		var nombre = $("#txt_nombre_materia").val();
		if(nombre==''){
			alert("Necesitas agregar el nombre de la materia!");
			return false;
			
		}
		for(var x=0;x<materias.length;x++){
			if(materias[x].nombre==nombre){
				bootbox.alert("<strong>No puedes agregar 2 veces el nombre de la misma materia.</strong>");
				return false;
			}
		}
		$.ajax({
			url: carpeta+ 'agregar_materia.php',
			dataType: 'JSON',
			data: {
				// our hypothetical feed requires UNIX timestamps
				nombre: nombre
			},
			success: function(datos) {       
				materias.push({id : datos[0].id,nombre : datos[0].nombre});
				objeto_actual.dibujar();
			},
			complete: function(){
				$("#txt_nombre_materia").val('');
			}
		});
	}
	this.dibujar = function(){
		var html = '';
		for(var x=0;x<materias.length;x++){
			html += '<tr>'
						+'<td>'+materias[x].nombre+'</td>'
						+'<td><button onclick="objeto_materias.eliminar('+materias[x].id+');"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button></td>'
					+'</tr>';
		}
		$("#grilla_agregar_materias").html(html);
	}
	this.eliminar = function(id){
		bootbox.confirm({
			title: "Eliminar",
			message: '¿Desea eliminar este sector del listado?',
			buttons: {
				cancel: {
					label: '<i class="fa fa-times"></i> No'
				},
				confirm: {
					label: '<i class="fa fa-check"></i> Si'
				}
			},
			callback: function (result) {
				if(result==true){
					for(var x=0;x<materias.length;x++){
						if(materias[x].id==id){
							var id_eliminar = id;
							$.ajax({
								url: carpeta+ 'eliminar_materia.php',
								dataType: 'JSON',
								data: {
									// our hypothetical feed requires UNIX timestamps
									id: id_eliminar
								}
							});
							materias.splice(x,1);
						}
					}
					objeto_actual.dibujar();	
				}
			}
		});
	}
	this.devolver = function(){
		var materias = $.ajax({
						url: carpeta+'mostrar_materias.php',
						type:'post',
						dataType:'json',
						async:false    		
					}).responseText;
		materias = JSON.parse(materias);
		return materias;
	}
}
var materias_para_combobox = new Array();
var objeto_materias = new Materias();
//-----------------/Pseudo Clase Materia--------------------------
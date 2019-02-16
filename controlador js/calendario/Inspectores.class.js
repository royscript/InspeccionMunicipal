//------------------Pseudo Clase Inspectores--------------------------
function Inspectores(){
	var inspectores = new Array();
	var objeto_actual = this;
	var carpeta = '../controlador/calendario/';
	this.iniciar = function(){
		inspectores.length = 0;
		$.ajax({
			url: carpeta+ 'mostrar_inspectores.php',
			dataType: 'JSON',
			success: function(datos) { 
				for(var x=0;x<datos.length;x++){      
					inspectores.push({id : datos[x].id,nombre : datos[x].nombre,rut : datos[x].rut});
				}
			}
		});
		setTimeout(function(){
			objeto_actual.dibujar();
		},1500);
		var dialog = bootbox.dialog({
			title: 'Agregar Inspectores',
			message: '<div class="form-group">'
						+'<label for="exampleInputEmail1">Nombre</label>'
						+'<input type="text" class="form-control" id="txt_nombre_inspector" placeholder="Ej: Roy Standen">'
					  +'</div>'
					  +'<div class="form-group">'
						+'<label for="exampleInputEmail1">Rut</label>'
						+'<input type="text" class="form-control" id="txt_rut_inspector" placeholder="Ej: 16.428.927-3">'
					  +'</div>'
					  +'<div class="form-group">'
						+'<button type="button" onclick="objeto_inspectores.agregar();" class="btn btn-default">Agregar</button>'
					  +'</div>'
					  +'<table class="table">'
						+'<tr>'
							+'<th>Nombre</th>'
							+'<th>Rut</th>'
							+'<th>Eliminar</th>'
						+'</tr>'
						+'<tbody id="grilla_agregar_inspectores">'
						+'<tr>'
							+'<td rowspan="3"><p><img src="../fotos/cargando-loading-027.gif"> Cargando...</p></td>'
						+'</tr>'
						+'</tbody>'
					 +'</table>',
				callback: function (result) {
					inspectores_para_combobox.length = 0;
					inspectores_para_combobox = objeto_actual.devolver();
				}
		});
	}
	this.agregar = function(){
		var nombre = $("#txt_nombre_inspector").val();
		var rut = $("#txt_rut_inspector").val();
		if(nombre=='' || rut==''){
			alert("Para agregar el inspector es necesario el rut y el nombre");
			return false;
			
		}
		for(var x=0;x<inspectores.length;x++){
			if(inspectores[x].rut==rut){
				bootbox.alert("<strong>No puedes agregar 2 veces el nombre el mismo inspector.</strong>");
				return false;
			}
		}
		$.ajax({
			url: carpeta+ 'agregar_inspector.php',
			dataType: 'JSON',
			data: {
				// our hypothetical feed requires UNIX timestamps
				nombre: nombre,
				rut: rut
			},
			success: function(datos) {       
				inspectores.push({id : datos[0].id,nombre : datos[0].nombre,rut : datos[0].rut});
				objeto_actual.dibujar();
			},
			complete: function(){
				$("#txt_nombre_inspector").val('');
				$("#txt_rut_inspector").val('');
			}
		});
	}
	this.dibujar = function(){
		var html = '';
		for(var x=0;x<inspectores.length;x++){
			html += '<tr>'
						+'<td>'+inspectores[x].nombre+'</td>'
						+'<td>'+inspectores[x].rut+'</td>'
						+'<td><button onclick="objeto_inspectores.eliminar('+inspectores[x].id+');"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button></td>'
					+'</tr>';
		}
		$("#grilla_agregar_inspectores").html(html);
	}
	this.eliminar = function(id){
		bootbox.confirm({
			title: "Eliminar",
			message: '¿Desea eliminar este inspector del listado?',
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
					for(var x=0;x<inspectores.length;x++){
						if(inspectores[x].id==id){
							var id_eliminar = id;
							$.ajax({
								url: carpeta+ 'eliminar_inspector.php',
								dataType: 'JSON',
								data: {
									// our hypothetical feed requires UNIX timestamps
									id: id_eliminar
								}
							});
							inspectores.splice(x,1);
						}
					}
					objeto_actual.dibujar();	
				}
			}
		});
	}
	this.devolver = function(){
		var inspectores = $.ajax({
						url: carpeta+'mostrar_inspectores.php',
						type:'post',
						dataType:'json',
						async:false    		
					}).responseText;
		inspectores = JSON.parse(inspectores);
		return inspectores;
	}
}
var inspectores_para_combobox = new Array();
var objeto_inspectores = new Inspectores();
//-----------------/Pseudo Clase Inspectores--------------------------
//------------------Pseudo Clase Sectores--------------------------
function Sectores(){
	var sectores = new Array();
	var objeto_actual = this;
	var carpeta = '../controlador/calendario/';
	this.iniciar = function(){
		sectores.length = 0;
		$.ajax({
			url: carpeta+ 'mostrar_sectores.php',
			dataType: 'JSON',
			success: function(datos) { 
				for(var x=0;x<datos.length;x++){      
					sectores.push({id : datos[x].id,nombre : datos[x].nombre});
				}
			}
		});
		setTimeout(function(){
			objeto_actual.dibujar();
		},1500);
		var dialog = bootbox.dialog({
			title: 'Agregar Sectores',
			message: '<div class="form-group">'
						+'<label for="exampleInputEmail1">Nombre</label>'
						+'<input type="text" class="form-control" id="txt_nombre_sector" placeholder="Ej: Tierras Blancas">'
					  +'</div>'
					  +'<div class="form-group">'
						+'<button type="button" onclick="objeto_sectores.agregar();" class="btn btn-default">Agregar</button>'
					  +'</div>'
					  +'<table class="table">'
						+'<tr>'
							+'<th>Nombre</th>'
							+'<th>Eliminar</th>'
						+'</tr>'
						+'<tbody id="grilla_agregar_sectores">'
						+'<tr>'
							+'<td rowspan="2"><p><img src="../fotos/cargando-loading-027.gif"> Cargando...</p></td>'
						+'</tr>'
						+'</tbody>'
					 +'</table>',
				callback: function (result) {
					sectores_para_combobox.length = 0;
					sectores_para_combobox = objeto_actual.devolver();
				}
		});
	}
	this.agregar = function(){
		var nombre = $("#txt_nombre_sector").val();
		if(nombre==''){
			alert("Para agregar el nombre del sector");
			return false;
			
		}
		for(var x=0;x<sectores.length;x++){
			if(sectores[x].nombre==nombre){
				bootbox.alert("<strong>No puedes agregar 2 veces el nombre el mismo sector.</strong>");
				return false;
			}
		}
		$.ajax({
			url: carpeta+ 'agregar_sector.php',
			dataType: 'JSON',
			data: {
				// our hypothetical feed requires UNIX timestamps
				nombre: nombre
			},
			success: function(datos) {       
				sectores.push({id : datos[0].id,nombre : datos[0].nombre});
				objeto_actual.dibujar();
			},
			complete: function(){
				$("#txt_nombre_sector").val('');
			}
		});
	}
	this.dibujar = function(){
		var html = '';
		for(var x=0;x<sectores.length;x++){
			html += '<tr>'
						+'<td>'+sectores[x].nombre+'</td>'
						+'<td><button onclick="objeto_sectores.eliminar('+sectores[x].id+');"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button></td>'
					+'</tr>';
		}
		$("#grilla_agregar_sectores").html(html);
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
					for(var x=0;x<sectores.length;x++){
						if(sectores[x].id==id){
							var id_eliminar = id;
							$.ajax({
								url: carpeta+ 'eliminar_sector.php',
								dataType: 'JSON',
								data: {
									// our hypothetical feed requires UNIX timestamps
									id: id_eliminar
								}
							});
							sectores.splice(x,1);
						}
					}
					objeto_actual.dibujar();	
				}
			}
		});
	}
	this.devolver = function(){
		var sectores = $.ajax({
						url: carpeta+'mostrar_sectores.php',
						type:'post',
						dataType:'json',
						async:false    		
					}).responseText;
		sectores = JSON.parse(sectores);
		return sectores;
	}
}
var sectores_para_combobox = new Array();
var objeto_sectores = new Sectores();
//-----------------/Pseudo Clase Sectores--------------------------
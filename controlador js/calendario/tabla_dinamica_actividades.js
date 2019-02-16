//------------------Pseudo Clase tabla dinamica actividades--------------------------
function tabla_dinamica_actividades(){
	var actividades = new Array();
	this.iniciar = function(json){
		if(json.length==0){
			actividades.length = 0;
		}else{
			actividades = json;
		}
	}
	this.agregar = function(){
		var id = $("#seleccionar_actividad option:selected").val();
		var nombre = $("#seleccionar_actividad option:selected").text();
		for(var x=0;x<actividades.length;x++){
			if(actividades[x].id==id){
				bootbox.alert("<strong>No puedes agregar 2 veces la misma actividad a un evento.</strong>");
				return false;
			}
		}
		actividades.push({id : id,nombre : nombre});
		this.dibujar();
	}
	this.dibujar_sin_eliminar = function(){
		var html = '';
		var es_conductor = '';
		for(var x=0;x<actividades.length;x++){
			html += '<tr>'
						+'<td>'+actividades[x].nombre+'</td>'
					+'</tr>';
		}
		$("#grilla_actividades").html(html);
	}
	this.dibujar = function(){
		var html = '';
		for(var x=0;x<actividades.length;x++){
			html += '<tr>'
						+'<td>'+actividades[x].nombre+'</td>'
						+'<td><button onclick="grilla_actividades.eliminar('+actividades[x].id+');"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button></td>'
					+'</tr>';
		}
		$("#grilla_actividades").html(html);
	}
	this.eliminar = function(id){
		bootbox.confirm({
			title: "Eliminar",
			message: '¿Desea eliminar esta actividad del listado?',
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
					for(var x=0;x<actividades.length;x++){
						if(actividades[x].id==id){
							actividades.splice(x,1);
						}
					}
					grilla_actividades.dibujar();	
				}
			}
		});
	}
	this.devolver = function(){
		return actividades;
	}
}
var grilla_actividades = new tabla_dinamica_actividades();
//-----------------/Pseudo Clase tabla dinamica actividades--------------------------
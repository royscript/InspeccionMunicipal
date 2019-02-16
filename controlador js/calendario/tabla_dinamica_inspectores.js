//------------------Pseudo Clase tabla dinamica inspectores--------------------------
function tabla_dinamica_inspectores(){
	var inspectores = new Array();
	this.iniciar = function(json){
		if(json.length==0){
			inspectores.length = 0;
		}else{
			inspectores = json;
		}
	}
	this.agregar = function(){
		var id = $("#seleccionar_inspector option:selected").val();
		var nombre = $("#seleccionar_inspector option:selected").text();
		var conductor = $('input:radio[name=conductor]:checked').val();
		for(var x=0;x<inspectores.length;x++){
			if(inspectores[x].id==id){
				bootbox.alert("<strong>No puedes agregar 2 veces el nombre el mismo inspector a un evento.</strong>");
				return false;
			}
		}
		inspectores.push({id : id,nombre : nombre, conductor: conductor});
		this.dibujar();
	}
	this.dibujar_sin_eliminar = function(){
		var html = '';
		var es_conductor = '';
		for(var x=0;x<inspectores.length;x++){
			if(inspectores[x].conductor=='SI'){
				es_conductor = '<strong>SI</strong>';
			}else{
				es_conductor = '';
			}
			html += '<tr>'
						+'<td>'+inspectores[x].nombre+'</td>'
						+'<td>'+es_conductor+'</td>'
					+'</tr>';
		}
		$("#grilla_inspectores").html(html);
	}
	this.dibujar = function(){
		var html = '';
		var es_conductor = '';
		for(var x=0;x<inspectores.length;x++){
			if(inspectores[x].conductor=='SI'){
				es_conductor = '<strong>SI</strong>';
			}else{
				es_conductor = '';
			}
			html += '<tr>'
						+'<td>'+inspectores[x].nombre+'</td>'
						+'<td>'+es_conductor+'</td>'
						+'<td><button onclick="grilla_inspectores.eliminar('+inspectores[x].id+');"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button></td>'
					+'</tr>';
		}
		$("#grilla_inspectores").html(html);
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
							inspectores.splice(x,1);
						}
					}
					grilla_inspectores.dibujar();	
				}
			}
		});
	}
	this.devolver = function(){
		return inspectores;
	}
}
var grilla_inspectores = new tabla_dinamica_inspectores();
//-----------------/Pseudo Clase tabla dinamica inspectores--------------------------
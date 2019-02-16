//-----------------Pseudo Clase Grupo--------------------------
function Grupo(){
	var carpeta = '../controlador/calendario/';
	this.devolver = function(){
		var materias = $.ajax({
						url: carpeta+'mostrar_grupos.php?modificar='+$("#modificar").val()+'&grupo='+$("#grupo_usuario_actual").val(),
						type:'post',
						dataType:'json',
						async:false    		
					}).responseText;
		materias = JSON.parse(materias);
		return materias;
	}
}
var objeto_grupo = new Grupo();
//-----------------/Pseudo Clase Grupo--------------------------
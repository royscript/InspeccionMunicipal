<!DOCTYPE html>
<html>
  <head>
  	<script src='plugins/jquery-ui-1.10.3/jquery-1.9.1.js'></script>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Simple markers</title>
    <style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 100%;
      }
	  #floating-panel {
  position: absolute;
  top: 10px;
  left: 45%;
  z-index: 5;
  background-color: #fff;
  padding: 5px;
  border: 1px solid #999;
  text-align: center;
  font-family: 'Roboto','sans-serif';
  line-height: 30px;
  padding-left: 10px;
}
    </style>
  </head>
  <body>
  	<select name="operativo" id="operativo" style="display:none;">
  	  <option value="1">OPERATIVO DE LOCALES CON EXPENDIO DE BEBIDAS ALCOHOLICAS</option> 
    	
    </select><!--<button onClick="marcar_empresas()" id="boton_mostrar">Mostrar</button>
    <button onClick="geolocalizar_usuario()" id="boton_mostrar">Ver mi posición</button>
    <button onClick="limpiar()">Limpiar</button>-->
    <div id="floating-panel">
      <input onclick="ver_donde_estoy();" type=button value="Donde Estoy?">
    </div>
    <div id="map"></div>
    <div id="prueba"></div>
    <script>
var mapa = null;
function initMap(position) {
  var latitud = position.coords.latitude;
  var longitud = position.coords.longitude;
  var myLatLng = {lat: latitud, lng: longitud};

  mapa = new google.maps.Map(document.getElementById('map'), {
    zoom: 16,
    center: myLatLng
  });
  
  marcar_empresas();
  geolocalizar_usuario();
}
var sitios_localizados = new Array();
function marcar_empresas(){
	var empresas = $.ajax({
						url: 'controlador/mapa_empresas.php?id_operativo='+$("#operativo").val(),
						type:'post',
						dataType:'json',
						async:false    		
					}).responseText;
	empresas = JSON.parse(empresas);
	sitios_localizados = empresas;
	for(var x=0;x<empresas.length;x++){
		var contenido = '<div id="content">'+
								  '<div id="siteNotice">'+
								  '</div>'+
								  '<h1 id="firstHeading" class="firstHeading">'+empresas[x].nombre+'</h1>'+
								  '<div id="bodyContent">'+
								  '<br><strong>Dirección :</strong>'+empresas[x].direccion+
								  '<br><strong>Giro :</strong>'+empresas[x].giro+
								  '<br><strong>Rut :</strong>'+empresas[x].rut+
								  '<br><strong>Rol :</strong>'+empresas[x].rol+
								  '</div>'+
							 '</div>';
		
		

		var marcador = new google.maps.Marker({
			position: {lat: parseFloat(empresas[x].latitud), lng: parseFloat(empresas[x].longitud)},
			map: mapa,
			title: empresas[x].nombre
		});
		marcador.addListener('click', function() {
			infowindow.open(mapa, marcador);
		});
		
		var infowindow = new google.maps.InfoWindow();
		google.maps.event.addListener(marcador,'click', (function(marcador,contenido,infowindow){ 
			return function() {
				infowindow.setContent(contenido);
				infowindow.open(mapa,marcador);
			};
		})(marcador,contenido,infowindow));
	}
}

function limpiar(){
	navigator.geolocation.getCurrentPosition(initMap);
}



function geolocalizar_usuario(){
	obtener_coordenadas_usuario();
	setInterval(function(){ obtener_coordenadas_usuario(); }, 10000);
}

function obtener_coordenadas_usuario(){
	if(navigator.geolocation){
		navigator.geolocation.getCurrentPosition(function(position) {
				/*var marcador = null;
				//var imagen = '../../core/images/factory_google_maps-con-fondo.png';
				
				var marcador = new google.maps.Marker({
					position: {lat:position.coords.latitude, lng:position.coords.longitude},
					map: mapa,
					title: 'tu'
				});
				marcador.setMap(mapa);*/
			     
				  addMarker({lat:position.coords.latitude, lng:position.coords.longitude});
				$("#prueba").html("Latitud : "+position.coords.latitude+' Longitud : '+position.coords.longitude);
			}, function(objPositionError){
				// Procesar errores
				$("#prueba").html(objPositionError.message);
			}, {
				enableHighAccuracy: true,
				maximumAge: 30000,
				timeout: 27000
			}
		);
	}else{
			// El navegador no soporta la geolicalización
			
	}
}
var posicion_antigua_usuario = new Array();
var latitud_longitud_usuario = new Array();
var es_primera_vez = true;
function addMarker(location) {
	//console.log(posicion_antigua_usuario.length+'>'+0+' = '+posicion_antigua_usuario.length>0);
	//console.log(posicion_antigua_usuario);
  if(es_primera_vez==false){
	posicion_antigua_usuario.setMap(null);
	posicion_antigua_usuario.length = 0;
	$("#prueba").html("Eliminado "+posicion_antigua_usuario);
	//console.log("Eliminando");
  }else{
  	es_primera_vez = false;
  } 
  //console.log(posicion_antigua_usuario);
  var foto = 'fotos/breastfeeding.png';
  var marker = new google.maps.Marker({
    position: location,
    map: mapa,
	icon: foto
  });
  posicion_antigua_usuario = marker; 
  latitud_longitud_usuario = location;
}
function ver_donde_estoy(){
	mapa = new google.maps.Map(document.getElementById('map'), {
      zoom: 16,
      center: latitud_longitud_usuario
    });
	marcar_empresas();
}
    </script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC6jcxwgsbUVE9NdJlb3RANazCCl3BX298&callback=limpiar"></script>
  </body>
</html>
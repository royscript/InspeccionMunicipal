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
    </style>
  </head>
  <body>
  	<input name="giro" id="giro" type="text"> <button onClick="marcar_empresas()">Mostrar</button>
    <button onClick="limpiar()">Limpiar</button>
    <div id="map"></div>
    <script>
var mapa = null;
function initMap(position) {
  var latitud = position.coords.latitude;
  var longitud = position.coords.longitude;
  var myLatLng = {lat: latitud, lng: longitud};

  mapa = new google.maps.Map(document.getElementById('map'), {
    zoom: 14,
    center: myLatLng
  });

}

function marcar_empresas(){
	var empresas = $.ajax({
						url: 'controlador/mapa_empresas.php?giro='+$("#giro").val(),
						type:'post',
						dataType:'json',
						async:false    		
					}).responseText;
	empresas = JSON.parse(empresas);
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
limpiar();
    </script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC6jcxwgsbUVE9NdJlb3RANazCCl3BX298"></script>
  </body>
</html>
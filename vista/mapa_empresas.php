<!DOCTYPE html>
<html>
  <head>
  	<script src='../plugins/jquery-ui-1.10.3/jquery-1.9.1.js'></script>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Simple markers</title>
    <style>
      #map {
    margin: 0;
    padding: 0;
    height: 400px;
    max-width: none;
	height:800px;
}
#map img {
    max-width: none !important;
}


.gm-style-iw {
    width: 350px !important;
    top: 15px !important;
    left: 0px !important;
    background-color: #fff;
    box-shadow: 0 1px 6px rgba(178, 178, 178, 0.6);
    border: 1px solid rgba(72, 181, 233, 0.6);
    border-radius: 2px 2px 10px 10px;
}
#iw-container {
    margin-bottom: 10px;
}
#iw-container .iw-title {
    font-family: 'Open Sans Condensed', sans-serif;
    font-size: 22px;
    font-weight: 400;
    padding: 10px;
    background-color: #48b5e9;
    color: white;
    margin: 0;
    border-radius: 2px 2px 0 0;
}
#iw-container .iw-content {
    font-size: 13px;
    line-height: 18px;
    font-weight: 400;
    margin-right: 1px;
    padding: 15px 5px 20px 15px;
    max-height: 140px;
    overflow-y: auto;
    overflow-x: hidden;
}
.iw-content img {
    float: right;
    margin: 0 5px 5px 10px; 
}
.iw-subTitle {
    font-size: 16px;
    font-weight: 700;
    padding: 5px 0;
}
.iw-bottom-gradient {
    position: absolute;
    width: 326px;
    height: 25px;
    bottom: 10px;
    right: 18px;
    background: linear-gradient(to bottom, rgba(255,255,255,0) 0%, rgba(255,255,255,1) 100%);
    background: -webkit-linear-gradient(top, rgba(255,255,255,0) 0%, rgba(255,255,255,1) 100%);
    background: -moz-linear-gradient(top, rgba(255,255,255,0) 0%, rgba(255,255,255,1) 100%);
    background: -ms-linear-gradient(top, rgba(255,255,255,0) 0%, rgba(255,255,255,1) 100%);
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
  	<select name="tipo_de_locales" id="tipo_de_locales" style="display:none;">
  	  <option value="LOCALES CON EXPENDIO DE BEBIDAS ALCOHOLICAS">LOCALES CON EXPENDIO DE BEBIDAS ALCOHOLICAS</option> 
    	
    </select><!--<button onClick="marcar_empresas()" id="boton_mostrar">Mostrar</button>
    <button onClick="geolocalizar_usuario()" id="boton_mostrar">Ver mi posición</button>
    <button onClick="limpiar()">Limpiar</button>-->
    <div id="floating-panel">
      <input onclick="ver_donde_estoy();" type=button value="Donde Estoy?">
      <input name="buscar_empresa" id="buscar_empresa" type="text">
      <button id="mover_camara">Mover camara</button>
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
						url: '../controlador/mapa_empresas.php?accion=mapa_especial&tipo_de_locales='+$("#tipo_de_locales").val(),
						type:'post',
						dataType:'json',
						async:false    		
					}).responseText;
	empresas = JSON.parse(empresas);
	sitios_localizados = empresas;
	var nombre_empresa = null;
	var nombre_administrador = null;
	var nombre_de_fantasia = null;
	var rut_empresa = null;
	var rut_administrador = null;
	
	var estado = null;
	var fecha = null;
	var rol = null;
	
	var calle = null;
	var detalle = null;
	var estado = null;
	var fecha_registro = null;
	var latitud = null;
	var longitud = null;
	var numero = null;
	var sector = null;
	
	var articulo = null;
	var detalle = null;
	var esta_al_dia = null;
	var fecha = null;
	var ley = null;
	var ordenanza = null;
	
	var contenido = null;
	var id_categoria_empresa = null;
	for(var x=0;x<empresas.length;x++){
		rut_empresa = empresas[x].rut;
		rut_administrador = empresas[x].rut_administrador;
		nombre_empresa = empresas[x].nombre;
		nombre_administrador = empresas[x].nombre_administrador;
		nombre_de_fantasia = empresas[x].nombre_de_fantasia;
		for(var y=0;y<empresas[x].categoria.length;y++){
			estado = empresas[x].categoria[y].estado;
			fecha = empresas[x].categoria[y].fecha_de_ingreso;
			rol = empresas[x].categoria[y].rol;
			id_categoria_empresa = empresas[x].categoria[y].id_categoria_empresa;
			for(var z=0;z<empresas[x].categoria[y].direcciones.length;z++){
				calle = empresas[x].categoria[y].direcciones[z].calle;
				detalle = empresas[x].categoria[y].direcciones[z].detalle;
				estado = empresas[x].categoria[y].direcciones[z].estado;
				fecha_registro = empresas[x].categoria[y].direcciones[z].fecha_registro;
				latitud = empresas[x].categoria[y].direcciones[z].latitud;
				longitud = empresas[x].categoria[y].direcciones[z].longitud;
				numero = empresas[x].categoria[y].direcciones[z].numero;
				sector =empresas[x].categoria[y].direcciones[z].sector;
				if(latitud!=''){
					var infracciones = '<table border="1"  style="width: 100%;border-collapse: collapse;">';
					infracciones += '<tr>';
					infracciones += 	'<th>Ley</th>';
					infracciones += 	'<th>Art.</th>';
					infracciones += 	'<th>Ordenanza</th>';
					infracciones += 	'<th>Al día?</th>';
					infracciones += 	'<th>Fecha</th>';
					infracciones += 	'<th>Detalle</th>';
					infracciones += '</tr>';
					
					var estado = null;
					for(var r=0;r<empresas[x].categoria[y].direcciones[z].estado_legal.length;r++){
						articulo = empresas[x].categoria[y].direcciones[z].estado_legal[r].articulo;
						detalle = empresas[x].categoria[y].direcciones[z].estado_legal[r].detalle;
						esta_al_dia = empresas[x].categoria[y].direcciones[z].estado_legal[r].esta_al_dia;
						fecha = empresas[x].categoria[y].direcciones[z].estado_legal[r].fecha;
						ley = empresas[x].categoria[y].direcciones[z].estado_legal[r].ley;
						ordenanza = empresas[x].categoria[y].direcciones[z].estado_legal[r].ordenanza;
						
						if(r==0){
							estado = esta_al_dia;
						}
						infracciones += '<tr>';
						infracciones += 	'<td>'+ley+'</td>';
						infracciones += 	'<td>'+articulo+'</td>';
						infracciones += 	'<td>'+ordenanza+'</td>';
						infracciones += 	'<td>'+esta_al_dia+'</td>';
						infracciones += 	'<td>'+fecha+'</td>';
						infracciones += 	'<td>'+detalle+'</td>';
						infracciones += '</tr>';
					}
					infracciones += '</tabla>';
					/*contenido = '<div id="content">'+
									  '<div id="siteNotice">'+
									  '</div>'+
									  '<h1 id="firstHeading" class="firstHeading">'+nombre_de_fantasia+'</h1>'+
									  '<div id="bodyContent">'+
									  '<br><strong>Dirección :</strong>'+calle+' '+numero+
									  '<br><strong>Sector :</strong>'+sector+
									  '<br><strong>Patente :</strong>'+rol+' '+estado+
									  '<br><strong>Rut empresa :</strong>'+rut_empresa+
									  '<br><strong>Estado :</strong>'+estado+
									  '</div>'+
								 '</div>';*/
					var contenido = '<div id="iw-container">' +
                    '<div class="iw-title">'+nombre_de_fantasia+'</div>' +
                    '<div class="iw-content">' +
                      '<div class="iw-subTitle">Ubicación</div>' +
                      '<p><strong>Dirección : </strong>'+calle+' '+numero+', '+sector+'</p>' +
					  '<p><strong>Patente : </strong>'+rol+'</p>' +
					  '<p><strong>Rut Empresa : </strong>'+rut_empresa+'</p>' +
					  '<p><strong>Nombre Empresa : </strong>'+nombre_empresa+'</p>' +
					  '<p><strong>Administrador : </strong>'+nombre_administrador+' '+rut_administrador+'</p>' +
                      '<div class="iw-subTitle">Infracciones</div>' +
                      infracciones
                    '</div>' +
                    '<div class="iw-bottom-gradient"></div>' +
                  '</div>';
				    var imagen = null;
					if(id_categoria_empresa>=1 && id_categoria_empresa<=21){
						console.log(id_categoria_empresa+' '+estado);
						if(estado=='AL DÍA'){
							imagen = '../fotos/iconos/vino-verde.png';
						}else if(estado=='INFRINGE'){
							imagen = '../fotos/iconos/vino-rojo.png';
						}else if(estado=='LOCAL CERRADO'){
							imagen = '../fotos/iconos/vino-azul.png';
						}else{
							imagen = '../fotos/iconos/vino-amarillo.png';
						}
					}else{
						console.log(id_categoria_empresa+' '+estado);
						imagen = '../fotos/iconos/vino-verde.png';
					}
					var marcador = new google.maps.Marker({
						position: {lat: parseFloat(latitud), lng: parseFloat(longitud)},
						map: mapa,
						icon: imagen,
						title: nombre_de_fantasia
					});
					marcador.addListener('click', function() {
						infowindow.open(mapa, marcador);
					});
					
					var infowindow = new google.maps.InfoWindow();
					google.maps.event.addListener(marcador,'click', (function(marcador,contenido,infowindow){ 
						return function() {
							infowindow.setContent(contenido);
							infowindow.open(mapa,marcador);
							// Reference to the DIV that wraps the bottom of infowindow
							var iwOuter = $('.gm-style-iw');
						
							/* Since this div is in a position prior to .gm-div style-iw.
							 * We use jQuery and create a iwBackground variable,
							 * and took advantage of the existing reference .gm-style-iw for the previous div with .prev().
							*/
							var iwBackground = iwOuter.prev();
						
							// Removes background shadow DIV
							iwBackground.children(':nth-child(2)').css({'display' : 'none'});
						
							// Removes white background DIV
							iwBackground.children(':nth-child(4)').css({'display' : 'none'});
						
							// Moves the infowindow 115px to the right.
							iwOuter.parent().parent().css({left: '115px'});
						
							// Moves the shadow of the arrow 76px to the left margin.
							iwBackground.children(':nth-child(1)').attr('style', function(i,s){ return s + 'left: 76px !important;'});
						
							// Moves the arrow 76px to the left margin.
							iwBackground.children(':nth-child(3)').attr('style', function(i,s){ return s + 'left: 76px !important;'});
						
							// Changes the desired tail shadow color.
							iwBackground.children(':nth-child(3)').find('div').children().css({'box-shadow': 'rgba(72, 181, 233, 0.6) 0px 1px 6px', 'z-index' : '1'});
						
							// Reference to the div that groups the close button elements.
							var iwCloseBtn = iwOuter.next();
						
							// Apply the desired effect to the close button
							iwCloseBtn.css({opacity: '1', right: '38px', top: '3px', border: '7px solid #48b5e9', 'border-radius': '13px', 'box-shadow': '0 0 5px #3990B9'});
						
							// If the content of infowindow not exceed the set maximum height, then the gradient is removed.
							if($('.iw-content').height() < 140){
							  $('.iw-bottom-gradient').css({display: 'none'});
							}
						
							// The API automatically applies 0.7 opacity to the button after the mouseout event. This function reverses this event to the desired value.
							iwCloseBtn.mouseout(function(){
							  $(this).css({opacity: '1'});
							});
						};
					})(marcador,contenido,infowindow));
				}
			}
		}
		
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
  var foto = '../fotos/breastfeeding.png';
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
function mover_camara(){
	mapa.setCenter({lat : -29.956547333764615, lng: -71.33786827325821});
}
$(document).ready(function() {
    $("#mover_camara").click(function(){
		mover_camara();
	});
	//---autocompletar motivo
	 var cache = {};
	$( "#buscar_empresa" ).autocomplete({
	  minLength: 2,
	  source: function( request, response ) {
		var term = request.term;
		
		if ( term in cache ) {
		  response( cache[ term ] );
		  return;
		}
 
		  var data = [{label : "Roy", latitud: "asdasd", longitud: ""},{label : "Standen", nombres: "123"}];
		  cache[ term ] = data;
		  response( data );
	  },
	  select: function(event, ui) {
        //if(ui.item){
            //$('#vsearch').val(ui.item.value);
        //}
        //$('#search').submit();
		alert(ui.item.nombres);
      }
	});
});

    </script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC6jcxwgsbUVE9NdJlb3RANazCCl3BX298&callback=limpiar"></script>
    <script src="../plugins/jtable-bootstrap/jquery-ui-bootstrap-jquery-ui-bootstrap-71f2e47/js/jquery-ui-1.9.2.custom.min.js" type="text/javascript"></script>
    <link href="../plugins/jtable-bootstrap/jquery-ui-bootstrap-jquery-ui-bootstrap-71f2e47/css/custom-theme/jquery-ui-1.9.2.custom.css" rel="stylesheet" type="text/css" />
  </body>
</html>
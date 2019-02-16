// JavaScript Document
var id;
function soloLetras(e) { 
tecla = (document.all) ? e.keyCode : e.which;
if (tecla==8) return true; 
patron =/[A-Za-zñÑ\sá\é\í\ó\ú]/; 
te = String.fromCharCode(tecla); 
return patron.test(te); 
} 

function soloLetras_y_numeros(e) { 
tecla = (document.all) ? e.keyCode : e.which; 
if (tecla==8) return true; 
patron = /[A-Za-zñÑ\s\w\á\é\í\ó\ú\.\,\;\_\@\%\#\$\&]/;; 

te = String.fromCharCode(tecla); 
return patron.test(te); 
}
//VALIDADOR SOLO NUMEROS CON PUNTOS
function solonumeros(e){
 key = e.keyCode || e.which;
 tecla = String.fromCharCode(key).toLowerCase();
 numeros = "0123456789";
 especiales = [8,37,39,46];

 tecla_especial = false
 for(var i in especiales){
     if(key == especiales[i]){
  		tecla_especial = true;
  		break;
     } 
 }
 if(numeros.indexOf(tecla)==-1 && !tecla_especial)
     return false;
}

function soloNumerosEnteros(evt){
    //Validar la existencia del objeto event
    evt = (evt) ? evt : event;
     
    //Extraer el codigo del caracter de uno de los diferentes grupos de codigos
    var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode : ((evt.which) ? evt.which : 0));
     
    //Predefinir como valido
    var respuesta = true;
     
    //Validar si el codigo corresponde a los NO aceptables
    if (charCode > 31 && (charCode < 48 || charCode > 57)) 
    {
        //Asignar FALSE a la respuesta si es de los NO aceptables
        respuesta = false;
    }
     
    //Regresar la respuesta
    return respuesta;
}

function validar_pegado_con_teclado_solo_numeros(e) { // 1
 return !(e.keyCode==86 && e.ctrlKey);
    tecla = (document.all) ? e.keyCode : e.which; // 2
    if (tecla==8) return true; // 3
    patron = /\d/; // 4
    //patron = /\d/; // Solo acepta números
 //patron = /\w/; // Acepta números y letras
 //patron = /\D/; // No acepta números
 //patron =/[A-Za-zñÑ\s]/; // igual que el ejemplo, pero acepta también las letras ñ y Ñ
    te = String.fromCharCode(tecla); // 5
    return patron.test(te); // 6
    
} 


function validar_pegado_con_teclado_solo_letras(e) { // 1
 return !(e.keyCode==86 && e.ctrlKey);
    tecla = (document.all) ? e.keyCode : e.which; // 2
    if (tecla==8) return true; // 3
    patron =/[A-Za-zñÑ\s]/;// 4
    //patron = /\d/; // Solo acepta números
 //patron = /\w/; // Acepta números y letras
 //patron = /\D/; // No acepta números
 //patron =/[A-Za-zñÑ\s]/; // igual que el ejemplo, pero acepta también las letras ñ y Ñ
    te = String.fromCharCode(tecla); // 5
    return patron.test(te); // 6
    
} 

/*Si hay algo que no podemos evitar es que la persona que 
 visita tu página copie y pegue un texto no deseado al "input text" .
 Para eso podemos agregarle el atributo "onblur" a la etiqueta input 
 llamando a una función que limpie el "input text" si es que encuentra 
 un caracter no deseado.*/
 
 
 //VALIDACION SI LA PERSONA USA CRTL V PEGA NUMEROS U OTROS QUE NO SEAN CARACTERES SE BORRAN
function limpia_descripcion(){
    var val = document.getElementById("descripcion").value;
    var tam = val.length;
    for(i=0;i<tam;i++){
 if(!isNaN(val[i]))
 document.getElementById("descripcion").value='';
    }
} //onblur="limpia_descripcion()"
 //VALIDACION SI LA PERSONA USA CRTL V PEGA NUMEROS U OTROS QUE NO SEAN CARACTERES SE BORRAN
function limpia_titulo(){
    var val = document.getElementById("titulo").value;
    var tam = val.length;
    for(i=0;i<tam;i++){
 if(!isNaN(val[i]))
 document.getElementById("titulo").value='';
    }
}//onblur="limpia_titulo()" 


//VALIDADOR DE RUT CHILENO
function validacion_rut_usu_busquedas(rut,div,lugarDondeEstaElRut){
	if(rut==''){
		return false;
	}
	
if ( rut.length == 0 ){
	bootbox.alert('¡Rut de inválido!', function(result) {
		});
	document.getElementById(lugarDondeEstaElRut).value = ''; 
	return false; 
}
if ( rut.length < 8 ){ 
	bootbox.alert('¡Rut de inválido!', function(result) {
		});
	document.getElementById(lugarDondeEstaElRut).value = '';
	return false; 
}
if ( rut == 123123123 ){
	bootbox.alert('¡Rut de inválido!', function(result) {
		});
	document.getElementById(lugarDondeEstaElRut).value = '';
	return false; 
}
 var tmpstr = "";
 if (rut=="")
 	return;
 for ( i=0; i < rut.length; i++ )
   if ( rut.charAt(i) != ' ' && rut.charAt(i) != '.' && rut.charAt(i) != '-' )
     tmpstr = tmpstr + rut.charAt(i);
     rut = tmpstr;
     largo = rut.length;
	 tmpstr = "";
 for ( i=0; rut.charAt(i) == '0' ; i++ );
   for (; i < rut.length; i++ )
     tmpstr = tmpstr + rut.charAt(i);
	 rut = tmpstr;
	 largo = rut.length;
     if ( largo < 2 )
      {
		bootbox.alert('¡Rut de inválido!', function(result) {
		});
        /*alert("Debe ingresar el rut Completo");*/
		document.getElementById(lugarDondeEstaElRut).value = '';
        /*document.getElementById('rut').focus();*/
		
        return;
      }
   for (i=0; i < largo ; i++ )
      {
		if ( rut.charAt(i) != "0" && rut.charAt(i) != "1" && rut.charAt(i) !="2" && rut.charAt(i) != "3" && rut.charAt(i) != "4" && rut.charAt(i) !="5" && rut.charAt(i) != "6" && rut.charAt(i) != "7" && rut.charAt(i) !="8" && rut.charAt(i) != "9" && rut.charAt(i) !="k" && rut.charAt(i) != "K" )
		  {
			 bootbox.alert('¡Rut de inválido!', function(result) {
		});
			/*alert("El valor ingresado no Corresponde a un R.U.T valido.");*/
			document.getElementById(lugarDondeEstaElRut).value = '';
        /*document.getElementById('rut').focus();*/
			return;
		  }
     }
 var invertido = "";
 for ( i=(largo-1),j=0; i>=0; i--,j++ )
    invertido = invertido + rut.charAt(i);
 var drut = "";
 drut = drut + invertido.charAt(0);
 drut = drut + '-';
 cnt = 0;
 for ( i=1,j=2; i<largo; i++,j++ )
   {
     if ( cnt == 3 )
     {
       drut = drut + '.';
       j++;
       drut = drut + invertido.charAt(i);
       cnt = 1;
     }
     else
     {
       drut = drut + invertido.charAt(i);
       cnt++;
     }
  }
invertido = "";
for ( i=(drut.length-1),j=0; i>=0; i--,j++ )
   invertido = invertido + drut.charAt(i);
   document.getElementById(lugarDondeEstaElRut).value= invertido;

if ( validar_digito_usu_busquedas(rut,div,lugarDondeEstaElRut)==1 )
{
    return;
	
}
switch (String(rut)) { 
   	case "111111111": 
		bootbox.alert('¡Rut de inválido!', function(result) {
		});
		document.getElementById(lugarDondeEstaElRut).value = '';
      	 return false;
      	 break
    case "222222222": 
		bootbox.alert('¡Rut de inválido!', function(result) {
		});
		document.getElementById(lugarDondeEstaElRut).value = '';
      	 return false;
      	 break
    case "333333333": 
		bootbox.alert('¡Rut de inválido!', function(result) {
		});
		document.getElementById(lugarDondeEstaElRut).value = '';
      	 return false;
      	 break
    case "444444444": 
		$bootbox.alert('¡Rut de inválido!', function(result) {
		});
		document.getElementById(lugarDondeEstaElRut).value = '';
      	 return false;
      	 break
	case "555555555": 
		bootbox.alert('¡Rut de inválido!', function(result) {
		});
		document.getElementById(lugarDondeEstaElRut).value = '';
      	 return false;
      	 break
	case "666666666": 
		bootbox.alert('¡Rut de inválido!', function(result) {
		});
		document.getElementById(lugarDondeEstaElRut).value = '';
      	 return false;
      	 break
	case "777777777": 
		bootbox.alert('¡Rut de inválido!', function(result) {
		});
		document.getElementById(lugarDondeEstaElRut).value = '';
      	 return false;
      	 break
	case "888888888": 
		bootbox.alert('¡Rut de inválido!', function(result) {
		});
		document.getElementById(lugarDondeEstaElRut).value = '';
      	 return false;
      	 break
	case "999999999": 
		bootbox.alert('¡Rut de inválido!', function(result) {
		});
		document.getElementById(lugarDondeEstaElRut).value = '';
      	 return false;
      	 break
	case "19": 
		bootbox.alert('¡Rut de inválido!', function(result) {
		});
		document.getElementById(lugarDondeEstaElRut).value = '';
      	 return false;
      	 break
   	default: 
      	 return true; 
}
}
function validar_digito_usu_busquedas(crut,div,lugarDondeEstaElRut){
 largo = crut.length;
 if ( largo < 2 )
   {
	 bootbox.alert('¡Rut de inválido!', function(result) {
		});
     /*alert("Debe ingresar el rut completo");*/
	 document.getElementById(lugarDondeEstaElRut).value = '';
     /*document.getElementById('rut').focus();*/
	 return;
   }
 if ( largo > 2 )
   rut = crut.substring(0, largo - 1);
 else
   rut = crut.charAt(0);
   dv = crut.charAt(largo-1);
   checkCDV_usu( dv,div,lugarDondeEstaElRut );
 if ( rut == null || dv == null )
   return 0;
 var dvr = '0';
 suma = 0;
 mul = 2;
 for (i= rut.length -1 ; i >= 0; i--)
  {
    suma = suma + rut.charAt(i) * mul;
    if (mul == 7)
       mul = 2;
    else
       mul++;
            }
    res = suma % 11;
    if (res==1)
      dvr = 'k';
    else if (res==0)
       dvr = '0';
    else
     {
       dvi = 11-res;
       dvr = dvi + "";
     }
    if ( dvr != dv.toLowerCase() )
    {
      /*alert("EL RUT es Incorrecto. Verifique...");*/
	  bootbox.alert('¡Rut de inválido!', function(result) {
		});
       document.getElementById(lugarDondeEstaElRut).value = '';
    /* document.getElementById('rut').focus();*/
      return 1;
    }
   //return validarRepeticionRut($('#'+lugarDondeEstaElRut).val(),lugarDondeEstaElRut);
}


function validacion_rut_usu(rut,div,lugarDondeEstaElRut){
	if(rut==''){
		return false;
	}
	
if ( rut.length == 0 ){
	bootbox.alert('¡Rut inválido!', function(result) {
		});
	document.getElementById(lugarDondeEstaElRut).value = ''; 
	return false; 
}
if ( rut.length < 8 ){ 
	bootbox.alert('¡Rut inválido!', function(result) {
		});
	document.getElementById(lugarDondeEstaElRut).value = '';
	return false; 
}
if ( rut == 123123123 ){
	bootbox.alert('¡Rut inválido!', function(result) {
		});
	document.getElementById(lugarDondeEstaElRut).value = '';
	return false; 
}
 var tmpstr = "";
 if (rut=="")
 	return;
 for ( i=0; i < rut.length; i++ )
   if ( rut.charAt(i) != ' ' && rut.charAt(i) != '.' && rut.charAt(i) != '-' )
     tmpstr = tmpstr + rut.charAt(i);
     rut = tmpstr;
     largo = rut.length;
	 tmpstr = "";
 for ( i=0; rut.charAt(i) == '0' ; i++ );
   for (; i < rut.length; i++ )
     tmpstr = tmpstr + rut.charAt(i);
	 rut = tmpstr;
	 largo = rut.length;
     if ( largo < 2 )
      {
		bootbox.alert('¡Rut inválido!', function(result) {
		});
        /*alert("Debe ingresar el rut Completo");*/
		document.getElementById(lugarDondeEstaElRut).value = '';
        /*document.getElementById('rut').focus();*/
		
        return;
      }
   for (i=0; i < largo ; i++ )
      {
		if ( rut.charAt(i) != "0" && rut.charAt(i) != "1" && rut.charAt(i) !="2" && rut.charAt(i) != "3" && rut.charAt(i) != "4" && rut.charAt(i) !="5" && rut.charAt(i) != "6" && rut.charAt(i) != "7" && rut.charAt(i) !="8" && rut.charAt(i) != "9" && rut.charAt(i) !="k" && rut.charAt(i) != "K" )
		  {
			 bootbox.alert('¡Rut inválido!', function(result) {
		});
			/*alert("El valor ingresado no Corresponde a un R.U.T valido.");*/
			document.getElementById(lugarDondeEstaElRut).value = '';
        /*document.getElementById('rut').focus();*/
			return;
		  }
     }
 var invertido = "";
 for ( i=(largo-1),j=0; i>=0; i--,j++ )
    invertido = invertido + rut.charAt(i);
 var drut = "";
 drut = drut + invertido.charAt(0);
 drut = drut + '-';
 cnt = 0;
 for ( i=1,j=2; i<largo; i++,j++ )
   {
     if ( cnt == 3 )
     {
       drut = drut + '.';
       j++;
       drut = drut + invertido.charAt(i);
       cnt = 1;
     }
     else
     {
       drut = drut + invertido.charAt(i);
       cnt++;
     }
  }
invertido = "";
for ( i=(drut.length-1),j=0; i>=0; i--,j++ )
   invertido = invertido + drut.charAt(i);
   document.getElementById(lugarDondeEstaElRut).value= invertido;

if ( validar_digito_usu(rut,div,lugarDondeEstaElRut)==1 )
{
    return;
	
}
switch (String(rut)) { 
   	case "111111111": 
		bootbox.alert('¡Rut inválido!', function(result) {
		});
		document.getElementById(lugarDondeEstaElRut).value = '';
      	 return false;
      	 break
    case "222222222": 
		bootbox.alert('¡Rut inválido!', function(result) {
		});
		document.getElementById(lugarDondeEstaElRut).value = '';
      	 return false;
      	 break
    case "333333333": 
		bootbox.alert('¡Rut inválido!', function(result) {
		});
		document.getElementById(lugarDondeEstaElRut).value = '';
      	 return false;
      	 break
    case "444444444": 
		$bootbox.alert('¡Rut inválido!', function(result) {
		});
		document.getElementById(lugarDondeEstaElRut).value = '';
      	 return false;
      	 break
	case "555555555": 
		bootbox.alert('¡Rut inválido!', function(result) {
		});
		document.getElementById(lugarDondeEstaElRut).value = '';
      	 return false;
      	 break
	case "666666666": 
		bootbox.alert('¡Rut inválido!', function(result) {
		});
		document.getElementById(lugarDondeEstaElRut).value = '';
      	 return false;
      	 break
	case "777777777": 
		bootbox.alert('¡Rut inválido!', function(result) {
		});
		document.getElementById(lugarDondeEstaElRut).value = '';
      	 return false;
      	 break
	case "888888888": 
		bootbox.alert('¡Rut inválido!', function(result) {
		});
		document.getElementById(lugarDondeEstaElRut).value = '';
      	 return false;
      	 break
	case "999999999": 
		bootbox.alert('¡Rut inválido!', function(result) {
		});
		document.getElementById(lugarDondeEstaElRut).value = '';
      	 return false;
      	 break
	case "19": 
		bootbox.alert('¡Rut inválido!', function(result) {
		});
		document.getElementById(lugarDondeEstaElRut).value = '';
      	 return false;
      	 break
   	default: 
      	 return true; 
}
}
function validacion_rut_usu_proveedor(rut,div,lugarDondeEstaElRut){
	if(rut==''){
		return false;
	}
	
if ( rut.length == 0 ){
	bootbox.alert('¡Rut inválido!', function(result) {
		});
	document.getElementById(lugarDondeEstaElRut).value = ''; 
	return false; 
}
if ( rut.length < 8 ){ 
	bootbox.alert('¡Rut inválido!', function(result) {
		});
	document.getElementById(lugarDondeEstaElRut).value = '';
	return false; 
}
if ( rut == 123123123 ){
	bootbox.alert('¡Rut inválido!', function(result) {
		});
	document.getElementById(lugarDondeEstaElRut).value = '';
	return false; 
}
 var tmpstr = "";
 if (rut=="")
 	return;
 for ( i=0; i < rut.length; i++ )
   if ( rut.charAt(i) != ' ' && rut.charAt(i) != '.' && rut.charAt(i) != '-' )
     tmpstr = tmpstr + rut.charAt(i);
     rut = tmpstr;
     largo = rut.length;
	 tmpstr = "";
 for ( i=0; rut.charAt(i) == '0' ; i++ );
   for (; i < rut.length; i++ )
     tmpstr = tmpstr + rut.charAt(i);
	 rut = tmpstr;
	 largo = rut.length;
     if ( largo < 2 )
      {
		bootbox.alert('¡Rut inválido!', function(result) {
		});
        /*alert("Debe ingresar el rut Completo");*/
		document.getElementById(lugarDondeEstaElRut).value = '';
        /*document.getElementById('rut').focus();*/
		
        return;
      }
   for (i=0; i < largo ; i++ )
      {
		if ( rut.charAt(i) != "0" && rut.charAt(i) != "1" && rut.charAt(i) !="2" && rut.charAt(i) != "3" && rut.charAt(i) != "4" && rut.charAt(i) !="5" && rut.charAt(i) != "6" && rut.charAt(i) != "7" && rut.charAt(i) !="8" && rut.charAt(i) != "9" && rut.charAt(i) !="k" && rut.charAt(i) != "K" )
		  {
			 bootbox.alert('¡Rut inválido!', function(result) {
		});
			/*alert("El valor ingresado no Corresponde a un R.U.T valido.");*/
			document.getElementById(lugarDondeEstaElRut).value = '';
        /*document.getElementById('rut').focus();*/
			return;
		  }
     }
 var invertido = "";
 for ( i=(largo-1),j=0; i>=0; i--,j++ )
    invertido = invertido + rut.charAt(i);
 var drut = "";
 drut = drut + invertido.charAt(0);
 drut = drut + '-';
 cnt = 0;
 for ( i=1,j=2; i<largo; i++,j++ )
   {
     if ( cnt == 3 )
     {
       drut = drut + '.';
       j++;
       drut = drut + invertido.charAt(i);
       cnt = 1;
     }
     else
     {
       drut = drut + invertido.charAt(i);
       cnt++;
     }
  }
invertido = "";
for ( i=(drut.length-1),j=0; i>=0; i--,j++ )
   invertido = invertido + drut.charAt(i);
   document.getElementById(lugarDondeEstaElRut).value= invertido;

if ( validar_digito_usu_proveedor(rut,div,lugarDondeEstaElRut)==1 )
{
    return;
	
}
switch (String(rut)) { 
   	case "111111111": 
		bootbox.alert('¡Rut inválido!', function(result) {
		});
		document.getElementById(lugarDondeEstaElRut).value = '';
      	 return false;
      	 break
    case "222222222": 
		bootbox.alert('¡Rut inválido!', function(result) {
		});
		document.getElementById(lugarDondeEstaElRut).value = '';
      	 return false;
      	 break
    case "333333333": 
		bootbox.alert('¡Rut inválido!', function(result) {
		});
		document.getElementById(lugarDondeEstaElRut).value = '';
      	 return false;
      	 break
    case "444444444": 
		$bootbox.alert('¡Rut inválido!', function(result) {
		});
		document.getElementById(lugarDondeEstaElRut).value = '';
      	 return false;
      	 break
	case "555555555": 
		bootbox.alert('¡Rut inválido!', function(result) {
		});
		document.getElementById(lugarDondeEstaElRut).value = '';
      	 return false;
      	 break
	case "666666666": 
		bootbox.alert('¡Rut inválido!', function(result) {
		});
		document.getElementById(lugarDondeEstaElRut).value = '';
      	 return false;
      	 break
	case "777777777": 
		bootbox.alert('¡Rut inválido!', function(result) {
		});
		document.getElementById(lugarDondeEstaElRut).value = '';
      	 return false;
      	 break
	case "888888888": 
		bootbox.alert('¡Rut inválido!', function(result) {
		});
		document.getElementById(lugarDondeEstaElRut).value = '';
      	 return false;
      	 break
	case "999999999": 
		bootbox.alert('¡Rut inválido!', function(result) {
		});
		document.getElementById(lugarDondeEstaElRut).value = '';
      	 return false;
      	 break
	case "19": 
		bootbox.alert('¡Rut inválido!', function(result) {
		});
		document.getElementById(lugarDondeEstaElRut).value = '';
      	 return false;
      	 break
   	default: 
      	 return true; 
}
}

function validar_digito_usu(crut,div,lugarDondeEstaElRut){
 largo = crut.length;
 if ( largo < 2 )
   {
	 bootbox.alert('¡Rut inválido!', function(result) {
		});
     /*alert("Debe ingresar el rut completo");*/
	 document.getElementById(lugarDondeEstaElRut).value = '';
     /*document.getElementById('rut').focus();*/
	 return;
   }
 if ( largo > 2 )
   rut = crut.substring(0, largo - 1);
 else
   rut = crut.charAt(0);
   dv = crut.charAt(largo-1);
   checkCDV_usu( dv,div,lugarDondeEstaElRut );
 if ( rut == null || dv == null )
   return 0;
 var dvr = '0';
 suma = 0;
 mul = 2;
 for (i= rut.length -1 ; i >= 0; i--)
  {
    suma = suma + rut.charAt(i) * mul;
    if (mul == 7)
       mul = 2;
    else
       mul++;
            }
    res = suma % 11;
    if (res==1)
      dvr = 'k';
    else if (res==0)
       dvr = '0';
    else
     {
       dvi = 11-res;
       dvr = dvi + "";
     }
    if ( dvr != dv.toLowerCase() )
    {
      /*alert("EL RUT es Incorrecto. Verifique...");*/
	  bootbox.alert('¡Rut inválido!', function(result) {
		});
       document.getElementById(lugarDondeEstaElRut).value = '';
    /* document.getElementById('rut').focus();*/
      return 1;
    }
   return validarRepeticionRut($('#'+lugarDondeEstaElRut).val(),lugarDondeEstaElRut);
}
function validar_digito_usu_proveedor(crut,div,lugarDondeEstaElRut){
 largo = crut.length;
 if ( largo < 2 )
   {
	 bootbox.alert('¡Rut inválido!', function(result) {
		});
     /*alert("Debe ingresar el rut completo");*/
	 document.getElementById(lugarDondeEstaElRut).value = '';
     /*document.getElementById('rut').focus();*/
	 return;
   }
 if ( largo > 2 )
   rut = crut.substring(0, largo - 1);
 else
   rut = crut.charAt(0);
   dv = crut.charAt(largo-1);
   checkCDV_usu( dv,div,lugarDondeEstaElRut );
 if ( rut == null || dv == null )
   return 0;
 var dvr = '0';
 suma = 0;
 mul = 2;
 for (i= rut.length -1 ; i >= 0; i--)
  {
    suma = suma + rut.charAt(i) * mul;
    if (mul == 7)
       mul = 2;
    else
       mul++;
            }
    res = suma % 11;
    if (res==1)
      dvr = 'k';
    else if (res==0)
       dvr = '0';
    else
     {
       dvi = 11-res;
       dvr = dvi + "";
     }
    if ( dvr != dv.toLowerCase() )
    {
      /*alert("EL RUT es Incorrecto. Verifique...");*/
	  bootbox.alert('¡Rut inválido!', function(result) {
		});
       document.getElementById(lugarDondeEstaElRut).value = '';
    /* document.getElementById('rut').focus();*/
      return 1;
    }
   return validarRepeticionRutProveedor($('#'+lugarDondeEstaElRut).val(),lugarDondeEstaElRut);
}

function checkCDV_usu( dvr,div,lugarDondeEstaElRut )
{
  dv = dvr + "";
  if ( dv != '0' && dv != '1' && dv != '2' && dv != '3' && dv != '4' && dv != '5' && dv != '6' && dv != '7' && dv != '8' && dv != '9' && dv != 'k'  && dv != 'K')
    {
       /*alert("Debe ingresar un digito verificador valido.");*/
	   bootbox.alert('¡Rut inválido!', function(result) {
		});
	   document.getElementById(lugarDondeEstaElRut).value = '';
    /* document.getElementById('rut').focus();*/
       return;
    }
  return;
}


function rut_repetido_empleado(rut,div){
	var primero;
		var segundo;
		var tercero;
		var cuarto;
	if(rut.length==9){
		primero=rut.substr(0,2);
		segundo =rut.substr(2,3);
		tercero=rut.substr(5,3);
		cuarto =rut.substr(8,1);
		rut = primero+'.'+segundo+'.'+tercero+'-'+cuarto;
	}else{
		primero=rut.substr(0,1);
		segundo =rut.substr(1,3);
		tercero=rut.substr(4,3);
		cuarto =rut.substr(7,1);
		rut = primero+'.'+segundo+'.'+tercero+'-'+cuarto;
	}
	if($("#rutEnUso").val()==null){ 
		$("body").append('<input type="hidden" id="rutEnUso" value="">');
	}
}



//validacion validar rut que exista abogado EDSON CARRASCO


function validarRepeticionRut(rut,lugarDondeEstaElRut){
	if(rut=="" || rut==" ") return false;
	$.ajax({
			url: '../Controlador/persona_controlador.php?accion=verificarRut',
			type:'POST',
			processData: true,
			data: '&rut='+encodeURI(String(rut)),
			success:function(datos){//Cuando se devuelvan los datos, se llamarán "datos" y se realizará lo que suceda entre llaves
				datos = JSON.parse(datos);
				if(datos.rut == rut) {
					   var mensaje = '<div class="alert alert-danger">¡El rut está siendo utilizado! <br>El rut pertenece a <b>'+datos.nombre+'</b></div>';
					  bootbox.alert(mensaje, function(result) {
						  
					  });
					 // $("#Rut").val('');
				   } else {
				}
			}
		});	
}
function validarRepeticionRutProveedor(rut,lugarDondeEstaElRut){
	if(rut=="" || rut==" ") return false;
	$.ajax({
			url: '../Controlador/proveedor_controlador.php?accion=verificarRut',
			type:'POST',
			processData: true,
			data: '&rut='+encodeURI(String(rut)),
			success:function(datos){//Cuando se devuelvan los datos, se llamarán "datos" y se realizará lo que suceda entre llaves
				datos = JSON.parse(datos);
				if(datos.rut == rut) {
					   var mensaje = '<div class="alert alert-danger">¡El rut está siendo utilizado! <br>El rut pertenece a <b>'+datos.nombre+'</b></div>';
					  bootbox.alert(mensaje, function(result) {
						  
					  });
					 // $("#Rut").val('');
				   } else {
				}
			}
		});	
}

function base64_decode(data) {
  //  discuss at: http://phpjs.org/functions/base64_decode/
  // original by: Tyler Akins (http://rumkin.com)
  // improved by: Thunder.m
  // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  //    input by: Aman Gupta
  //    input by: Brett Zamir (http://brett-zamir.me)
  // bugfixed by: Onno Marsman
  // bugfixed by: Pellentesque Malesuada
  // bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  //   example 1: base64_decode('S2V2aW4gdmFuIFpvbm5ldmVsZA==');
  //   returns 1: 'Kevin van Zonneveld'
  //   example 2: base64_decode('YQ===');
  //   returns 2: 'a'

  var b64 = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=';
  var o1, o2, o3, h1, h2, h3, h4, bits, i = 0,
    ac = 0,
    dec = '',
    tmp_arr = [];

  if (!data) {
    return data;
  }

  data += '';

  do { // unpack four hexets into three octets using index points in b64
    h1 = b64.indexOf(data.charAt(i++));
    h2 = b64.indexOf(data.charAt(i++));
    h3 = b64.indexOf(data.charAt(i++));
    h4 = b64.indexOf(data.charAt(i++));

    bits = h1 << 18 | h2 << 12 | h3 << 6 | h4;

    o1 = bits >> 16 & 0xff;
    o2 = bits >> 8 & 0xff;
    o3 = bits & 0xff;

    if (h3 == 64) {
      tmp_arr[ac++] = String.fromCharCode(o1);
    } else if (h4 == 64) {
      tmp_arr[ac++] = String.fromCharCode(o1, o2);
    } else {
      tmp_arr[ac++] = String.fromCharCode(o1, o2, o3);
    }
  } while (i < data.length);

  dec = tmp_arr.join('');

  return dec.replace(/\0+$/, '');
}

function permitir(filaCrear,filaModificar,filaEliminar,listar){
	if($("#crear").val()=='NO'){
		filaCrear.remove();
	}
	if($("#modificar").val()=='NO'){
		filaModificar.remove();
	}
	if($("#eliminar").val()=='NO'){
		filaEliminar.remove();
	}
	if($("#listar").val()=='NO'){
		listar.remove();
	}
}
<?php
/*----------Código Generado por --------------*/
/*-- Fecha : 22/11/2016 21:47:53--*/
/*-- Autores : Roy Alex Standen Barraza - Edson Carrasco Gonzales--*/
/*-- Contacto : roystandenb@gmail.com / edsoncarrascogonzalez@gmail.com --*/
error_reporting(E_ALL);
session_start();
include_once("../modelo/conexion.php");
include_once("../modelo/denuncios.class.php");
if(isset($_SESSION['usuario'])){
@$ID_DENUNCIO = $_POST['ID_DENUNCIO'];
@$NOMBRE_TALONARIO = $_POST['NOMBRE_TALONARIO'];
@$ID_JUZGADO = $_POST['ID_JUZGADO'];
@$ID_INSPECTOR = $_POST['ID_INSPECTOR'];
@$SECTOR = $_POST['SECTOR'];
@$RUT_INFRACTOR = $_POST['RUT_INFRACTOR'];
@$NOMBRE_INFRACTOR = $_POST['NOMBRE_INFRACTOR'];
@$DIRECCION_INFRACTOR = $_POST['DIRECCION_INFRACTOR'];
@$TIPO_VEHICULO = $_POST['TIPO_VEHICULO'];
@$NOMBRE_MARCA = $_POST['NOMBRE_MARCA'];
@$NUMERO_BOLETA_TALONARIO = $_POST['NUMERO_BOLETA_TALONARIO'];
@$FECHA_INFRACCION = $_POST['FECHA_INFRACCION'];
@$HORA_INFRACCION = $_POST['HORA_INFRACCION'];
@$LUGAR_INFRACCION = $_POST['LUGAR_INFRACCION'];
@$PATENTE_AUTO = $_POST['PATENTE_AUTO'];
@$COLOR_AUTO = $_POST['COLOR_AUTO'];
@$NUMERO_LEY = $_POST['NUMERO_LEY'];
@$ARTICULO_LEY = $_POST['ARTICULO_LEY'];
@$FECHA_LIMITE = $_POST['FECHA_LIMITE'];
@$FORMA_DE_NOTIFICACION = $_POST['FORMA_DE_NOTIFICACION'];
@$MOTIVO_INFRACCION = $_POST['MOTIVO_INFRACCION'];
@$OBSERVACIONES_DENUNCIO = $_POST['OBSERVACIONES_DENUNCIO'];
@$ES_EMPRESA = $_POST['ES_EMPRESA'];
@$ID_USUARIO = $_POST['ID_USUARIO'];
@$ROL_EMPRESA_INFRACCION = $_POST['ROL_EMPRESA_INFRACCION'];

$accion = $_GET['accion'];
	if($accion=='crear'){
		$objeto = new denuncios($ID_DENUNCIO,0,$ID_JUZGADO,$ID_INSPECTOR,$SECTOR,0,0,0,$NUMERO_BOLETA_TALONARIO,$FECHA_INFRACCION,$HORA_INFRACCION,$LUGAR_INFRACCION,$PATENTE_AUTO,$COLOR_AUTO,$NUMERO_LEY,$ARTICULO_LEY,$FECHA_LIMITE,$FORMA_DE_NOTIFICACION,$MOTIVO_INFRACCION,$OBSERVACIONES_DENUNCIO);
		print $objeto->crear($SECTOR,$RUT_INFRACTOR,$NOMBRE_INFRACTOR,$DIRECCION_INFRACTOR,$TIPO_VEHICULO,$NOMBRE_MARCA,$ES_EMPRESA,$ROL_EMPRESA_INFRACCION);
	}else if($accion=='modificar'){
		$objeto = new denuncios($ID_DENUNCIO,0,$ID_JUZGADO,$ID_INSPECTOR,$SECTOR,0,0,0,$NUMERO_BOLETA_TALONARIO,$FECHA_INFRACCION,$HORA_INFRACCION,$LUGAR_INFRACCION,$PATENTE_AUTO,$COLOR_AUTO,$NUMERO_LEY,$ARTICULO_LEY,$FECHA_LIMITE,$FORMA_DE_NOTIFICACION,$MOTIVO_INFRACCION,$OBSERVACIONES_DENUNCIO);
		print $objeto->modificar($SECTOR,$RUT_INFRACTOR,$NOMBRE_INFRACTOR,$DIRECCION_INFRACTOR,$TIPO_VEHICULO,$NOMBRE_MARCA,$ES_EMPRESA,$ID_USUARIO,$ROL_EMPRESA_INFRACCION);
	}else if($accion=='eliminar'){
		$objeto = new denuncios($ID_DENUNCIO,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
		print $objeto->eliminar();
	}else if($accion=='mostrar'){
		$objeto = new denuncios(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
		echo $objeto->mostrar($_POST['buscar_numero_boleta'],$_POST['buscar_rut_infractor'],$_POST['buscar_inspector'],$_POST['buscar_usuario'],$_POST['Fecha_inicio'],$_POST['Fecha_final'],$_POST['Hora_inicio'],$_POST['Hora_final'],$_POST['buscar_sector'],$_POST['buscar_calle'],$_POST['buscar_detalle_denuncios'],$_GET['jtSorting'],$_GET['jtStartIndex'],$_GET['jtPageSize']);
	}else if($accion=='comboboxJuzgado'){
		$conexion = new Database();
		$datos = $conexion->listarJtablesSinPaginador(" `juzgado` "
															," `ID_JUZGADO` AS Value, `NOMBRE` AS DisplayText ", "");
		echo json_encode($datos);
	}else if($accion=='comboboxInspector'){
		$conexion = new Database();
		$datos = $conexion->listarJtablesSinPaginador(" `inspector` "
															," `ID_INSPECTOR` AS Value, `NOMBRE_INSPECTOR` AS DisplayText ", "");
		echo json_encode($datos);
	}else if($accion=='comboboxInfraccion'){
		$conexion = new Database();
		$datos = $conexion->listarJtablesSinPaginador(" `motivo_infraccion` "
															," `ID_MOTIVO_INFRACCION` AS Value, `NOMBRE` AS DisplayText ", "");
		echo json_encode($datos);
	}else if($accion=='comboboxResponsable'){
		$conexion = new Database();
		$datos = $conexion->listarJtablesSinPaginador(" `usuario` "
															," `ID_USUARIO` AS Value, `USUARIO_USUARIO` AS DisplayText ", "");
		echo json_encode($datos);
	}else if($accion=='comboboxSector'){
		$conexion = new Database();
		$datos = $conexion->listarJtablesSinPaginador(" `sector` "
															," `ID_SECTOR` AS Value, `NOMBRE_SECTOR` AS DisplayText ", "");
		echo json_encode($datos);	
	}else if($accion=='autocompletar_RUT_INFRACTOR'){
		$conexion = new Database();
		$sql = 'SELECT * FROM `infractor` WHERE `RUT` LIKE "%'.$_GET['term'].'%" Limit 0,7';
		$registros = $conexion->listar($sql);
		$datos = array();
		foreach($registros as $datos_sql){
			$datos[] = array("label"=>$datos_sql['RUT'],
			                 "nombres"=>$datos_sql['NOMBRES'],
							 "direccion"=>$datos_sql['DIRECCION'],
							 "es_empresa"=>$datos_sql['ES_EMPRESA']);
		}
		echo json_encode($datos);
	}else if($accion=='comprobarNumeroBoleta'){
		$conexion = new Database();
		$sql = 'SELECT `NUMERO_BOLETA_TALONARIO` 
				FROM `denuncio` WHERE `NUMERO_BOLETA_TALONARIO` LIKE REPLACE("'.$_GET['num'].'"," ","")
				AND `ID_USUARIO` NOT LIKE "'.$_GET['id_usuario'].'" ';
		$registros = $conexion->listar($sql);
		$datos = array();
		if(count($registros)>0){
			$datos[] = array("existe"=>"si");
		}else{
			$datos[] = array("existe"=>"no");
		}
		echo json_encode($datos);	
	}else if($accion=='autocompletar_TIPO_VEHICULO'){
		$conexion = new Database();
		$sql = 'SELECT * FROM `tipo_vehiculo` WHERE `NOMBRE_TIPO_VEHICULO` LIKE "%'.$_GET['term'].'%"';
		$registros = $conexion->listar($sql);
		$datos = array();
		foreach($registros as $datos_sql){
			$datos[] = array("label"=>$datos_sql['NOMBRE_TIPO_VEHICULO']);
		}
		echo json_encode($datos);	
	}else if($accion=='autocompletar_sector'){
		$conexion = new Database();
		$sql = 'SELECT * FROM `sector` WHERE `NOMBRE_SECTOR` LIKE "%'.$_GET['term'].'%"';
		$registros = $conexion->listar($sql);
		$datos = array();
		foreach($registros as $datos_sql){
			$datos[] = array("label"=>$datos_sql['NOMBRE_SECTOR']);
		}
		echo json_encode($datos);	
	}else if($accion=='autocompletar_MARCA_VEHICULO'){
		$conexion = new Database();
		$sql = 'SELECT * FROM `marca` WHERE `NOMBRE_MARCA` LIKE "%'.$_GET['term'].'%"';
		$registros = $conexion->listar($sql);
		$datos = array();
		foreach($registros as $datos_sql){
			$datos[] = array("label"=>$datos_sql['NOMBRE_MARCA']);
		}
		echo json_encode($datos);	
	}
}
?>
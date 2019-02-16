<?php
/*----------Código Generado por --------------*/
/*-- Fecha : 22/11/2016 21:47:53--*/
/*-- Autores : Roy Alex Standen Barraza - Edson Carrasco Gonzales--*/
/*-- Contacto : roystandenb@gmail.com / edsoncarrascogonzalez@gmail.com --*/
error_reporting(E_ALL);
session_start();
include_once("../modelo/conexion.php");
include_once("../modelo/estadoLegalDelLocal.class.php");
if(isset($_SESSION['usuario'])){
@$ID_ESTADO_LEGAL = $_POST['ID_ESTADO_LEGAL'];
@$ID_EMPRESAS_A_INTERVENIR = $_POST['ID_EMPRESAS_A_INTERVENIR'];
@$ID_DIRECCION_EMPRESA = $_POST['ID_DIRECCION_EMPRESA'];
@$LEY_ESTADO_LEGAL = $_POST['LEY_ESTADO_LEGAL'];
@$ARTICULO_ESTADO_LEGAL = $_POST['ARTICULO_ESTADO_LEGAL'];
@$ORDENANZA_ESTADO_LEGAL = $_POST['ORDENANZA_ESTADO_LEGAL'];
@$DETALLE_ESTADO_LEGAL = $_POST['DETALLE_ESTADO_LEGAL'];
@$ESTA_AL_DIA_ESTADO_LEGAL = $_POST['ESTA_AL_DIA_ESTADO_LEGAL'];
@$DETALLE_ESTADO_LEGAL = $_POST['DETALLE_ESTADO_LEGAL'];
@$FECHA_ESTADO_LEGAL = $_POST['FECHA_ESTADO_LEGAL'];
$accion = $_GET['accion'];
	if($accion=='crear'){
		$objeto = new estadoLegalDelLocal($ID_ESTADO_LEGAL,$ID_EMPRESAS_A_INTERVENIR,$ID_DIRECCION_EMPRESA,$LEY_ESTADO_LEGAL,$ARTICULO_ESTADO_LEGAL,$ORDENANZA_ESTADO_LEGAL,$DETALLE_ESTADO_LEGAL,$ESTA_AL_DIA_ESTADO_LEGAL,$FECHA_ESTADO_LEGAL);
		print $objeto->crear();
	}else if($accion=='modificar'){
		$objeto = new estadoLegalDelLocal($ID_ESTADO_LEGAL,$ID_EMPRESAS_A_INTERVENIR,$ID_DIRECCION_EMPRESA,$LEY_ESTADO_LEGAL,$ARTICULO_ESTADO_LEGAL,$ORDENANZA_ESTADO_LEGAL,$DETALLE_ESTADO_LEGAL,$ESTA_AL_DIA_ESTADO_LEGAL,$FECHA_ESTADO_LEGAL);
		print $objeto->modificar();
	}else if($accion=='eliminar'){
		$objeto = new estadoLegalDelLocal($ID_ESTADO_LEGAL,$ID_EMPRESAS_A_INTERVENIR,$ID_DIRECCION_EMPRESA,$LEY_ESTADO_LEGAL,$ARTICULO_ESTADO_LEGAL,$ORDENANZA_ESTADO_LEGAL,$DETALLE_ESTADO_LEGAL,$ESTA_AL_DIA_ESTADO_LEGAL,$FECHA_ESTADO_LEGAL);
		print $objeto->eliminar();
	}else if($accion=='mostrar'){
		$objeto = new estadoLegalDelLocal($ID_ESTADO_LEGAL,$ID_EMPRESAS_A_INTERVENIR,$_GET['id'],$LEY_ESTADO_LEGAL,$ARTICULO_ESTADO_LEGAL,$ORDENANZA_ESTADO_LEGAL,$DETALLE_ESTADO_LEGAL,$ESTA_AL_DIA_ESTADO_LEGAL,$FECHA_ESTADO_LEGAL);
		echo $objeto->mostrar($_GET['jtSorting'],$_GET['jtStartIndex'],$_GET['jtPageSize']);
	}else if($accion=='comboboxTipoPermiso'){
		$conexion = new Database();
		$datos = $conexion->listarJtablesSinPaginador(" `permiso` "
															," `ID_EMPRESAS_A_INTERVENIR` AS Value, `NOMBRE_PERMISO` AS DisplayText ", "");
		echo json_encode($datos);	
	}
}
?>
<?php
/*----------Código Generado por --------------*/
/*-- Fecha : 22/11/2016 21:47:53--*/
/*-- Autores : Roy Alex Standen Barraza - Edson Carrasco Gonzales--*/
/*-- Contacto : roystandenb@gmail.com / edsoncarrascogonzalez@gmail.com --*/
error_reporting(E_ALL);
session_start();
include_once("../modelo/conexion.php");
include_once("../modelo/categoria_de_la_empresa.class.php");
if(isset($_SESSION['usuario'])){
@$ID_CATEGORIA_DE_LA_EMPRESA = $_POST['ID_CATEGORIA_DE_LA_EMPRESA'];
@$ID_EMPRESAS_A_INTERVENIR = $_POST['ID_EMPRESAS_A_INTERVENIR'];
@$ID_CATEGORIA_EMPRESA = $_POST['ID_CATEGORIA_EMPRESA'];
@$ROL_CATEGORIA_DE_LA_EMPRESA = $_POST['ROL_CATEGORIA_DE_LA_EMPRESA'];
@$ESTADO_CATEGORIA_DE_LA_EMPRESA = $_POST['ESTADO_CATEGORIA_DE_LA_EMPRESA'];
$accion = $_GET['accion'];
	if($accion=='crear'){
		$objeto = new categoria_de_la_empresa($ID_CATEGORIA_DE_LA_EMPRESA,$ID_EMPRESAS_A_INTERVENIR,$ID_CATEGORIA_EMPRESA,$ROL_CATEGORIA_DE_LA_EMPRESA,$ESTADO_CATEGORIA_DE_LA_EMPRESA);
		print $objeto->crear();
	}else if($accion=='modificar'){
		$objeto = new categoria_de_la_empresa($ID_CATEGORIA_DE_LA_EMPRESA,$ID_EMPRESAS_A_INTERVENIR,$ID_CATEGORIA_EMPRESA,$ROL_CATEGORIA_DE_LA_EMPRESA,$ESTADO_CATEGORIA_DE_LA_EMPRESA);
		print $objeto->modificar();
	}else if($accion=='eliminar'){
		$objeto = new categoria_de_la_empresa($ID_CATEGORIA_DE_LA_EMPRESA,$ID_EMPRESAS_A_INTERVENIR,$ID_CATEGORIA_EMPRESA,$ROL_CATEGORIA_DE_LA_EMPRESA,$ESTADO_CATEGORIA_DE_LA_EMPRESA);
		print $objeto->eliminar();
	}else if($accion=='mostrar'){
		$objeto = new categoria_de_la_empresa($ID_CATEGORIA_DE_LA_EMPRESA,$_GET['Id'],$ID_CATEGORIA_EMPRESA,$ROL_CATEGORIA_DE_LA_EMPRESA,$ESTADO_CATEGORIA_DE_LA_EMPRESA);
		echo $objeto->mostrar($_GET['jtSorting'],$_GET['jtStartIndex'],$_GET['jtPageSize']);
	}else if($accion=='comboboxTipoPermiso'){
		$conexion = new Database();
		$datos = $conexion->listarJtablesSinPaginador(" `permiso` "
															," `ID_EMPRESAS_A_INTERVENIR` AS Value, `NOMBRE_PERMISO` AS DisplayText ", "");
		echo json_encode($datos);	
	}
}
?>
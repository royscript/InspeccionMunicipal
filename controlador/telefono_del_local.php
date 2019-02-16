<?php
/*----------Código Generado por --------------*/
/*-- Fecha : 22/11/2016 21:47:53--*/
/*-- Autores : Roy Alex Standen Barraza - Edson Carrasco Gonzales--*/
/*-- Contacto : roystandenb@gmail.com / edsoncarrascogonzalez@gmail.com --*/
error_reporting(E_ALL);
session_start();
include_once("../modelo/conexion.php");
include_once("../modelo/telefonoDelLocal.class.php");
if(isset($_SESSION['usuario'])){
@$ID_TELEFONO_EMPRESA_A_INTERVENIR = $_POST['ID_TELEFONO_EMPRESA_A_INTERVENIR'];
@$NUMERO_TELEFONO_EMPRESA_A_INTERVENIR = $_POST['NUMERO_TELEFONO_EMPRESA_A_INTERVENIR'];
@$ID_DIRECCION_EMPRESA = $_POST['ID_DIRECCION_EMPRESA'];
@$NOMBRE_CONTACTO_TELEFONO_EMPRESA_A_INTERVENIR = $_POST['NOMBRE_CONTACTO_TELEFONO_EMPRESA_A_INTERVENIR'];
$accion = $_GET['accion'];
	if($accion=='crear'){
		$objeto = new telefonoDelLocal($ID_TELEFONO_EMPRESA_A_INTERVENIR,$NUMERO_TELEFONO_EMPRESA_A_INTERVENIR,$ID_DIRECCION_EMPRESA,$NOMBRE_CONTACTO_TELEFONO_EMPRESA_A_INTERVENIR);
		print $objeto->crear();
	}else if($accion=='modificar'){
		$objeto = new telefonoDelLocal($ID_TELEFONO_EMPRESA_A_INTERVENIR,$NUMERO_TELEFONO_EMPRESA_A_INTERVENIR,$ID_DIRECCION_EMPRESA,$NOMBRE_CONTACTO_TELEFONO_EMPRESA_A_INTERVENIR);
		print $objeto->modificar();
	}else if($accion=='eliminar'){
		$objeto = new telefonoDelLocal($ID_TELEFONO_EMPRESA_A_INTERVENIR,$NUMERO_TELEFONO_EMPRESA_A_INTERVENIR,$ID_DIRECCION_EMPRESA,$NOMBRE_CONTACTO_TELEFONO_EMPRESA_A_INTERVENIR);
		print $objeto->eliminar();
	}else if($accion=='mostrar'){
		$objeto = new telefonoDelLocal($ID_TELEFONO_EMPRESA_A_INTERVENIR,$NUMERO_TELEFONO_EMPRESA_A_INTERVENIR,$_GET['id'],$NOMBRE_CONTACTO_TELEFONO_EMPRESA_A_INTERVENIR);
		echo $objeto->mostrar($_GET['jtSorting'],$_GET['jtStartIndex'],$_GET['jtPageSize']);
	}else if($accion=='comboboxTipoPermiso'){
		$conexion = new Database();
		$datos = $conexion->listarJtablesSinPaginador(" `permiso` "
															," `NUMERO_TELEFONO_EMPRESA_A_INTERVENIR` AS Value, `NOMBRE_PERMISO` AS DisplayText ", "");
		echo json_encode($datos);	
	}
}
?>
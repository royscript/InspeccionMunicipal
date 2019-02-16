<html>
<head></head>
<body>
<?php
include_once("modelo/conexion.php");
$conexion = new Database();
$sql = "SELECT * 
		FROM `usuario` 
		WHERE `USUARIO_USUARIO` LIKE '".$_POST['user']."' 
		AND `CONTRASENA_USUARIO` LIKE '".$_POST['pass']."'";
$registros = $conexion->listar($sql);
if(count($registros)>0){
	foreach($registros as $datos){
		session_start();
		$_SESSION['usuario'] =  $datos['ID_USUARIO'];
		$_SESSION['grupo'] =  $datos['TIPO_USUARIO'];
		header('Location: vista/menu.php');
	}
}else{
	header('Location: index.php');
}
?>
</body>
</html>
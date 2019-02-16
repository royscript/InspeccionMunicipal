<?php
if(isset($_SESSION['usuario'])){
	session_destroy();
	header('Location: ../index.php');
}else{
	session_start(); 
	include_once("../modelo/menu.class.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>DEPTO INSPECCION MUNICIPAL</title>
</head>
<link rel="stylesheet" type="text/css" href="../bootstrap-3.3.7-dist/css/bootstrap.min.css">
<script src='../plugins/jquery-ui-1.10.3/jquery-1.9.1.js'></script>
<script src="../bootstrap-3.3.7-dist/js/bootstrap.js"></script>
<script src="../bootbox.min.js"></script>
<body>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Inspección Municipal</a>
    </div>
    <ul class="nav navbar-nav">
      <?php
	  	$objeto = new menu();
		if(isset($_GET['s'])){
			echo $objeto->mostrar($_GET['s'],$_SESSION['usuario']);
		}else{
			echo $objeto->mostrar(NULL,$_SESSION['usuario']);
		}
	  ?>
    </ul>
  </div>
</nav>
<link href="../plugins/jtable-bootstrap/jquery-ui-bootstrap-jquery-ui-bootstrap-71f2e47/css/custom-theme/jquery-ui-1.9.2.custom.css" rel="stylesheet" type="text/css" />
<script src="../plugins/jtable-bootstrap/jquery-ui-bootstrap-jquery-ui-bootstrap-71f2e47/js/jquery-ui-1.9.2.custom.min.js" type="text/javascript"></script>
<link href="../plugins/jtable-bootstrap/jtable.2.4.0/themes/lightcolor/blue/jtable.css" rel="stylesheet" type="text/css" />
<script src="../plugins/jtable-bootstrap/jtable.2.4.0/jquery.jtable.js" type="text/javascript"></script>
<script src="../plugins/jtable-bootstrap/jtable.2.4.0/localization/jquery.jtable.es.js" type="text/javascript"></script><!--BEGIN AUTOMATIC JUMP-->
<script src="../controlador js/validaciones.js" type="text/javascript"></script>
<script src="../plugins/bootstrap-select.js" type="text/javascript"></script>
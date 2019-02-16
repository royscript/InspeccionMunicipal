<?php
include_once("modelo/conexion.php");
$conexion = new Database();
$archivo_nombre = 'LISTADO con comas.csv';
$fila = 1;
if (($gestor = fopen($archivo_nombre, "r")) !== FALSE) {
    while (($datos = fgetcsv($gestor, 1000, ";")) !== FALSE) {
        $numero = count($datos);
        echo "<p> $numero de campos en la linea $fila: <br /></p>\n";
        $fila++;
		$datos_a_ingresar = '';
        for ($c=0; $c < $numero; $c++) {
			if($datos[$c]!=''){
				if($numero==($c+2)){
					$datos_a_ingresar .= "'".$datos[$c]."'";
				}else{
					$datos_a_ingresar .= "'".$datos[$c]."',";
				}
			}
        }
		echo "<br>".$query = "INSERT INTO `empresa`
				(`ROL_EMPRESA`,`RUT_EMPRESA`,`NOMBRE_EMPRESA`,`DIRECCION_EMPRESA`,`CSII_EMPRESA`,`GIRO_EMPRESA`,`MONTO_EMPRESA`)
				VALUES
				(".$datos_a_ingresar.")";
		$query = $conexion->ejecutar_query($query);
    }
    fclose($gestor);
}
?>
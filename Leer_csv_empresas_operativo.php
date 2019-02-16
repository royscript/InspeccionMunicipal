<?php
include_once("modelo/conexion.php");
$conexion = new Database();
$archivo_nombre = 'Patentes de Alcohol Marzo 2017.csv';
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
		echo "<br>".$query = "INSERT INTO `empresas_a_intervenir` 
							(`ID_OPERATIVO`,`ROL_EMPRESAS_A_INTERVENIR`,`RUT_EMPRESAS_A_INTERVENIR`,
							`NOMBRE_EMPRESAS_A_INTERVENIR`,`DIRECCION_EMPRESAS_A_INTERVENIR`,`CATEGORIA_EMPRESAS_A_INTERVENIR`,
							`GIRO_EMPRESAS_A_INTERVENIR`,`MONTO_EMPRESAS_A_INTERVENIR`)
				VALUES
				(1,".$datos_a_ingresar.")";
		$query = $conexion->ejecutar_query($query); 
    }
    fclose($gestor);
}
?>
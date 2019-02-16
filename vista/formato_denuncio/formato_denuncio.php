<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
include_once("../../modelo/conexion.php");
$id_denuncio = $_GET['id'];
$sql = "SELECT DENUNCIO.*,
			   TALONARIO.`NOMBRE_TALONARIO`,
			   DENUNCIO.`ID_JUZGADO` AS ID_JUZGADO,
			   SECTOR.`NOMBRE_SECTOR` AS SECTOR,
			   INFRACTOR.`NOMBRES` AS NOMBRE_INFRACTOR,
			   INFRACTOR.`RUT` AS RUT_INFRACTOR,
			   INFRACTOR.`DIRECCION` AS DIRECCION_INFRACTOR,
			   INFRACTOR.`ES_EMPRESA` AS ES_EMPRESA,
			   TIPO_VEHICULO.`NOMBRE_TIPO_VEHICULO` AS TIPO_VEHICULO,
			   MARCA.`NOMBRE_MARCA` AS NOMBRE_MARCA,
			   JUZGADO.`NOMBRE` AS NOMBRE_JUZGADO,
			   JUZGADO.`NUMERO` AS NUMERO_JUZGADO,
			   SECTOR.`NOMBRE_SECTOR` AS NOMBRE_SECTOR,
			   CONCAT(
					DATE_FORMAT(NOW(),'%d'),' de ',
					IF(DATE_FORMAT(NOW(),'%m')='01','Enero',	
						IF(DATE_FORMAT(NOW(),'%m')='02','Febrero',
							IF(DATE_FORMAT(NOW(),'%m')='03','Marzo',
								IF(DATE_FORMAT(NOW(),'%m')='04','Abril',
									IF(DATE_FORMAT(NOW(),'%m')='05','Mayo',
										IF(DATE_FORMAT(NOW(),'%m')='06','Junio',
											IF(DATE_FORMAT(NOW(),'%m')='07','Julio',
												IF(DATE_FORMAT(NOW(),'%m')='08','Agosto',
													IF(DATE_FORMAT(NOW(),'%m')='09','Septiembre',
														IF(DATE_FORMAT(NOW(),'%m')='10','Octubre',
															IF(DATE_FORMAT(NOW(),'%m')='11','Noviembre',
																IF(DATE_FORMAT(NOW(),'%m')='12','Diciembre','')
																)
															)
														)
													)
												)
											)
										)
									)
								)
							)
						),' ',DATE_FORMAT(NOW(),'%Y'),'.-'
					) AS FECHA_ACTUAL,
				CONCAT(
					DATE_FORMAT(DENUNCIO.`FECHA_LIMITE`,'%d'),' de ',
					IF(DATE_FORMAT(DENUNCIO.`FECHA_LIMITE`,'%m')='01','Enero',	
						IF(DATE_FORMAT(DENUNCIO.`FECHA_LIMITE`,'%m')='02','Febrero',
							IF(DATE_FORMAT(DENUNCIO.`FECHA_LIMITE`,'%m')='03','Marzo',
								IF(DATE_FORMAT(DENUNCIO.`FECHA_LIMITE`,'%m')='04','Abril',
									IF(DATE_FORMAT(DENUNCIO.`FECHA_LIMITE`,'%m')='05','Mayo',
										IF(DATE_FORMAT(DENUNCIO.`FECHA_LIMITE`,'%m')='06','Junio',
											IF(DATE_FORMAT(DENUNCIO.`FECHA_LIMITE`,'%m')='07','Julio',
												IF(DATE_FORMAT(DENUNCIO.`FECHA_LIMITE`,'%m')='08','Agosto',
													IF(DATE_FORMAT(DENUNCIO.`FECHA_LIMITE`,'%m')='09','Septiembre',
														IF(DATE_FORMAT(DENUNCIO.`FECHA_LIMITE`,'%m')='10','Octubre',
															IF(DATE_FORMAT(DENUNCIO.`FECHA_LIMITE`,'%m')='11','Noviembre',
																IF(DATE_FORMAT(DENUNCIO.`FECHA_LIMITE`,'%m')='12','Diciembre','')
																)
															)
														)
													)
												)
											)
										)
									)
								)
							)
						),' ',DATE_FORMAT(DENUNCIO.`FECHA_LIMITE`,'%Y'),''
					) AS FECHA_LIMITE,
					CONCAT(
						DATE_FORMAT(DENUNCIO.`FECHA_INFRACCION`,'%d'),' de ',
						IF(DATE_FORMAT(DENUNCIO.`FECHA_INFRACCION`,'%m')='01','Enero',	
							IF(DATE_FORMAT(DENUNCIO.`FECHA_INFRACCION`,'%m')='02','Febrero',
								IF(DATE_FORMAT(DENUNCIO.`FECHA_INFRACCION`,'%m')='03','Marzo',
									IF(DATE_FORMAT(DENUNCIO.`FECHA_INFRACCION`,'%m')='04','Abril',
										IF(DATE_FORMAT(DENUNCIO.`FECHA_INFRACCION`,'%m')='05','Mayo',
											IF(DATE_FORMAT(DENUNCIO.`FECHA_INFRACCION`,'%m')='06','Junio',
												IF(DATE_FORMAT(DENUNCIO.`FECHA_INFRACCION`,'%m')='07','Julio',
													IF(DATE_FORMAT(DENUNCIO.`FECHA_INFRACCION`,'%m')='08','Agosto',
														IF(DATE_FORMAT(DENUNCIO.`FECHA_INFRACCION`,'%m')='09','Septiembre',
															IF(DATE_FORMAT(DENUNCIO.`FECHA_INFRACCION`,'%m')='10','Octubre',
																IF(DATE_FORMAT(DENUNCIO.`FECHA_INFRACCION`,'%m')='11','Noviembre',
																	IF(DATE_FORMAT(DENUNCIO.`FECHA_INFRACCION`,'%m')='12','Diciembre','')
																	)
																)
															)
														)
													)
												)
											)
										)
									)
								)
							),' DE ',DATE_FORMAT(DENUNCIO.`FECHA_INFRACCION`,'%Y'),''
						) AS FECHA_DENUNCIO,
				DENUNCIO.`HORA_INFRACCION` AS HORA_INFRACCION,
		INSPECTOR.`NOMBRE_INSPECTOR`,
	    INSP_A_CARGO.`NOMBRE_INSPECTOR_A_CARGO`
		FROM `denuncio` DENUNCIO
		LEFT JOIN `sector` SECTOR
		ON(DENUNCIO.`ID_SECTOR`=SECTOR.`ID_SECTOR`)
		LEFT JOIN `infractor` INFRACTOR
		ON(DENUNCIO.`ID_INFRACTOR`=INFRACTOR.`ID_INFRACTOR`)
		LEFT JOIN `talonario` TALONARIO
		ON(DENUNCIO.`ID_TALONARIO`=TALONARIO.`ID_TALONARIO`) 
		LEFT JOIN `tipo_vehiculo` TIPO_VEHICULO
		ON(DENUNCIO.`ID_TIPO_VEHICULO`=TIPO_VEHICULO.`ID_TIPO_VEHICULO`)
		LEFT JOIN `marca` MARCA
		ON(DENUNCIO.`ID_MARCA`=MARCA.`ID_MARCA`)
		INNER JOIN `juzgado` JUZGADO
		ON(JUZGADO.`ID_JUZGADO`=DENUNCIO.`ID_JUZGADO`)
		INNER JOIN `inspector` INSPECTOR
		ON(INSPECTOR.`ID_INSPECTOR`=DENUNCIO.`ID_INSPECTOR`)
		INNER JOIN `inspector_a_cargo` INSP_A_CARGO
		ON(INSP_A_CARGO.`ID_INSPECTOR_A_CARGO`=INSPECTOR.`ID_INSPECTOR_A_CARGO`)
		WHERE DENUNCIO.`ID_DENUNCIO` = ".$id_denuncio;
$conexion = new Database();
$conexion->ejecutar_query($sql);
$registros = $conexion->listar($sql);
foreach($registros as $datos){
	$articulo = $datos['ARTICULO_LEY'];
	$ley = $datos['NUMERO_LEY'];
	$numero_parte = $datos['ID_DENUNCIO'];
	$nombre_juzgado = $datos['NOMBRE_JUZGADO'];
	$numero_juzgado = $datos['NUMERO_JUZGADO'];
	$fecha_actual = $datos['FECHA_ACTUAL'];
	$fecha_limite = $datos['FECHA_LIMITE'];
	$fecha_denuncio = $datos['FECHA_DENUNCIO'];
	$hora_infraccion = $datos['HORA_INFRACCION'];
	$motivo_infraccion = $datos['MOTIVO_INFRACCION'];
	$numero_boleta = $datos['NUMERO_BOLETA_TALONARIO'];
	$lugar = $datos['LUGAR_INFRACCION'];
	$nombre_infractor = $datos['NOMBRE_INFRACTOR'];
	$rut_infractor = $datos['RUT_INFRACTOR'];
	$direccion_infractor = $datos['DIRECCION_INFRACTOR'];
	$es_empresa = $datos['ES_EMPRESA'];
	
	$patente_vehiculo = $datos['PATENTE_AUTO'];
	$color_vehiculo = $datos['COLOR_AUTO'];
	$tipo_vehiculo = $datos['TIPO_VEHICULO'];
	$nombre_marca = $datos['NOMBRE_MARCA'];
	$observacion = $datos['OBSERVACIONES_DENUNCIO'];
	$nombre_inspector = $datos['NOMBRE_INSPECTOR'];
	$inspector_supervisor = $datos['NOMBRE_INSPECTOR_A_CARGO'];
	$NOMBRE_SECTOR = $datos['NOMBRE_SECTOR'];
}
?>
	<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>
	<style>
		body{
			font-size: 18px;
			min-width: 795px;
			width: 795px;
			min-height: 1023px;
			max-width: 795px;
			max-height: 1023px;
			height: 1023px;
		}
		#tabla_denuncio{
			min-width: 795px;
			width: 795px;
			max-width: 795px;
		}
		#logo{
			height: 150px;
			float: left;
		}
		#fila_logo{
			max-height: 150px;
			min-height: 150px;
			height: 150px;
		}
		#fila_encabezado_ley{
			    height: 30px;
				max-height: 30px;
				text-align: right;
		}
		.altura_minima{
			text-align: justify;
			height: 30px;
		}
		.derecha{
			float: right;
		}
		.izquierda{
			float: left;
		}
		.centro{
			float: center;
		}
		.justificado{
			text-align: justify;
		}
		.firma_del_medio{
			    left: 260px;
				position: absolute;
		}
		footer{
			 position: relative;
			  margin-top: 53px; /* ponga en negativo el alto de su pie de página para nuestro    ejemplo usamos 63, usted debe remplazarlo según su diseño   */
			  height: 63px;
			  clear:both;
			  width:100%;
		}
		@page {
		  size: letter; 
		  margin: 10%;
		}
	</style>
	<body>
		<img src="Municipalidad de Coquimbo_logo.jpg" id="logo">
		<br>
		<br>
		<br>
		<br>
		<br>
		<div class="derecha"><?php echo 'DA CUENTA INF.ART. '.$articulo.' LEY '.$ley.''; ?></div>
		<br>
		<br>
		<div class="derecha"><?php echo 'PARTE '; ?> <strong><?php echo 'N° _________/ '.$numero_juzgado.'° J.P.L.'; ?></strong></div>
		<br>
		<br>
		<div class="derecha"><?php echo utf8_encode('Coquimbo, '.$fecha_actual); ?></div>
		<br>
		<br>
		<div class="justificado">
			<?php echo 'AL '.$nombre_juzgado.' JUZGADO DE POLICIA LOCAL DE COQUIMBO DOY CUENTA A US., QUE EN <strong>'.strtoupper($fecha_denuncio).'</strong> A LAS,';?> <strong><?php echo $hora_infraccion; ?> HRS.</strong>
		</div>
		<br>
		<br>
		<div class="justificado">
			<?php echo 'SE SORPORENDIÓ Y NOTIFICÓ LA SIGUIENTE INFRACCIÓN:'; ?> <strong><?php echo $motivo_infraccion; ?></strong>
		</div>
		<br>
		<br>
		<div class="izquierda">
			SE NOTIFICA DENUNCIO A JUZGADO DE POLICIA LOCAL N° <strong><?php echo $numero_boleta; ?></strong>
		</div>
		<br>
		<br>
		<div class="izquierda">
			LUGAR DE LA INFRACCIÓN: <strong><?php echo $lugar.', '.$NOMBRE_SECTOR; ?>.</strong>
		</div>
		<br>
		<br>
		<table id="tabla_denuncio" border="0">
			<tr class="altura_minima">
				<td>
					<br>
					NOMBRE: <strong><?php echo $nombre_infractor; ?></strong>
				</td>
				<td>
					<br>
					RUT: <strong><?php echo $rut_infractor;?></strong>
				</td>
			</tr>
			<tr class="altura_minima">
				<td colspan="2">
					<br>
					DIRECCIÓN: <strong><?php echo $direccion_infractor;?></strong>
				</td>
			</tr>
			<tr class="altura_minima">
				<td>
					<br>
					VEHIC. PLACA: <strong><?php echo $patente_vehiculo; ?></strong>
				</td>
				<td>
					<br>
					TIPO: <strong><?php echo $tipo_vehiculo; ?></strong>
				</td>
			</tr>
			<tr class="altura_minima">
				<td>
					<br>
					MARCA: <strong><?php echo $nombre_marca; ?></strong>
				</td>
				<td>
					<br>
					COLOR: <strong><?php echo $color_vehiculo; ?></strong>
				</td>
			</tr>
		</table>
		<br>
		<div class="justificado">
			OBSERVACIONES: <strong><?php echo $observacion;?></strong>
		</div>
		<br>
		<div class="justificado">
		<?php echo 'El denunciado quedó citado para comparecer a la audiencia del '.ucwords(strtolower($nombre_juzgado)).' Juzgado de Policía Local el día <strong>'.$fecha_limite.'</strong> a las <strong>10:00 Hrs</strong>., con sus respectivos testigos y demás medios de prueba, bajo apercibimiento de proceder en su rebeldía.'; ?>
		</div>
		<br>
		<br>
		<center>
			Testigos de la Infracción
		</center>
		<br>
		<footer>
			<div class="izquierda" style="text-align: center; margin-left:90px; position:absolute;">
				<strong>
					<?php echo $nombre_inspector; ?>
					<br>
					INSPECTOR MUNICIPAL
				</strong>
			</div>
			
			<div class="derecha" style="text-align: center; position:absolute; float:right; right:0px;">
				<strong>
					RODRIGO LETELIER TRIGO
					<br>
					COORD. DEPTO. INSPECCION MUNICIPAL
				</strong>
			</div>
            <br />
            <br />
            <br />
            <div class="izquierda" style="text-align: center; position:absolute; left:0px;">
            	<br />
                <br />
				<strong>
					<?php echo $inspector_supervisor; ?>
				</strong>
			</div>
		</footer>
	</body>
</html>
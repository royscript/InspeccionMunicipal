<?php
include_once("../modelo/conexion.php");
$conexion = new Database();
if(isset($_GET['accion'])){ 
	if($_GET['accion']=='mapa_especial'){
		if($_GET['tipo_de_locales']=='LOCALES CON EXPENDIO DE BEBIDAS ALCOHOLICAS'){
				$sql = "SELECT  
				DISTINCT(
				CONCAT(EI.`RUT_EMPRESAS_A_INTERVENIR`,' ',DE.`CALLE_DIRECCION_EMPRESA`,' ',`NUMERO_DIRECCION_EMPRESA`,' ',`SECTOR_DIRECCION_EMPRESA`)
				),
							EI.`RUT_EMPRESAS_A_INTERVENIR`,
							EI.`NOMBRE_EMPRESAS_A_INTERVENIR`,
							EI.`NOMBRE_FANTASIA_EMPRESAS_A_INTERVENIR`,
							EI.`NOMBRE_ADMINISTRADOR_EMPRESAS_A_INTERVENIR`,
							EI.`RUT_ADMINISTRADOR_EMPRESAS_A_INTERVENIR`,
							EI.`MONTO_EMPRESAS_A_INTERVENIR`,
							EI.`FECHA_REGISTRO_EMPRESAS_A_INTERVENIR`,
							CE.`ID_CATEGORIA_DE_LA_EMPRESA`,
							EI.ID_EMPRESAS_A_INTERVENIR
					FROM EMPRESAS_A_INTERVENIR EI 
					INNER JOIN `CATEGORIA_DE_LA_EMPRESA` CE 
					ON(EI.`ID_EMPRESAS_A_INTERVENIR`=CE.`ID_EMPRESAS_A_INTERVENIR`) 
					INNER JOIN `DIRECCION_EMPRESA` DE 
					ON(CE.`ID_CATEGORIA_DE_LA_EMPRESA`=DE.`ID_CATEGORIA_DE_LA_EMPRESA`) 
					INNER JOIN `ESTADO_LEGAL` EL 
					ON(EI.`ID_EMPRESAS_A_INTERVENIR`=EL.`ID_EMPRESAS_A_INTERVENIR`)
	WHERE CE.`ID_CATEGORIA_EMPRESA` BETWEEN 1 AND 21
					";
			$registros = $conexion->listar($sql);
			$json = array();
			foreach($registros as $datos){
				$consultar_categoria = "SELECT CDE.`ID_CATEGORIA_DE_LA_EMPRESA`,
											   CDE.`ID_CATEGORIA_EMPRESA`,
											   CONCAT(CDE.`ROL_CATEGORIA_DE_LA_EMPRESA`,' ',CE.`NOMBRE_CATEGORIA_EMPRESA`,' ',CE.`DESCRIPCION_CATEGORIA_EMPRESA`) AS ROL_CATEGORIA_DE_LA_EMPRESA,
											   CDE.`ESTADO_CATEGORIA_DE_LA_EMPRESA`,
											   CDE.`FECHA_REGISTRO_CATEGORIA_DE_LA_EMPRESA`
										FROM `CATEGORIA_DE_LA_EMPRESA` CDE
										INNER JOIN `CATEGORIA_EMPRESA` CE
										ON(CDE.`ID_CATEGORIA_EMPRESA`=CE.`ID_CATEGORIA_EMPRESA`)
										WHERE CDE.`ID_EMPRESAS_A_INTERVENIR`= ".$datos['ID_EMPRESAS_A_INTERVENIR'];
				$registros_categoria = $conexion->listar($consultar_categoria);
				$json_categoria = array();
				foreach($registros_categoria as $datos_categoria){
					
					$consultar_direcciones = "SELECT `CALLE_DIRECCION_EMPRESA`,
												   `NUMERO_DIRECCION_EMPRESA`,
												   `DETALLE_DIRECCION_EMPRESA`,
												   `ESTADO_DIRECCION_EMPRESA`,
												   `FECHA_REGISTRO_DIRECCION_EMPRESA`,
												   `LATITUD_DIRECCION_EMPRESA`,
												   `LONGITUD_DIRECCION_EMPRESA`,
												   `SECTOR_DIRECCION_EMPRESA`,
												   `ID_DIRECCION_EMPRESA`
											FROM `DIRECCION_EMPRESA` 
											WHERE `ID_CATEGORIA_DE_LA_EMPRESA` = ".$datos_categoria['ID_CATEGORIA_DE_LA_EMPRESA'];
					$registros_direcciones = $conexion->listar($consultar_direcciones);
					$json_direcciones = array();
					foreach($registros_direcciones as $datos_direcciones){
						$consultar_estado_legal = "SELECT `LEY_ESTADO_LEGAL`,
														   `ARTICULO_ESTADO_LEGAL`,
														   `ORDENANZA_ESTADO_LEGAL`,
														   `DETALLE_ESTADO_LEGAL`,
														   `ESTA_AL_DIA_ESTADO_LEGAL`,
														   DATE_FORMAT(`FECHA_ESTADO_LEGAL`,'%d-%m-%Y') FECHA_ESTADO_LEGAL
													FROM `ESTADO_LEGAL` 
													WHERE `ID_DIRECCION_EMPRESA` =  ".$datos_direcciones['ID_DIRECCION_EMPRESA']."
													ORDER BY `ID_ESTADO_LEGAL` DESC";
						$registros_estado_legal = $conexion->listar($consultar_estado_legal);
						$json_estado_legal = array();
						foreach($registros_estado_legal as $datos_estado_legal){
							$json_estado_legal[] = array(
								"ley"=>$datos_estado_legal['LEY_ESTADO_LEGAL'],
								"articulo"=>$datos_estado_legal['ARTICULO_ESTADO_LEGAL'],
								"ordenanza"=>$datos_estado_legal['ORDENANZA_ESTADO_LEGAL'],
								"detalle"=>$datos_estado_legal['DETALLE_ESTADO_LEGAL'],
								"esta_al_dia"=>$datos_estado_legal['ESTA_AL_DIA_ESTADO_LEGAL'],
								"fecha"=>$datos_estado_legal['FECHA_ESTADO_LEGAL']
							);
						}
						$json_direcciones[] = array(
							"calle"=>$datos_direcciones['CALLE_DIRECCION_EMPRESA'],
							"numero"=>$datos_direcciones['NUMERO_DIRECCION_EMPRESA'],
							"detalle"=>$datos_direcciones['DETALLE_DIRECCION_EMPRESA'],
							"estado"=>$datos_direcciones['ESTADO_DIRECCION_EMPRESA'],
							"fecha_registro"=>$datos_direcciones['FECHA_REGISTRO_DIRECCION_EMPRESA'],
							"latitud"=>$datos_direcciones['LATITUD_DIRECCION_EMPRESA'],
							"longitud"=>$datos_direcciones['LONGITUD_DIRECCION_EMPRESA'],
							"sector"=>$datos_direcciones['SECTOR_DIRECCION_EMPRESA'],
							"estado_legal"=>$json_estado_legal
						);
					}
					
					$json_categoria[] = array(
						"rol"=>$datos_categoria['ROL_CATEGORIA_DE_LA_EMPRESA'],
						"estado"=>$datos_categoria['ESTADO_CATEGORIA_DE_LA_EMPRESA'],
						"fecha_de_ingreso"=>$datos_categoria['FECHA_REGISTRO_CATEGORIA_DE_LA_EMPRESA'],
						"id_categoria_empresa"=>$datos_categoria['ID_CATEGORIA_EMPRESA'],
						"direcciones"=>$json_direcciones
					);
				}
				 
				
				$json[] = array(
					"rut"=>$datos['RUT_EMPRESAS_A_INTERVENIR'],
					"nombre"=>$datos['NOMBRE_EMPRESAS_A_INTERVENIR'],
					"nombre_de_fantasia"=>$datos['NOMBRE_FANTASIA_EMPRESAS_A_INTERVENIR'],
					"nombre_administrador"=>$datos['NOMBRE_ADMINISTRADOR_EMPRESAS_A_INTERVENIR'],
					"rut_administrador"=>$datos['RUT_ADMINISTRADOR_EMPRESAS_A_INTERVENIR'],
					"categoria"=>$json_categoria
				);
			}
			echo json_encode($json);
		}
	}
}else if(!isset($_GET['id_operativo'])){
	$sql = "SELECT * 
			FROM `empresa` 
			WHERE `LATITUD_EMPRESA` NOT LIKE ''
			AND `GIRO_EMPRESA` LIKE '%".$_GET['giro']."%'
			AND `GIRO_EMPRESA` NOT LIKE '%SIN VENTA DE ".$_GET['giro']."%'
			";
	$registros = $conexion->listar($sql);
	$json = array();
	foreach($registros as $datos){
		$json[] = array(
			"nombre"=>$datos['NOMBRE_EMPRESA'],
			"direccion"=>$datos['DIRECCION_EMPRESA'],
			"latitud"=>$datos['LATITUD_EMPRESA'],
			"longitud"=>$datos['LONGITUD_EMPRESA'],
			"giro"=>$datos['GIRO_EMPRESA'],
			"rut"=>$datos['RUT_EMPRESA'],
			"rol"=>$datos['ROL_EMPRESA']
		);
	}
	echo json_encode($json);
}else{
	$sql = "SELECT *
			FROM `empresas_momentaneas` 
			WHERE `LATITUD_EMPRESAS_MOMENTANEAS` NOT LIKE ''
			AND `LATITUD_EMPRESAS_MOMENTANEAS` IS NOT NULL
			";
	$registros = $conexion->listar($sql);
	$json = array();
	foreach($registros as $datos){
		$json[] = array(
			"nombre"=>$datos['NOMBRE_EMPRESAS_MOMENTANEAS'],
			"direccion"=>$datos['DIRECCION_EMPRESAS_MOMENTANEAS'],
			"latitud"=>$datos['LATITUD_EMPRESAS_MOMENTANEAS'],
			"longitud"=>$datos['LONGITUD_EMPRESAS_MOMENTANEAS'],
			"giro"=>$datos['GIRO_EMPRESAS_MOMENTANEAS'],
			"rut"=>$datos['RUT_EMPRESAS_MOMENTANEAS'],
			"rol"=>$datos['ROL_EMPRESAS_MOMENTANEAS']
		);
	}
	echo json_encode($json);

}
?>
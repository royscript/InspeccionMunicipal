<?php
include_once("conexion.php");
Class denuncios{
	//Atributos
	private $ID_DENUNCIO = null;
	private $ID_TALONARIO = null;
	private $ID_JUZGADO = null;
	private $ID_INSPECTOR = null;
	private $ID_SECTOR = null;
	private $ID_INFRACTOR = null;
	private $ID_TIPO_VEHICULO = null;
	private $ID_MARCA = null;//------
	private $NUMERO_BOLETA_TALONARIO = null;//---------
	private $FECHA_INFRACCION = null;//------------
	private $HORA_INFRACCION = null;
	private $LUGAR_INFRACCION = null;//-------
	private $PATENTE_AUTO = null;
	private $COLOR_AUTO = null;//----
	private $NUMERO_LEY = null;
	private $ARTICULO_LEY = null;
	private $FECHA_LIMITE = null;
	private $FORMA_DE_NOTIFICACION = null;
	private $MOTIVO_INFRACCION = null;
	private $OBSERVACIONES_DENUNCIO = null;
	private $nombre_tabla = 'denuncio';
	private $id_tabla = 'ID_DENUNCIO';
	
	//Constructor
	function __construct($ID_DENUNCIO,$ID_TALONARIO,$ID_JUZGADO,$ID_INSPECTOR,$ID_SECTOR,$ID_INFRACTOR,$ID_TIPO_VEHICULO,$ID_MARCA,$NUMERO_BOLETA_TALONARIO,$FECHA_INFRACCION,$HORA_INFRACCION,$LUGAR_INFRACCION,$PATENTE_AUTO,$COLOR_AUTO,$NUMERO_LEY,$ARTICULO_LEY,$FECHA_LIMITE,$FORMA_DE_NOTIFICACION,$MOTIVO_INFRACCION,$OBSERVACIONES_DENUNCIO) {
		$this->ID_DENUNCIO = $ID_DENUNCIO;
		$this->ID_TALONARIO = $ID_TALONARIO;
		$this->ID_JUZGADO = $ID_JUZGADO;
		$this->ID_INSPECTOR = $ID_INSPECTOR;
		$this->ID_SECTOR = $ID_SECTOR;
		$this->ID_INFRACTOR = $ID_INFRACTOR;
		$this->ID_TIPO_VEHICULO = $ID_TIPO_VEHICULO;
		$this->ID_MARCA = $ID_MARCA;
		$this->NUMERO_BOLETA_TALONARIO = $NUMERO_BOLETA_TALONARIO;
		$this->FECHA_INFRACCION = $FECHA_INFRACCION;
		$this->HORA_INFRACCION = $HORA_INFRACCION;
		$this->LUGAR_INFRACCION = $LUGAR_INFRACCION;
		$this->PATENTE_AUTO = $PATENTE_AUTO;
		$this->COLOR_AUTO = $COLOR_AUTO;
		$this->NUMERO_LEY = $NUMERO_LEY;
		$this->ARTICULO_LEY = $ARTICULO_LEY;
		$this->FECHA_LIMITE = $FECHA_LIMITE;
		$this->FORMA_DE_NOTIFICACION = $FORMA_DE_NOTIFICACION;
		$this->MOTIVO_INFRACCION = $MOTIVO_INFRACCION;
		$this->OBSERVACIONES_DENUNCIO = $OBSERVACIONES_DENUNCIO;
		//-------------Conexion-----
		$this->conexion = new Database();
	}
	
	//Funciones públicas
	public function crear($nombre_sector,$rut_infractor,$nombres_infractor,$direccion_infractor,$tipo_de_vehiculo,$nombre_marca,$ES_EMPRESA,$ROL_EMPRESA_INFRACCION){
		//---------------------QUE NO SE REPITA EL NUMERO DEL TALONARIO-----------------
		$sql_numero_talonario = "SELECT * FROM `denuncio` 
								 WHERE `NUMERO_BOLETA_TALONARIO` LIKE  '".$this->NUMERO_BOLETA_TALONARIO."'";
		$registros = $this->conexion->listar($sql_numero_talonario);
		if(count($registros)>0){//Si existe el sector se debe buscar el ID para capturarlo e ingresarlo
			return json_encode(array( 'Result' => "ERROR", 
						  'Message' => "<strong>El número de boleta del talonario se encuentra en uso, verifique en los registros ingresados." ));
		}
		//--------------------/QUE NO SE REPITA EL NUMERO DEL TALONARIO-----------------
		
		//------------------SECTOR----------------------
		$sql_sector = "SELECT * FROM `sector` WHERE REPLACE(`NOMBRE_SECTOR`,' ','') LIKE REPLACE('".$nombre_sector."',' ','')";
		$registros = $this->conexion->listar($sql_sector);
		$this->ID_SECTOR = null;
		if(count($registros)>0){//Si existe el sector se debe buscar el ID para capturarlo e ingresarlo
			foreach($registros as $datos_sql){
				$this->ID_SECTOR = $datos_sql['ID_SECTOR'];
			}
		}else{//Si no existe el sector se ingresa como nuevo sector y se rescata el ID
			$query = "INSERT INTO `sector` (`NOMBRE_SECTOR`)
						VALUES
						('".$nombre_sector."')";
			$query = $this->conexion->ejecutar_query($query);
			$this->ID_SECTOR = $this->conexion->ultimo_id();
		}
		//--------------------/SECTOR--------------------
		
		//---------------------TALONARIO-----------------
		$sql_talonario = "SELECT * 
							FROM  `talonario` 
							WHERE ".$this->NUMERO_BOLETA_TALONARIO." 
							BETWEEN  `NUMERO_INICIAL` 
							AND  `NUMERO_FINAL` ";
		$registros = $this->conexion->listar($sql_talonario);
		$this->ID_TALONARIO = null;
		if(count($registros)==1){//Si existe el sector se debe buscar el ID para capturarlo e ingresarlo
			foreach($registros as $datos_sql){
				$this->ID_TALONARIO = $datos_sql['ID_TALONARIO'];
			}
		}else{//Si no existe el sector se ingresa como nuevo sector y se rescata el ID
			return json_encode(array( 'Result' => "ERROR", 
						  'Message' => "<strong>El número de talonario no se encuentra asociado a ningún talonario </strong>. Verifique que el talonario se encuentre registrado previo al ingreso de la notificación." ));
		}
		//--------------------/TALONARIO-----------------
		
		//---------------------INFRACTOR----------------------
		$sql_infractor = "SELECT * FROM `infractor` WHERE REPLACE(REPLACE(`RUT`,'.',''),' ','') LIKE REPLACE(REPLACE('".$rut_infractor."','.',''),' ','')";
		$registros = $this->conexion->listar($sql_infractor);
		$this->ID_INFRACTOR = null;
		if(count($registros)>0){//Si existe el sector se debe buscar el ID para capturarlo e ingresarlo
			foreach($registros as $datos_sql){
				$this->ID_INFRACTOR = $datos_sql['ID_INFRACTOR'];
				$sql_infractor_v2 = "SELECT * 
									FROM `infractor` 
									WHERE REPLACE(REPLACE(`RUT`,'.',''),' ','') LIKE REPLACE(REPLACE('".$rut_infractor."','.',''),' ','')
									AND `NOMBRES` LIKE '".$nombres_infractor."'
									AND `DIRECCION` LIKE '".$direccion_infractor."'
									AND `ES_EMPRESA` LIKE '".$ES_EMPRESA."' ";
				$registros_sql_v2 = $this->conexion->listar($sql_infractor_v2);
				if(count($registros_sql_v2)>0){//--Si es mayor a 0 es porque se maneja la misma información
				
				}else{//Si no está la misma información es porque algo cambió
					$query = "UPDATE `infractor` SET
								`NOMBRES` = '".$nombres_infractor."',
								`DIRECCION` = '".$direccion_infractor."',
								`ES_EMPRESA` = '".$ES_EMPRESA."'
							  WHERE `ID_INFRACTOR` = ".$this->ID_INFRACTOR;
					$query = $this->conexion->ejecutar_query($query);
				}
			}
		}else{//Si no existe el sector se ingresa como nuevo sector y se rescata el ID
			$query = "INSERT INTO `infractor` (`NOMBRES`,`RUT`,`DIRECCION`,`ES_EMPRESA`)
						VALUES 
						('".$nombres_infractor."','".$rut_infractor."','".$direccion_infractor."','".$ES_EMPRESA."')";
			$query = $this->conexion->ejecutar_query($query);
			$this->ID_INFRACTOR = $this->conexion->ultimo_id();
		}
		//--------------------/INFRACTOR----------------------
		
		//---------------------TIPO DE VEHICULO-----------------
		if($tipo_de_vehiculo==''){
			$this->ID_TIPO_VEHICULO = 'NULL';
		}else{
			$sql_tipo_de_vehiculo = "SELECT * FROM `tipo_vehiculo` WHERE `NOMBRE_TIPO_VEHICULO` LIKE '".$tipo_de_vehiculo."'";
			$registros = $this->conexion->listar($sql_tipo_de_vehiculo);
			$this->ID_TIPO_VEHICULO = null;
			if(count($registros)==1){//Si existe el sector se debe buscar el ID para capturarlo e ingresarlo
				foreach($registros as $datos_sql){
					$this->ID_TIPO_VEHICULO = $datos_sql['ID_TIPO_VEHICULO'];
				}
			}else{//Si no existe el sector se ingresa como nuevo sector y se rescata el ID
				$query = "INSERT INTO `tipo_vehiculo` (`NOMBRE_TIPO_VEHICULO`)
							VALUES 
							('".$tipo_de_vehiculo."')";
				$query = $this->conexion->ejecutar_query($query);
				$this->ID_TIPO_VEHICULO = $this->conexion->ultimo_id();
			}
		}
		//--------------------/TIPO DE VEHICULO-----------------
		
		//---------------------MARCA-----------------
		if($nombre_marca==''){
			$this->ID_MARCA = 'NULL';
		}else{
			$sql_tipo_de_vehiculo = "SELECT * FROM `marca` WHERE `NOMBRE_MARCA` LIKE '".$nombre_marca."'";
			$registros = $this->conexion->listar($sql_tipo_de_vehiculo);
			$this->ID_MARCA = null;
			if(count($registros)==1){//Si existe el sector se debe buscar el ID para capturarlo e ingresarlo
				foreach($registros as $datos_sql){
					$this->ID_MARCA = $datos_sql['ID_MARCA'];
				}
			}else{//Si no existe el sector se ingresa como nuevo sector y se rescata el ID
				$query = "INSERT INTO `marca` (`NOMBRE_MARCA`)
							VALUES 
							('".$nombre_marca."')";
				$query = $this->conexion->ejecutar_query($query);
				$this->ID_MARCA = $this->conexion->ultimo_id();
			}
		}
		//--------------------MARCA-----------------
		
		if($this->ID_TIPO_VEHICULO == 0){
			$this->ID_TIPO_VEHICULO = 'NULL';
		}
		if($this->ID_MARCA == 0){
			$this->ID_MARCA = 'NULL';
		}
		//----INGRESAR EL DENUNCIO
		$ingreso_denuncio = "INSERT INTO `denuncio` 
						(`ID_TALONARIO`,`ID_JUZGADO`,`ID_INSPECTOR`,`ID_SECTOR`,
						`ID_INFRACTOR`,`ID_TIPO_VEHICULO`,`ID_MARCA`,
						`NUMERO_BOLETA_TALONARIO`,`FECHA_INFRACCION`,`HORA_INFRACCION`,
						`LUGAR_INFRACCION`,`PATENTE_AUTO`,`COLOR_AUTO`,
						`NUMERO_LEY`,`ARTICULO_LEY`,`FECHA_LIMITE`,
						`FORMA_DE_NOTIFICACION`,`MOTIVO_INFRACCION`,`OBSERVACIONES_DENUNCIO`,`ID_USUARIO`,`ROL_EMPRESA_INFRACCION`)
				VALUES
				('".$this->ID_TALONARIO."','".$this->ID_JUZGADO."','".$this->ID_INSPECTOR."','".$this->ID_SECTOR."',
				'".$this->ID_INFRACTOR."','".$this->ID_TIPO_VEHICULO."','".$this->ID_MARCA."',
				'".$this->NUMERO_BOLETA_TALONARIO."',STR_TO_DATE(REPLACE('".$this->FECHA_INFRACCION."','-','.') ,GET_FORMAT(date,'EUR')),'".$this->HORA_INFRACCION."',
				'".$this->LUGAR_INFRACCION."','".$this->PATENTE_AUTO."','".$this->COLOR_AUTO."',
				'".$this->NUMERO_LEY."','".$this->ARTICULO_LEY."',
				STR_TO_DATE(REPLACE('".$this->FECHA_LIMITE."','-','.') ,GET_FORMAT(date,'EUR')),'".$this->FORMA_DE_NOTIFICACION."','".$this->MOTIVO_INFRACCION."','".$this->OBSERVACIONES_DENUNCIO."','".$_SESSION['usuario']."','".$ROL_EMPRESA_INFRACCION."')";
		$query = $this->conexion->ejecutar_query($ingreso_denuncio);
		
		return $this->devolver_datos_tabla($query);
		
	}
	
	public function modificar($nombre_sector,$rut_infractor,$nombres_infractor,$direccion_infractor,$tipo_de_vehiculo,$nombre_marca,$ES_EMPRESA,$ID_USUARIO,$ROL_EMPRESA_INFRACCION){
		if($_SESSION['usuario']==$ID_USUARIO){//Si el usuario actual no es el que registró el denuncio no podrá modificarlo
		}else{
			return json_encode(array( 'Result' => "ERROR", 
						  'Message' => "<strong>Usted no ingresó este denuncio, porlotanto no puede modificarlo ni eliminarlo." ));
		}
		//---------------------QUE NO SE REPITA EL NUMERO DEL TALONARIO-----------------
		$sql_numero_talonario = "SELECT * FROM `denuncio` 
								 WHERE `NUMERO_BOLETA_TALONARIO` LIKE  '".$this->NUMERO_BOLETA_TALONARIO."' 
								 AND `ID_DENUNCIO` NOT LIKE '".$this->ID_DENUNCIO."'";
		$registros = $this->conexion->listar($sql_numero_talonario);
		if(count($registros)>0){//Si existe el sector se debe buscar el ID para capturarlo e ingresarlo
			return json_encode(array( 'Result' => "ERROR", 
						  'Message' => "<strong>El número de boleta del talonario se encuentra en uso, verifique en los registros ingresados." ));
		}
		//--------------------/QUE NO SE REPITA EL NUMERO DEL TALONARIO-----------------
		
		//------------------SECTOR----------------------
		$sql_sector = "SELECT * FROM `sector` WHERE REPLACE(`NOMBRE_SECTOR`,' ','') LIKE REPLACE('".$nombre_sector."',' ','')";
		$registros = $this->conexion->listar($sql_sector);
		$this->ID_SECTOR = null;
		if(count($registros)>0){//Si existe el sector se debe buscar el ID para capturarlo e ingresarlo
			foreach($registros as $datos_sql){
				$this->ID_SECTOR = $datos_sql['ID_SECTOR'];
			}
		}else{//Si no existe el sector se ingresa como nuevo sector y se rescata el ID
			$query = "INSERT INTO `sector` (`NOMBRE_SECTOR`)
						VALUES
						('".$nombre_sector."')";
			$query = $this->conexion->ejecutar_query($query);
			$this->ID_SECTOR = $this->conexion->ultimo_id();
		}
		//--------------------/SECTOR--------------------
		
		//---------------------TALONARIO-----------------
		$sql_talonario = "SELECT * 
							FROM  `talonario` 
							WHERE ".$this->NUMERO_BOLETA_TALONARIO." 
							BETWEEN  `NUMERO_INICIAL` 
							AND  `NUMERO_FINAL` ";
		$registros = $this->conexion->listar($sql_talonario);
		$this->ID_TALONARIO = null;
		if(count($registros)==1){//Si existe el sector se debe buscar el ID para capturarlo e ingresarlo
			foreach($registros as $datos_sql){
				$this->ID_TALONARIO = $datos_sql['ID_TALONARIO'];
			}
		}else{//Si no existe el sector se ingresa como nuevo sector y se rescata el ID
			return json_encode(array( 'Result' => "ERROR", 
						  'Message' => "<strong>El número de talonario no se encuentra asociado a ningún talonario </strong>. Verifique que el talonario se encuentre registrado previo al ingreso de la notificación." ));
		}
		//--------------------/TALONARIO-----------------
		
		//---------------------INFRACTOR----------------------
		$sql_infractor = "SELECT * FROM `infractor` WHERE REPLACE(REPLACE(`RUT`,'.',''),' ','') LIKE REPLACE(REPLACE('".$rut_infractor."','.',''),' ','')";
		$registros = $this->conexion->listar($sql_infractor);
		$this->ID_INFRACTOR = null;
		if(count($registros)>0){//Si existe el sector se debe buscar el ID para capturarlo e ingresarlo
			foreach($registros as $datos_sql){
				$this->ID_INFRACTOR = $datos_sql['ID_INFRACTOR'];
				$sql_infractor_v2 = "SELECT * 
									FROM `infractor` 
									WHERE REPLACE(REPLACE(`RUT`,'.',''),' ','') LIKE REPLACE(REPLACE('".$rut_infractor."','.',''),' ','')
									AND `NOMBRES` LIKE '".$nombres_infractor."'
									AND `DIRECCION` LIKE '".$direccion_infractor."'
									AND `ES_EMPRESA` LIKE '".$ES_EMPRESA."' ";
				$registros_sql_v2 = $this->conexion->listar($sql_infractor_v2);
				if(count($registros_sql_v2)>0){//--Si es mayor a 0 es porque se maneja la misma información
				
				}else{//Si no está la misma información es porque algo cambió
					$query = "UPDATE `infractor` SET
								`NOMBRES` = '".$nombres_infractor."',
								`DIRECCION` = '".$direccion_infractor."',
								`ES_EMPRESA` = '".$ES_EMPRESA."'
							  WHERE `ID_INFRACTOR` = ".$this->ID_INFRACTOR;
					$query = $this->conexion->ejecutar_query($query);
				}
			}
		}else{//Si no existe el sector se ingresa como nuevo sector y se rescata el ID
			$query = "INSERT INTO `infractor` (`NOMBRES`,`RUT`,`DIRECCION`,`ES_EMPRESA`)
						VALUES 
						('".$nombres_infractor."','".$rut_infractor."','".$direccion_infractor."','".$ES_EMPRESA."')";
			$query = $this->conexion->ejecutar_query($query);
			$this->ID_INFRACTOR = $this->conexion->ultimo_id();
		}
		//--------------------/INFRACTOR----------------------
		
		//---------------------TIPO DE VEHICULO-----------------
		if($tipo_de_vehiculo==''){
			$this->ID_TIPO_VEHICULO = 'NULL';
		}else{
			$sql_tipo_de_vehiculo = "SELECT * FROM `tipo_vehiculo` WHERE `NOMBRE_TIPO_VEHICULO` LIKE '".$tipo_de_vehiculo."'";
			$registros = $this->conexion->listar($sql_tipo_de_vehiculo);
			$this->ID_TIPO_VEHICULO = null;
			if(count($registros)==1){//Si existe el sector se debe buscar el ID para capturarlo e ingresarlo
				foreach($registros as $datos_sql){
					$this->ID_TIPO_VEHICULO = $datos_sql['ID_TIPO_VEHICULO'];
				}
			}else{//Si no existe el sector se ingresa como nuevo sector y se rescata el ID
				$query = "INSERT INTO `tipo_vehiculo` (`NOMBRE_TIPO_VEHICULO`)
							VALUES 
							('".$tipo_de_vehiculo."')";
				$query = $this->conexion->ejecutar_query($query);
				$this->ID_TIPO_VEHICULO = $this->conexion->ultimo_id();
			}
		}
		//--------------------/TIPO DE VEHICULO-----------------
		
		//---------------------MARCA-----------------
		if($nombre_marca==''){
			$this->ID_MARCA = 'NULL';
		}else{
			$sql_tipo_de_vehiculo = "SELECT * FROM `marca` WHERE `NOMBRE_MARCA` LIKE '".$nombre_marca."'";
			$registros = $this->conexion->listar($sql_tipo_de_vehiculo);
			$this->ID_MARCA = null;
			if(count($registros)==1){//Si existe el sector se debe buscar el ID para capturarlo e ingresarlo
				foreach($registros as $datos_sql){
					$this->ID_MARCA = $datos_sql['ID_MARCA'];
				}
			}else{//Si no existe el sector se ingresa como nuevo sector y se rescata el ID
				$query = "INSERT INTO `marca` (`NOMBRE_MARCA`)
							VALUES 
							('".$nombre_marca."')";
				$query = $this->conexion->ejecutar_query($query);
				$this->ID_MARCA = $this->conexion->ultimo_id();
			}
		}
		//--------------------MARCA-----------------
		
		if($this->ID_TIPO_VEHICULO == 0){
			$this->ID_TIPO_VEHICULO = 'NULL';
		}
		if($this->ID_MARCA == 0){
			$this->ID_MARCA = 'NULL';
		}
		//----INGRESAR EL DENUNCIO
		$modificar_denuncio = "UPDATE `denuncio` SET
						    `ID_TALONARIO`='".$this->ID_TALONARIO."',
							`ID_JUZGADO`='".$this->ID_JUZGADO."',
							`ID_INSPECTOR`='".$this->ID_INSPECTOR."',
							`ID_SECTOR`='".$this->ID_SECTOR."',
							`ID_INFRACTOR`='".$this->ID_INFRACTOR."',
							`ID_TIPO_VEHICULO`='".$this->ID_TIPO_VEHICULO."',
							`ID_MARCA`='".$this->ID_MARCA."',
							`NUMERO_BOLETA_TALONARIO`='".$this->NUMERO_BOLETA_TALONARIO."',
							`FECHA_INFRACCION`=STR_TO_DATE(REPLACE('".$this->FECHA_INFRACCION."','-','.') ,GET_FORMAT(date,'EUR')),
							`HORA_INFRACCION`='".$this->HORA_INFRACCION."',
							`LUGAR_INFRACCION`='".$this->LUGAR_INFRACCION."',
							`PATENTE_AUTO`='".$this->PATENTE_AUTO."',
							`COLOR_AUTO`='".$this->COLOR_AUTO."',
							`NUMERO_LEY`='".$this->NUMERO_LEY."',
							`ARTICULO_LEY`='".$this->ARTICULO_LEY."',
							`FECHA_LIMITE`=STR_TO_DATE(REPLACE('".$this->FECHA_LIMITE."','-','.') ,GET_FORMAT(date,'EUR')),
							`FORMA_DE_NOTIFICACION`='".$this->FORMA_DE_NOTIFICACION."',
							`MOTIVO_INFRACCION`='".$this->MOTIVO_INFRACCION."',
							`OBSERVACIONES_DENUNCIO`='".$this->OBSERVACIONES_DENUNCIO."',
							`ROL_EMPRESA_INFRACCION`='".$ROL_EMPRESA_INFRACCION."'
							WHERE `ID_DENUNCIO` = ".$this->ID_DENUNCIO;
		$query = $this->conexion->ejecutar_query($modificar_denuncio);
		return $this->devolver_datos_tabla($query);
	}
	
	public function eliminar(){
		$consulta_id_denuncio="SELECT ID_USUARIO FROM `denuncio` WHERE `ID_DENUNCIO`='".$this->ID_DENUNCIO."'";
		$registros = $this->conexion->listar($consulta_id_denuncio);
		foreach($registros as $datos_sql){
			$ID_USUARIO = $datos_sql['ID_USUARIO'];
		}
		
		if($_SESSION['usuario']==$ID_USUARIO){//Si el usuario actual no es el que registró el denuncio no podrá modificarlo
		}else{
			return json_encode(array( 'Result' => "ERROR", 
						  'Message' => "<strong>Usted no ingresó este denuncio, porlotanto no puede modificarlo ni eliminarlo. Id usuario ".$_SESSION['usuario']." logeado, el Id necesario ".$ID_USUARIO )); 
		}
		$query="DELETE FROM `denuncio` WHERE `ID_DENUNCIO`='".$this->ID_DENUNCIO."'";
		$query = $this->conexion->ejecutar_query($query);
		return $this->devolver_datos_tabla($query);
	}
	
	public function mostrar($buscar_numero_boleta,
							$buscar_rut_infractor,
							$buscar_inspector,
							$buscar_usuario,
							$Fecha_inicio,
							$Fecha_final,
							$Hora_inicio,
							$Hora_final,
							$buscar_sector,
							$buscar_calle,
							$buscar_detalle_denuncio,
							$jtSorting,
							$jtStartIndex,
							$jtPageSize){
		if($buscar_detalle_denuncio!=''){
			$buscar_detalle_denuncio = ' DENUNCIO.`MOTIVO_INFRACCION` LIKE "%'.$buscar_detalle_denuncio.'%"';
		}else{
			$buscar_detalle_denuncio = ' 1 = 1 ';
		}
		if($buscar_calle!=''){
			$buscar_calle = ' AND DENUNCIO.`LUGAR_INFRACCION` LIKE "%'.$buscar_calle.'%"';
		}else{
			$buscar_calle = ' AND 1 = 1 ';
		}						
		if($buscar_sector!=''){
			$buscar_sector = ' AND DENUNCIO.`ID_SECTOR` = "'.$buscar_sector.'"';
		}else{
			$buscar_sector = ' AND 1 = 1 ';
		}
		if($Hora_inicio!='' && $Hora_final!=''){
			$Hora_inicio = ' AND DENUNCIO.`HORA_INFRACCION` BETWEEN "'.$Hora_inicio.'" AND "'.$Hora_final.'"';
		}else{
			$Hora_inicio = ' AND 1 = 1 ';
		}
		if($buscar_numero_boleta!=''){
			$buscar_numero_boleta = ' AND DENUNCIO.`NUMERO_BOLETA_TALONARIO` LIKE "'.$buscar_numero_boleta.'"';
		}else{
			$buscar_numero_boleta = ' AND 1 = 1 ';
		}
		if($buscar_rut_infractor!=''){
			$buscar_rut_infractor = ' AND REPLACE(REPLACE(INFRACTOR.`RUT`,".","")," ","") LIKE REPLACE(REPLACE("'.$buscar_rut_infractor.'",".","")," ","")';
		}else{
			$buscar_rut_infractor = ' AND 1 = 1 ';
		}
		if($buscar_inspector!=''){
			$buscar_inspector = ' AND DENUNCIO.`ID_INSPECTOR` = '.$buscar_inspector;
		}else{
			$buscar_inspector = ' AND 1 = 1 ';
		}
		if($buscar_usuario!=''){
			$buscar_usuario = ' AND DENUNCIO.`ID_USUARIO` = '.$buscar_usuario;
		}else{
			$buscar_usuario = ' AND 1 = 1 ';
		}
		if($Fecha_inicio!='' && $Fecha_final!=''){
			$Fecha_inicio = ' AND DENUNCIO.`FECHA_INFRACCION` BETWEEN "'.$Fecha_inicio.'" AND "'.$Fecha_final.'"';
		}else{
			$Fecha_inicio = ' AND 1 = 1 ';
		}
		//Se agreó LEFT JOIN A LA CONSULTA PORQUE AL
		//ALMACENAR LOS IDS QUE QUEDAN NULOS SE GUARDAN
		//COMO 0 EN VEZ DE NULOS Y AL CRUZAR TABLAS NO
		//PUEDEN MOSTRAR EL PRODUCTO CARTESIANO
		$campos = " DENUNCIO.*,
					   TALONARIO.`NOMBRE_TALONARIO`,
					   DENUNCIO.`ID_JUZGADO` AS ID_JUZGADO,
					   SECTOR.`NOMBRE_SECTOR` AS SECTOR,
					   INFRACTOR.`NOMBRES` AS NOMBRE_INFRACTOR,
					   INFRACTOR.`RUT` AS RUT_INFRACTOR,
					   INFRACTOR.`DIRECCION` AS DIRECCION_INFRACTOR,
					   INFRACTOR.`ES_EMPRESA` AS ES_EMPRESA,
					   TIPO_VEHICULO.`NOMBRE_TIPO_VEHICULO` AS TIPO_VEHICULO,
					   MARCA.`NOMBRE_MARCA` AS NOMBRE_MARCA ";
		$tablas = " `denuncio` DENUNCIO
					LEFT JOIN `sector` SECTOR
					ON(DENUNCIO.`ID_SECTOR`=SECTOR.`ID_SECTOR`)
					LEFT JOIN `infractor` INFRACTOR
					ON(DENUNCIO.`ID_INFRACTOR`=INFRACTOR.`ID_INFRACTOR`)
					LEFT JOIN `talonario` TALONARIO
					ON(DENUNCIO.`ID_TALONARIO`=TALONARIO.`ID_TALONARIO`) 
					LEFT JOIN `tipo_vehiculo` TIPO_VEHICULO
					ON(DENUNCIO.`ID_TIPO_VEHICULO`=TIPO_VEHICULO.`ID_TIPO_VEHICULO`)
					LEFT JOIN `marca` MARCA
					ON(DENUNCIO.`ID_MARCA`=MARCA.`ID_MARCA`) ";
		$clausulaWhere = " WHERE ".$buscar_detalle_denuncio.$buscar_calle.$buscar_sector.$Hora_inicio.$buscar_numero_boleta.$buscar_rut_infractor.$buscar_inspector.$buscar_usuario.$Fecha_inicio;
		$datos = $this->conexion->listarJtables($tablas,$campos,$clausulaWhere,$jtSorting,$jtStartIndex,$jtPageSize);
		$this->conexion->cerrarConexion();
		return $datos;
	}
	
	
	//Funciones privadas
	private function devolver_datos_tabla($resultado_query){
		$result = "SELECT * 
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
				  WHERE `".$this->id_tabla."` LIKE '".$this->conexion->ultimo_id()."'";
		if($resultado_query){
			$result = $this->conexion->consulta($result);
			$result = $this->conexion->extraer_registro();
			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			$jTableResult['Record'] = $result;
			$this->conexion->cerrarConexion();
		}else{
			$result = $this->conexion->consulta($result);
			$result = $this->conexion->extraer_registro();
			$jTableResult = array();
			$jTableResult['Result'] = "ERROR";
			$jTableResult['Record'] = $result;
			$this->conexion->cerrarConexion();
		}
		return json_encode($jTableResult);
	}
}
?>
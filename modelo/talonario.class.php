<?php
include_once("conexion.php");
Class talonario{
	//Atributos
	private $ID_TALONARIO = null;
	private $ID_INSPECTOR = null;
	private $NOMBRE_TALONARIO = null;
	private $NUMERO_INICIAL = null;
	private $NUMERO_FINAL = null;
	private $conexion = null;
	private $ID_INSPECTOR_tabla = 'talonario';
	private $id_tabla = 'ID_TALONARIO';
	
	//Constructor
	function __construct($ID_TALONARIO,$ID_INSPECTOR,$NOMBRE_TALONARIO,$NUMERO_INICIAL,$NUMERO_FINAL) {
		$this->ID_TALONARIO = $ID_TALONARIO;
		$this->ID_INSPECTOR = $ID_INSPECTOR;
		$this->NOMBRE_TALONARIO = $NOMBRE_TALONARIO;
		$this->NUMERO_INICIAL = $NUMERO_INICIAL;
		$this->NUMERO_FINAL = $NUMERO_FINAL;
		//-------------Conexion-----
		$this->conexion = new Database();
	}
	
	//Funciones públicas
	public function crear(){
		//--------------VALIDAR QUE NO SE TOPE CON OTRO TALONARIO--------------
		$sql_talonario = "SELECT * 
							FROM  `talonario` 
							WHERE ( ".$this->NUMERO_INICIAL." BETWEEN  `NUMERO_INICIAL` AND  `NUMERO_FINAL` )
							OR ( ".$this->NUMERO_FINAL." BETWEEN  `NUMERO_INICIAL` AND  `NUMERO_FINAL` )
							OR ( `NOMBRE_TALONARIO` LIKE '".$this->NOMBRE_TALONARIO."' )";
		$registros = $this->conexion->listar($sql_talonario);
		foreach($registros as $datos_sql){
			return json_encode(array( 'Result' => "ERROR", 
					  'Message' => "<strong>Los datos que registró del talonario pertenecen a otro talonario ya registrado." ));
		}
		
		//-------------/VALIDAR QUE NO SE TOPE CON OTRO TALONARIO--------------
		
		$query = "INSERT INTO `".$this->ID_INSPECTOR_tabla."`
				(`ID_INSPECTOR`,`NOMBRE_TALONARIO`,`NUMERO_INICIAL`,`NUMERO_FINAL`)
				VALUES
				('".$this->ID_INSPECTOR."','".$this->NOMBRE_TALONARIO."','".$this->NUMERO_INICIAL."','".$this->NUMERO_FINAL."')";
		$query = $this->conexion->ejecutar_query($query);
		return $this->devolver_datos_tabla($query);
		
	}
	
	public function modificar(){
		//--------------VALIDAR QUE NO SE TOPE CON OTRO TALONARIO--------------
		$sql_talonario = "SELECT * 
							FROM  `talonario` 
							WHERE (
									( ".$this->NUMERO_INICIAL." BETWEEN  `NUMERO_INICIAL` AND  `NUMERO_FINAL` )
									OR ( ".$this->NUMERO_FINAL." BETWEEN  `NUMERO_INICIAL` AND  `NUMERO_FINAL` )
									OR ( `NOMBRE_TALONARIO` LIKE '".$this->NOMBRE_TALONARIO."' )
							       )
							AND `ID_TALONARIO` NOT LIKE '".$this->ID_TALONARIO."'";
		$registros = $this->conexion->listar($sql_talonario);
		foreach($registros as $datos_sql){
			return json_encode(array( 'Result' => "ERROR", 
					  'Message' => "<strong>Los datos que registró del talonario pertenecen a otro talonario ya registrado." ));
		}
		
		//-------------/VALIDAR QUE NO SE TOPE CON OTRO TALONARIO--------------
		$query="UPDATE `".$this->ID_INSPECTOR_tabla."`
				SET
				`ID_INSPECTOR` = '".$this->ID_INSPECTOR."',
				`NOMBRE_TALONARIO` = '".$this->NOMBRE_TALONARIO."',
				`NUMERO_INICIAL` = '".$this->NUMERO_INICIAL."',
				`NUMERO_FINAL` = '".$this->NUMERO_FINAL."'
				WHERE `".$this->id_tabla."` = '".$this->ID_TALONARIO."'";
		$query = $this->conexion->ejecutar_query($query);
		return $this->devolver_datos_tabla($query);
	}
	
	public function eliminar(){
		//--------------VALIDAR QUE NO SE TOPE CON OTRO TALONARIO--------------
		$sql_talonario = "SELECT * FROM `denuncio` WHERE `ID_TALONARIO` =  ".$this->ID_TALONARIO." ";
		$registros = $this->conexion->listar($sql_talonario);
		foreach($registros as $datos_sql){
			return json_encode(array( 'Result' => "ERROR", 
					  'Message' => "<strong>El talonario tiene denuncios asociados, porlotanto no se puede borrar." ));
		}
		
		//-------------/VALIDAR QUE NO SE TOPE CON OTRO TALONARIO--------------
		$query="DELETE FROM `".$this->ID_INSPECTOR_tabla."` WHERE `".$this->id_tabla."`='".$this->ID_TALONARIO."'";
		$query = $this->conexion->ejecutar_query($query);
		return $this->devolver_datos_tabla($query);
	}
	
	public function mostrar($buscar_numero_talonario,$jtSorting,$jtStartIndex,$jtPageSize){
		if(!$buscar_numero_talonario==''){
			$buscar_numero_talonario = ' `NOMBRE_TALONARIO` LIKE "%'.$buscar_numero_talonario.'%"';
		}else{
			$buscar_numero_talonario = '1=1';
		}
		$campos = " T.*,
					(
						SELECT COUNT(*) FROM `denuncio` WHERE `ID_TALONARIO` = T.`ID_TALONARIO`
					) AS CANTIDAD_DENUNCIOS_REALIZADOS,
					(`NUMERO_FINAL` - `NUMERO_INICIAL`) AS CANTIDAD_DE_BOLETAS ";
		$tablas = " talonario T";
		$clausulaWhere = " WHERE ".$buscar_numero_talonario;
		$datos = $this->conexion->listarJtables($tablas,$campos,$clausulaWhere,$jtSorting,$jtStartIndex,$jtPageSize);
		$this->conexion->cerrarConexion();
		return $datos;
	}
	
	
	//Funciones privadas
	private function devolver_datos_tabla($resultado_query){
		$result = "SELECT * FROM `".$this->ID_INSPECTOR_tabla."` WHERE `".$this->id_tabla."` LIKE '".$this->conexion->ultimo_id()."'";
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
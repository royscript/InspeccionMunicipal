<?php
include_once("conexion.php");
Class localesDeLaEmpresa{
	//Atributos
	private $ID_DIRECCION_EMPRESA = null;
	private $ID_CATEGORIA_DE_LA_EMPRESA = null;
	private $CALLE_DIRECCION_EMPRESA = null;
	private $NUMERO_DIRECCION_EMPRESA = null;
	private $DETALLE_DIRECCION_EMPRESA = null;
	private $ESTADO_DIRECCION_EMPRESA = null;
	private $LATITUD_DIRECCION_EMPRESA = null;
	private $LONGITUD_DIRECCION_EMPRESA = null;
	private $SECTOR_DIRECCION_EMPRESA = null;
	private $conexion = null;
	private $nombre_tabla = 'DIRECCION_EMPRESA';
	private $id_tabla = 'ID_DIRECCION_EMPRESA';
	
	//Constructor
	function __construct($ID_DIRECCION_EMPRESA,$ID_CATEGORIA_DE_LA_EMPRESA,$CALLE_DIRECCION_EMPRESA,$NUMERO_DIRECCION_EMPRESA,$DETALLE_DIRECCION_EMPRESA,$ESTADO_DIRECCION_EMPRESA,$LATITUD_DIRECCION_EMPRESA,$LONGITUD_DIRECCION_EMPRESA,$SECTOR_DIRECCION_EMPRESA) {
		$this->ID_DIRECCION_EMPRESA = $ID_DIRECCION_EMPRESA;
		$this->ID_CATEGORIA_DE_LA_EMPRESA = $ID_CATEGORIA_DE_LA_EMPRESA;
		$this->CALLE_DIRECCION_EMPRESA = $CALLE_DIRECCION_EMPRESA;
		$this->NUMERO_DIRECCION_EMPRESA = $NUMERO_DIRECCION_EMPRESA;
		$this->DETALLE_DIRECCION_EMPRESA = $DETALLE_DIRECCION_EMPRESA;
		$this->ESTADO_DIRECCION_EMPRESA = $ESTADO_DIRECCION_EMPRESA;
		$this->LATITUD_DIRECCION_EMPRESA = $LATITUD_DIRECCION_EMPRESA;
		$this->LONGITUD_DIRECCION_EMPRESA = $LONGITUD_DIRECCION_EMPRESA;
		$this->SECTOR_DIRECCION_EMPRESA = $SECTOR_DIRECCION_EMPRESA;
		//-------------Conexion-----
		$this->conexion = new Database();
	}
	
	//Funciones públicas
	public function crear(){
		$query = "INSERT INTO `".$this->nombre_tabla."`
				(`ID_CATEGORIA_DE_LA_EMPRESA`,`CALLE_DIRECCION_EMPRESA`,
				 `NUMERO_DIRECCION_EMPRESA`,`DETALLE_DIRECCION_EMPRESA`,
				 `ESTADO_DIRECCION_EMPRESA`,`FECHA_REGISTRO_DIRECCION_EMPRESA`,
				 `LATITUD_DIRECCION_EMPRESA`,`LONGITUD_DIRECCION_EMPRESA`,
				 `SECTOR_DIRECCION_EMPRESA`)
				VALUES
				('".$this->ID_CATEGORIA_DE_LA_EMPRESA."','".$this->CALLE_DIRECCION_EMPRESA."',
				'".$this->NUMERO_DIRECCION_EMPRESA."','".$this->DETALLE_DIRECCION_EMPRESA."',
				'".$this->ESTADO_DIRECCION_EMPRESA."',NOW(),
				'".$this->LATITUD_DIRECCION_EMPRESA."','".$this->LONGITUD_DIRECCION_EMPRESA."',
				'".$this->SECTOR_DIRECCION_EMPRESA."')";
		$query = $this->conexion->ejecutar_query($query);
		return $this->devolver_datos_tabla($query);
		
	}
	
	public function modificar(){
		$query="UPDATE `".$this->nombre_tabla."`
				SET
				`ID_CATEGORIA_DE_LA_EMPRESA` = '".$this->ID_CATEGORIA_DE_LA_EMPRESA."',
				`CALLE_DIRECCION_EMPRESA` = '".$this->CALLE_DIRECCION_EMPRESA."',
				`NUMERO_DIRECCION_EMPRESA` = '".$this->NUMERO_DIRECCION_EMPRESA."',
				`DETALLE_DIRECCION_EMPRESA` = '".$this->DETALLE_DIRECCION_EMPRESA."',
				`ESTADO_DIRECCION_EMPRESA` = '".$this->ESTADO_DIRECCION_EMPRESA."',
				`FECHA_REGISTRO_DIRECCION_EMPRESA` = NOW(),
				LATITUD_DIRECCION_EMPRESA = '".$this->LATITUD_DIRECCION_EMPRESA."',
				LONGITUD_DIRECCION_EMPRESA = '".$this->LONGITUD_DIRECCION_EMPRESA."',
				SECTOR_DIRECCION_EMPRESA = '".$this->SECTOR_DIRECCION_EMPRESA."'
				WHERE `".$this->id_tabla."` = '".$this->ID_DIRECCION_EMPRESA."'";
		$query = $this->conexion->ejecutar_query($query);
		return $this->devolver_datos_tabla($query);
	}
	
	public function eliminar(){
		$query="DELETE FROM `".$this->nombre_tabla."` WHERE `".$this->id_tabla."`='".$this->ID_DIRECCION_EMPRESA."'";
		$query = $this->conexion->ejecutar_query($query);
		return $this->devolver_datos_tabla($query);
	}
	
	public function mostrar($id,$jtSorting,$jtStartIndex,$jtPageSize){
		$campos = " * ";
		$tablas = " DIRECCION_EMPRESA DE
		            INNER JOIN `CATEGORIA_DE_LA_EMPRESA` CE
					ON(DE.ID_CATEGORIA_DE_LA_EMPRESA=CE.ID_CATEGORIA_DE_LA_EMPRESA)
					INNER JOIN `EMPRESAS_A_INTERVENIR` EI
					ON(CE.ID_EMPRESAS_A_INTERVENIR=EI.ID_EMPRESAS_A_INTERVENIR)";
		$clausulaWhere = " WHERE EI.`ID_EMPRESAS_A_INTERVENIR` = ".$id;
		$datos = $this->conexion->listarJtables($tablas,$campos,$clausulaWhere,$jtSorting,$jtStartIndex,$jtPageSize);
		$this->conexion->cerrarConexion();
		return $datos;
	}
	
	
	//Funciones privadas
	private function devolver_datos_tabla($resultado_query){
		$result = "SELECT * FROM `".$this->nombre_tabla."` WHERE `".$this->id_tabla."` LIKE '".$this->conexion->ultimo_id()."'";
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
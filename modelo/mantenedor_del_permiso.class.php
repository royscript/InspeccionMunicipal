<?php
include_once("conexion.php");
Class mantenedor_del_permiso{
	//Atributos
	private $ID_MANTENEDOR_DEL_PERMISO = null;
	private $ID_MANTENEDOR = null;
	private $ID_PERMISO = null;
	private $LISTAR_MANTENEDOR_DEL_PERMISO = null;
	private $INGRESAR_MANTENEDOR_DEL_PERMISO = null;
	private $MODIFICAR_MANTENEDOR_DEL_PERMISO = null;
	private $ELIMINAR_MANTENEDOR_DEL_PERMISO = null;
	private $conexion = null;
	private $nombre_tabla = 'mantenedor_del_permiso';
	private $id_tabla = 'ID_MANTENEDOR_DEL_PERMISO';
	
	//Constructor
	function __construct($ID_MANTENEDOR_DEL_PERMISO,$ID_MANTENEDOR,$ID_PERMISO,$LISTAR_MANTENEDOR_DEL_PERMISO,$INGRESAR_MANTENEDOR_DEL_PERMISO,$MODIFICAR_MANTENEDOR_DEL_PERMISO,$ELIMINAR_MANTENEDOR_DEL_PERMISO) {
		$this->ID_MANTENEDOR_DEL_PERMISO = $ID_MANTENEDOR_DEL_PERMISO;
		$this->ID_MANTENEDOR = $ID_MANTENEDOR;
		$this->ID_PERMISO = $ID_PERMISO;
		$this->LISTAR_MANTENEDOR_DEL_PERMISO = $LISTAR_MANTENEDOR_DEL_PERMISO;
		$this->INGRESAR_MANTENEDOR_DEL_PERMISO = $INGRESAR_MANTENEDOR_DEL_PERMISO;
		$this->MODIFICAR_MANTENEDOR_DEL_PERMISO = $MODIFICAR_MANTENEDOR_DEL_PERMISO;
		$this->ELIMINAR_MANTENEDOR_DEL_PERMISO = $ELIMINAR_MANTENEDOR_DEL_PERMISO;
		//-------------Conexion-----
		$this->conexion = new Database();
	}
	
	//Funciones públicas
	public function crear(){
		$query = "INSERT INTO `".$this->nombre_tabla."`
				(`ID_MANTENEDOR`,`ID_PERMISO`,
				`LISTAR_MANTENEDOR_DEL_PERMISO`,`INGRESAR_MANTENEDOR_DEL_PERMISO`,
				MODIFICAR_MANTENEDOR_DEL_PERMISO,ELIMINAR_MANTENEDOR_DEL_PERMISO)
				VALUES
				('".$this->ID_MANTENEDOR."','".$this->ID_PERMISO."',
				'".$this->LISTAR_MANTENEDOR_DEL_PERMISO."','".$this->INGRESAR_MANTENEDOR_DEL_PERMISO."',
				'".$this->MODIFICAR_MANTENEDOR_DEL_PERMISO."','".$this->ELIMINAR_MANTENEDOR_DEL_PERMISO."')";
		$query = $this->conexion->ejecutar_query($query);
		return $this->devolver_datos_tabla($query);
		
	}
	
	public function modificar(){
		$query="UPDATE `".$this->nombre_tabla."`
				SET
				`ID_MANTENEDOR` = '".$this->ID_MANTENEDOR."',
				`ID_PERMISO` = '".$this->ID_PERMISO."',
				`LISTAR_MANTENEDOR_DEL_PERMISO` = '".$this->LISTAR_MANTENEDOR_DEL_PERMISO."',
				`INGRESAR_MANTENEDOR_DEL_PERMISO` = '".$this->INGRESAR_MANTENEDOR_DEL_PERMISO."',
				`MODIFICAR_MANTENEDOR_DEL_PERMISO` = '".$this->MODIFICAR_MANTENEDOR_DEL_PERMISO."',
				ELIMINAR_MANTENEDOR_DEL_PERMISO = '".$this->ELIMINAR_MANTENEDOR_DEL_PERMISO."'
				WHERE `".$this->id_tabla."` = '".$this->ID_MANTENEDOR_DEL_PERMISO."'";
		$query = $this->conexion->ejecutar_query($query);
		return $this->devolver_datos_tabla($query);
	}
	
	public function eliminar(){
		$query="DELETE FROM `".$this->nombre_tabla."` WHERE `".$this->id_tabla."`='".$this->ID_MANTENEDOR_DEL_PERMISO."'";
		$query = $this->conexion->ejecutar_query($query);
		return $this->devolver_datos_tabla($query);
	}
	
	public function mostrar($IdPermiso,$jtSorting,$jtStartIndex,$jtPageSize){
		$campos = " * ";
		$tablas = " mantenedor_del_permiso ";
		$clausulaWhere = " WHERE `ID_PERMISO` = ".$IdPermiso;
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
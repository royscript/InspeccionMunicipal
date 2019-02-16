<?php
include_once("conexion.php");
Class empresas{
	//Atributos
	private $ID_EMPRESAS_A_INTERVENIR = null;
	private $RUT_EMPRESAS_A_INTERVENIR = null;
	private $NOMBRE_EMPRESAS_A_INTERVENIR = null;
	private $NOMBRE_FANTASIA_EMPRESAS_A_INTERVENIR = null;
	private $NOMBRE_ADMINISTRADOR_EMPRESAS_A_INTERVENIR = null;
	private $RUT_ADMINISTRADOR_EMPRESAS_A_INTERVENIR = null;
	private $MONTO_EMPRESAS_A_INTERVENIR = null;
	private $conexion = null;
	private $nombre_tabla = 'EMPRESAS_A_INTERVENIR';
	private $id_tabla = 'ID_EMPRESAS_A_INTERVENIR';
	
	//Constructor
	function __construct($ID_EMPRESAS_A_INTERVENIR,$RUT_EMPRESAS_A_INTERVENIR,$NOMBRE_EMPRESAS_A_INTERVENIR,$NOMBRE_FANTASIA_EMPRESAS_A_INTERVENIR,$NOMBRE_ADMINISTRADOR_EMPRESAS_A_INTERVENIR,$RUT_ADMINISTRADOR_EMPRESAS_A_INTERVENIR,$MONTO_EMPRESAS_A_INTERVENIR) {
		$this->ID_EMPRESAS_A_INTERVENIR = $ID_EMPRESAS_A_INTERVENIR;
		$this->RUT_EMPRESAS_A_INTERVENIR = $RUT_EMPRESAS_A_INTERVENIR;
		$this->NOMBRE_EMPRESAS_A_INTERVENIR = $NOMBRE_EMPRESAS_A_INTERVENIR;
		$this->NOMBRE_FANTASIA_EMPRESAS_A_INTERVENIR = $NOMBRE_FANTASIA_EMPRESAS_A_INTERVENIR;
		$this->NOMBRE_ADMINISTRADOR_EMPRESAS_A_INTERVENIR = $NOMBRE_ADMINISTRADOR_EMPRESAS_A_INTERVENIR;
		$this->RUT_ADMINISTRADOR_EMPRESAS_A_INTERVENIR = $RUT_ADMINISTRADOR_EMPRESAS_A_INTERVENIR;
		$this->MONTO_EMPRESAS_A_INTERVENIR = $MONTO_EMPRESAS_A_INTERVENIR;
		//-------------Conexion-----
		$this->conexion = new Database();
	}
	
	//Funciones públicas
	public function crear(){
		//---------------------QUE NO SE REPITA LA EMPRESA-----------------
		$sql_empresa = "SELECT * FROM `EMPRESAS_A_INTERVENIR` 
								 WHERE `RUT_EMPRESAS_A_INTERVENIR` LIKE  '".$this->RUT_EMPRESAS_A_INTERVENIR."'";
		$registros = $this->conexion->listar($sql_empresa);
		if(count($registros)>0){//Si existe el sector se debe buscar el ID para capturarlo e ingresarlo
			return json_encode(array( 'Result' => "ERROR", 
						  'Message' => "<strong>La empresa ya se encuentra registrada." ));
		}
		//--------------------/QUE NO SE REPITA LA EMPRESA-----------------
		$query = "INSERT INTO `".$this->nombre_tabla."`
				(`RUT_EMPRESAS_A_INTERVENIR`,`NOMBRE_EMPRESAS_A_INTERVENIR`,
				`NOMBRE_FANTASIA_EMPRESAS_A_INTERVENIR`,`NOMBRE_ADMINISTRADOR_EMPRESAS_A_INTERVENIR`,
				`RUT_ADMINISTRADOR_EMPRESAS_A_INTERVENIR`,`MONTO_EMPRESAS_A_INTERVENIR`,`FECHA_REGISTRO_EMPRESAS_A_INTERVENIR`)
				VALUES
				('".$this->RUT_EMPRESAS_A_INTERVENIR."','".$this->NOMBRE_EMPRESAS_A_INTERVENIR."',
				'".$this->NOMBRE_FANTASIA_EMPRESAS_A_INTERVENIR."','".$this->NOMBRE_ADMINISTRADOR_EMPRESAS_A_INTERVENIR."',
				'".$this->RUT_ADMINISTRADOR_EMPRESAS_A_INTERVENIR."','".$this->MONTO_EMPRESAS_A_INTERVENIR."',NOW())";
		$query = $this->conexion->ejecutar_query($query);
		return $this->devolver_datos_tabla($query);
		
	}
	
	public function modificar(){
		//---------------------QUE NO SE REPITA LA EMPRESA-----------------
		$sql_empresa = "SELECT * FROM `EMPRESAS_A_INTERVENIR` 
								 WHERE `RUT_EMPRESAS_A_INTERVENIR` LIKE  '".$this->RUT_EMPRESAS_A_INTERVENIR."'
								 AND `".$this->id_tabla."` NOT LIKE '".$this->ID_EMPRESAS_A_INTERVENIR."'";
		$registros = $this->conexion->listar($sql_empresa);
		if(count($registros)>0){//Si existe el sector se debe buscar el ID para capturarlo e ingresarlo
			return json_encode(array( 'Result' => "ERROR", 
						  'Message' => "<strong>La empresa ya se encuentra registrada." ));
		}
		//--------------------/QUE NO SE REPITA LA EMPRESA-----------------
		$query="UPDATE `".$this->nombre_tabla."`
				SET
				`RUT_EMPRESAS_A_INTERVENIR` = '".$this->RUT_EMPRESAS_A_INTERVENIR."',
				`NOMBRE_EMPRESAS_A_INTERVENIR` = '".$this->NOMBRE_EMPRESAS_A_INTERVENIR."',
				`NOMBRE_FANTASIA_EMPRESAS_A_INTERVENIR` = '".$this->NOMBRE_FANTASIA_EMPRESAS_A_INTERVENIR."',
				NOMBRE_ADMINISTRADOR_EMPRESAS_A_INTERVENIR = '".$this->NOMBRE_ADMINISTRADOR_EMPRESAS_A_INTERVENIR."',
				RUT_ADMINISTRADOR_EMPRESAS_A_INTERVENIR = '".$this->RUT_ADMINISTRADOR_EMPRESAS_A_INTERVENIR."',
				MONTO_EMPRESAS_A_INTERVENIR = '".$this->MONTO_EMPRESAS_A_INTERVENIR."'
				WHERE `".$this->id_tabla."` = '".$this->ID_EMPRESAS_A_INTERVENIR."'";
		$query = $this->conexion->ejecutar_query($query);
		return $this->devolver_datos_tabla($query);
	}
	
	public function eliminar(){
		$query="DELETE FROM `".$this->nombre_tabla."` WHERE `".$this->id_tabla."`='".$this->ID_EMPRESAS_A_INTERVENIR."'";
		$query = $this->conexion->ejecutar_query($query);
		return $this->devolver_datos_tabla($query);
	}
	
	public function mostrar($rut_empresa,$nombre_empresa,$nombre_fantasia_empresa,$estado_legal,$sector,$jtSorting,$jtStartIndex,$jtPageSize){
		if($rut_empresa==''){
			$rut_empresa = ' 1 = 1 ';
		}else{
			$rut_empresa = ' EI.`RUT_EMPRESAS_A_INTERVENIR` LIKE "'.$rut_empresa.'" ';
		}
		if($nombre_empresa==''){
			$nombre_empresa = ' AND 1 = 1';
		}else{
			$nombre_empresa = ' AND EI.`NOMBRE_EMPRESAS_A_INTERVENIR` LIKE "'.$nombre_empresa.'" ';
		}
		if($nombre_fantasia_empresa==''){
			$nombre_fantasia_empresa = ' AND 1 = 1';
		}else{
			$nombre_fantasia_empresa = ' AND EI.`NOMBRE_FANTASIA_EMPRESAS_A_INTERVENIR` LIKE "'.$nombre_fantasia_empresa.'" ';
		}
		if($estado_legal==''){
			$estado_legal = ' AND 1 = 1';
		}else{
			$estado_legal = ' AND EL.`ESTA_AL_DIA_ESTADO_LEGAL` LIKE "'.$estado_legal.'" ';
		}
		if($sector==''){
			$sector = ' AND 1 = 1';
		}else{
			$sector = ' AND DE.`SECTOR_DIRECCION_EMPRESA` LIKE "'.$sector.'" ';
		}
		$campos = " DISTINCT(EI.`ID_EMPRESAS_A_INTERVENIR`) AS DISTINTAS,
					EI.`ID_EMPRESAS_A_INTERVENIR` AS `ID_EMPRESAS_A_INTERVENIR`,
					EI.`RUT_EMPRESAS_A_INTERVENIR` AS `RUT_EMPRESAS_A_INTERVENIR`,
					EI.`NOMBRE_EMPRESAS_A_INTERVENIR` AS `NOMBRE_EMPRESAS_A_INTERVENIR`,
					EI.`NOMBRE_FANTASIA_EMPRESAS_A_INTERVENIR` AS `NOMBRE_FANTASIA_EMPRESAS_A_INTERVENIR`,
					EI.`NOMBRE_ADMINISTRADOR_EMPRESAS_A_INTERVENIR` AS `NOMBRE_ADMINISTRADOR_EMPRESAS_A_INTERVENIR`,
					EI.`RUT_ADMINISTRADOR_EMPRESAS_A_INTERVENIR` AS `RUT_ADMINISTRADOR_EMPRESAS_A_INTERVENIR`,
					EI.`MONTO_EMPRESAS_A_INTERVENIR` AS `MONTO_EMPRESAS_A_INTERVENIR`,
					EI.`FECHA_REGISTRO_EMPRESAS_A_INTERVENIR` AS `FECHA_REGISTRO_EMPRESAS_A_INTERVENIR` ";
		$tablas = " EMPRESAS_A_INTERVENIR EI
		            LEFT JOIN `CATEGORIA_DE_LA_EMPRESA` CE
					ON(EI.`ID_EMPRESAS_A_INTERVENIR`=CE.`ID_EMPRESAS_A_INTERVENIR`)
					LEFT JOIN `DIRECCION_EMPRESA` DE
					ON(CE.`ID_CATEGORIA_DE_LA_EMPRESA`=DE.`ID_CATEGORIA_DE_LA_EMPRESA`)
					LEFT JOIN `ESTADO_LEGAL` EL
					ON(EI.`ID_EMPRESAS_A_INTERVENIR`=EL.`ID_EMPRESAS_A_INTERVENIR`) ";
		$clausulaWhere = " WHERE ".$rut_empresa.$nombre_empresa.$nombre_fantasia_empresa.$estado_legal.$sector; 
		$datos = $this->conexion->listarJtablesCoOtroCount($tablas,$campos,' COUNT(DISTINCT(EI.`ID_EMPRESAS_A_INTERVENIR`)) ',$clausulaWhere,$jtSorting,$jtStartIndex,$jtPageSize);
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
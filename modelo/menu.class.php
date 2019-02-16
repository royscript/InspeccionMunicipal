<?php
include_once("conexion.php");
Class menu{
	public function mostrar($seleccion,$usuario){
		$objeto = new Database();
		$conexion = new Database();
		$sql = 'SELECT * 
				FROM  `mantenedor` M
				INNER JOIN `mantenedor_del_permiso` MP
				ON(M.`ID_MANTENEDOR`=MP.`ID_MANTENEDOR`)
				INNER JOIN `permiso` P
				ON(MP.`ID_PERMISO`=P.`ID_PERMISO`)
				INNER JOIN `usuario` U
				ON(U.`ID_PERMISO`=P.`ID_PERMISO`)
				WHERE U.`ID_USUARIO` = '.$usuario;
		$registros = $conexion->listar($sql);
		$html = '';
		$colorear_boton = '';
		foreach($registros as $datos){
			//Colorear boton del menú
			if($seleccion==$datos['ID_MANTENEDOR']){
				$colorear_boton = 'class="active"';
				$_SESSION['LISTAR'] = $datos['LISTAR_MANTENEDOR_DEL_PERMISO'];
				$_SESSION['INGRESAR'] = $datos['INGRESAR_MANTENEDOR_DEL_PERMISO'];
				$_SESSION['MODIFICAR'] = $datos['MODIFICAR_MANTENEDOR_DEL_PERMISO'];
				$_SESSION['ELIMINAR'] = $datos['ELIMINAR_MANTENEDOR_DEL_PERMISO'];
				echo '<input name="listar" id="listar" type="hidden" value="'.$_SESSION['LISTAR'].'" />';
				echo '<input name="crear" id="crear" type="hidden" value="'.$_SESSION['INGRESAR'].'" />';
				echo '<input name="modificar" id="modificar" type="hidden" value="'.$_SESSION['MODIFICAR'].'" />';
				echo '<input name="eliminar" id="eliminar" type="hidden" value="'.$_SESSION['ELIMINAR'].'" />';
				echo '<input name="grupo_usuario_actual" id="grupo_usuario_actual" type="hidden" value="'.$_SESSION['grupo'].'" />';
			}else{
				$colorear_boton = '';
			}
			//Dibujar menú
			$html .= '<li '.$colorear_boton.'><a href="'.$datos['UBICACION_MANTENEDOR'].'?s='.$datos['ID_MANTENEDOR'].'"">'.$datos['NOMBRE_MANTENEDOR'].'</a></li>';
			
		}
		$html .= '<li><a href="../salir.php">SALIR</a></li>';
		return $html;
	}
}
?>
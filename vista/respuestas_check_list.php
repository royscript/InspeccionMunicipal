<?php
include_once("menu.php");
?>
<br />
<strong>Inspector</strong> <select name="buscar_operativo" id="buscar_operativo">
								<?php
                                    $conexion = new Database();
                                    $conexion->ejecutar_query($sql);
                                    $sql = "SELECT * FROM `operativo`";
                                    $registros = $conexion->listar($sql);
                                    foreach($registros as $datos){
                                        echo '<option value="'.$datos['ID_OPERATIVO'].'">'.$datos['NOMBRE_OPERATIVO'].' '.$datos['FECHA_OPERATIVO'].'</option>';
                                    }
                                ?>
                           	  </select>
                          <button id="btn_buscar">Buscar Checklist</button>
<br />
<br />
<table width="100%" border="1">
  <tr>
  	<td><strong>Rut</strong></td>
    <td colspan="4"><input name="txt_rut_empresa" type="text" id="txt_rut_empresa" size="100" />
    <input name="id_empresa" id="id_empresa" type="hidden" value="" /></td>
  </tr>
  <tr>
    <td><strong>Nombre de Fantasía</strong></td>
    <td colspan="4"><input name="txt_nombre_de_fantasia" type="text" id="txt_nombre_de_fantasia" size="100" /></td>
  </tr>
  <tr>
    <td><strong>Nombre</strong></td>
    <td colspan="4"><input name="txt_nombre" type="text" id="txt_nombre" size="100" /></td>
  </tr>
  <tr>
    <td><strong>Administrador</strong></td>
    <td colspan="4"><input name="txt_nombre_administrador" type="text" id="txt_nombre_administrador" size="100" /></td>
  </tr>
  <tr>
    <td><strong>Fecha</strong></td>
    <td width="29%"><input type="date" name="date_fecha" id="date_fecha" /></td>
    <td width="6%">Hora</td>
    <td colspan="2"><input type="time" name="time_hora" id="time_hora" /></td>
  </tr>
  <tr>
    <td><strong>Dirección</strong></td>
    <td colspan="4"><input name="txt_direccion" type="text" id="txt_direccion" size="100" /></td>
  </tr>
  <tr>
    <td width="15%"><strong>Razón Social</strong></td>
    <td colspan="4"><label for="txt_razon_social"></label>
    <input name="txt_razon_social" type="text" id="txt_razon_social" size="100" /></td>
  </tr>
  <tr>
    <td height="103" valign="top">
    								<strong>N° Rol</strong>
    </td>
    <td colspan="4" id="roles_del_local">
    	
    </td>
  </tr>
</table>
<input name="id_operativo" id="id_operativo" type="hidden" value="" />
<div id="preguntas_y_respuestas"></div>
<link rel="stylesheet" href="../plugins/jQuery-Validation-Engine-master/css/validationEngine.jquery.css" type="text/css"/>
<script src="../plugins/jQuery-Validation-Engine-master/js/languages/jquery.validationEngine-es.js" type="text/javascript" charset="utf-8"></script>
<script src="../plugins/jQuery-Validation-Engine-master/js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script src="../controlador js/respuestas_checklist.js" type="text/javascript"></script>
</body>
</html>
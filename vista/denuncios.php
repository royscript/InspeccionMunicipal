<?php
include_once("menu.php");
?>
<br />
<div class="row">
   <div class="col-lg-12">
      <div class="box">
         <header>
            <div class="icons"><i class="fa fa-exchange"></i></div>
            <h5>Parámetros para filtrar datos</h5>
         </header>
         <div class="body">
            <form id="validVal" class="form-inline">
               <div class="row form-group">
               		<div class="col-lg-18" style="margin-left: 20px;">
                     	<strong>Numero de Boleta</strong> <input class="form-control autotab" name="buscar_numero_boleta" id="buscar_numero_boleta" type="text">
                     	<strong>Rut Infractor</strong> <input class="form-control autotab" name="buscar_rut_infractor" id="buscar_rut_infractor" type="text">
                        <strong>Inspector</strong> <select name="buscar_grupo" id="buscar_inspector">
								<?php
                                    $conexion = new Database();
                                    $conexion->ejecutar_query($sql);
                                    $sql = "SELECT * FROM `inspector`";
                                    $registros = $conexion->listar($sql);
									echo '<option value="">TODOS</option>';
                                    foreach($registros as $datos){
                                        echo '<option value="'.$datos['ID_INSPECTOR'].'">'.$datos['NOMBRE_INSPECTOR'].'</option>';
                                    }
                                ?>
                           	  </select>
                         <strong>Sectores</strong> <select name="buscar_sector" id="buscar_sector">
								<?php
                                    $conexion = new Database();
                                    $conexion->ejecutar_query($sql);
                                    $sql = "SELECT * FROM `sector`";
                                    $registros = $conexion->listar($sql);
									echo '<option value="">TODOS</option>';
                                    foreach($registros as $datos){
                                        echo '<option value="'.$datos['ID_SECTOR'].'">'.$datos['NOMBRE_SECTOR'].'</option>';
                                    }
                                ?>
                           	  </select>
                  	</div>
                    <div class="col-lg-18" style="margin-left: 20px;">
                         <strong>Usuario</strong> <select name="buscar_usuario" id="buscar_usuario">
								<?php
                                    $conexion = new Database();
                                    $conexion->ejecutar_query($sql);
                                    $sql = "SELECT * FROM `usuario`";
                                    $registros = $conexion->listar($sql);
									echo '<option value="">TODOS</option>';
                                    foreach($registros as $datos){
                                        echo '<option value="'.$datos['ID_USUARIO'].'">'.$datos['USUARIO_USUARIO'].'</option>';
                                    }
                                ?>
                           	  </select>
                          <strong>Fecha Inicio</strong> <input class="form-control autotab" name="Fecha_inicio" id="Fecha_inicio" type="date" tabindex="11">
                          <strong>Hora Inicio</strong> <input class="form-control autotab" name="Hora_inicio" id="Hora_inicio" type="time" tabindex="11">
                     	  <strong>Fecha Final</strong> <input class="form-control autotab" name="Fecha_final" id="Fecha_final" type="date" tabindex="11">
                          <strong>Hora Final</strong> <input class="form-control autotab" name="Hora_final" id="Hora_final" type="time" tabindex="11">
                          <br />
                          <strong>Calle</strong> <input class="form-control autotab" name="buscar_calle" id="buscar_calle" type="text">
                          <strong>Buscar Motivo</strong>
                          <input class="form-control autotab" name="buscar_detalle_denuncios" id="buscar_detalle_denuncios" type="text">
                  	</div>
                    <div class="col-lg-4">
                     <button type="submit" class="btn btn-default" id="botonCargarRegistros"> 
                     	<span class="glyphicon glyphicon-search" aria-hidden="true"></span> Cargar Registros
                     </button>
                    </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<!--END AUTOMATIC JUMP-->

   <div id="Contenedor"></div>
   <br>
   <br>
   <a href="https://neosystemspa.cl/"></a>Autor : Roy Standen B., derechos Neosystem Spa</a>
<link rel="stylesheet" href="../plugins/jQuery-Validation-Engine-master/css/validationEngine.jquery.css" type="text/css"/>
<script src="../plugins/jQuery-Validation-Engine-master/js/languages/jquery.validationEngine-es.js" type="text/javascript" charset="utf-8"></script>
<script src="../plugins/jQuery-Validation-Engine-master/js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script src="../controlador js/denuncios.js" type="text/javascript"></script>
</body>
</html>
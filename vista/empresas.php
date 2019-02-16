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
                     	<strong>Rut Empresa</strong> <input class="form-control autotab" name="buscar_rut_empresa" id="buscar_rut_empresa" type="text">
                     	<strong>Nombre Empresa</strong> <input class="form-control autotab" name="buscar_nombre_empresa" id="buscar_nombre_empresa" type="text">
                        <strong>Nombre de Fantasía Empresa</strong> <input class="form-control autotab" name="buscar_nombre_fantasia_empresa" id="buscar_nombre_fantasia_empresa" type="text">
                         <strong>Sectores</strong> <select name="buscar_sector" id="buscar_sector">
								<?php
                                    $conexion = new Database();
                                    $conexion->ejecutar_query($sql);
                                    $sql = "SELECT DISTINCT(`SECTOR_DIRECCION_EMPRESA`) AS SECTOR_DIRECCION_EMPRESA 
FROM `DIRECCION_EMPRESA`";
                                    $registros = $conexion->listar($sql);
									echo '<option value="">TODOS</option>';
                                    foreach($registros as $datos){
                                        echo '<option value="'.$datos['SECTOR_DIRECCION_EMPRESA'].'">'.$datos['SECTOR_DIRECCION_EMPRESA'].'</option>';
                                    }
                                ?>
                           	  </select>
                          <strong>Estado Legal</strong> <select name="buscar_estado_legal" id="buscar_estado_legal">
								<option value="">TODOS</option>
                                <option value="AL DÍA">AL DÍA</option>
                                <option value="INFRINGE">INFRINGE</option>
                                <option value="LABOR EDUCATIVA">LABOR EDUCATIVA</option>
                           	  </select>
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
<link rel="stylesheet" href="../plugins/jQuery-Validation-Engine-master/css/validationEngine.jquery.css" type="text/css"/>
<script src="../plugins/jQuery-Validation-Engine-master/js/languages/jquery.validationEngine-es.js" type="text/javascript" charset="utf-8"></script>
<script src="../plugins/jQuery-Validation-Engine-master/js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script src="../controlador js/empresas.js" type="text/javascript"></script>
</body>
</html>
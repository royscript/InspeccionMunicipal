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
               		<div class="col-lg-18">
                     	Fecha Inicio <input class="form-control autotab" name="Fecha_inicio" id="Fecha_inicio" type="date" tabindex="11">
                     	Fecha Final <input class="form-control autotab" name="Fecha_final" id="Fecha_final" type="date" tabindex="11">
                     	Grupo <select name="buscar_grupo" id="buscar_grupo">
								<?php
                                    $conexion = new Database();
                                    $conexion->ejecutar_query($sql);
                                    $sql = "SELECT * FROM `grupo`";
                                    $registros = $conexion->listar($sql);
									echo '<option value="">TODOS</option>';
                                    foreach($registros as $datos){
                                        echo '<option value="'.$datos['ID_GRUPO'].'">'.$datos['NOMBRE_GRUPO'].'</option>';
                                    }
                                ?>
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
<script src="../controlador js/eventos.js" type="text/javascript"></script>
</body>
</html>
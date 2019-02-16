<?php
include_once("menu.php");
?>
<link href='../fullcalendar-3.1.0/fullcalendar.min.css' rel='stylesheet' />
<link href='../fullcalendar-3.1.0/fullcalendar.print.min.css' rel='stylesheet' media='print' />
<script src='../fullcalendar-3.1.0/lib/moment.min.js'></script><script src="../bootbox.min.js"></script>
<script src='../fullcalendar-3.1.0/lib/jquery.min.js'></script>
<script src='../fullcalendar-3.1.0/fullcalendar.min.js'></script>
<script src='../fullcalendar-3.1.0/locale-all.js' ></script>

<script src="../controlador js/calendario/tabla_dinamica_inspectores.js"></script>
<script src="../controlador js/calendario/tabla_dinamica_actividades.js"></script>
<script src="../controlador js/calendario/Inspectores.class.js"></script>
<script src="../controlador js/calendario/Sectores.class.js"></script>
<script src="../controlador js/calendario/Materias.class.js"></script>
<script src="../controlador js/calendario/Horas_inspectores.class.js"></script>
<script src="../controlador js/calendario/Horas_sector.class.js"></script>
<script src="../controlador js/calendario/Horas_materia.class.js"></script>
<script src="../controlador js/calendario/Grupo.class.js"></script>
<script src="../controlador js/calendario/Acciones_full_calendar.js"></script>
<style>
.fc-time-grid-event .fc-time {
    background: #3F51B5;
	font-size: 15px;
}
.fc-title{
}
</style>


<script>	


</script>
<style>

	body {
		margin: 0;
		padding: 0;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
		font-size: 14px;
	}

	#top {
		background: #eee;
		border-bottom: 1px solid #ddd;
		padding: 0 10px;
		line-height: 40px;
		font-size: 12px;
	}

	#calendar {
		max-width: 100%;
		margin: 40px auto;
		padding: 0 10px;
	}

</style>
	<div class="btn-group" role="group" aria-label="...">
<?php if($_SESSION['MODIFICAR']=='NO'){
      }else{ ?>
      <button type="button" class="btn btn-default" id="btn_agregar_inspector"><img src="../fotos/add-user.png" width="26" height="26" title="Agregar Inspector"></button>
      <button type="button" class="btn btn-default" id="btn_agregar_sector"><img src="../fotos/agregar-direccion_318-120688.jpg" width="26" height="26" title="Agregar Sector"></button>
      <button type="button" class="btn btn-default" id="btn_agregar_materia"><img src="../fotos/adjunto_agregar.png" width="26" height="26" title="Agregar Actividades"></button>
<?php } ?>
      <button type="button" class="btn btn-default" id="btn_ver_horas_de_trabajo"><img src="../fotos/Business-Overtime-icon.png" width="26" height="26" title="Ver Horas de Trabajo"></button>
      <button type="button" class="btn btn-default" id="btn_ver_horas_de_trabajo_por_sector"><img src="../fotos/Opciones Regionales, Idioma y de Fecha y hora.png" width="26" height="26" title="Ver Horas de Trabajo por sector"></button>
      <button type="button" class="btn btn-default" id="btn_ver_horas_de_trabajo_por_materia"><img src="../fotos/horarios_documentos.png" width="26" height="26" title="Ver Horas de Trabajo por Actividades"></button>
    </div>
    
    <select class="" id="select_calendario_grupos">
    </select>

	<div id='calendar'></div>
</body>
</html>

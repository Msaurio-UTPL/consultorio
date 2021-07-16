<?php
if(Session::getUID()!="")
{
?>
	<div class="row">
	<div class="col-md-12">
	<h2><span class="label label-info"><b>SISTEMA DE GESTIÓN DE CITAS MEDICAS (GesMed-ECU)</b></span><sup><small><span class="label label-info">Versión 1.0</span></small></sup></h2>
	<h5>Abril 2021.</h5>
	<p>Bienvenido a <b>GesMed-ECU</b>, un sistema desarrollado para optimizar, agilitar y facilitar la gestión de citas medicas.</p>
	<p>Detalle de la funcionalidad:</p>
	<ul>
		<li><b>Gestión de Pacientes</b> Gestión de Pacientes (Nuevo, Edición, Contactos, Direcciones, Citas Médicas).<sup><span class="label label-success">Disponible</span></sup></li>
		<li><b>Gestión de Reportes</b> Reportes Varios. <sup><span class="label label-warning">En Desarrollo</span></sup></li>
		<li><b>Gestión Atención Médica</b> Gestión de la Atención Médica (Consulta de Citas, Horario de Atención, Historia Clínica, Certificado Médico).<sup><span class="label label-success">Disponible</span></sup></li>
		<li><b>Gestión de Médicos</b> Gestión de Datos Médicos (Nuevo, Edición).<sup><span class="label label-success">Disponible</span></sup></li>
		<li><b>Parámetros Generales</b> Gestión de Lista de Parámetros (Consulta, Nuevo, Edición).<sup><span class="label label-success">Disponible</span></sup></li>
		<li><b>Usuarios del Sistema</b> Gestión de Usuarios (Consulta, Nuevo, Edición, Reporte).<sup><span class="label label-success">Disponible</span></sup></li>
		<li><b>Centros Médicos</b> Gestión de Centros Medicos (Consulta, Edición).<sup><span class="label label-success">Disponible</span></sup></li>		
	</ul>
	<b>
	<a href="manual/ManualUsuarioGesmed.pdf" title="Revisar Manual" target="blank">Manual de Usuario</a><br>
	<p>Elaborado por:</b><span class="label label-danger"><b>Mario Suárez Cedeno</b></p>
	</div>
	</div>	
<?php
}
else
{
	View::Error("<b>Error!!!<br></b>No puede emplear el sistema sin iniciar sesión.<br><a href='index.php'>Inicio</a>");
}
?>



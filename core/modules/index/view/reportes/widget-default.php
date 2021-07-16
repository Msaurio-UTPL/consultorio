<?php
$u=null;
if(Session::getUID()!="")
{
	$u = SPUser::getById(Session::getUID());
	$user = $u->usuCodUsuario;
	$rol=$u->detIdRol;
	// Reportes con acceso abierto
	?>	

	<h3>Reportes Disponibles:</h3>
	<?php // Medico
		  if($u->detIdRol=='1' or $u->detIdRol=='2' or $u->detIdRol=='3'):?>
			<li><a href="report/reportepacientes.php"><i class="fa fa-newspaper-o"></i> Reporte de Pacientes</a></li>
			<li><a href="report/reportemedicos.php"><i class="fa fa-newspaper-o"></i> Reporte de Médicos</a></li>
			<li><a href="report/reportecentros.php"><i class="fa fa-newspaper-o"></i> Reporte de Centros Médicos</a></li>
			<li><a href="report/reportehorarios.php"><i class="fa fa-newspaper-o"></i> Reporte de Horarios Médicos</a></li>
			<li><a href="report/reportecitas.php"><i class="fa fa-newspaper-o"></i> Reporte de Citas Médicas</a></li>
			<li><a href="report/reportecontactos.php"><i class="fa fa-newspaper-o"></i> Reporte de Contactos Paciente</a></li>
			<li><a href="report/reportedirecciones.php"><i class="fa fa-newspaper-o"></i> Reporte de Direcciones Paciente</a></li>
	<?php endif;?>
<?php
}
else
{
	View::Error("<b>Error!!!<br></b>No puede emplear el sistema sin iniciar sesión.<br><a href='index.php'>Inicio</a>");
	?>
	<?php
}
?>
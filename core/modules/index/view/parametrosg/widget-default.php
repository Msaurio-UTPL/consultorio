<?php
$u=null;
if(Session::getUID()!="")
{
	$u = SPUser::getById(Session::getUID());
	$user = $u->usuCodUsuario;
	$rol=$u->detIdRol;
	?>	

	<h3>Gestión de Parámetros Generales:</h3>
	<?php // Super Usuario
		  if($u->detIdRol=='1'):?>
			<li><a href="index.php?view=conceptosg"><i class="fa fa-newspaper-o"></i> Lista de Conceptos</a></li>
			<li><a href="index.php?view=detalleconcepto"><i class="fa fa-newspaper-o"></i> Detalle de Conceptos</a></li>		
	<?php endif;?>
	<?php // Administrador
		  if($u->detIdRol=='2'):?>
		
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
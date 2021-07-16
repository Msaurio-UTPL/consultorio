<?php
$u=null;
if(Session::getUID()!="")
{
	$u = UserData::getById(Session::getUID());
	$user = $u->usuario;
	$perfil=$u->perfil;
	if ($perfil=="1" or $perfil=="2")
	{
	?>	
		<div class="row">
			<div class="col-md-12">
			<a href="index.php?view=jugadores" class="btn btn-default pull-right"><i class='glyphicon glyphicon-step-backward'></i> Gestión de Jugadores</a>
			<a href="index.php?view=consultalc" class="btn btn-default pull-right"><i class='glyphicon glyphicon-user'></i> Por Club</a>
			<a href="index.php?view=consultanombre" class="btn btn-default pull-right"><i class='glyphicon glyphicon-user'></i> Por Nombres</a>
			<a href="index.php?view=consultaid" class="btn btn-default pull-right"><i class='glyphicon glyphicon-user'></i> Por Identificación</a>
			
			<h3>Consulta de Jugadores</h3>
		</div>
<?php
	}	
	else
	{
		View::Error("<b>Error!!!<br></b>El usuario <b>".$user."</b> no esta autorizado para emplear esta opción.<br><a href='index.php?view=home'>Inicio</a>");
	}
}
else
{
	View::Error("<b>Error!!!<br></b>No puede emplear el sistema sin iniciar sesión.<br><a href='index.php'>Inicio</a>");
	?>
	<?php
}
?>
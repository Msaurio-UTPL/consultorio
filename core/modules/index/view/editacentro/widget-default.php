<?php
$u=null;
if(Session::getUID()!="")
{
	$u = SPUser::getById(Session::getUID());
	$user = $u->usuCodUsuario;
	$rol=$u->detIdRol;
	if ($rol=='1')
	{
		$estado="";
	?>
		<?php
			$centro = SPCentro::getById($_GET["id"]);
		?>
			
		<div class="row">
			<div class="col-md-12">
			<h3>Edición de Centro:</h3>
			<form class="form-horizontal" method="post" enctype="multipart/form-data" id="actualizacentro" action="index.php?view=actualizacentro" role="form">
				<div class="form-group">
					<label for="inputEmail1" class="col-lg-2 control-label">Código:*</label>
					<div class="col-md-3">
						<input type="text" readonly name="id" required class="form-control" value="<?php echo $centro->cenIdCentro; ?>" id="id" placeholder="Código">
						<input type="hidden" readonly name="id1" class="form-control" value="<?php echo $centro->conIdTipo; ?>" id="id1">
						<input type="hidden" readonly name="id2" class="form-control" value="<?php echo $centro->detIdTipo; ?>" id="id2">
						
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail1" class="col-lg-2 control-label">Nombre:*</label>
					<div class="col-md-6">
						<input type="text" name="nombre" required class="form-control" id="nombre" value="<?php echo $centro->cenDescripcion; ?>" placeholder="Nombre del centro">
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail1" class="col-lg-2 control-label">Identificación:*</label>
					<div class="col-md-3">
						<input type="text" name="identificacion" required class="form-control" id="identificacion" value="<?php echo $centro->cenIdentificacion; ?>" placeholder="Identificación de la empresa">
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail1" class="col-lg-2 control-label">Inicio de Suscripción:*</label>
					<div class="col-md-2">
						<input type="date" name="susini" required class="form-control" id="susini" value="<?php echo $centro->cenSuscripcionInicio; ?>" placeholder="Inicio de Suscripción">
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail1" class="col-lg-2 control-label">Fin de Suscripción:*</label>
					<div class="col-md-2">
						<input type="date" name="susfin" required class="form-control" id="susfin" value="<?php echo $centro->cenSuscripcionFin; ?>" placeholder="Fin de Suscripción">
					</div>
				</div>
				<div class="form-group">
					<label for="imagen" class="col-lg-2 control-label">Logotipo:*</label>
					<div class="col-md-5">
						<input type="file" name="logo" class="form-control" id="logo" placeholder="Logotipo de la empresa">
						<?php
						echo '<div align="center"><img src="data:image/jpeg;base64,'.base64_encode($centro->cenLogo).' " height="97" width="130"></div>';
						?>
					</div>
				</div>
			</div>
				<div class="form-group">
					<div class="col-lg-offset-2 col-lg-10">
						<button type="submit" class="btn btn-primary">Actualizar Centro</button>
					</div>
				</div>
			</form>
			</div>
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
}
?>
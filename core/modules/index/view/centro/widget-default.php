<?php
$u=null;
if(Session::getUID()!="")
{
	$u = SPUser::getById(Session::getUID());
	$user = $u->usuCodUsuario;
	$rol=$u->detIdRol;
	if ($rol=='1')
	{
	?>	
		<div class="row">
			<div class="col-md-12">
				<a href="index.php?view=nuevocentro" class="btn btn-default pull-right"><i class='glyphicon glyphicon-edit'></i> Nuevo Centro</a>
				<h3>Gestión de Centros Médicos</h3>
				<?php
				$users = SPCentro::getAll();
				if(count($users)>0){
					// si hay usuarios
					?>
					<table class="table table-bordered table-hover">
					<thead>
					<th>Centro</th>
					<th>Identificación</th>
					<th>Tipo</th>
					<th>Inicio Suscripción</th>
					<th>Fin de Suscripción</th>
					<th>Dirección</th>
					<th>Telefonos</th>
					<th>Logo</th>
					</thead>
					<?php
					foreach($users as $user){
						?>
						<tr>
						<td><?php echo $user->cenDescripcion; ?></td>
						<td><?php echo $user->cenIdentificacion; ?></td>
						<td><?php 
									$tipoCentro = SPDetConceptos::getById($user->conIdTipo,$user->detIdTipo);
									echo $tipoCentro->detDescDetalle;
							?>
						</td>
						<td><?php echo $user->cenSuscripcionInicio; ?></td>
						<td><?php echo $user->cenSuscripcionFin; ?></td>
						<td><?php echo $user->cenDireccion; ?></td>
						<td><?php echo $user->cenTelefonos; ?></td>
						<td><?php //echo $user->cenLogo;
								  echo '<img src="data:image/jpeg;base64,'.base64_encode($user->cenLogo).' " height="97" width="130">';						
									$imagen = $user->cenLogo; // Datos binarios de la imagen.
									$tipo = 'image/jpeg';  // Mime Type de la imagen.
									// Mandamos las cabeceras al navegador indicando el tipo de datos que vamos a enviar.
									//header("Content-type: $tipo");
									// A continuación enviamos el contenido binario de la imagen.
									//echo $imagen;
							?>
						</td>
						<td style="width:30px;"><a href="index.php?view=editaCentro&id=<?php echo $user->cenIdCentro?>" class="btn btn-warning btn-xs">Edición</a></td>
						</tr>
						<?php
					}
				}else{
					// no hay usuarios
				}
				?>
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
	?>
	<?php
}
?>
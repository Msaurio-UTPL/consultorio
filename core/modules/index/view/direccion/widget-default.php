<?php
$u=null;
if(Session::getUID()!="")
{
	$u = SPUser::getById(Session::getUID());
	$user = $u->usuCodUsuario;
	$rol=$u->detIdRol;
	if ($rol=='1' or $rol=='2' or $rol=='3')
	{
	?>	
		<div class="row">
			<div class="col-md-12">
			<a href="index.php?view=nuevadireccion&id=<?php echo $_GET["id"] ?>" class="btn btn-default pull-right"><i class='glyphicon glyphicon-edit'></i> Nueva Direccion</a>
				<h3>Gestión de Direcciones</h3>
				<?php
				$dir = SPDireccion::getBySec($_GET["id"]);
				//echo $dir->ctoIddiracto;
				if(count($dir)>0){
					// si hay datos
					?>
					<table class="table table-bordered table-hover">
					<thead>
					<th>ID</th>
					<th>Tipo</th>
					<th>Calles y Número / Cuenta Correo1</th>
					<th>Sector o Barrio / Cuenta Correo2</th>
					<th>Referencia</th>
					<th>Estado</th>
					</thead>
					<?php
					foreach($dir as $con){
						?>
						<tr>
						<td><?php echo $con->paciente_pacIdPaciente; ?></td>
						<td><?php 
									$tipo = SPDetConceptos::getById($con->conIdDireccion,$con->detIdDireccion);
									echo $tipo->detDescDetalle;
							?>
						</td>						
						<td><?php echo $con->dirDescripcion1; ?></td>
						<td><?php echo $con->dirDescripcion2; ?></td>
						<td><?php echo $con->dirDescripcion3; ?></td>
						<td><?php 
									$estado = SPDetConceptos::getById($con->conIdEstado,$con->detIdEstado);
									echo $estado->detDescDetalle;
							?>
						</td>
						<td style="width:30px;"><a href="index.php?view=editadireccion&id=<?php echo $con->paciente_pacIdPaciente?>&id2=<?php echo $con->detIdDireccion?>" class="btn btn-warning btn-xs">Edición</a></td>
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
		View::Error("<b>Error!!!<br></b>El usuario <b>".$con."</b> no esta autorizado para emplear esta opción.<br><a href='index.php?view=home'>Inicio</a>");
	}
}
else
{
	View::Error("<b>Error!!!<br></b>No puede emplear el sistema sin iniciar sesión.<br><a href='index.php'>Inicio</a>");
	?>
	<?php
}
?>
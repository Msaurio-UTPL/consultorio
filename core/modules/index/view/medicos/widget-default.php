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
			<a href="index.php?view=nuevomedico" class="btn btn-default pull-right"><i class='glyphicon glyphicon-edit'></i> Nuevo Médico</a>
				<h3>Gestión de Médicos</h3>
				<?php
				$users = SPMedico::getAll();
				if(count($users)>0){
					// si hay medicos
					?>
					<table class="table table-bordered table-hover">
					<thead>
					<th>Centro</th>
					<th>Identificación</th>
					<th>Apellidos</th>
					<th>Nombres</th>
					<th>Especialidad</th>
					<th>Duración Citas</th>
					<th>Estado</th>
					</thead>
					<?php
					foreach($users as $user){
						?>
						<tr>
						<td><?php echo $user->centro_cenIdCentro; ?></td>
						<td><?php echo $user->medIdentificacion; ?></td>
						<td><?php echo $user->medApellidos; ?></td>
						<td><?php echo $user->medNombres; ?></td>
						<td><?php 
									$especialidad = SPDetConceptos::getById($user->conIdEspecialidad,$user->detIdEspecialidad);
									echo $especialidad->detDescDetalle;
							?>
						</td>
						<td><?php 
									$duracion = SPDetConceptos::getById($user->conIdDuracion,$user->detIdDuracion);
									echo $duracion->detDescDetalle;
							?>
						</td>						
						<td><?php 
									$estado = SPDetConceptos::getById($user->conIdEstado,$user->detIdEstado);
									echo $estado->detDescDetalle;
							?>
						</td>
						<td style="width:30px;"><a href="index.php?view=editamedico&id=<?php echo $user->medIdMedico?>" class="btn btn-warning btn-xs">Edición</a></td>
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
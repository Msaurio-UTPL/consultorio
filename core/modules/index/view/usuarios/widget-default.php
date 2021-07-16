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
			<a href="report/reporteusuario.php" class="btn btn-default pull-right"><i class='fa fa-archive'></i> Reportes PDF</a>
			<a href="index.php?view=nuevousuario" class="btn btn-default pull-right"><i class='glyphicon glyphicon-edit'></i> Nuevo Usuario</a>
				<h3>Gestión de Usuarios</h3>
				<?php
				$users = SPUser::getAll();
				if(count($users)>0){
					// si hay usuarios
					?>
					<table class="table table-bordered table-hover">
					<thead>
					<th>Centro</th>
					<th>Usuario</th>
					<th>Nombre</th>
					<th>Mail</th>
					<th>Rol</th>
					<th>Activo</th>
					</thead>
					<?php
					foreach($users as $user){
						?>
						<tr>
						<td><?php echo $user->centro_cenIdCentro; ?></td>
						<td><?php echo $user->usuCodUsuario; ?></td>
						<td><?php echo $user->usuNombreUsuario; ?></td>
						<td><?php echo $user->usuCorreo; ?></td>
						<td><?php
								if ($user->detIdRol=='1')
								{
									echo "ADMINISTRADOR";
								};
								if ($user->detIdRol=='2')
								{
									echo "MEDICO";
								};
								if ($user->detIdRol=='3')
								{
									echo "ASISTENTE";
								};
							
							?></td>
						<td>
							<?php if($user->detIdEstado=='1'):?>
								<i class="glyphicon glyphicon-ok"></i>
							<?php else:?>
								<i class="glyphicon glyphicon-remove"></i>
							<?php endif; ?>
						</td>
						<td style="width:30px;"><a href="index.php?view=editausuario&id=<?php echo $user->usuIdUsuario?>" class="btn btn-warning btn-xs">Edición</a></td>
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
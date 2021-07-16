<?php
$u=null;
if(Session::getUID()!="")
{
	$u = UserData::getById(Session::getUID());
	$user = $u->usuario;
	$perfil=$u->perfil;
	if ($perfil=="1")
	{
	?>	
		<div class="row">
			<div class="col-md-12">
			<a href="report/reporteidentificacion.php" class="btn btn-default pull-right"><i class='fa fa-archive'></i> Reporte PDF</a>
				<h3>Lista de Tipos de Identificación</h3>
				<?php
				$users = SPIdentificacion::getAll();
				if(count($users)>0){
					// si hay usuarios
					?>
					<table class="table table-bordered table-hover">
					<thead>
					<th>Id</th>
					<th>Tipo de Identificación</th>
					</thead>
					<?php
					foreach($users as $user){
						?>
						<tr>
						<td><?php echo $user->idTipo; ?></td>
						<td><?php echo $user->DesTipo; ?></td>
						<td style="width:30px;"><a href="index.php?view=editatipoidentificacion&id=<?php echo $user->idtipo;?>" class="btn btn-warning btn-xs">Edición</a></td>
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
}
?>
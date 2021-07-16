<?php
$u=null;
if(Session::getUID()!="")
{
	$u = SPUser::getById(Session::getUID());
	$user = $u->usuCodUsuario;
	$rol=$u->detIdRol;
	if ($rol=='1' or $rol=='2')
	{
	?>	
		<div class="row">
			<div class="col-md-12">
			<a href="report/reportegrupos.php" class="btn btn-default pull-right"><i class='fa fa-archive'></i> Reporte PDF</a>
			<a href="index.php?view=nuevoconcepto" class="btn btn-default pull-right"><i class='glyphicon glyphicon-edit'></i> Nuevo Grupo</a>
				<h3>Lista de Grupos</h3>
				<?php
				$grupos = SPGrupo::getAll();
				if(count($grupos)>0){
					// si hay usuarios
					?>
					<table class="table table-bordered table-hover">
					<thead>
					<th>Id</th>
					<th>Descripción</th>
					<th>Participación</th>
					<th>Ámbito</th>
					<th>Fecha</th>
					</thead>
					<?php
					foreach($grupos as $grupo){
						?>
						<tr>
						<td><?php echo $grupo->gruIdGrupo; ?></td>
						<td><?php echo $grupo->gruDescGrupo; ?></td>
						<td><?php echo $grupo->gruPorcParticipacion; ?></td>
						<td><?php echo $grupo->detIdAmbito; ?></td>
						<td><?php echo $grupo->fecha; ?></td>
						<td style="width:30px;">
							<a href="index.php?view=editagrupo&id=<?php echo $grupo->gruIdGrupo?>" class="btn btn-warning btn-xs">Edición</a>
							<!--
							<a href="index.php?view=eliminargrupo&id=<?php //echo $grupo->gruIdGrupo?>" class="btn btn-warning btn-xs">Eliminación</a>
							-->
						</td>
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
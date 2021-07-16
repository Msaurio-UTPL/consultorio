<?php
$u=null;
if(Session::getUID()!="")
{
	$u = UserData::getById(Session::getUID());
	$user = $u->usuario;
	$perfil=$u->perfil;
	$uliga=$u->idliga;
	if ($perfil=="1" or $perfil=="2")
	{
	?>	
		<div class="row">
		<div class="col-md-12">
			<a href="index.php?view=jugadores" class="btn btn-default pull-right"><i class='glyphicon glyphicon-step-backward'></i> Gestión de Jugadores</a>
			<a href="index.php?view=consultalc" class="btn btn-default pull-right"><i class='glyphicon glyphicon-user'></i> Por Liga / Club</a>
			<a href="index.php?view=consultanombre" class="btn btn-default pull-right"><i class='glyphicon glyphicon-user'></i> Por Nombres</a>
			<a href="index.php?view=consultaid" class="btn btn-default pull-right"><i class='glyphicon glyphicon-user'></i> Por Identificación</a>
			<h3>Consulta de Jugadores</h3>
			<?php
			$users= array();
			//echo $_POST["vliga"];
			//echo $_POST["vclub"];
			if( isset($_POST["vliga"]) and isset($_POST["vclub"]))
			{
				$vliga=$_POST["vliga"];
				$vclub=$_POST["vclub"];
				$users = SPJugador::getJugadoresLC($vliga,$vclub);
				$vdesliga=SPLiga::getById($vliga);
				$vdesclub=SPClub::getById($vliga,$vclub);
			}
			$tjugadores=count($users);
			if(count($tjugadores)>0)
			{
				// si hay usuarios
				?>
				<h5><?php echo '<b>Liga:</b> '.$vdesliga->DesLiga;?></h5>
				<h5><?php echo '<b>Cub:</b> '.$vdesclub->DesClub;?></h5>
				<h5><?php echo '<b>Jugadores: </b>'.$tjugadores;?></h5>
				<table class="table table-bordered table-hover">
				<thead>
					<th>Código</th>
					<th>Identificación</th>
					<th>Nombres</th>
					<th>Apellidos</th>
					<th>Nacimiento</th>
					<th>Lugar</th>
					<th>Género</th>
					<th>Etnia</th>
					<th>Fichaje</th>
					<th>Activo</th>
				</thead>
				<?php
				foreach($users as $j)
				{
					$trans = SPTransferencia::getByJugador($j->codigoJugador);
					?>
					<tr>
					<td><a href="index.php?view=consultaid&q=<?php echo $j->identificacion; ?>" title="Detalle" target="_blank"><?php echo $j->codigoJugador; ?></a></td>
					<?php 	if ($perfil=="1")
						{
							?><td><a href="index.php?view=calificacion&q=<?php echo $j->codigoJugador; ?>" title="Calificar" target="_blank"><?php echo $j->identificacion; ?></a></td><?php
						}
						else
						{
							?><td><?php echo $j->identificacion; ?></a></td><?php
						}
					?>
					<td><?php echo $j->nombres; ?></td>
					<?php 	if ($perfil=="1")
						{
							?><td><a href="index.php?view=transferencia&q=<?php echo $j->codigoJugador; ?>&vnliga=<?php echo $vliga; ?>" title="Transferir" target="_blank"><?php echo $j->apellidos; ?></a></td><?php
						}
						else
						{
							?><td><?php echo $j->apellidos; ?></a></td><?php
						}
					?>
					<td><?php echo $j->nacimiento; ?></td>
					<td><?php echo $j->lugar; ?></td>
					<td><?php echo $j->DesGenero;?></td>
					<td><?php echo $j->DesEtnia;?></td>
					<td><?php echo $j->fichaje; ?></td>
					<td>
						<?php if($j->activo=='1'):?>
							<i class="glyphicon glyphicon-ok"></i>

						<?php else:?>
							<i class="glyphicon glyphicon-remove"></i>
						<?php endif;
						if ($uliga==$vliga or $perfil=="1")
						{
							?>
								<a href="index.php?view=editajugador&id=<?php echo $j->codigoJugador;?>" title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
							<?php						
						}
						if ($perfil=="1")
						{
							?>
							<a href="index.php?view=reubica&q=<?php echo $j->codigoJugador;?>&vnliga=<?php echo $vliga;?>" title="Reubicar"><i class="glyphicon glyphicon-refresh"></i></a>
							<?php
						}
						?>
					</td>
					</tr>
					<?php
				}
				?>
				</table>
				<?php
			}
			else
			{		
				echo "<p class='alert alert-danger'><b>ATENCIÓN:</b> No hay Jugadores con esa identificación.</p>";
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
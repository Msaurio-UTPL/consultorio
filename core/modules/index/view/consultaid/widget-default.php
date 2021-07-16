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
			<a href="index.php?view=consultalc" class="btn btn-default pull-right"><i class='glyphicon glyphicon-user'></i> Por Club</a>
			<a href="index.php?view=consultanombre" class="btn btn-default pull-right"><i class='glyphicon glyphicon-user'></i> Por Nombres</a>
			<a href="index.php?view=consultaid" class="btn btn-default pull-right"><i class='glyphicon glyphicon-user'></i> Por Identificación</a>
			<h3>Consulta de Jugadores</h3>
			<form class="form-horizontal" role="form">
				<input type="hidden" name="view" value="consultaid">
				<div class="form-group">
					<div class="col-lg-3">
						<div class="input-group">
						  <span class="input-group-addon"><i class="fa fa-search"></i></span>
						  <input type="text" name="q" value="<?php if(isset($_GET["q"]) && $_GET["q"]!=""){ echo $_GET["q"]; } ?>" required  class="form-control" placeholder="Identificación">
						</div>
					</div>
					
					<div class="col-lg-2">
						<button class="btn btn-primary btn-block">Buscar</button>
					</div>
				</div>
			</form>
			<?php
			$users= array();
			$trans= array();
			if( isset($_GET["q"]) )
			{
				$users = SPJugador::getById($_GET['q']);
			}
			if(count($users)>0)
			{
				// si hay usuarios
				$trans = SPTransferencia::getByJugador($users->codigoJugador);
				?>
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
				<th>Liga</th>
				<th>Club</th>
				<th>Fechas</th>
				<th>Activo</th>
				</thead>
				<tr>
				<td><?php echo $users->codigoJugador; ?></td>
				<?php 	if ($perfil=="1")
						{
							?><td><a href="index.php?view=calificacion&q=<?php echo $users->codigoJugador; ?>" title="Calificar" target="_blank"><?php echo $users->identificacion; ?></a></td><?php
						}
						else
						{
							?><td><?php echo $users->identificacion; ?></a></td><?php
						}
				?>
				<td><?php echo $users->nombres; ?></td>
				<?php 	if ($perfil=="1")
						{
							?><td><a href="index.php?view=transferencia&q=<?php echo $users->codigoJugador; ?>&vnliga=<?php echo $users->idliga; ?>" title="Transferir" target="_blank"><?php echo $users->apellidos; ?></a></td><?php
						}
						else
						{
							?><td><?php echo $users->apellidos; ?></a></td><?php
						}
				?>
				<td><?php echo $users->nacimiento; ?></td>
				<td><?php echo $users->lugar; ?></td>
				<td><?php echo $users->DesGenero;?></td>
				<td><?php echo $users->DesEtnia;?></td>
				<td><?php echo $users->DesLiga;?></td>
				<td><?php echo $users->DesClub;?></td>
				<td><b><a href="" title="<?php echo substr($users->creacion,0,19); ?>">Creación:</a></b><br><?php echo $users->creacion; ?><br>
					<b><a href="" title="<?php echo substr($users->fichaje,0,19); ?>">Fichaje:</a></b><br><?php echo $users->fichaje; ?></td>
				<td>
					<?php if($users->activo=='1'):?>
						<i class="glyphicon glyphicon-ok"></i>
					<?php else:?>
						<i class="glyphicon glyphicon-remove"></i>
					<?php endif; ?>
					<br>
					<?php	echo $users->logactivo;
							echo $uliga;
							echo $users->idliga;
							if ($uliga==$users->idliga or $perfil=="1")
							{
								?>
									<br><a href="index.php?view=editajugador&id=<?php echo $users->codigoJugador;?>" title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
								<?php						
							}
							if ($perfil=="1")
							{
								?>
								<a href="index.php?view=reubica&q=<?php echo $users->codigoJugador;?>&vnliga=<?php echo $users->idliga;?>" title="Reubicar"><i class="glyphicon glyphicon-refresh"></i></a>
								<?php
							}
								
					?>
				</td>
				</tr>
				</table>
				<h5><b>Calificaciones:</b></h5>
				<table class="table table-bordered table-hover">
				<thead>
					<th>Detalle</th>
				</thead>
				<?php 
					$observacion=$users->observacion;
					//echo $observacion;
					$vpos=0;
					$vtexto='';
					while (strpos($observacion,'/') )
					{
						$vpos=strpos($observacion,'/');
						//echo $vpos;
						$vtexto=substr($observacion,0,$vpos);
						echo '<tr><td>'.$vtexto.'</td><tr>';
						$observacion=substr($observacion,$vpos+1,strlen($observacion));
					}
					echo '<tr><td>'.$observacion.'</td></tr>';
				?>
				</table>
				<?php
				if(count($trans)>0)
				{
					?>
					<h5><b>Transferencias:</b></h5>
					<table class="table table-bordered table-hover">
					<thead>
						<th>Liga Anterior</th>
						<th>Club Anterior</th>
						<th>Fecha Anterior</th>
						<th>Tipo</th>
					</thead>
					<?php
					foreach($trans as $t)
					{
						?>
						<tr>
							<td><?php echo $t->DesLiga; ?></td>
							<td><?php echo $t->DesClub;?></td>
							<td><?php echo $t->transferencia; ?></td>
							<td><?php echo $t->tipo; ?></td>
						</tr>
						<?php	
					}
					?>
					</table>
					<?php
				}
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
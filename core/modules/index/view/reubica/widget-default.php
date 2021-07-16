<?php
$u=null;
if(Session::getUID()!="")
{
	$u = UserData::getById(Session::getUID());
	$user = $u->usuario;
	$perfil=$u->perfil;
	$liga=$u->idliga;
	if ($perfil=="1")
	{
	?>	
		<div class="row">
			<div class="col-md-12">
			<a href="index.php?view=jugadores" class="btn btn-default pull-right"><i class='glyphicon glyphicon-user'></i> Gestión de Jugadores</a>
			<h3>Reubicación de Jugadores</h3>
		</div>
		<script language="javascript" src="js/jquery-1.10.2.min.js"></script>
		<script language="javascript">
			$(document).ready(function(){
				$("#vnliga").change(function ()
				{
					$("#vnliga option:selected").each(function ()
					{
						//alert ('Entro'+$(this).val());
						idliga = $(this).val();
						//alert(document.getElementById("vcod").value);
						vurl='/sysplay/index.php?view=reubica&q='+document.getElementById("vcod").value+'&vnliga=';
						//alert(vurl);
						// El contenido HTML del elemento con id "contenido"
						//alert (idliga);
						window.location.replace(vurl.concat(idliga));
					});
				})
			});
		</script>
		</head>
		<body>
		<?php	
		//echo $_GET['q'];
		$jugadores= array();
		$jugadores= SPJugador::getByCod($_GET['q']);
		//echo count($jugadores);
		//echo $_GET['vnliga'];
		//echo $_GET['vliga'];
		if (isset($_GET['vnliga']))
		{
			//echo "si recibio";
			//echo $_GET['vliga'];
			$ligaactual=$_GET['vnliga'];
			$ligas = SPLiga::getAll();
			$clubes = SPClub::getByLiga($ligaactual);
			?>
			<div class="row">
				<div class="col-md-12">
				<form class="form-horizontal" method="post" id="detalle" action="index.php?view=actualizajugadorligaclub" role="form">
					<div class="form-group">
						<label class="col-lg-2 control-label">Nombres:</label>
						<div class="col-lg-6">
							<input type="hidden" name="vcod"  value="<?php echo $jugadores->codigoJugador;?>" class="form-control" id="vcod" readonly>
							<input type="text" name="nombre"  value="<?php echo $jugadores->nombres;?>" class="form-control" id="nombre" readonly>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">Apellidos:</label>
						<div class="col-lg-6">
							<input type="text" name="apellido"  value="<?php echo $jugadores->apellidos;?>" class="form-control" id="apellido" readonly>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">Reubicar a Liga:*</label>
						<div class="col-lg-6">
							<input type="text" name="liga"  value="<?php echo $jugadores->DesLiga;?>" class="form-control" id="liga" readonly>
							<select name="vnliga" id="vnliga" class="form-control" required>
								<?php foreach($ligas as $l):?>
									<option <?php if(isset($ligaactual) and $l->idliga==$ligaactual){ echo "selected"; }?> value="<?php echo $l->idliga;
													?>"><?php echo $l->DesLiga; ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail1" class="col-lg-2 control-label">Reubicar a Club:*</label>
						<div class="col-lg-6">
							<input type="text" name="club"  value="<?php echo $jugadores->DesClub;?>" class="form-control" id="club" readonly>
							<select name="vnclub" class="form-control" required>
								<option value="">-- Seleccione --</option>
								<?php foreach($clubes as $c):?>
									<option value="<?php echo $c->idclub; ?>"><?php echo $c->DesClub; ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<p class="alert alert-info">* Campos obligatorios</p>
					<div class="form-group">
						<div class="col-lg-offset-2 col-lg-10">
							<button type="submit" class="btn btn-primary">Reubicar</button>
						</div>
					</div>
				</form>
				</div>
			</div>
			<?php
		}
		else
		{
			//echo "no recibio";
			$ligas = SPLiga::getAll();
			//$ligas = SPLiga::getAll();
			//$clubes = SPClub::getByLiga();
			?>
			<div class="row">
				<div class="col-md-12">
				<form class="form-horizontal" method="post" id="detalle" action="index.php?view=actualizajugadorligaclub" role="form">
					<div class="form-group">
						<label class="col-lg-2 control-label">Nombres:</label>
						<div class="col-lg-6">
							<input type="hidden" name="vcod"  value="<?php echo $jugadores->codigoJugador;?>" class="form-control" id="vcod" readonly>
							<input type="text" name="nombre"  value="<?php echo $jugadores->nombres;?>" class="form-control" id="nombre" readonly>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">Apellidos:</label>
						<div class="col-lg-6">
							<input type="text" name="apellido"  value="<?php echo $jugadores->apellidos;?>" class="form-control" id="apellido" readonly>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">Reubicar a Liga:*</label>
						<div class="col-lg-6">
							<input type="text" name="liga"  value="<?php echo $jugadores->DesLiga;?>" class="form-control" id="liga" readonly>
							<select name="vliga" id="vliga" class="form-control" required>
								<?php foreach($ligas as $l):?>
									<option value="<?php echo $l->idliga;
													?>"><?php echo $l->DesLiga; ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail1" class="col-lg-2 control-label">Reubicar a Club:*</label>
						<div class="col-lg-6">
							<input type="text" name="club"  value="<?php echo $jugadores->DesClub;?>" class="form-control" id="club" readonly>
							<select name="vclub" class="form-control" required>
								<option value="">-- Seleccione --</option>
								<?php foreach($clubes as $c):?>
									<option value="<?php echo $c->idclub; ?>"><?php echo $c->DesClub; ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<p class="alert alert-info">* Campos obligatorios</p>
					<div class="form-group">
						<div class="col-lg-offset-2 col-lg-10">
							<button type="submit" class="btn btn-primary">Reubicar</button>
						</div>
					</div>
				</form>
				</div>
			</div>
			<?php
		}
		//echo $l->idliga;
		//echo $ligaactual;												
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
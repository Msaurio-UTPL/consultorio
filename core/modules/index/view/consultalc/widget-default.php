<?php
$u=null;
if(Session::getUID()!="")
{
	$u = UserData::getById(Session::getUID());
	$user = $u->usuario;
	$perfil=$u->perfil;
	$liga=$u->idliga;
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
		</div>
		<script language="javascript" src="js/jquery-1.10.2.min.js"></script>
		<script language="javascript">
			$(document).ready(function(){
				$("#vliga").change(function ()
				{
					$("#vliga option:selected").each(function ()
					{
						idliga = $(this).val();
						vurl='/sysplay/index.php?view=consultalc&vliga=';
						//alert (idliga);
						window.location.replace(vurl.concat(idliga));
					});
				})
			});
		</script>
		</head>
		<body>
<?php
		switch ($perfil)
		{
			case "1":
						//echo $_POST['vliga'];
						//echo $_GET['vliga'];
						if (isset($_GET['vliga']))
						{
							//echo "si recibio";
							//echo $_GET['vliga'];
							$ligaactual=$_GET['vliga'];
							$ligas = SPLiga::getAll();
							$clubes = SPClub::getByLiga($ligaactual);
							?>
							<div class="row">
								<div class="col-md-12">
								<form class="form-horizontal" method="post" id="detalle" action="index.php?view=consultalcdetalle" role="form">
									<div class="form-group">
										<label class="col-lg-2 control-label">Ligas disponibles:*</label>
										<div class="col-lg-6">
											<select name="vliga" id="vliga" class="form-control" required>
												<?php foreach($ligas as $l):?>
													<option <?php if(isset($ligaactual) and $l->idliga==$ligaactual){ echo "selected"; }?> value="<?php echo $l->idliga;
																	?>"><?php echo $l->DesLiga; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label for="inputEmail1" class="col-lg-2 control-label">Clubes disponibles:*</label>
										<div class="col-lg-6">
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
											<button type="submit" class="btn btn-primary">Buscar</button>
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
								<form class="form-horizontal" method="post" id="detalle" action="index.php?view=consultalcdetalle" role="form">
									<div class="form-group">
										<label class="col-lg-2 control-label">Ligas disponibles:*</label>
										<div class="col-lg-6">
											<select name="vliga" id="vliga" class="form-control" required>
												<?php foreach($ligas as $l):?>
													<option value="<?php echo $l->idliga;
																	?>"><?php echo $l->DesLiga; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label for="inputEmail1" class="col-lg-2 control-label">Clubes disponibles:*</label>
										<div class="col-lg-6">
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
											<button type="submit" class="btn btn-primary">Buscar</button>
										</div>
									</div>
								</form>
								</div>
							</div>
							<?php
						}
						//echo $l->idliga;
						//echo $ligaactual;						
						?>
						
						<?php
						break;
			case "2":
						$ligas = SPLiga::getById($liga);
						$clubes = SPClub::getByLiga($liga);
						?>
						<div class="row">
							<div class="col-md-12">
							<form class="form-horizontal" method="post" id="detalle" action="index.php?view=consultalcdetalle" role="form">
								<div class="form-group">
									<label class="col-lg-2 control-label">Ligas disponibles:*</label>
									<div class="col-md-6">
										<input type="text" name="liga" readonly class="form-control" id="name" value="<?php echo $ligas->DesLiga; ?>" placeholder="Nombre completo del club">
										<input type="hidden" name="vliga" readonly class="form-control" id="name" value="<?php echo $ligas->idliga; ?>" placeholder="Nombre completo del club">
									</div>
								</div>
								<div class="form-group">
									<label for="inputEmail1" class="col-lg-2 control-label">Clubes disponibles:*</label>
									<div class="col-lg-6">
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
									<button type="submit" class="btn btn-primary">Buscar</button>
								</div>
							</div>
							</form>
							</div>
						</div>
						<?php
						break;
		}
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
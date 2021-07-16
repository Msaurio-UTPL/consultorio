<?php
error_reporting(E_ERROR | E_PARSE);
$u=null;
if(Session::getUID()!="")
{
	$u = SPUser::getById(Session::getUID());
	$user = $u->usuCodUsuario;
	$rol=$u->detIdRol;
	$estado = SPDetConceptos::getByCod("1","0");
	//echo $_GET["id"];
	$medico = SPMedico::getByIdSec($_GET["id"]);
	//echo $medico->medIdMedico;
	if ($rol=='1' or $rol=='2')
	{
	?>	
		<div class="row">
			<div class="col-md-12">
				<h3>Horarios para Dr(a).: </h3>
				<form class="form-horizontal" method="post" id="actualizahorario" action="index.php?view=actualizahorario" role="form">
				<tr><td>
					<input type="readonly" name="medApellidos" id="medApellidos" required value="<?php echo $medico->medApellidos; echo " "; echo $medico->medNombres;?>" class="form-control" placeholder="Medico">
				</td></tr>
				<table class="table table-bordered table-hover">
				<thead>
				<th>Descripción del Día</th>
				<th>Hora Ini.</th>
				<th>Hora Fin.</th>
				<th>Cod. Estado</th>
				</thead>				
				<?php
				$horarios = SPHorario::getByMedico($medico->medIdMedico);
				if(count($horarios)>0){
						//echo "si hay datos";
						foreach($horarios as $horario){
							?>
							<tr>
							<td>
								<input type="text" name="horDescripcion<?php echo $horario->detIdDia;?>" id="horDescripcion<?php echo $horario->detIdDia;?>" readonly value="<?php echo $horario->horDescripcion; ?>" class="form-control" placeholder="desc hora">
								<input type="hidden" name="detIdDia<?php echo $horario->detIdDia;?>" id="detIdDia<?php echo $horario->detIdDia;?>" value="<?php echo $horario->detIdDia;?>">
							</td>							
							<td>
								<input type="time" name="horHoraInicio<?php echo $horario->detIdDia;?>" id="horHoraInicio<?php echo $horario->detIdDia;?>" required value="<?php echo $horario->horHoraInicio; ?>" class="form-control" placeholder="Hora Inicio ">
							</td>
							<td>
								<input type="time" name="horHoraFin<?php echo $horario->detIdDia;?>" id="horHoraFin<?php echo $horario->detIdDia;?>" required value="<?php echo $horario->horHoraFin; ?>" class="form-control" placeholder="Hora Final ">
							</td>
							<td>
								<?php if ($horario->detIdEstado == 1){ ?>
								<input type="checkbox" name="detIdEstado<?php echo $horario->detIdDia;?>" id="detIdEstado<?php echo $horario->detIdDia;?>" checked="checked" class="form-check-input" placeholder="Cod. Estado "> 
								<?php } else { ?>
								<input type="checkbox" name="detIdEstado<?php echo $horario->detIdDia;?>" id="detIdEstado<?php echo $horario->detIdDia;?>" class="form-check-input" placeholder="Cod. Estado "> 
								<?php } ?>
							</td>
							</tr>	
						<?php
						}
				}
				else {
					$detconceptos = SPDetConceptos::getAllId(12);
					if(count($detconceptos)>0){
						//echo "no hay datos";
						foreach($detconceptos as $detconcepto){
							?>
							<tr>
							<td>
								<div class="form-group">
									<div class="col-md-10">
										<input type="hidden" name="detIdDetalle<?php echo $detconcepto->detIdDetalle; ?>" id="detIdDetalle<?php echo $detconcepto->detIdDetalle; ?>" value="<?php echo $detconcepto->detIdDetalle;?>">
										<input type="text" name="detDescDetalle<?php echo $detconcepto->detIdDetalle; ?>" id="detDescDetalle<?php echo $detconcepto->detIdDetalle; ?>" readonly value="<?php echo $detconcepto->detDescDetalle;?>" class="form-control">
									</div>
								</div>								
							</td>
							<td>
								<div class="form-group">
									<div class="col-md-8">
										<input type="time" name="horHoraInicio<?php echo $detconcepto->detIdDetalle; ?>" id="horHoraInicio<?php echo $detconcepto->detIdDetalle; ?>" required value="<?php echo "09:00";?>" class="form-control" placeholder="Hora Inicio ">
									</div>
								</div>
							</td>
							<td>
								<div class="form-group">
									<div class="col-md-8">
										<input type="time" name="horHoraFin<?php echo $detconcepto->detIdDetalle; ?>" id="horHoraFin<?php echo $detconcepto->detIdDetalle; ?>" required value="<?php echo "18:00";?>" class="form-control" placeholder="Hora Fin ">
									</div>
								</div>							
							</td>
							<td>
								<div class="form-check-input">
									<div class="col-md-5">
										<input type="checkbox" name="detIdEstado<?php echo $detconcepto->detIdDetalle; ?>" id="detIdEstado<?php echo $detconcepto->detIdDetalle; ?>" value="1" class="form-check-input" placeholder="1=Activa 2=Inactiva ">
									</div>
								</div>								
							</td>							
							</tr>
							<?php
						}
					}else{
						// no hay datos
					}
				}
				?>
				<div class="form-group">
					<div class="col-lg-offset-2 col-lg-10">
						<input type="hidden" name="medIdMedico" id="medIdMedico" value="<?php echo $medico->medIdMedico;?>">
						<button type="submit" class="btn btn-primary">Actualizar Horario</button>
					</div>
				</div>
				</form>
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
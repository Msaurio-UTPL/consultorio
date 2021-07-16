<?php
$u=null;
if(Session::getUID()!="")
{
	$u = SPUser::getById(Session::getUID());
	$user = $u->usuCodUsuario;
	$rol = $u->detIdRol;
	//$tipoid = SPDetConceptos::getByCod("4","0");
	//$espe = SPDetConceptos::getByCod("11","0");
	//$dura = SPDetConceptos::getByCod("13","0");
	if ($rol=='1' or $rol =='2' or $rol =='3')
	{
		$estado="";
	?>
		<?php
			$cita = SPCita::getById($_GET["id"]);
			$medico = SPMedico::getByIdSec($cita->medIdMedico);
			$paciente = SPBasica::getByIdSec($cita->paciente_pacIdPaciente);
		?>
			
		<div class="row">
			<div class="col-md-12">
			<h3>Edición de Datos de Médico:</h3>
			<form class="form-horizontal" method="post" id="actualizacita" action="index.php?view=actualizacita" role="form">
				<div class="form-group">
					<label for="inputEmail1" class="col-lg-2 control-label">Médico:*</label>
					<div class="col-md-4">
						<input type="text" readonly name="medico" required class="form-control" value="<?php echo $medico->medApellidos; echo " "; echo $medico->medNombres;?>" id="medico" placeholder="Médico">
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail1" class="col-lg-2 control-label">Paciente:*</label>
					<div class="col-md-4">
						<input type="text" readonly name="medico" required class="form-control" value="<?php echo $paciente->pacApellidos; echo " "; echo $paciente->pacNombres;?>" id="medico" placeholder="Médico">
					</div>
				</div>				
				<div class="form-group">
					<label for="inputEmail1" class="col-lg-2 control-label">Fecha Cita:*</label>
					<div class="col-md-2">
						<input type="date" name="citFecha" required class="form-control" id="citFecha" value="<?php echo $cita->citFecha; ?>" placeholder="Fecha de cita">
					</div>
				</div>				
				<div class="form-group">
					<label for="inputEmail1" class="col-lg-2 control-label">Hora de Cita:*</label>
					<div class="col-md-2">
						<input type="time" name="citHoraInicio" required class="form-control" id="citHoraInicio" value="<?php echo $cita->citHoraInicio; ?>" placeholder="Hora de Cita">
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail1" class="col-lg-2 control-label">Activo:*</label>
					<div class="col-md-6">
						<label class="checkbox-inline">
							<input type="radio" id="detIdEstado" name="detIdEstado" <?php echo $estado; ?> <?php if($cita->detIdEstado=="1"){ echo "checked"; }?> value="1"> Activo
						</label>
						<label class="checkbox-inline">
							<input type="radio" id="detIdEstado" name="detIdEstado" <?php echo $estado; ?> <?php if($cita->detIdEstado=="2"){ echo "checked"; }?> value="2"> Inactivo
						</label>
					</div>
				</div>
				<div class="form-group">
					<div class="col-lg-offset-2 col-lg-10">
						<input type="hidden" name="medIdMedico" value="<?php echo $cita->medIdMedico;?>">
						<input type="hidden" name="citIdCita" value="<?php echo $cita->citIdCita;?>">
						<input type="hidden" name="paciente_pacIdPaciente" value="<?php echo $cita->paciente_pacIdPaciente;?>">
						<input type="hidden" name="horario_horIdHorario" value="<?php echo $cita->horario_horIdHorario;?>">
						<button type="submit" class="btn btn-primary">Actualizar Datos</button>
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
}
?>
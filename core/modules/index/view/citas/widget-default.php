<?php
$u=null;
if(Session::getUID()!="")
{
	$u = SPUser::getById(Session::getUID());
	$user = $u->usuCodUsuario;
	$rol=$u->detIdRol;
	if ($rol=='1' or $rol=='2' or $rol=='3')
	{
		$medicoactual = 0;
		$paciente = SPBasica::getInfoByIdSec($_GET["id"]);
		//echo  $_GET["id"];
		$centro = SPUser::getCentro($user);
		$centrod = SPCentro::getById($centro->centro_cenIdCentro);
		$medico = SPMedico::getByCentro($centrod->cenIdCentro);
	?>
	<div class="row">
		<div class="col-md-12">
		<h3>Agendamiento de Citas</h3>
		<form class="form-horizontal" method="post" id="addproduct" action="index.php?view=anadircita" role="form">
			<div class="form-group">
				<label for="inputEmail1" class="col-lg-2 control-label">Centro:*</label>
				<div class="col-md-4">
					<input type="text" readonly name="cenDescripcion" value="<?php echo $centrod->cenDescripcion; ?>" class="form-control" id="cenDescripcion" placeholder="Centro">
				</div>
			</div>
			<div class="form-group">
				<label for="inputEmail1" class="col-lg-2 control-label">Paciente:*</label>
				<div class="col-md-4">
					<input type="text" readonly name="pacApellidos" value="<?php echo $paciente->pacApellidos; echo " "; echo $paciente->pacNombres; ?>" class="form-control" id="pacApellidos" placeholder="Paciente">
				</div>
			</div>			
			<div class="form-group">
				<label class="col-lg-2 control-label">Médico:*</label>
				<div class="col-lg-3">
					<select name="medIdMedico" id="medIdMedico" class="form-control" required>
						<option value="">-- Seleccione --</option>
						<?php foreach($medico as $l):?>
							<option <?php if(isset($medicoactual) and $l->medIdMedico==$medicoactual){ echo "selected"; }?> value="<?php echo $l->medIdMedico; ?>"><?php echo $l->medApellidos; echo " "; echo $l->medNombres; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>	
			<div class="form-group">
				<label for="inputEmail1" class="col-lg-2 control-label">Fecha:*</label>
				<div class="col-md-4">
					<input type="date" name="citFecha" required value="<?php echo $paciente->hoy; ?>" class="form-control" id="citFecha" placeholder="Fecha">
				</div>
			</div>
			<div class="form-group">
				<label for="inputEmail1" class="col-lg-2 control-label">Hora Cita:*</label>
				<div class="col-md-4">
					<input type="text" name="citHoraInicio" required class="form-control" id="citHoraInicio" placeholder="hh:mm">
				</div>
			</div>
			<div class="form-group">
				<label for="inputEmail1" class="col-lg-2 control-label">Estado:*</label>
				<div class="col-md-6">
				<label class="checkbox-inline">
					<input type="radio" id="inlineCheckbox1" name="activo" required value="1"> Activo
				</label>
				<label class="checkbox-inline">
					<input type="radio" id="inlineCheckbox2" name="activo" required value="2"> Inactivo
				</label>
			</div>
		</div>
		<p class="alert alert-info">* Campos obligatorios</p>
		<div class="form-group">
			<div class="col-lg-offset-2 col-lg-10">
				<input type="hidden" name="paciente" value="<?php echo $paciente->pacIdPaciente;?>">		
				<button type="submit" class="btn btn-primary">Agregar Cita</button>
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
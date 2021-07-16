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
		<form class="form-horizontal" method="post" id="addproduct" action="index.php?view=citas2&id=<?php echo $paciente->pacIdPaciente?>&id2=<?php echo $medicoactual?>" role="form">
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
						<?php $medicoactual=$l->medIdMedico; endforeach; ?>
					</select>
				</div>
			</div>	
		</div>
		<p class="alert alert-info">* Campos obligatorios</p>
		<div class="form-group">
			<div class="col-lg-offset-2 col-lg-10">
				<input type="hidden" name="paciente" value="<?php echo $paciente->pacIdPaciente;?>">		
				<button type="submit" class="btn btn-primary">Siguiente </button>
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
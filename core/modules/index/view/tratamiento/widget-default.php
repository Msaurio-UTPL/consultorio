<?php
$u=null;
if(Session::getUID()!="")
{
	$u = SPUser::getById(Session::getUID());
	$user = $u->usuCodUsuario;
	$rol = $u->detIdRol;
	$historia = SPHistoria::getById($_GET["id"]);
	$med = SPMedico::getByIdSec($historia->medIdMedico);
	$paciente = SPBasica::getByIdSec($historia->paciente_pacIdPaciente);
	$cita = SPCita::getByIdPacFec($med->medIdMedico,$paciente->pacIdPaciente,$historia->hisFecha);
	$centro = SPCentro::getById($med->centro_cenIdCentro);
	$medi = SPDetConceptos::getAllId("33");
	$pres = SPDetConceptos::getAllId("34");
	$frec = SPDetConceptos::getAllId("35");
	$tiem = SPDetConceptos::getAllId("36");
	?>	
	<div class="row">
		<div class="col-md-12">
		<h3>Gestión de Tratamiento o Plan:</h3>
		<form class="form-horizontal" method="post" id="actualizamedicinas" action="index.php?view=actualizamedicinas&id=<?php echo $historia->hisIdHistoria; ?>" role="form">
			<?php 
			  if($u->detIdRol=='1' or $u->detIdRol=='2'):
			  ?>
			<div class="form-group">
				<label for="inputEmail1" class="col-lg-2 control-label">Centro:*</label> 
				<div class="col-md-4">
					<input type="text" readonly name="centro" readonly class="form-control" value="<?php echo $centro->cenDescripcion; ?>" id="centro" >
				</div>
			</div>
			<div class="form-group">
				<label for="inputEmail1" class="col-lg-2 control-label">Médico:*</label>
				<div class="col-md-4">
					<input type="text" name="medico" readonly class="form-control" value="<?php echo $med->medApellidos; echo " "; echo $med->medNombres; ?>" id="medico" >
				</div>
			</div>
			<div class="form-group">
				<label for="inputEmail1" class="col-lg-2 control-label">Paciente:*</label>
				<div class="col-md-4">
					<input type="text" name="paciente" readonly class="form-control" value="<?php echo $paciente->pacApellidos; echo " "; echo $paciente->pacNombres; ?>" id="paciente" >
				</div>
			</div>	
			<div class="form-group">
				<label for="inputEmail1" class="col-lg-2 control-label">Edad:*</label>
				<div class="col-md-2">
					<input type="text" name="edad" readonly class="form-control" value="<?php echo $paciente->edad; ?>" id="edad" >
				</div>
			</div>			
			<div class="form-group">
				<label for="inputEmail1" class="col-lg-2 control-label">Medicinas:</label>
				<div class="col-md-3">
					<select name="detIdMedicamento" required id="detIdMedicamento" class="form-control" >
						<option value="">-- Seleccione --</option>								
						<?php foreach($medi as $l):?>
							<option  value="<?php echo $l->detIdDetalle; ?>"><?php echo $l->detDescDetalle; ?></option>
						<?php endforeach; ?>
					</select>						
				</div>
			</div>		
			<div class="form-group">
				<label for="inputEmail1" class="col-lg-2 control-label">Tipo Presentación:</label>
				<div class="col-md-3">
					<select name="detIdTipoPresentacion" required id="detIdTipoPresentacion" class="form-control" >
						<option value="">-- Seleccione --</option>								
						<?php foreach($pres as $l):?>
							<option  value="<?php echo $l->detIdDetalle; ?>"><?php echo $l->detDescDetalle; ?></option>
						<?php endforeach; ?>
					</select>						
				</div>
			</div>				
			<div class="form-group">
				<label for="inputEmail1" class="col-lg-2 control-label">Cantidad:</label>
				<div class="col-md-2">
					<input type="text" required name="medCantidad" class="form-control" value="" id="medCantidad" placeholder="Cantidad Tratamiento">
				</div>
			</div>	
			<div class="form-group">
				<label for="inputEmail1" class="col-lg-2 control-label">Indicaciones:</label>
				<div class="col-md-8">
					<input type="text" required name="exaIndicaciones" class="form-control" value="" id="exaIndicaciones" placeholder="Registre Indicaciones para medicamento">
				</div>
			</div>	
			<div class="form-group">
				<label for="inputEmail1" class="col-lg-2 control-label">Frecuencia dosificación:</label>
				<div class="col-md-3">
					<select name="detIdFrecuencia" required id="detIdFrecuencia" class="form-control" >
						<option value="">-- Seleccione --</option>								
						<?php foreach($frec as $l):?>
							<option  value="<?php echo $l->detIdDetalle; ?>"><?php echo $l->detDescDetalle; ?></option>
						<?php endforeach; ?>
					</select>						
				</div>
			</div>	
			<div class="form-group">
				<label for="inputEmail1" class="col-lg-2 control-label">Tiempo dosificación:</label>
				<div class="col-md-3">
					<select name="detIdTiempo" required id="detIdTiempo" class="form-control" >
						<option value="">-- Seleccione --</option>								
						<?php foreach($tiem as $l):?>
							<option  value="<?php echo $l->detIdDetalle; ?>"><?php echo $l->detDescDetalle; ?></option>
						<?php endforeach; ?>
					</select>						
				</div>
			</div>	
			<div class="form-group">
				<label for="inputEmail1" class="col-lg-2 control-label">Cantidad dosificación:</label>
				<div class="col-md-2">
					<input type="text" required name="traCantidad" class="form-control" value="" id="traCantidad" placeholder="Cantidad Dosis">
				</div>
			</div>				
			<?php endif;?>		
			<div class="form-group">
				<div class="col-lg-offset-2 col-lg-10">
					<input type="hidden" name="cenIdCentro" class="form-control" value="<?php echo $med->centro_cenIdCentro; ?>" id="cenIdCentro" >
					<input type="hidden" name="historia" class="form-control" value="<?php echo $historia->hisIdHistoria; ?>" id="historia" >
					<input type="hidden" name="medico" class="form-control" value="<?php echo $historia->medIdMedico; ?>" id="medico" >
					<input type="hidden" name="fecha" class="form-control" value="<?php echo $historia->hisFecha; ?>" id="fecha" >
					<button type="submit" class="btn btn-primary">Registra tratamiento</button>
				</div>
			</div>	
		</form>	
		</div>
	</div>
<?php 
}
else
{
	View::Error("<b>Error!!!<br></b>No puede emplear el sistema sin iniciar sesión.<br><a href='index.php'>Inicio</a>");
	?>
	<?php
}
?>
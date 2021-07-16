<?php
$u=null;
if(Session::getUID()!="")
{
	$u = SPUser::getById(Session::getUID());
	$user = $u->usuCodUsuario;
	$rol = $u->detIdRol;
	$historia = SPHistoria::getById($_GET["id"]);
	$tipo = SPDetConceptos::getById(29,$_POST["tipoexamen"]);
	$med = SPMedico::getByIdSec($historia->medIdMedico);
	$paciente = SPBasica::getByIdSec($historia->paciente_pacIdPaciente);
	$cita = SPCita::getByIdPacFec($med->medIdMedico,$paciente->pacIdPaciente,$historia->hisFecha);
	$centro = SPCentro::getById($med->centro_cenIdCentro);
	?>	
	<div class="row">
		<div class="col-md-12">
		<h3>Gestión de Pedido de Examen:</h3>
		<form class="form-horizontal" method="post" id="actualizaexamen" action="index.php?view=actualizaexamen&id=<?php echo $historia->hisIdHistoria?>" role="form">
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
				<label for="inputEmail1" class="col-lg-2 control-label">Tipo Examen:*</label>
				<div class="col-md-2">
					<input type="text" name="tipo" readonly class="form-control" value="<?php echo $tipo->detDescDetalle; ?>" id="tipo" >
				</div>
			</div>		
			<?php
			if ($tipo->detIdDetalle == 1) {
				$te = 30;
			} else {
				if ($tipo->detIdDetalle == 2) {
					$te = 31;
				}
				else {
					$te = 32;
				}
			}
			$exam = SPDetConceptos::getAllId($te);
			?>
			<div class="form-group">
				<label for="inputEmail1" class="col-lg-2 control-label">Listado de Exámenes:</label>
				<div class="col-md-3">
					<select name="detIdTipoExamen" required id="detIdTipoExamen" class="form-control" >
						<option value="">-- Seleccione --</option>								
						<?php foreach($exam as $l):?>
							<option  value="<?php echo $l->detIdDetalle; ?>"><?php echo $l->detDescDetalle; ?></option>
						<?php endforeach; ?>
					</select>						
				</div>
			</div>		
			<div class="form-group">
				<label for="inputEmail1" class="col-lg-2 control-label">Indicaciones Exámen:</label>
				<div class="col-md-8">
					<input type="text" required name="exaIndicaciones" class="form-control" value="" id="exaIndicaciones" placeholder="Registre Indicaciones para realizar Exámen">
				</div>
			</div>		
			<div class="form-group">
				<label for="inputEmail1" class="col-lg-2 control-label">Fecha Realizar Exámen:</label>
				<div class="col-md-2">
					<input type="date" required name="exaFechaExamen" class="form-control" value="" id="exaFechaExamen" placeholder="Registre Fecha para realizar Exámen">
				</div>
			</div>	
			<?php endif;?>		
			<div class="form-group">
				<div class="col-lg-offset-2 col-lg-10">
					<input type="hidden" name="Examen" class="form-control" value="<?php echo $te; ?>" id="Examen" >
					<input type="hidden" name="historia" class="form-control" value="<?php echo $historia->hisIdHistoria; ?>" id="historia" >
					<input type="hidden" name="medico" class="form-control" value="<?php echo $med->medIdMedico; ?>" id="medico" >
					<input type="hidden" name="fecha" class="form-control" value="<?php echo $historia->hisFecha; ?>" id="fecha" >
					<button type="submit" class="btn btn-primary">Actualiza Examen</button>
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
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
	$tipo = SPDetConceptos::getAllId("29");
	$medi = SPDetConceptos::getAllId("32");
	$pres = SPDetConceptos::getAllId("33");
	?>	
	<div class="row">
		<div class="col-md-12">
		<h3>Gestión de Pedido de Examen:</h3>
		<form class="form-horizontal" method="post" id="addproduct" action="index.php?view=pedidoexamen1&id=<?php echo $historia->hisIdHistoria; ?>" role="form">
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
				<label for="inputEmail1" class="col-lg-2 control-label">Tipo de Exámen:</label>
				<div class="col-md-3">
					<select name="tipoexamen" id="tipoexamen" required class="form-control" >
						<option value="">-- Seleccione --</option>								
						<?php foreach($tipo as $l):?>
							<option  value="<?php echo $l->detIdDetalle; ?>"><?php echo $l->detDescDetalle; ?></option>
						<?php endforeach; ?>
					</select>						
				</div>
			</div>	
			<?php endif;?>		
			<div class="form-group">
				<div class="col-lg-offset-2 col-lg-10">
					<input type="hidden" name="historia" class="form-control" value="<?php echo $historia->hisIdHistoria; ?>" id="historia" >
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
	View::Error("<b>Error!!!<br></b>No puede emplear el sistema sin iniciar sesión.<br><a href='index.php'>Inicio</a>");
	?>
	<?php
}
?>
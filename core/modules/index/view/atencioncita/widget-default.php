<?php
$u=null;
if(Session::getUID()!="")
{
	$u = SPUser::getById(Session::getUID());
	$user = $u->usuCodUsuario;
	$rol = $u->detIdRol;
	$med = SPMedico::getByIdSec($_GET["id"]);
	$paciente = SPBasica::getByIdSec($_GET["id2"]);
	$cita = SPCita::getByIdPacFec($med->medIdMedico,$paciente->pacIdPaciente,$_GET["id3"]);
	$historia = SPHistoria::getByMedPacFec($med->medIdMedico,$paciente->pacIdPaciente,$cita->citFecha);
	$centro = SPCentro::getById($med->centro_cenIdCentro);
	$diagnostico = SPDiagnostico::getById($historia->hisIdHistoria);
	$examenes = SPExamenes::getByHis($historia->hisIdHistoria);
	$medicinas = SPMedicinas::getByHis($historia->hisIdHistoria);
	$tratamiento = SPTratamiento::getByHis($historia->hisIdHistoria);
	$cie = SPDetConceptos::getAllId("27");
	$diag = SPDetConceptos::getAllId("28");		
	$tipoex = SPDetConceptos::getAllId("29");
	$medi = SPDetConceptos::getAllId("33");
	$pres = SPDetConceptos::getAllId("34");
	$frec = SPDetConceptos::getAllId("35");
	$tiem = SPDetConceptos::getAllId("36");	
	?>	
	<div class="row">
		<div class="col-md-12">
		<form class="form-horizontal" method="post" id="actualizahistoria" action="index.php?view=actualizahistoria" role="form">
			<?php 
			  if($u->detIdRol=='1' or $u->detIdRol=='2'):
			  ?>
				<table style="width:80%">
				<tr>
					<td><a href="index.php?view=signosvitales&id=<?php echo $historia->hisIdHistoria; ?>" class="btn btn-primary"> Signos Vitales</a></td>
					<td><a href="index.php?view=antecedentesfamiliares&id=<?php echo $historia->hisIdHistoria; ?>" class="btn btn-primary"> Antecedentes Familiares</a></td>
					<td><a href="index.php?view=antecedentespersonalespa&id=<?php echo $historia->hisIdHistoria; ?>" class="btn btn-primary"> Antecedentes-Patológicos</a></td>
					<td><a href="index.php?view=antecedentespersonalespe&id=<?php echo $historia->hisIdHistoria; ?>" class="btn btn-primary"> Antecedentes-Pediátricos</a></td>
					<td><a href="index.php?view=antecedentespersonalesha&id=<?php echo $historia->hisIdHistoria; ?>" class="btn btn-primary"> Antecedentes-Hábitos</a></td>					
					<td><a href="index.php?view=organosysistemas&id=<?php echo $historia->hisIdHistoria; ?>" class="btn btn-primary"> Organos y Sistemas</a></td>
					<td><a href="index.php?view=examenfisico&id=<?php echo $historia->hisIdHistoria; ?>" class="btn btn-primary"> Examen Físico</a></td>
				</tr>
				</table>
			<h3>Datos de Consulta:</h3>				
			<?php endif;?>		
			<div class="form-group">
				<label for="inputEmail1" class="col-lg-2 control-label">Centro:*</label> 
				<div class="col-md-4">
					<input type="text" readonly name="centro" readonly class="form-control" value="<?php echo $centro->cenDescripcion; ?>" id="centro" >
				</div>
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
				<label for="inputEmail1" class="col-lg-2 control-label">Edad:*</label>
				<div class="col-md-2">
					<input type="text" name="edad" readonly class="form-control" value="<?php echo $paciente->edad; ?>" id="edad" >
				</div>
			</div>				
			<div class="form-group">
				<label for="inputEmail1" class="col-lg-2 control-label">Fecha de Consulta:*</label>
				<div class="col-md-2">
					<input type="text" name="fecha" readonly class="form-control" value="<?php echo $paciente->hoy; ?>" id="fecha" >
				</div>
			</div>		
			<h3>Gestión de Atención Médica:</h3>			
			<div class="form-group">
				<label for="inputEmail1" class="col-lg-2 control-label">Motivo de Consulta:*</label>
				<div class="col-md-8">
					<input type="text" name="hisMotivoConsulta" required class="form-control" value="<?php echo $historia->hisMotivoConsulta; ?>" id="hisMotivoConsulta" placeholder="Registre motivo de consulta">
				</div>
			</div>		
			<div class="form-group">
				<label for="inputEmail1" class="col-lg-2 control-label">Enfermedad:</label>
				<div class="col-md-8">
					<input type="text" name="hisEnfermedad" class="form-control" value="<?php echo $historia->hisEnfermedad; ?>" id="hisEnfermedad" placeholder="Registre enfermedad encontrada">
				</div>
			</div>	
			<div class="form-group">
				<div class="col-lg-offset-2 col-lg-10">
					<input type="hidden" name="cenIdCentro" class="form-control" value="<?php echo $med->centro_cenIdCentro; ?>" id="cenIdCentro" >
					<input type="hidden" name="historia" class="form-control" value="<?php echo $historia->hisIdHistoria; ?>" id="historia" >
					<input type="hidden" name="medico" class="form-control" value="<?php echo $historia->medIdMedico; ?>" id="medico" >
					<input type="hidden" name="fecha" class="form-control" value="<?php echo $historia->hisFecha; ?>" id="fecha" >
					<input type="hidden" name="paciente" class="form-control" value="<?php echo $paciente->pacIdPaciente; ?>" id="paciente" >
					<button type="submit" class="btn btn-primary">Cerrar Consulta</button>
				</div>
			</div>				
		</form>	
		<h3>Diagnósticos</h3>							
		<form class="form-horizontal" method="post" id="actualizadiagnostico" action="index.php?view=actualizadiagnostico&id=<?php echo $historia->hisIdHistoria?>" role="form">
			<div class="form-group">
				<label for="inputEmail1" class="col-lg-2 control-label">Diagnóstico:</label>
				<div class="col-md-8">
					<input type="text" name="diaDiagnostico" class="form-control" value="" id="diaDiagnostico" placeholder="Registre diagnóstico">
				</div>
			</div>				
			<div class="form-group">
				<label for="inputEmail1" class="col-lg-2 control-label">Código CIE-10:</label>
				<div class="col-md-5">
					<select name="detIdCie10" id="detIdCie10" class="form-control" >
						<option value="">-- Seleccione --</option>								
						<?php foreach($cie as $l):?>
							<option  value="<?php echo $l->detIdDetalle; ?>" ><?php echo $l->detDescDetalle; ?></option>
						<?php endforeach; ?>
					</select>						
				</div>
			</div>		
			<div class="form-group">
				<label for="inputEmail1" class="col-lg-2 control-label">Tipo de Diagnóstico:</label>
				<div class="col-md-3">
					<select name="detIdTipo" id="detIdTipo" class="form-control" >
						<option value="">-- Seleccione --</option>								
						<?php foreach($diag as $l):?>
							<option  value="<?php echo $l->detIdDetalle; ?>" ><?php echo $l->detDescDetalle; ?></option>
						<?php endforeach; ?>
					</select>						
				</div>
			</div>	
			<div class="form-group">
				<div class="col-lg-offset-2 col-lg-10">
					<input type="hidden" name="historia" class="form-control" value="<?php echo $historia->hisIdHistoria; ?>" id="historia" >
					<button type="submit" class="btn btn-primary">Agregar Diagnóstico</button>
				</div>
			</div>
		</form>		
		<?php if(count($diagnostico)>0) 
			{ // si hay datos ?>
			<table class="table table-bordered table-hover">
				<thead>
					<th>Diagnóstico</th>
					<th>CIE-10</th>
					<th>Tipo</th>
				</thead>
				<?php foreach($diagnostico as $d)
				{ ?>
					<tr>
					<td><?php echo $d->diaDiagnostico; ?></td>
					<td><?php 
								$cie10 = SPDetConceptos::getById($d->conIdCie10,$d->detIdCie10);
								echo $cie10->detNexo." ".$cie10->detDescDetalle;
						?>
					</td>						
					<td><?php 
								$tipo = SPDetConceptos::getById($d->conIdTipo,$d->detIdTipo);
								echo $tipo->detDescDetalle;
						?>
					</td>
					</tr>
					<?php
				} ?>
			</table> <?php 
			} ?>
		<h3>Pedidos Exámen</h3>							
		<form class="form-horizontal" method="post" id="actualizaexamen" action="index.php?view=pedidoexamen1&id=<?php echo $historia->hisIdHistoria?>" role="form">
			<div class="form-group">
				<label for="inputEmail1" class="col-lg-2 control-label">Tipos de Exámen:</label>
				<div class="col-md-3">
					<select name="tipoexamen" required id="tipoexamen" class="form-control" >
						<option value="">-- Seleccione --</option>								
						<?php foreach($tipoex as $l):?>
							<option  value="<?php echo $l->detIdDetalle; ?>"><?php echo $l->detDescDetalle; ?></option>
						<?php endforeach; ?>
					</select>						
				</div>
			</div>	
			<div class="form-group">
				<div class="col-lg-offset-2 col-lg-10">
					<input type="hidden" name="historia" class="form-control" value="<?php echo $historia->hisIdHistoria; ?>" id="historia" >
					<button type="submit" class="btn btn-primary">Agregar Exámen</button>
				</div>
			</div>
		</form>		
		<?php if(count($examenes)>0) 
			{ // si hay datos ?>
			<table class="table table-bordered table-hover">
				<thead>
					<!--<th>Clase Exámen</th> -->
					<th>Tipo Exámen</th>
					<th>Fecha Exámen</th>
					<th>Indicaciones Exámen</th>
				</thead>
				<?php foreach($examenes as $d)
				{ ?>
					<tr>
					<td><?php 
								$tipoe = SPDetConceptos::getById($d->conIdTipoExamen,$d->detIdTipoExamen);
								echo $tipoe->detDescDetalle;
						?>
					</td>						
					<td><?php echo $d->exaFechaExamen; ?></td>
					<td><?php echo $d->exaIndicaciones; ?></td>					
					</tr>
					<?php
				} ?>
			</table>
			<a href="report/reportepedido.php?id=<?php echo $historia->hisIdHistoria; ?>" class="btn btn-primary"> Imprime Pedido</a> <?php 
			} ?>			
		<h3>Medicinas y Tratamiento</h3>							
		<form class="form-horizontal" method="post" id="actualizamedicinas" action="index.php?view=actualizamedicinas&id=<?php echo $historia->hisIdHistoria?>" role="form">
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
			<div class="form-group">
				<label for="inputEmail1" class="col-lg-2 control-label">Dias Reposo:</label>
				<div class="col-md-1">
					<input type="text" name="dias" required class="form-control" value="5" id="dias" placeholder="Registre reposo">
				</div>
			</div>				
			<div class="form-group">
				<div class="col-lg-offset-2 col-lg-10">
					<input type="hidden" name="historia" class="form-control" value="<?php echo $historia->hisIdHistoria; ?>" id="historia" >
					<input type="hidden" name="medico" class="form-control" value="<?php echo $historia->medIdMedico; ?>" id="medico" >
					<input type="hidden" name="fecha" class="form-control" value="<?php echo $historia->hisFecha; ?>" id="fecha" >					
					<button type="submit" class="btn btn-primary">Agregar Medicinas/Tratamiento</button>
				</div>
			</div>
		</form>		
		<?php if(count($medicinas)>0) 
			{ // si hay datos ?>
			<table class="table table-bordered table-hover">
				<thead>
					<!--<th>Clase Exámen</th> -->
					<th>Medicina</th>
					<th>Presentación</th>
					<th>Cantidad Total</th>
					<th>Frecuencia</th>
					<th>Tiempo</th>
					<th>Dosis</th>
				</thead>
				<?php foreach($medicinas as $d)
				{ ?>
					<tr>
					<td><?php 
								$medici = SPDetConceptos::getById($d->conIdMedicamento,$d->detIdMedicamento);
								echo $medici->detDescDetalle;
						?>
					</td>	
					<td><?php 
								$tipopre = SPDetConceptos::getById($d->conIdTipoPresentacion,$d->detIdTipoPresentacion);
								echo $tipopre->detDescDetalle;
						?>
					</td>		
					<td><?php echo $d->medCantidad; ?></td>
					<?php $trata = SPTratamiento::getByIdDet($d->historia_hisIdHistoria,$d->medIdMedicinas); ?>
					<td><?php 
								$frecu = SPDetConceptos::getById($trata->conIdFrecuencia,$trata->detIdFrecuencia);
								echo $frecu->detDescDetalle;
						?>
					</td>
					<td><?php 
								$tiem = SPDetConceptos::getById($trata->conIdTiempo,$trata->detIdTiempo);
								echo $tiem->detDescDetalle;
						?>
					</td>					
					<td><?php echo $trata->traCantidad; ?></td>
					</tr>
					<?php
				} ?>
			</table>
			<a href="report/reportereceta.php?id=<?php echo $historia->hisIdHistoria; ?>" class="btn btn-primary"> Imprime Receta</a> <?php 
			} ?>
			<div>
				<input type="hidden" name="historia" class="form-control" value="<?php echo $historia->hisIdHistoria; ?>" id="historia" >
				<a href="report/reportecertificado.php?id=<?php echo $historia->hisIdHistoria; ?>" class="btn btn-primary">Imprime Certificado Médico</a>
				<a href="https://us02web.zoom.us/j/3086949770?pwd=T2tuVlNvcEN0L0VIRkJxZldYRGFWUT09" class="btn btn-primary">Consulta Virtual ZOOM</a>
			</div>	
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
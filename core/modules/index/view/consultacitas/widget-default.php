<?php
$u=null;
if(Session::getUID()!="")
{
	$u = SPUser::getById(Session::getUID());
	$user = $u->usuCodUsuario;
	$rol=$u->detIdRol;
	if ($rol=='1' or $rol=='2' or $rol=='3')
	{
	?>	
		<div class="row">
			<div class="col-md-12">
				<h3>Gestión de Atención Médica</h3>
				<?php
				$citas = array(); 
				$citas = SPCita::getByMed($_GET["id"]);
				if(count($citas)>0){
					// si hay datos
					?>
					<table class="table table-bordered table-hover">
					<thead>
					<th>Identificación</th>
					<th>Apellidos</th>
					<th>Nombres</th>
					<th>Fecha</th>
					<th>Hora</th>
					<th>Edad</th>
					<th>Estado</th>
					</thead>
					<?php foreach($citas as $cit) { 
					$paciente = array(); 
					$paciente = SPBasica::getByIdSec($cit->paciente_pacIdPaciente); ?>
						<tr>
						<td><?php echo $paciente->pacIdentificacion; ?></td>
						<td><?php echo $paciente->pacApellidos; ?></td>							
						<td><?php echo $paciente->pacNombres; ?></td>
						<td><?php echo $cit->citFecha; ?></td>
						<td><?php echo $cit->citHoraInicio; ?></td>
						<td><?php echo $paciente->edad; ?></td>
						<td><?php 
									$estado = SPDetConceptos::getById($cit->conIdEstado,$cit->detIdEstado);
									echo $estado->detDescDetalle;
							?>
						</td>
						<td style="width:30px;"><a href="index.php?view=editacita&id=<?php echo $cit->citIdCita?>" class="btn btn-warning btn-xs">Edición</a></td>
						<td style="width:30px;"><a href="index.php?view=atencioncita&id=<?php echo $cit->medIdMedico; ?>&id2=<?php echo $cit->paciente_pacIdPaciente; ?>&id3=<?php echo $cit->citFecha; ?>" class="btn btn-warning btn-xs">Atención Médica</a></td>						
						</tr>
						<?php
					}
				}else{
					echo "<p class='alert alert-danger'><b>ATENCIÓN:</b> No hay Citas Registradas.</p>";
				}
				?>
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
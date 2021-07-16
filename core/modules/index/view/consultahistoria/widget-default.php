<?php
error_reporting(E_ERROR | E_PARSE);
$u=null;
if(Session::getUID()!="")
{
	$u = SPUser::getById(Session::getUID());
	$user = $u->usuCodUsuario;
	$rol=$u->detIdRol;
	if ($rol=='1' or $rol=='2' or $rol=='3')
	{
		$paciente = array();
		$historia = array();
		$cita = array();
		$med = array();
		//echo $_GET["id"];
		if( isset($_GET["id"]) )
		{
			$paciente = SPBasica::getByIdSec($_GET["id"]);
			$historia = SPHistoria::getByPacFeciFecf($paciente->pacIdPaciente,$_POST['fechai'],$_POST['fechaf']);
		}		
	?>	
	<div class="row">
		<div class="col-md-12">
			<h3>Consulta de Historia Clínica por Rangos</h3>
			<form class="form-horizontal" method="post" id="addproduct" action="index.php?view=imprimehistoria&id=<?php echo $paciente->pacIdPaciente?>" role="form">
				<input type="hidden" name="view" value="historia">
				<div class="form-group">
					<div class="col-lg-offset-1 col-lg-5">
						<button type="submit" class="btn btn-primary">Imprime Rango</button>
					</div>
				</div>					
				<div class="form-group">
					<?php
					if(count($historia)>0)
					{
						//echo "si hay datos";
						?>
						<table class="table table-bordered table-hover">
							<thead>
							<th>Apellidos</th>
							<th>Nombres</th>
							<th>Edad</th>					
							<th>Fecha Consulta</th>	
							<th>Hora Consulta</th>	
							<th>Motivo Consulta</th>	
							<th>Médico</th>	
							</thead>
							<?php 
							foreach($historia as $his){ ?>
								<tr>
								<td><?php echo $paciente->pacApellidos; ?></td>
								<td><?php echo $paciente->pacNombres; ?></td>
								<td><?php echo $paciente->edad; ?></td>
								<td><?php echo $his->hisFecha; ?></td>
								<td><?php 
										$cita = SPCita::getByIdPacFec($his->medIdMedico,$paciente->pacIdPaciente,$his->hisFecha);
										echo $cita->citHoraInicio; 
									?>
								</td>						
								<td><?php echo $his->hisMotivoConsulta; ?></td>	
								<td><?php 
										$med = SPMedico::getByIdSec($his->medIdMedico);
										echo $med->medApellidos." ".$med->medNombres;
									?>
								</td>
								</tr>
							<?php
							} ?>
						</table>						
					<?php 
					}
					else
					{		
						echo "<p class='alert alert-danger'><b>ATENCIÓN:</b> No hay Historia con ese rango de fechas.</p>";
					}
					?>						
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
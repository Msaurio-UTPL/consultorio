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
	?>	
	<div class="row">
		<div class="col-md-12">
			<h3>Gestión de Historia</h3>
				<form class="form-horizontal" role="form">
					<input type="hidden" name="view" value="pacientes">
					<div class="form-group">
						<div class="col-lg-3">
							<div class="input-group">
							  <span class="input-group-addon"><i class="fa fa-search"></i></span>
							  <input type="text" name="q" value="<?php if(isset($_GET["q"]) && $_GET["q"]!=""){ echo $_GET["q"]; } ?>" required  class="form-control" placeholder="Apellidos">
							</div>
						</div>
						<div class="col-lg-2">
							<button class="btn btn-primary btn-block">Buscar</button>
						</div>
					</div>
				</form>	
				<?php
				$paciente = array();
				if( isset($_GET["q"]) )
				{
					$paciente = SPBasica::getLike($_GET["q"]);
				}
				if(count($paciente)>0)
				{
					//echo "si hay datos";
					?>
					<table class="table table-bordered table-hover">
					<thead>
					<th>ID</th>
					<th>Identificación</th>
					<th>Apellidos</th>
					<th>Nombres</th>
					<th>Genero</th>
					<th>Estado Civil</th>
					<th>Edad</th>					
					</thead>
					<?php 
					foreach($paciente as $pac){ ?>
						<tr>
						<td><?php echo $pac->pacIdPaciente; ?></td>
						<td><?php echo $pac->pacIdentificacion; ?></td>
						<td><?php echo $pac->pacApellidos; ?></td>
						<td><?php echo $pac->pacNombres; ?></td>
						<td><?php 
									$genero = SPDetConceptos::getById($pac->conIdGenero,$pac->detIdGenero);
									echo $genero->detDescDetalle;
							?>
						</td>
						<td><?php 
									$estado = SPDetConceptos::getById($pac->conIdEstadoCivil,$pac->detIdEstadoCivil);
									echo $estado->detDescDetalle;
							?>
						</td>
						<td><?php echo $pac->edad; ?></td>						
						<td style="width:30px;"><a href="index.php?view=historiadetalle&id=<?php echo $pac->pacIdPaciente;?>" class="btn btn-warning btn-xs">Detalle</a></td>
						</tr>
					</table>
					<?php
					}
				}
				else
				{		
					echo "<p class='alert alert-danger'><b>ATENCIÓN:</b> No hay Pacientes con esa descripcion.</p>";
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
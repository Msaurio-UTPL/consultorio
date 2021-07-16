<?php
error_reporting(E_ERROR | E_PARSE);
$u=null;
if(Session::getUID()!="")
{
	$u = SPUser::getById(Session::getUID());
	$user = $u->usuCodUsuario;
	$rol=$u->detIdRol;
	if ($rol=='1' or $rol=='2'  or $rol=='3' )
	{
	?>	
		<div class="row">
		<div class="col-md-12">
			<h3>Consulta de Pacientes</h3>
			<form class="form-horizontal" role="form">
				<input type="hidden" name="view" value="consultas">
				<div class="form-group">
					<div class="col-lg-3">
						<div class="input-group">
						  <span class="input-group-addon"><i class="fa fa-search"></i></span>
						  <input type="text" name="q" value="<?php if(isset($_GET["q"]) && $_GET["q"]!=""){ echo $_GET["q"]; } ?>" required  class="form-control" placeholder="Identificación">
						</div>
					</div>
					<div class="col-lg-2">
						<button class="btn btn-primary btn-block">Buscar</button>
					</div>
				</div>
			</form>
			<?php
			$paciente= array();
			if( isset($_GET["q"]) )
			{
				$paciente = SPBasica::getById($_GET['q']);
				//echo $paciente->pacIdentificacion;
			}
			if(count($paciente)>0)
			{
				// si hay datos
				?>
				<table class="table table-bordered table-hover">
				<thead>
					<th>Tipo Identificación</th>
					<th>Identificación</th>
					<th>Apellidos</th>
					<th>Nombres</th>
					<th>Genero</th>
					<th>Estado Civil</th>
					<th>Ocupacion</th>
					<th>Contacto</th>
					<th>Edad</th>
				</thead>
				<tr>
					<td><?php 	$detconcepto=SPDetConceptos::getById($paciente->conIdTipoIdentificacion,$paciente->detIdTipoIdentificacion);
								echo $detconcepto->detDescDetalle; ?></td>
					<td><?php echo $paciente->pacIdentificacion; ?></td>
					<td><?php echo $paciente->pacApellidos; ?></td>
					<td><?php echo $paciente->pacNombres; ?></td>
					<td><?php 	$detconcepto=SPDetConceptos::getById($paciente->conIdGenero,$paciente->detIdGenero);
								echo $detconcepto->detDescDetalle; ?></td>
					<td><?php 	$detconcepto=SPDetConceptos::getById($paciente->conIdEstadoCivil,$paciente->detIdEstadoCivil);
								echo $detconcepto->detDescDetalle; ?></td>
					<td><?php 	$detconcepto=SPDetConceptos::getById($paciente->conIdOcupacion,$paciente->detIdOcupacion);
								echo $detconcepto->detDescDetalle; ?></td>							
					<td><?php echo $paciente->pacContacto; ?></td>
					<td><?php echo $paciente->edad; ?></td>
				</tr>
				</table>
				
				<table class="table table-bordered table-hover">
				<tr>
					<td><a href="index.php?view=detcontacto&id=<?php echo $paciente->pacIdPaciente;?>" title="Datos de Contactos"><i class="glyphicon glyphicon-eye-open"></i> Contactos</a></td>
					<td><a href="index.php?view=detdireccion&id=<?php echo $paciente->pacIdPaciente;?>" title="Datos de Direcciones"><i class="glyphicon glyphicon-eye-open"></i> Direcciones</a></td>
					<td><a href="index.php?view=detcitas&id=<?php echo $paciente->pacIdPaciente;?>" title="Informacion de Citas"><i class="glyphicon glyphicon-eye-open"></i> Citas</a></td>
				</tr>
				</table>
				
			<?php
			}
			else
			{		
				echo "<p class='alert alert-danger'><b>ATENCIÓN:</b> No hay Pacientes con esa identificación.</p>";
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
}
?>
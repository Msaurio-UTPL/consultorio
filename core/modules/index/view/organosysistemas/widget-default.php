<?php
error_reporting(E_ERROR | E_PARSE);
$u=null;
if(Session::getUID()!="")
{
	$u = SPUser::getById(Session::getUID());
	$user = $u->usuCodUsuario;
	$usua = SPUser::getById($u->usuCodUsuario);
	$centro = SPCentro::getById($usua->centro_cenIdCentro);
	$historia = array();
	$historia = SPHistoria::getById($_GET["id"]);
	$persona = SPBasica::getByIdSec($historia->paciente_pacIdPaciente);
	$rol=$u->detIdRol;
	if ($rol=='1' or $rol=='2' or $rol=='3')
	{
	?>	
		<div class="row">
			<div class="col-md-12">
				<table style="width:80%">
				<tr>
					<td><a href="index.php?view=signosvitales&id=<?php echo $historia->hisIdHistoria; ?>" class="btn btn-primary"> Signos Vitales</a></td>
					<td><a href="index.php?view=antecedentesfamiliares&id=<?php echo $historia->hisIdHistoria; ?>" class="btn btn-primary"> Antecedentes Familiares</a></td>
					<td><a href="index.php?view=antecedentespersonalespa&id=<?php echo $historia->hisIdHistoria; ?>" class="btn btn-primary"> Antecedentes-Patológicos</a></td>
					<td><a href="index.php?view=antecedentespersonalespe&id=<?php echo $historia->hisIdHistoria; ?>" class="btn btn-primary"> Antecedentes-Pediátricos</a></td>
					<td><a href="index.php?view=antecedentespersonalesha&id=<?php echo $historia->hisIdHistoria; ?>" class="btn btn-primary"> Antecedentes-Hábitos</a></td>					
					<td><a href="index.php?view=organosysistemas&id=<?php echo $historia->hisIdHistoria; ?>" class="btn btn-primary"> Organos y Sistemas</a></td>
					<td><a href="index.php?view=examenfisico&id=<?php echo $historia->hisIdHistoria; ?>" class="btn btn-primary"> Examen Físico</a></td>
					<td><a href="index.php?view=atencioncita&id=<?php echo $historia->medIdMedico;?>&id2=<?php echo $persona->pacIdPaciente;?>&id3=<?php echo $historia->hisFecha;?>" class="btn btn-primary"> Regresa</a></td>
				</tr>
				</table>			
				<h3>Gestión de Organos y Sistemas</h3>
				<form class="form-horizontal" method="post" id="anadirorganos" action="index.php?view=anadirorganos&id=<?php echo $historia->hisIdHistoria; ?>" role="form">
				<div class="form-group">
					<label for="inputEmail1" class="col-lg-2 control-label">Centro:</label>
					<div class="col-md-3">
						<input type="text" readonly name="centro_cenIdCentro" required class="form-control" value="<?php echo $centro->cenDescripcion; ?>" id="centro_cenIdCentro" placeholder="Centro">
					</div>
				</div>				
				<?php
				$deta = array(); 
				$deta = SPDetConceptos::getAllId(18);
				//$historia = array(); $historia = SPHistoria::getByPac($_GET["id"]);
				$dethistoria = array(); $dethistoria = SPDetHistoria::getByHist($historia->hisIdHistoria,18);
				$con = 0;
				if(count($deta)>0){
					// si hay datos
					?>
					<table class="table table-bordered table-hover">
					<thead>
					<th>Antecedentes Personales: </th>
					<th><?php echo $persona->pacApellidos; ?> </th>
					<th><?php echo ""; ?> </th>
					<th><?php echo $persona->pacNombres; ?> </th>
					<th><?php echo "Edad:"; ?> </th>
					<th><?php echo $persona->edad; ?> </th>
					</thead>
					<?php foreach($deta as $det) { 
						$con = $con + 1; 
						$dethistoria = array(); $dethistoria = SPDetHistoria::getByIdHist($historia->hisIdHistoria,18,$det->detIdDetalle); 
						if (count($dethistoria)>0){ ?>
							<td>
								<input type="text" name="detDescDetalle<?php echo $det->detIdDetalle; ?>" id="detDescDetalle<?php echo $det->detIdDetalle; ?>" readonly value="<?php echo $det->detDescDetalle; ?>" class="form-control">
							</td>								
							<td>
								<input type="text" name="detAntecedente<?php echo $det->detIdDetalle; ?>" id="detAntecedente<?php echo $det->detIdDetalle; ?>" value="<?php echo $dethistoria->detAntecedente; ?>" placeholder="Sin Antecedente" class="form-control">
							</td>						
							<td>
								<input type="hidden" name="detIdDetalle<?php echo $det->detIdDetalle; ?>" id="detIdDetalle<?php echo $det->detIdDetalle; ?>" readonly value="<?php echo $det->detIdDetalle; ?>" class="form-control">
							</td>		
							<?php 
							} else { ?>
							<td>
								<input type="text" name="detDescDetalle<?php echo $det->detIdDetalle; ?>" id="detDescDetalle<?php echo $det->detIdDetalle; ?>" readonly value="<?php echo $det->detDescDetalle; ?>" class="form-control">
							</td>								
							<td>
								<input type="text" name="detAntecedente<?php echo $det->detIdDetalle; ?>" id="detAntecedente<?php echo $det->detIdDetalle; ?>" value="" placeholder="Sin Antecedente" class="form-control">
							</td>						
							<td>
								<input type="hidden" name="detIdDetalle<?php echo $det->detIdDetalle; ?>" id="detIdDetalle<?php echo $det->detIdDetalle; ?>" readonly value="<?php echo $det->detIdDetalle; ?>" class="form-control">
							</td> <?php 	
							}
							if ($con==2) { 
							$con = 0; ?> 
							<tr> </tr>						
					<?php 	}
					}
				}else{
					echo "<p class='alert alert-danger'><b>ATENCIÓN:</b> No hay Tabla de Signos.</p>";
				}
				?>
				<div class="form-group">
					<div class="col-lg-offset-2 col-lg-10">
						<input type="hidden" name="pacIdPaciente" id="pacIdPaciente" value="<?php echo $persona->pacIdPaciente;?>">
						<input type="hidden" name="historia" id="historia" value="<?php echo $historia->hisIdHistoria;?>">
						<input type="hidden" name="medico" id="medico" value="<?php echo $historia->medIdMedico;?>">
						<input type="hidden" name="fecha" id="fecha" value="<?php echo $historia->hisFecha;?>">
						<button type="submit" class="btn btn-primary">Actualizar Datos</button>
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
	?>
	<?php
}
?>
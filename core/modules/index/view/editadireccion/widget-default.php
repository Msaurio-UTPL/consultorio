<?php
$u=null;
if(Session::getUID()!="")
{
	$u = SPUser::getById(Session::getUID());
	$user = $u->usuCodUsuario;
	$rol=$u->detIdRol;
	$tipos = SPDetConceptos::getByCod("6","0");
	$paciente = SPBasica::getByIdSec($_GET["id"]);
	if ($rol=='1' or $rol=='2' or $rol=='3')
	{
		$estado="";
	?>
		<?php
			$direccion = SPDireccion::getById($_GET["id"],$_GET["id2"]);
			$tipo = SPDetConceptos::getByIdSec("5",$direccion->detIdDireccion);
			//echo $tipo->detDescDetalle;
		?>
		<div class="row">
			<div class="col-md-12">
			<h3>Edición de Dirección:</h3>
			<form class="form-horizontal" method="post" enctype="multipart/form-data" id="actualizadireccion" action="index.php?view=actualizadireccion" role="form">
				<div class="form-group">
					<label for="inputEmail1" class="col-lg-2 control-label">Paciente:</label>
					<div class="col-md-3">
						<input type="text" readonly name="paciente" required class="form-control" value="<?php echo $paciente->pacApellidos; echo " "; echo $paciente->pacNombres;?>" id="paciente" placeholder="Paciente">
						<input type="hidden" readonly name="id" class="form-control" value="<?php echo $direccion->paciente_pacIdPaciente; ?>" id="id">
						<input type="hidden" readonly name="id1" class="form-control" value="<?php echo $direccion->conIdDireccion; ?>" id="id1">
						<input type="hidden" readonly name="id2" class="form-control" value="<?php echo $direccion->detIdDireccion; ?>" id="id2">	
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail1" class="col-lg-2 control-label">Tipo de direccion Editado:</label>
					<div class="col-md-3">
						<input type="text" readonly name="desctipo" class="form-control" id="desctipo" value="<?php echo $tipo->detDescDetalle; ?>" placeholder="Tipo direccion anterior">
					</div>
				</div>				
				<div class="form-group">
					<label for="inputEmail1" class="col-lg-2 control-label">Tipo de direccion:</label>
					<div class="col-md-3">
						<input type="text" readonly name="detIdDireccion" class="form-control" id="detIdDireccion" value="<?php echo $tipo->detIdDetalle; ?>" placeholder="Tipo direccion">
					</div>
				</div>	
				<div class="form-group">
					<label for="inputEmail1" class="col-lg-2 control-label">Calles y Número / Cuenta Correo1:*</label>
					<div class="col-md-5">
						<input type="text" name="dirDescripcion1" required class="form-control" id="dirDescripcion1" value="<?php echo $direccion->dirDescripcion1; ?>" placeholder="Calles y Número / Cuenta Correo1">
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail1" class="col-lg-2 control-label">Sector o Barrio / Cuenta Correo2:*</label>
					<div class="col-md-5">
						<input type="text" name="dirDescripcion2" required class="form-control" id="dirDescripcion2" value="<?php echo $direccion->dirDescripcion2; ?>" placeholder="Sector o Barrio / Cuenta Correo2">
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail1" class="col-lg-2 control-label">Referencia:</label>
					<div class="col-md-5">
						<input type="text" name="dirDescripcion3" class="form-control" id="dirDescripcion3" value="<?php echo $direccion->dirDescripcion3; ?>" placeholder="Referencia">
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail1" class="col-lg-2 control-label">Activo:*</label>
					<div class="col-md-6">
						<label class="checkbox-inline">
							<input type="radio" id="inlineCheckbox1" name="detIdEstado" required value="1"> Activo
						</label>
						<label class="checkbox-inline">
							<input type="radio" id="inlineCheckbox2" name="detIdEstado" required value="2"> Inactivo
						</label>
					</div>
				</div>
			</div>
				<div class="form-group">
					<div class="col-lg-offset-2 col-lg-10">
						<button type="submit" class="btn btn-primary">Actualizar Dirección</button>
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
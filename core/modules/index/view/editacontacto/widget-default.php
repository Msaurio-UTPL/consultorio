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
			$contacto = SPContacto::getById($_GET["id"],$_GET["id2"]);
			$tipo = SPDetConceptos::getByIdSec("6",$contacto->detIdContacto);
			//echo $tipo->detDescDetalle;
		?>
		<div class="row">
			<div class="col-md-12">
			<h3>Edición de Contacto:</h3>
			<form class="form-horizontal" method="post" enctype="multipart/form-data" id="actualizacontacto" action="index.php?view=actualizacontacto" role="form">
				<div class="form-group">
					<label for="inputEmail1" class="col-lg-2 control-label">Paciente:</label>
					<div class="col-md-3">
						<input type="text" readonly name="paciente" required class="form-control" value="<?php echo $paciente->pacApellidos; echo " "; echo $paciente->pacNombres;?>" id="paciente" placeholder="Paciente">
						<input type="hidden" readonly name="id" class="form-control" value="<?php echo $contacto->paciente_pacIdPaciente; ?>" id="id">
						<input type="hidden" readonly name="id1" class="form-control" value="<?php echo $contacto->conIdContacto; ?>" id="id1">
						<input type="hidden" readonly name="id2" class="form-control" value="<?php echo $contacto->detIdContacto; ?>" id="id2">	
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail1" class="col-lg-2 control-label">Tipo de Contacto Editado:</label>
					<div class="col-md-3">
						<input type="text" readonly name="desctipo" class="form-control" id="desctipo" value="<?php echo $tipo->detDescDetalle; ?>" placeholder="Tipo contacto anterior">
					</div>
				</div>				
				<div class="form-group">
					<label for="inputEmail1" class="col-lg-2 control-label">Tipo de Contacto:</label>
					<div class="col-md-3">
						<input type="text" readonly name="detIdContacto" class="form-control" id="detIdContacto" value="<?php echo $tipo->detIdDetalle; ?>" placeholder="Tipo contacto">
					</div>
				</div>	
				<div class="form-group">
					<label for="inputEmail1" class="col-lg-2 control-label">Persona de Contacto:*</label>
					<div class="col-md-5">
						<input type="text" name="conDescripcion1" required class="form-control" id="conDescripcion1" value="<?php echo $contacto->conDescripcion1; ?>" placeholder="Persona de contacto">
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail1" class="col-lg-2 control-label">Número de Contacto:*</label>
					<div class="col-md-5">
						<input type="text" name="conDescripcion2" required class="form-control" id="conDescripcion2" value="<?php echo $contacto->conDescripcion2; ?>" placeholder="Numero de contacto">
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail1" class="col-lg-2 control-label">Referencia:</label>
					<div class="col-md-5">
						<input type="text" name="conDescripcion3" class="form-control" id="conDescripcion3" value="<?php echo $contacto->conDescripcion3; ?>" placeholder="Referencia">
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
						<button type="submit" class="btn btn-primary">Actualizar Contacto</button>
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
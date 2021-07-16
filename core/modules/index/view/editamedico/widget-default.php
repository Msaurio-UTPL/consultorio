<?php
$u=null;
if(Session::getUID()!="")
{
	$u = SPUser::getById(Session::getUID());
	$user = $u->usuCodUsuario;
	$rol = $u->detIdRol;
	$tipoid = SPDetConceptos::getByCod("4","0");
	$espe = SPDetConceptos::getByCod("11","0");
	$dura = SPDetConceptos::getByCod("13","0");
	if ($rol=='1' or $rol =='2')
	{
		$estado="";
	?>
		<?php
			$user = SPMedico::getByIdSec($_GET["id"]);
			$centro = SPCentro::getById($user->centro_cenIdCentro);
		?>
			
		<div class="row">
			<div class="col-md-12">
			<h3>Edición de Datos de Médico:</h3>
			<form class="form-horizontal" method="post" id="actualizamedico" action="index.php?view=actualizamedico" role="form">
				<div class="form-group">
					<label for="inputEmail1" class="col-lg-2 control-label">Centro:*</label>
					<div class="col-md-3">
						<input type="text" readonly name="centro" required class="form-control" value="<?php echo $centro->cenDescripcion; ?>" id="centro" placeholder="Centro">
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail1" class="col-lg-2 control-label">Apellidos:*</label>
					<div class="col-md-6">
						<input type="text" name="medApellidos" required class="form-control" id="medApellidos" value="<?php echo $user->medApellidos; ?>" placeholder="Apellidos del Médico">
					</div>
				</div>				
				<div class="form-group">
					<label for="inputEmail1" class="col-lg-2 control-label">Nombres:*</label>
					<div class="col-md-6">
						<input type="text" name="medNombres" required class="form-control" id="medNombres" value="<?php echo $user->medNombres; ?>" placeholder="Nombres del Médico">
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail1" class="col-lg-2 control-label">TipoId:*</label>
					<div class="col-md-6">
						<select name="detIdTipoIdentificacion" id="detIdTipoIdentificacion" class="form-control" required>
							<option value="">-- Seleccione --</option>									
							<?php foreach($tipoid as $l):?>
								<option  value="<?php echo $l->detIdDetalle; ?>"<?php if ($l->detIdDetalle == $user->detIdTipoIdentificacion) echo "selected"; ?> ><?php echo $l->detDescDetalle; ?></option>
							<?php endforeach; ?>
						</select>						
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail1" class="col-lg-2 control-label">Identificacion:*</label>
					<div class="col-md-6">
						<input type="text" name="medIdentificacion" required class="form-control" id="medIdentificacion" value="<?php echo $user->medIdentificacion; ?>" placeholder="Identificación del Médico">
					</div>
				</div>				
				<div class="form-group">
					<label for="inputEmail1" class="col-lg-2 control-label">Especialidad:*</label>
					<div class="col-md-6">
						<select name="detIdEspecialidad" id="detIdEspecialidad" class="form-control" required>
							<option value="">-- Seleccione --</option>									
							<?php foreach($espe as $l):?>
								<option  value="<?php echo $l->detIdDetalle; ?>"<?php if ($l->detIdDetalle == $user->detIdEspecialidad) echo "selected"; ?>><?php echo $l->detDescDetalle; ?></option>
							<?php endforeach; ?>
						</select>						
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail1" class="col-lg-2 control-label">Duración Citas:*</label>
					<div class="col-md-6">
						<select name="detIdDuracion" id="detIdDuracion" class="form-control" required>
							<option value="">-- Seleccione --</option>									
							<?php foreach($dura as $l):?>
								<option  value="<?php echo $l->detIdDetalle; ?>"<?php if ($l->detIdDetalle == $user->detIdDuracion) echo "selected"; ?>><?php echo $l->detDescDetalle; ?></option>
							<?php endforeach; ?>
						</select>						
					</div>
				</div>						
				<div class="form-group">
					<label for="inputEmail1" class="col-lg-2 control-label">Activo:*</label>
					<div class="col-md-6">
						<label class="checkbox-inline">
							<input type="radio" id="detIdEstado" name="detIdEstado" <?php echo $estado; ?> <?php if($user->detIdEstado=="1"){ echo "checked"; }?> value="1"> Activo
						</label>
						<label class="checkbox-inline">
							<input type="radio" id="detIdEstado" name="detIdEstado" <?php echo $estado; ?> <?php if($user->detIdEstado=="2"){ echo "checked"; }?> value="2"> Inactivo
						</label>
					</div>
				</div>
				<div class="form-group">
					<div class="col-lg-offset-2 col-lg-10">
						<input type="hidden" name="medIdMedico" value="<?php echo $user->medIdMedico;?>">
						<input type="hidden" name="centro_cenIdCentro" value="<?php echo $user->centro_cenIdCentro;?>">
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
}
?>
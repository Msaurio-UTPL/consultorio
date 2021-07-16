<?php
$u=null;
if(Session::getUID()!="")
{
	$u = SPUser::getById(Session::getUID());
	$user = $u->usuCodUsuario;
	$rol=$u->detIdRol;
	if ($rol=='1' or $rol=='2')
	{
		$tipoactual = 0;
		$tipoid = SPDetConceptos::getByCod("4","0");
		$espeactual = 0;
		$especialidad = SPDetConceptos::getByCod("11","0");
		$duraactual = 0;
		$duracion = SPDetConceptos::getByCod("13","0");		
		$centro = SPCentro::getAll();
	?>
	<div class="row">
		<div class="col-md-12">
		<h3>Nuevo Médico</h3>
		<form class="form-horizontal" method="post" id="addproduct" action="index.php?view=anadirmedico" role="form">
			<div class="form-group">
				<label for="inputEmail1" class="col-lg-2 control-label">Centro:*</label>
				<div class="col-md-4">
					<select name="centro_cenIdCentro" id="centro_cenIdCentro" class="form-control" required>
						<option value="">-- Seleccione --</option>									
						<?php foreach($centro as $l):?>
							<option  value="<?php echo $l->cenIdCentro; ?>"><?php echo $l->cenDescripcion; ?></option>
						<?php endforeach; ?>
					</select>	
				</div>
			</div>			
			<div class="form-group">
				<label for="inputEmail1" class="col-lg-2 control-label">Apellidos:*</label>
				<div class="col-md-4">
					<input type="text" name="medApellidos" required class="form-control" id="medApellidos" placeholder="Apellidos">
				</div>
			</div>
			<div class="form-group">
				<label for="inputEmail1" class="col-lg-2 control-label">Nombres:*</label>
				<div class="col-md-4">
					<input type="text" name="medNombres" required class="form-control" id="medNombres" placeholder="Nombres">
				</div>
			</div>
			<div class="form-group">
				<label class="col-lg-2 control-label">Tipo Identificación:*</label>
				<div class="col-lg-3">
					<select name="detIdTipoIdentificacion" id="detIdTipoIdentificacion" class="form-control" required>
						<option value="">-- Seleccione --</option>
						<?php foreach($tipoid as $l):?>
							<option <?php if(isset($tipoactual) and $l->detIdDetalle==$tipoactual){ echo "selected"; }?> value="<?php echo $l->detIdDetalle; ?>"><?php echo $l->detDescDetalle; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>		
			<div class="form-group">
				<label for="inputEmail1" class="col-lg-2 control-label">Identificación:*</label>
				<div class="col-md-4">
					<input type="text" name="medIdentificacion" required class="form-control" id="medIdentificacion" placeholder="Número de Identificación">
				</div>
			</div>
			<div class="form-group">
				<label class="col-lg-2 control-label">Especialidad:*</label>
				<div class="col-lg-3">
					<select name="detIdEspecialidad" id="detIdEspecialidad" class="form-control" required>
						<option value="">-- Seleccione --</option>
						<?php foreach($especialidad as $l):?>
							<option <?php if(isset($espeactual) and $l->detIdDetalle==$espeactual){ echo "selected"; }?> value="<?php echo $l->detIdDetalle; ?>"><?php echo $l->detDescDetalle; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>	
			<div class="form-group">
				<label class="col-lg-2 control-label">Duración de Citas:*</label>
				<div class="col-lg-3">
					<select name="detIdDuracion" id="detIdDuracion" class="form-control" required>
						<option value="">-- Seleccione --</option>
						<?php foreach($duracion as $l):?>
							<option <?php if(isset($duraactual) and $l->detIdDetalle==$duraactual){ echo "selected"; }?> value="<?php echo $l->detIdDetalle; ?>"><?php echo $l->detDescDetalle; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>	
			<div class="form-group">
				<label for="inputEmail1" class="col-lg-2 control-label">Estado:*</label>
				<div class="col-md-6">
				<label class="checkbox-inline">
					<input type="radio" id="inlineCheckbox1" name="activo" required value="1"> Activo
				</label>
				<label class="checkbox-inline">
					<input type="radio" id="inlineCheckbox2" name="activo" required value="2"> Inactivo
				</label>
			</div>
		</div>
		<p class="alert alert-info">* Campos obligatorios</p>
		<div class="form-group">
			<div class="col-lg-offset-2 col-lg-10">
				<input type="hidden" name="usuIdUsuario" id="usuIdUsuario" value="<?php echo $user->usuIdUsuario;?>">
				<button type="submit" class="btn btn-primary">Agregar Médico</button>
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
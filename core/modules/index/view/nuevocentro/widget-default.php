<?php
$u=null;
if(Session::getUID()!="")
{
	$u = SPUser::getById(Session::getUID());
	$user = $u->usuCodUsuario;
	$rol=$u->detIdRol;
	if ($rol=='1')
	{
		$tipoactual = 0;
		$tipoid = SPDetConceptos::getByCod("3","0");
	?>
	<div class="row">
		<div class="col-md-12">
		<h3>Nuevo Centro</h3>
		<form class="form-horizontal" method="post" id="addproduct" action="index.php?view=anadircentro" role="form">
			<div class="form-group">
				<label for="inputEmail1" class="col-lg-2 control-label">Descripción:*</label>
				<div class="col-md-4">
					<input type="text" name="cenDescripcion" required class="form-control" id="cenDescripcion" placeholder="Descripción">
				</div>
			</div>
			<div class="form-group">
				<label for="inputEmail1" class="col-lg-2 control-label">Identificación:*</label>
				<div class="col-md-4">
					<input type="text" name="cenIdentificacion" required class="form-control" id="cenIdentificacion" placeholder="Número de Identificación">
				</div>
			</div>
			<div class="form-group">
				<label class="col-lg-2 control-label">Tipo Persona:*</label>
				<div class="col-lg-3">
					<select name="detIdTipo" id="detIdTipo" class="form-control" required>
						<option value="">-- Seleccione --</option>
						<?php foreach($tipoid as $l):?>
							<option <?php if(isset($tipoactual) and $l->detIdDetalle==$tipoactual){ echo "selected"; }?> value="<?php echo $l->detIdDetalle; ?>"><?php echo $l->detDescDetalle; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>		
			<div class="form-group">
				<label for="inputEmail1" class="col-lg-2 control-label">Inicio Suscripción:*</label>
				<div class="col-md-4">
					<input type="date" name="cenSuscripcionInicio" required class="form-control" id="cenSuscripcionInicio" placeholder="Fecha Inicio Suscripción:">
				</div>
			</div>
			<div class="form-group">
				<label for="inputEmail1" class="col-lg-2 control-label">Fin Suscripción:*</label>
				<div class="col-md-4">
					<input type="date" name="cenSuscripcionFin" required class="form-control" id="cenSuscripcionFin" placeholder="Fecha Fin Suscripción:">
				</div>
			</div>
			<div class="form-group">
				<label for="inputEmail1" class="col-lg-2 control-label">Dirección:*</label>
				<div class="col-md-4">
					<input type="text" name="cenDireccion" required class="form-control" id="cenDireccion" placeholder="Dirección">
				</div>
			</div>	
			<div class="form-group">
				<label for="inputEmail1" class="col-lg-2 control-label">Teléfonos:*</label>
				<div class="col-md-4">
					<input type="text" name="cenTelefonos" required class="form-control" id="cenTelefonos" placeholder="Números de Teléfono separados por '-' ">
				</div>
			</div>	
		</div>
		<p class="alert alert-info">* Campos obligatorios</p>
		<div class="form-group">
			<div class="col-lg-offset-2 col-lg-10">
				<button type="submit" class="btn btn-primary">Agregar Centro</button>
			</div>
		</div>
		</form>
		</div>
	</div>
	<?php
	}
	else
	{
		View::Error("<b>Error!!!<br></b>El usuario <b>".$user."</b> no esta autorizado para emplear esta opción.<br><a href='index.php?view=centro'>Inicio</a>");
	}
}
else
{
	View::Error("<b>Error!!!<br></b>No puede emplear el sistema sin iniciar sesión.<br><a href='index.php'>Inicio</a>");
}
?>
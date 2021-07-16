<?php
$u=null;
if(Session::getUID()!="")
{
	$u = SPUser::getById(Session::getUID());
	$user = $u->usuCodUsuario;
	$rol=$u->detIdRol;
	$roles = SPDetConceptos::getByCod("2","0");
	$centro = SPCentro::getAll();
	if ($rol=='1' or $rol=='2')
	{
	?>
	<div class="row">
		<div class="col-md-12">
		<h3>Nuevo Usuario</h3>
		<form class="form-horizontal" method="post" id="addproduct" action="index.php?view=anadirusuario" role="form">
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
				<label for="inputEmail1" class="col-lg-2 control-label">Código:*</label>
				<div class="col-md-3">
					<input type="text" name="codigo" required class="form-control" id="codigo" placeholder="Código">
				</div>
			</div>
			<div class="form-group">
				<label for="inputEmail1" class="col-lg-2 control-label">Nombre:*</label>
				<div class="col-md-6">
					<input type="text" name="nombre" required class="form-control" id="nombre" placeholder="Nombre completo del usuario">
				</div>
			</div>
			<div class="form-group">
				<label for="inputEmail1" class="col-lg-2 control-label">Clave:*</label>
				<div class="col-md-6">
					<input type="password" name="clave" required class="form-control" id="clave" placeholder="Contraseña del usuario">
				</div>
			</div>
			<div class="form-group">
				<label for="inputEmail1" class="col-lg-2 control-label">Mail:*</label>
				<div class="col-md-6">
					<input type="email" name="mail" required class="form-control" id="mail" placeholder="Cuenta correo electrónico">
				</div>
			</div>			
			<div class="form-group">
				<label for="inputEmail1" class="col-lg-2 control-label">Rol:*</label>
				<div class="col-md-6">
					<select name="detIdRol" id="detIdRol" class="form-control" required>
						<option value="">-- Seleccione --</option>									
						<?php foreach($roles as $l):?>
							<option  value="<?php echo $l->detIdDetalle; ?>"><?php echo $l->detDescDetalle; ?></option>
						<?php endforeach; ?>
					</select>	
				</div>
			</div>
			<div class="form-group">
				<label for="inputEmail1" class="col-lg-2 control-label">Activo:*</label>
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
				<button type="submit" class="btn btn-primary">Agregar Usuario</button>
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
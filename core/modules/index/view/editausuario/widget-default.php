<?php
$u=null;
if(Session::getUID()!="")
{
	$u = SPUser::getById(Session::getUID());
	$user = $u->usuCodUsuario;
	$rol = $u->detIdRol;
	$roles = SPDetConceptos::getByCod("2","0");
	if ($rol=='1' or $rol =='2')
	{
		$estado="";
	?>
		<?php
			$user = SPUser::getBySec($_GET["id"]);
			$centro = SPCentro::getById($user->centro_cenIdCentro);
		?>
			
		<div class="row">
			<div class="col-md-12">
			<h3>Edición de Usuarios:</h3>
			<form class="form-horizontal" method="post" id="actualizausuario" action="index.php?view=actualizausuario" role="form">
				<div class="form-group">
					<label for="inputEmail1" class="col-lg-2 control-label">Centro:*</label>
					<div class="col-md-3">
						<input type="text" readonly name="centro_cenIdCentro" required class="form-control" value="<?php echo $centro->cenDescripcion; ?>" id="centro_cenIdCentro" placeholder="Centro">
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail1" class="col-lg-2 control-label">Código:*</label>
					<div class="col-md-3">
						<input type="text" name="usuCodUsuario" required class="form-control" value="<?php echo $user->usuCodUsuario; ?>" id="usuCodUsuario" placeholder="Código">
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail1" class="col-lg-2 control-label">Nombre:*</label>
					<div class="col-md-6">
						<input type="text" name="usuNombreUsuario" required class="form-control" id="usuNombreUsuario" value="<?php echo $user->usuNombreUsuario; ?>" placeholder="Nombre completo del usuario">
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail1" class="col-lg-2 control-label">Clave:*</label>
					<div class="col-md-6">
						<input type="password" name="usuClaveUsuario" required class="form-control" id="usuClaveUsuario" value="<?php echo $user->usuClaveUsuario; ?>" placeholder="Contraseña del usuario">
						
						<input type="hidden" name="claveant" required class="form-control" id="claveant" value="<?php echo $user->usuClaveUsuario; ?>" >
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail1" class="col-lg-2 control-label">Mail:*</label>
					<div class="col-md-6">
						<input type="email" name="usuCorreo" required class="form-control" id="usuCorreo" value="<?php echo $user->usuCorreo; ?>" placeholder="Cuenta correo electrónico">
					</div>
				</div>				
				<div class="form-group">
					<label for="inputEmail1" class="col-lg-2 control-label">Rol:*</label>
					<div class="col-md-6">
						<select name="detIdRol" id="detIdRol" class="form-control" required>
							<option value="">-- Seleccione --</option>	
							<?php foreach($roles as $l):?>
								<option  value="<?php echo $l->detIdDetalle; ?>" <?php	if ($l->detIdDetalle == $user->detIdRol) echo "selected"; ?> ><?php echo $l->detDescDetalle; ?></option>
							<?php endforeach; ?>
						</select>						
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail1" class="col-lg-2 control-label">Activo:*</label>
					<div class="col-md-6">
						<label class="checkbox-inline">
							<input type="radio" id="inlineCheckbox1" name="detIdEstado" required <?php echo $estado; ?> <?php if($user->detIdEstado=="1"){ echo "checked"; }?> value="1"> Activo
						</label>
						<label class="checkbox-inline">
							<input type="radio" id="inlineCheckbox2" name="detIdEstado" required <?php echo $estado; ?> <?php if($user->detIdEstado=="2"){ echo "checked"; }?> value="2"> Inactivo
						</label>
					</div>
				</div>
				<div class="form-group">
					<div class="col-lg-offset-2 col-lg-10">
						<input type="hidden" name="usuIdUsuario" value="<?php echo $user->usuIdUsuario;?>">
						<button type="submit" class="btn btn-primary">Actualizar Usuario</button>
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
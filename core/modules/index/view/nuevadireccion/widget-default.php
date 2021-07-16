<?php
$u=null;
if(Session::getUID()!="")
{
	$u = SPUser::getById(Session::getUID());
	$user = $u->usuCodUsuario;
	$rol=$u->detIdRol;
	if ($rol=='1' or $rol=='2' or $rol=='3')
	{
		$estado="";
	?>
		<?php
			//echo $_GET["id"];
			$dir = SPDireccion::getBySec($_GET["id"]);
			$tipo = SPDetConceptos::getByDirReg("5",$_GET["id"]);
			if (count($dir)>0)
			{
				View::Error("<b>Atencion!!! El paciente ya tiene direcciones registradas... por favor revise<br>");
			}				
				?>
				<div class="row">
				<div class="col-md-12">
					<h3>Gestión de Direcciones:</h3>
					<form class="form-horizontal" method="post" id="adddireccion" action="index.php?view=anadirdireccion" role="form">
					<div class="form-group">
						<label for="inputEmail1" class="col-lg-2 control-label">Código:</label>
						<div class="col-md-3">
							<input type="text" readonly name="id" class="form-control" value=
							"<?php echo $_GET["id"]; ?>" id="id" placeholder="Código">
						</div>
					</div>			
					<div class="form-group">
						<label class="col-lg-2 control-label">Tipo Dirección:*</label>
						<div class="col-lg-3">
							<select name="tipo" id="tipo" class="form-control" required>
								<option value="">-- Seleccione --</option>
								<?php foreach($tipo as $l):?>
									<option value="<?php echo $l->detIdDetalle; ?>"><?php echo $l->detDescDetalle; ?></option>
								<?php endforeach; ?>
							</select>
						</div>					
					</div>							
					<div class="form-group">
						<label for="inputEmail1" class="col-lg-2 control-label">Calles y Número / Cuenta Correo1:*</label>
						<div class="col-md-4">
							<input type="text" name="dirDescripcion1" required class="form-control" id="dirDescripcion1" placeholder="Principal e Intersección / Cuenta de Correo1">
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail1" class="col-lg-2 control-label">Sector o Barrio / Cuenta Correo2:*</label>
						<div class="col-md-4">
							<input type="text" name="dirDescripcion2" required class="form-control" id="dirDescripcion2" placeholder="Parroquia o Sector y Barrio / Cuenta de Correo2">
						</div>
					</div>			
					<div class="form-group">
						<label for="inputEmail1" class="col-lg-2 control-label">Referencia:</label>
						<div class="col-md-4">
							<input type="text" name="dirDescripcion3" class="form-control" id="dirDescripcion3" placeholder="Referencia lugar cercano">
						</div>
					</div>						
					<div class="form-group">
						<div class="col-lg-offset-2 col-lg-10">
							<button type="submit" class="btn btn-primary">Añadir Dirección</button>
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
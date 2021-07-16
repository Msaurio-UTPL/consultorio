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
			//echo "inicia:"; echo $_GET["id"];
			$con = SPContacto::getBySec($_GET["id"]);
			$tipo = SPDetConceptos::getByConReg("6",$_GET["id"]);
			if (count($con)>0)
			{
				View::Error("<b>Atencion!!! El paciente ya tiene contactos registrados... por favor revise<br>");
			}				
				?>
				<div class="row">
				<div class="col-md-12">
					<h3>Gestión de Contactos:</h3>
					<form class="form-horizontal" method="post" id="addcontacto" action="index.php?view=anadircontacto" role="form">
					<div class="form-group">
						<label for="inputEmail1" class="col-lg-2 control-label">Código:</label>
						<div class="col-md-3">
							<input type="text" readonly name="id" class="form-control" value=
							"<?php echo $_GET["id"]; ?>" id="id" placeholder="Código">
						</div>
					</div>		
					<div class="form-group">
						<label class="col-lg-2 control-label">Tipo Contacto:*</label>
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
						<label for="inputEmail1" class="col-lg-2 control-label">Persona de Contacto:*</label>
						<div class="col-md-4">
							<input type="text" name="conDescripcion1" required class="form-control" id="conDescripcion1" placeholder="Nombre del contacto">
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail1" class="col-lg-2 control-label">Número de Contacto:*</label>
						<div class="col-md-4">
							<input type="text" name="conDescripcion2" required class="form-control" id="conDescripcion2" placeholder="Formato: cod.provincia + num.telefonico de 7 digitos">
						</div>
					</div>			
					<div class="form-group">
						<label for="inputEmail1" class="col-lg-2 control-label">Referencia:*</label>
						<div class="col-md-4">
							<input type="text" name="conDescripcion3" required class="form-control" id="conDescripcion3" placeholder="Referencia del contacto">
						</div>
					</div>						
					<div class="form-group">
						<div class="col-lg-offset-2 col-lg-10">
							<button type="submit" class="btn btn-primary">Añadir Contacto</button>
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
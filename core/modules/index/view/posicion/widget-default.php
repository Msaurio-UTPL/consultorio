<?php
$u=null;
if(Session::getUID()!="")
{
	$u = SPUser::getById(Session::getUID());
	$user = $u->usuCodUsuario;
	$rol=$u->detIdRol;
	if ($rol=='1' or $rol=='2' or $rol=='3')
	{
		$proveedor = SPBasica::getInfoByIdSec($_GET["id"]);
		?>
		<h3>Posicionamiento del Proveedor:</h3>
		<?php
		if (count($proveedor)>0)
		{
			$vrazonsocial=$proveedor->proDescProveedor;
			$total1=SPCatalogo::getTotal($_GET["id"],1);
			$total2=SPCatalogo::getTotal($_GET["id"],2);
			$total3=SPCatalogo::getTotal($_GET["id"],3);
			/*
			echo "<br>".$proveedor->proHistorico;
			echo "<br>".$proveedor->proPrueba;
			echo "<br>".$proveedor->proRechazado;
			echo "<br>".$proveedor->proTecnologico;
			echo "<br>".$proveedor->proCritico;
			echo "<br>".$proveedor->proNacional;
			echo "<br>".$proveedor->proExtranjero;
			*/
			?>
			<div class="row">
				<div class="col-md-12">
				<form class="form-horizontal" method="post" id="addproduct" action="index.php?view=actualizarposicion" role="form">
					<div class="form-group">
						<div class="col-md-3">
							<input type="hidden" name="codigo" readonly class="form-control" value ="<?php echo $_GET["id"]; ?>" id="codigo">
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail1" class="col-lg-2 control-label">Nombre:</label>
						<div class="col-md-6">
							<input type="text" name="nombre" readonly class="form-control" value ="<?php echo $vrazonsocial; ?>" id="nombre" >
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail1" class="col-lg-2 control-label">Producto:*</label>
						<div class="col-md-6">
							<label class="checkbox-inline">
								<input type="checkbox" id="CheckBien" disabled name="CheckBien" <?php if (count($total1)>0) echo "checked";?> > Bienes </label>
							<label class="checkbox-inline">
								<input type="checkbox" id="CheckServicio" disabled name="CheckServicio" <?php if (count($total2)>0) echo "checked";?> > Servicios </label>
							<label class="checkbox-inline">
								<input type="checkbox" id="CheckRecurso" disabled name="CheckRecurso" <?php if (count($total3)>0) echo "checked";?> > Recursos </label>
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail1" class="col-lg-2 control-label">Relación:*</label>
						<div>
							<label class="checkbox-inline">
								<input type="radio" id="relacion" name="relacion" <?php if ($proveedor->proHistorico==1) echo "checked"; ?> required value="1"> Histórica
							</label>
							<label class="checkbox-inline">
								<input type="radio" id="relacion" name="relacion" <?php if ($proveedor->proPrueba==1) echo "checked"; ?> required value="2"> A prueba
							</label>
							<label class="checkbox-inline">
								<input type="radio" id="relacion" name="relacion" <?php if ($proveedor->proRechazado==1) echo "checked"; ?> required value="3"> Rechazado
							</label>
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail1" class="col-lg-2 control-label">Servicios Críticos:*</label>
						<div>
							<label class="checkbox-inline">
								<input type="radio" id="critico" name="critico" <?php if ($proveedor->proCritico==1) echo "checked"; ?> required value="1"> Si </label>
							<label class="checkbox-inline">
								<input type="radio" id="critico" name="critico" <?php if ($proveedor->proCritico==0) echo "checked"; ?> required value="0"> No </label>
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail1" class="col-lg-2 control-label">Característica:*</label>
						<div>
							<label class="checkbox-inline">
								<input type="radio" id="tecno" name="tecno" <?php if ($proveedor->proTecnologico==1) echo "checked"; ?> required value="1"> De tipo tecnológico
							</label>
							<label class="checkbox-inline">
								<input type="radio" id="tecno" name="tecno" <?php if ($proveedor->proTecnologico==0) echo "checked"; ?> required value="0"> No tecnológico
							</label>
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail1" class="col-lg-2 control-label">Origen de Operaciones:*</label>
						<div>
						<label class="checkbox-inline">
							<input type="radio" id="origen" name="origen" <?php if ($proveedor->proNacional==1) echo "checked"; ?> required value="1"> Nacional
						</label>
						<label class="checkbox-inline">
							<input type="radio" id="origen" name="origen" <?php if ($proveedor->proExtranjero==1) echo "checked"; ?> required value="2"> Extranjero
						</label>
					</div>
				</div>
				<p class="alert alert-info">* Campos obligatorios</p>
				<div class="form-group">
					<div class="col-lg-offset-2 col-lg-10">
						<button type="submit" class="btn btn-primary">Actualizar Posicionamiento</button>
					</div>
				</div>
				</form>
				</div>
			</div>
			<?php
		}
		else
		{
			echo "<p class='alert alert-danger'><b>ATENCIÓN:</b> No hay Proveedores con esa identificación.</p><a href='index.php?view=operaciones'>Inicio</a>";
		}		
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
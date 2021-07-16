<?php
$u=null;
if(Session::getUID()!="")
{
	$u = SPUser::getById(Session::getUID());
	$user = $u->usuCodUsuario;
	$rol=$u->detIdRol;
	if ($rol=='1' or $rol=='2')
	{
		$vcodigo = SPConceptos::getById($_GET["id"]);
		$vid = $_GET["id"];
	?>
	<div class="row">
		<div class="col-md-12">
		<h3>Nuevo Detalle de Concepto</h3>
		<form class="form-horizontal" method="post" id="addproduct" action="index.php?view=anadirdetconcepto" role="form">
			<div class="form-group">
				<label for="inputEmail1" class="col-lg-2 control-label">Concepto:*</label>
				<div class="col-md-6">
					<input type="text" name="descconcepto" id="descconcepto" readonly value="<?php echo $vcodigo->conDescConcepto; ?>" class="form-control" placeholder="Nombre completo de Detalle Concepto">
				</div>
			</div>	
			<div class="form-group">
				<label for="inputEmail1" class="col-lg-2 control-label">idconcepto:</label>
				<div class="col-md-6">
					<input type="text" name="idconcepto" id="idconcepto" readonly value="<?php echo $vcodigo->conIdConcepto; ?>" class="form-control" placeholder="codigo de Concepto">
				</div>
			</div>
			<div class="form-group">
				<label for="inputEmail1" class="col-lg-2 control-label">iddetalle:</label>
				<div class="col-md-6">
					<input type="text" name="iddetalle" id="iddetalle" readonly class="form-control" placeholder="codigo de detalle">
				</div>
			</div>			
			<div class="form-group">
				<label for="inputEmail1" class="col-lg-2 control-label">Descripcion:*</label>
				<div class="col-md-6">
					<input type="text" name="detconcepto" id="detconcepto" required class="form-control" placeholder="Nombre Detalle de Concepto">
				</div>
			</div>
			<div class="form-group">
				<label for="inputEmail1" class="col-lg-2 control-label">Nexo:</label>
				<div class="col-md-4">
					<input type="text" name="nexo" id="nexo" class="form-control" placeholder="Defina nexo con tabla detalle de Concepto">
				</div>
			</div>
			<p class="alert alert-info">* Campos obligatorios</p>
			<div class="form-group">
				<div class="col-lg-offset-2 col-lg-10">
					<button type="submit" class="btn btn-primary">Agregar Detalle de Concepto</button>
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
	echo "<p class='alert alert-danger'><b>ERROR:</b> Ingreso no autorizado.</p>";
}
?>
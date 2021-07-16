<?php
$u=null;
if(Session::getUID()!="")
{
	$u = SPUser::getById(Session::getUID());
	$user = $u->usuCodUsuario;
	$rol=$u->detIdRol;
	if ($rol=='1' or $rol=='2')
	{
		$con = SPConceptos::getAll();
	?>
	<div class="row">
		<div class="col-md-12">
		<h3>Nuevo Detalle de Concepto</h3>
		<form class="form-horizontal" method="post" id="addproduct" action="index.php?view=anadirdetconcepto" role="form">
			<div class="form-group">
				<label for="inputEmail1" class="col-lg-2 control-label">Concepto:</label>
				<div class="col-md-3">
					<select name="conIdConcepto" id="conIdConcepto" class="form-control" >
						<option value="">-- Seleccione --</option>								
						<?php foreach($con as $l):?>
							<option  value="<?php echo $l->conIdConcepto; ?>"><?php echo $l->conDescConcepto; ?></option>
						<?php endforeach; ?>
					</select>						
				</div>
			</div>				
			<div class="form-group">
				<label for="inputEmail1" class="col-lg-2 control-label">Descripción de detalle del concepto:*</label>
				<div class="col-md-6">
					<input type="text" name="detDescDetalle" id="detDescDetalle" required class="form-control" placeholder="Nombre de Detalle de Concepto">
				</div>
			</div>	
			<div class="form-group">
				<label for="inputEmail1" class="col-lg-2 control-label">Nexo para detalle del concepto:</label>
				<div class="col-md-6">
					<input type="text" name="detNexo" id="detNexo" class="form-control" placeholder="Nexo de Detalle de Concepto">
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
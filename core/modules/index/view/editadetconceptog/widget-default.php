<?php
$u=null;
if(Session::getUID()!="")
{
	$u = SPUser::getById(Session::getUID());
	$user = $u->usuCodUsuario;
	$rol=$u->detIdRol;
	if ($rol=='1' or $rol=='2')
	{
	?>
		<?php
			$concepto = SPConceptos::getById($_GET["id"]);
			$detconcepto = SPDetConceptos::getById($_GET["id"],$_GET["id2"]);
		?>
			
		<div class="row">
			<div class="col-md-12">
			<h3>Edición de Detalle de Conceptos:</h3>
			<form class="form-horizontal" method="post" id="actualizadetconceptog" action="index.php?view=actualizadetconceptog" role="form">
				<div class="form-group">
					<div class="col-md-6">
						<input type="hidden" name="id" value="<?php echo $concepto->conIdConcepto;?>" class="form-control" id="id">
						<input type="hidden" name="id2" value="<?php echo $detconcepto->detIdDetalle;?>" class="form-control" id="id2">
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail1" class="col-lg-2 control-label">Concepto:</label>
					<div class="col-md-6">
						<input type="text" readonly name="descconcepto" id="descconcepto" required value="<?php echo $concepto->conDescConcepto;?>" class="form-control" placeholder="Nombre completo de Concepto">
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail1" class="col-lg-2 control-label">Detalle de Concepto:*</label>
					<div class="col-md-6">
						<input type="text" name="detdescconcepto" id="detdescconcepto" required value="<?php echo $detconcepto->detDescDetalle;?>" class="form-control" placeholder="Nombre completo de Detalle de Concepto">
					</div>
				</div>
				<p class="alert alert-info">* Campos obligatorios</p>
				<div class="form-group">
					<div class="col-lg-offset-2 col-lg-10">
						<input type="hidden" name="user_id" value="<?php echo $user->conIdConcepto;?>">
						<button type="submit" class="btn btn-primary">Actualizar Detalle</button>
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
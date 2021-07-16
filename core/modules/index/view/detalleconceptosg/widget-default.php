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
		<div class="row">
			<div class="col-md-12">
				<a href="index.php?view=nuevodetconceptog" class="btn btn-default pull-right"><i class='glyphicon glyphicon-edit'></i> Nuevo Detalle de Concepto</a>
				<h3>Lista de Detalle de Conceptos Generales</h3>
				<?php
				$detconceptos = SPDetConceptos::getAllId($_POST['concepto']);
				if(count($detconceptos)>0){
					// si hay usuarios
					?>
					<table class="table table-bordered table-hover">
					<thead>
					<th>Id Concepto</th>
					<th>Descripción del Concepto</th>
					<th>Id</th>
					<th>Descripción del Detalle Concepto</th>
					<th>Nexo</th>
					</thead>
					<?php
					foreach($detconceptos as $detconcepto){
						?>
						<tr>
						<td><?php echo $detconcepto->concepto_conIdConcepto; ?></td>
						<td><?php
									$conceptos = SPConceptos::getById($detconcepto->concepto_conIdConcepto);
									echo $conceptos->conDescConcepto; 
							?>
						</td>
						<td><?php echo $detconcepto->detIdDetalle; ?></td>
						<td><?php echo $detconcepto->detDescDetalle; ?></td>
						<td><?php echo $detconcepto->detNexo; ?></td>
						<td style="width:30px;">
							<a href="index.php?view=editadetconceptog&id=<?php echo $detconcepto->concepto_conIdConcepto?>&id2=<?php echo $detconcepto->detIdDetalle?>" class="btn btn-warning btn-xs">Editar Detalle</a>
							<!--
							<a href="index.php?view=eliminarconcepto&id=<?php //echo $concepto->conIdConcepto?>" class="btn btn-warning btn-xs">Eliminación</a>
							-->
						</td>
						</tr>
						<?php
					}
				}else{
					// no hay datos
				}
				?>
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
	?>
	<?php
}
?>
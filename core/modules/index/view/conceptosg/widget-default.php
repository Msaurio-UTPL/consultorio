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
			<a href="index.php?view=nuevoconceptog" class="btn btn-default pull-right"><i class='glyphicon glyphicon-edit'></i> Nuevo Concepto</a>
				<h3>Lista de Conceptos Generales</h3>
				<?php
				$conceptos = SPConceptos::getAll();
				if(count($conceptos)>0){
					// si hay usuarios
					?>
					<table class="table table-bordered table-hover">
					<thead>
					<th>Id</th>
					<th>Descripción</th>
					</thead>
					<?php
					foreach($conceptos as $concepto){
						?>
						<tr>
						<td><?php echo $concepto->conIdConcepto; ?></td>
						<td><?php echo $concepto->conDescConcepto; ?></td>
						<td style="width:30px;">
							<a href="index.php?view=editaconceptog&id=<?php echo $concepto->conIdConcepto?>" class="btn btn-warning btn-xs">Edición</a>
							<!--
							<a href="index.php?view=eliminarconcepto&id=<?php //echo $concepto->conIdConcepto?>" class="btn btn-warning btn-xs">Eliminación</a>
							-->
						</td>
						</tr>
						<?php
					}
				}else{
					// no hay usuarios
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
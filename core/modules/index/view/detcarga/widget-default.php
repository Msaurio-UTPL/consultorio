<?php
$u=null;
if(Session::getUID()!="")
{
	$u = SPUser::getById(Session::getUID());
	$user = $u->usuCodUsuario;
	$rol=$u->detIdRol;
	if ($rol=='1' or $rol=='2'  or $rol=='3' )
	{
	?>	
		<div class="row">
		<div class="col-md-12">
			<h3>Consulta de Documentos</h3>
			<?php
			$proveedor= array();
			if( isset($_GET["id"]) )
			{
				$documentos = SPDocumento::getDetProv($_GET['id']);
			}
			if(count($documentos)>0)
			{
				// si hay usuarios
				?>
				<table class="table table-bordered table-hover">
				<thead>
				<th>Documento</th>
				<th>Tamaño</th>
				<th>Periodo</th>
				<th>Fecha de carga</th>
				<th>Acción</th>
				</thead>
				<?php
				foreach($documentos as $l)
				{
					?>
					<tr>
						<td><?php
									$conceptos=SPDetConceptos::getByIdSec($l->conIdConcepto,$l->detIdDetalle);
									echo $conceptos->detDescDetalle;
							?></td>
						<td><?php echo $l->docTamanio; ?></td>
						<td><?php echo $l->docFecha; ?></td>
						<td><?php echo $l->fecha; ?></td>
						<td>
							<a href="report/verdocumento.php?id=<?php echo $l->docIdDocumento; ?> " title="Mirar" target="_blank"><i class="glyphicon glyphicon-eye-open"></i></a>
						</td>
					</tr>
					<?php
				}
				?>
				</table>
					<?php
			}
			else
			{		
				echo "<p class='alert alert-danger'><b>ATENCIÓN:</b> No existen documentos para el proveedor seleccionado.</p>";
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
}
?>
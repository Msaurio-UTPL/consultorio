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
			<h3>Consulta de Direcciones</h3>
			<?php
			$direcciones= array();
			if( isset($_GET["id"]) )
			{
				$direcciones = SPDireccion::getByProv($_GET['id']);
			}
			if(count($direcciones)>0)
			{
				// si hay datos
				?>
				<table class="table table-bordered table-hover">
				<thead>
				<th>Tipo</th>
				<th>Calles y Número / Cuenta Correo</th>
				<th>Sector o Barrio / Cuenta Correo2</th>
				<th>Referencia</th>
				<th>Estado</th>
				</thead>
				<?php
				foreach($direcciones as $dir)
				{
					?>
					<tr>
						<td><?php
									//$conceptos=SPDetConceptos::getByIdSec($l->conIdContacto,$l->detIdContacto);
									$tipo = SPDetConceptos::getByIdSec($dir->conIdDireccion,$dir->detIdDireccion);
									echo $tipo->detDescDetalle;
							?>
						</td>
						<td><?php echo $dir->dirDescripcion1; ?></td>
						<td><?php echo $dir->dirDescripcion2; ?></td>
						<td><?php echo $dir->dirDescripcion3; ?></td>
						<td>
								<?php if($dir->detIdEstado=='1'):?>
								<i class="glyphicon glyphicon-ok"></i>
								<?php else:?>
									<i class="glyphicon glyphicon-remove"></i>
								<?php endif; ?>
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
				echo "<p class='alert alert-danger'><b>ATENCIÓN:</b> No hay direcciones para el paciente seleccionado.</p>";
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
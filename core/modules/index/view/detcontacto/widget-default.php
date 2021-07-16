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
			<h3>Consulta de Contactos</h3>
			<?php
			$contactos= array();
			if( isset($_GET["id"]) )
			{
				$contactos = SPContacto::getByProv($_GET['id']);
			}
			if(count($contactos)>0)
			{
				// si hay usuarios
				?>
				<table class="table table-bordered table-hover">
				<thead>
				<th>Tipo</th>
				<th>Persona</th>
				<th>Número de Contacto</th>
				<th>Referencia</th>
				<th>Estado</th>
				</thead>
				<?php
				foreach($contactos as $cc)
				{
					?>
					<tr>
						<td><?php
									$tipo = SPDetConceptos::getByIdSec($cc->conIdContacto,$cc->detIdContacto);
									echo $tipo->detDescDetalle;
							?>
						</td>
						<td><?php echo $cc->conDescripcion1; ?></td>
						<td><?php echo $cc->conDescripcion2; ?></td>
						<td><?php echo $cc->conDescripcion3; ?></td>
						<td>
								<?php if($cc->detIdEstado=='1'):?>
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
				echo "<p class='alert alert-danger'><b>ATENCIÓN:</b> No hay contactos para el paciente seleccionado.</p>";
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
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
			<h3>Operaciones con Proveedores</h3>
			<form class="form-horizontal" role="form">
				<input type="hidden" name="view" value="operaciones">
				<div class="form-group">
					<div class="col-lg-3">
						<div class="input-group">
						  <span class="input-group-addon"><i class="fa fa-search"></i></span>
						  <input type="text" name="q" value="<?php if(isset($_GET["q"]) && $_GET["q"]!=""){ echo $_GET["q"]; } ?>" required  class="form-control" placeholder="Identificación">
						</div>
					</div>
					
					<div class="col-lg-2">
						<button class="btn btn-primary btn-block">Buscar</button>
					</div>
				</div>
			</form>
			<?php
			$proveedor= array();
			$trans= array();
			if( isset($_GET["q"]) )
			{
				$proveedor = SPBasica::getById($_GET['q']);
			}
			if(count($proveedor)>0)
			{
				// si hay usuarios
				?>
				<table class="table table-bordered table-hover">
				<thead>
				<th>Tipo de Proveedor</th>
				<th>Tipo de Identificación</th>
				<th>Identificación</th>
				<th>Primer Nombre</th>
				<th>Segundo Nombre</th>
				<th>Primer Apellido</th>
				<th>Segundo Apellido</th>
				<th>Razón Social</th>
				<th>Estado</th>
				</thead>
				<tr>
				<td><?php 	$detconcepto=SPDetConceptos::getById($proveedor->conIdTipoPersona,$proveedor->detIdTipoPersona);
							echo $detconcepto->detDescDetalle; ?></td>
				<td><?php 	$detconcepto=SPDetConceptos::getById($proveedor->conIdTipoIdentificacion,$proveedor->detIdTipoIdentificacion);
							echo $detconcepto->detDescDetalle; ?></td>
				<td><?php echo $proveedor->proIdentificacion; ?></td>
				<td><?php echo $proveedor->proRepresentantePN; ?></td>
				<td><?php echo $proveedor->proRepresentanteSN; ?></td>
				<td><?php echo $proveedor->proRepresentantePA; ?></td>
				<td><?php echo $proveedor->proRepresentanteSA; ?></td>
				<td><?php echo $proveedor->proDescProveedor; ?></td>
				<td>
					<?php if($proveedor->detIdEstado=='1'):?>
						<i class="glyphicon glyphicon-ok"></i>
					<?php else:?>
						<i class="glyphicon glyphicon-remove"></i>
					<?php endif; ?>
					<br>
					<td> <a href="index.php?view=editapersona&id=<?php echo $proveedor->proIdProveedor;?>" class="btn btn-default pull-right"><i class='glyphicon glyphicon-edit'></i> Edición</a></td>
				</td>
				</tr>
				</table>
				<table class="table table-bordered table-hover">
				<tr>
				<td><a href="index.php?view=contacto&id=<?php echo $proveedor->proIdProveedor;?>" title="Datos de Contactos"><i class="glyphicon  glyphicon-edit"></i> Contactos</a></td>
				<td><a href="index.php?view=direccion&id=<?php echo $proveedor->proIdProveedor;?>" title="Datos de Direcciones"><i class="glyphicon glyphicon-edit"></i> Direcciones</a></td>
				<td><a href="index.php?view=posicion&id=<?php echo $proveedor->proIdProveedor;?>" title="Informacion de Posicionamiento"><i class="glyphicon glyphicon-edit"></i> Posicionamiento</a></td>
				<td><a href="index.php?view=carga&id=<?php echo $proveedor->proIdProveedor;?>" title="Carga documentos"><i class="glyphicon glyphicon-edit"></i>Carga</a></td>
				<td><a href="index.php?view=balance&id=<?php echo $proveedor->proIdProveedor;?>" title="Informacion Financiera"><i class="glyphicon glyphicon-edit"></i> Información Financiera</a></td>
				<td><a href="index.php?view=catalogo&id=<?php echo $proveedor->proIdProveedor;?>" title="Catálogo de Proveedor"><i class="glyphicon glyphicon-edit"></i> Catálogo</a></td>
				<td><a href="index.php?view=evagrupo&id=<?php echo $proveedor->proIdProveedor;?>" title="Criterios de Evaluación"><i class="glyphicon glyphicon-edit"></i> Criterios</a></td>
				</tr>
				</table>
					<?php
			}
			else
			{		
				echo "<p class='alert alert-danger'><b>ATENCIÓN:</b> No hay Proveedores con esa identificación.</p>";
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
<?php
$u=null;
if(Session::getUID()!="")
{
	$u = SPUser::getById(Session::getUID());
	$user = $u->usuCodUsuario;
	$rol=$u->detIdRol;
	if ($rol=='1' or $rol=='2' or $rol=='3')
	{
		$estado="";
		$proveedor = SPBasica::getInfoByIdSec($_GET["id"]);
		$vrazonsocial=$proveedor->proDescProveedor;
		// Tipo
		$detconcepto=SPDetConceptos::getById($proveedor->conIdTipoPersona,$proveedor->detIdTipoPersona);
		$vtipo=$detconcepto->detDescDetalle;
		?>
		<div class="row">
		<div class="col-md-12">
		<h3>Edición de Documentos:</h3>
		<h5><?php echo $vrazonsocial; ?></h5>
		<h5><?php echo $vtipo; ?></h5>
		<form class="form-horizontal" method="post" enctype="multipart/form-data" id="editadocs" action="index.php?view=editadocs" role="form">
		<table class="table table-bordered table-hover">
			<thead>
			<th>Documento</th>
			<th>Período</th>
			<th>Tamaño</th>
			<th>Archivo PDF</th>
			</thead>
		<?php	
		$documentos=SPDocumento::getDetProv($proveedor->proIdProveedor);
		//echo count($documentos);
		$indice=1;
		foreach($documentos as $doc)
		{
			?>
			<tr>
			<td>
				<?php 	$detconcepto=SPDetConceptos::getById($doc->conIdConcepto,$doc->detIdDetalle);
						$vtipo=$detconcepto->detDescDetalle;
						echo $vtipo; ?>
				<input type="hidden" readonly name="codigo" value="<?php echo $doc->detIdDetalle; ?>" class="form-control" id="codigo" >
			</td>
			<td>
				<div class="col-md-15">
					<input type="text" name="periodo" required value="<?php echo $doc->docFecha; ?>" class="form-control" id="periodo" placeholder="Período">
				</div>
			</td>
			<td>
				<div class="col-md-4">
					<input type="text" name="tamano" required value="<?php echo $doc->docTamanio; ?>" class="form-control" id="tamano" placeholder="Tamaño">
					<?php
					header("Content-type: application/pdf");
					// A continuación enviamos el contenido binario de la imagen.
					echo $doc->docDocumento;
					//echo '<embed src="'.$doc->docDocumento.'" type="application/pdf" width="10%" height="100px" />';
					?>
				</div>
			</td>
			<td>
				<div class="col-md-15">
					<input type="file" name="documento<?php echo $indice; ?>" accept="application/pdf" required class="form-control" id="documento<?php echo $indice; ?>" placeholder="Documento PDF">
				</div>
			</td>
			</tr>
			<?php
			$indice++;
		}
		$indice--;
		?>
		</table>
		<div class="col-md-15">
			<input type="hidden" name="proveedor" class="form-control" id="proveedor" value="<?php echo $_GET["id"]; ?>">
			<input type="hidden" name="identificacion" class="form-control" id="identificacion" value="<?php echo $proveedor->proIdentificacion; ?>">
			<input type="hidden" name="totaldocumentos" class="form-control" id="totaldocumentos" value="<?php echo $indice; ?>">
		</div>
		<div class="form-group">
			<div class="col-lg-offset-2 col-lg-10">
				<button type="submit" class="btn btn-primary">Editar Documentos</button>
			</div>
		</div>
		</form>
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
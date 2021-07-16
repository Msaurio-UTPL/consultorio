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
		<h3>Carga de Documentos:</h3>
		<h5><?php echo $vrazonsocial; ?></h5>
		<h5><?php echo $vtipo; ?></h5>
		<form class="form-horizontal" method="post" enctype="multipart/form-data" id="cargadocumentos" action="index.php?view=cargadocumentos" role="form">
		<table class="table table-bordered table-hover">
			<thead>
			<th>Documento</th>
			<th>Período</th>
			<th>Archivo PDF</th>
			</thead>
		<?php	
		if ($proveedor->detIdTipoPersona==1)
		{
			// Natural 4 documentos
			$vdocumentos=SPDetConceptos::getByLista(16,'3,4,5,6');
		}
		if ($proveedor->detIdTipoPersona==2)
		{
			// Jurídica 8 documentos
			$vdocumentos=SPDetConceptos::getByLista(16,'7,4,8,9,5,10,11,12');
		}
		$indice=1;
		foreach($vdocumentos as $doc)
		{
			?>
			<tr>
			<td>
				<?php echo $doc->detDescDetalle; ?>
				<input type="hidden" readonly name="listacodigos[]" value="<?php echo $doc->detIdDetalle; ?>" class="form-control" id="listacodigos" >
			</td>
			<td>
				<div class="col-md-10">
					<select name="listaperiodos[]" class="form-control" id="listaperiodos" required>
												<option value="">-- Seleccione --</option>
												<option value="2019">2019</option>
												<option value="2020">2020</option>
												<option value="2021">2021</option>
					</select>
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
				<button type="submit" class="btn btn-primary">Cargar Documentos</button>
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
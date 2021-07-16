<?php
$u=null;
if(Session::getUID()!="")
{
	$u = SPUser::getById(Session::getUID());
	$user = $u->usuCodUsuario;
	$rol=$u->detIdRol;
	
	if ($rol=='1' or $rol=='2' or $rol=='3')
	{
		$natu = SPBasica::getAll();
		$pais = SPDetConceptos::getByCod("20","20");
		$tipoid = SPDetConceptos::getByCod("4","0");
		$genero = SPDetConceptos::getByCod("7","0");
		$civil = SPDetConceptos::getByCod("8","0");
		$aseg = SPDetConceptos::getByCod("9","0");
		$ocup = SPDetConceptos::getByCod("10","0");		
		$pa = 0;
		$pro = 0;
		$provactual = 0;
		$aseactual = 0;
		$ocuactual = 0;
	?>
	
	<script language="javascript" src="js/jquery-1.10.2.min.js"></script>
		<script language="javascript">
			$(document).ready(function(){
				$("#detIdPais").change(function ()
				{
					$("#detIdPais option:selected").each(function ()
					{
						detIdDetalle = $(this).val();
						vurl='/consultorio/index.php?view=persona&detIdPais=';
						//alert (detIdDetalle);
						window.location.replace(vurl.concat(detIdDetalle));
					});
				})		
				$("#detIdProvincia").change(function ()
				{
					$("#detIdProvincia option:selected").each(function ()
					{
						detIdDetalle = $(this).val();
						vurl='/consultorio/index.php?view=persona&detIdPais='+document.getElementById("detIdPais").value+'&detIdProvincia='+detIdDetalle;
						//alert (vurl);
						window.location.replace(vurl);
					});
				})
						
			});
		</script>
		<?php 
		if (isset($_GET['detIdPais']))
		{
			$paisactual=$_GET['detIdPais'];
			if (isset($_GET['detIdProvincia'])) { $provactual=$_GET['detIdProvincia'];}
			if (isset($_GET['detIdCanton'])) { $canactual=$_GET['detIdCanton'];}
			if (isset($_GET['detIdAseguradora'])) { $asactual=$_GET['detIdAseguradora'];}
			if (isset($_GET['detIdOcupacion'])) { $ocactual=$_GET['detIdOcupacion'];}
			?>
			<div class="row">
						<div class="col-md-12">
							<h3>Información Básica del Paciente</h3>
							<form class="form-horizontal" method="post" id="addproduct" action="index.php?view=anadirpersona" role="form">
								<div class="form-group">
									<label class="col-lg-2 control-label">País:*</label>
									<div class="col-lg-3">
										<select name="detIdPais" id="detIdPais" class="form-control" required>
											<option value="">-- Seleccione --</option>
											<?php foreach($pais as $l):?>
												<option <?php if(isset($paisactual) and $l->detIdDetalle==$paisactual){ echo "selected"; }?> value="<?php echo $l->detIdDetalle; ?>"><?php echo $l->detDescDetalle; ?></option>
											<?php endforeach; ?>
										</select>
									</div>
									<?php 
										$prov = SPDetConceptos::getByCod("21",$paisactual);
										//echo $pa;
									?>		
								</div>									
								<div class="form-group">
									<label class="col-lg-2 control-label">Provincia:*</label>
									<div class="col-lg-3">
										<select name="detIdProvincia" id="detIdProvincia" class="form-control" required>
											<option value="">-- Seleccione --</option>
											<?php foreach($prov as $l):?>
												<option <?php if(isset($provactual) and $l->detIdDetalle==$provactual){ echo "selected"; }?> value="<?php echo $l->detIdDetalle; ?>"><?php echo $l->detDescDetalle; ?></option>
											<?php endforeach; ?>
										</select>
									</div>
									<?php 
										$can = SPDetConceptos::getByCod("22",$provactual);
										//echo $provactual;
									 ?>	
								</div>					
								<div class="form-group">
									<label class="col-lg-2 control-label">Cantón:*</label>
									<div class="col-lg-3">
										<select name="detIdCanton" id="detIdCanton" class="form-control" required>
											<option value="">-- Seleccione --</option>
											<?php foreach($can as $l):?>
												<option  value="<?php echo $l->detIdDetalle; ?>"><?php echo $l->detDescDetalle; ?></option>
											<?php endforeach; ?>
										</select>
									</div>
									<?php 
										$ca = SPDetConceptos::getByCod("22",$provactual);
										//echo $ca;
									 ?>							
								</div>	
								<div class="form-group">
									<div class="col-md-3">
										<input type="hidden" name="detIdParroquia" id="detIdParroquia" class="form-control" placeholder="Ciudad">
									</div>
								</div>									
								<div class="form-group">
									<label for="inputEmail1" class="col-lg-2 control-label"> Apellidos:*</label>
									<div class="col-md-3">
										<input type="text" name="pacApellidos" id="pacApellidos" required class="form-control" placeholder="Apellidos">
									</div>
								</div>
								<div class="form-group">
									<label for="inputEmail1" class="col-lg-2 control-label">Nombres:*</label>
									<div class="col-md-3">
										<input type="text" name="pacNombres" id="pacNombres" required class="form-control" placeholder="Nombres">
									</div>
								</div>
								<div class="form-group">
									<label for="inputEmail1" class="col-lg-2 control-label">Tipo Identificacion:*</label>
									<div class="col-md-2">
										<select name="detIdTipoIdentificacion" id="detIdTipoIdentificacion" class="form-control" required>
											<option value="">-- Seleccione --</option>
											<?php foreach($tipoid as $l):?>
												<option  value="<?php echo $l->detIdDetalle; ?>"><?php echo $l->detDescDetalle; ?></option>
											<?php endforeach; ?>
										</select>									
									</div>
								</div>	
								<div class="form-group">
									<label for="inputEmail1" class="col-lg-2 control-label">Número Identificacion:*</label>
									<div class="col-md-3">
										<input type="text" name="pacIdentificacion" id="pacIdentificacion" class="form-control" placeholder="Número Identificacion">
									</div>
								</div>		
								<div class="form-group">
									<label for="inputEmail1" class="col-lg-2 control-label">Genero:*</label>
									<div class="col-md-3">
										<select name="detIdGenero" id="detIdGenero" class="form-control" required>
											<option value="">-- Seleccione --</option>									
											<?php foreach($genero as $l):?>
												<option  value="<?php echo $l->detIdDetalle; ?>"><?php echo $l->detDescDetalle; ?></option>
											<?php endforeach; ?>
										</select>	
									</div>
								</div>	
								<div class="form-group">
									<label for="inputEmail1" class="col-lg-2 control-label">Estado Civil:*</label>
									<div class="col-md-3">
										<select name="detIdEstadoCivil" id="detIdEstadoCivil" class="form-control" required>
											<option value="">-- Seleccione --</option>									
											<?php foreach($civil as $l):?>
												<option  value="<?php echo $l->detIdDetalle; ?>"><?php echo $l->detDescDetalle; ?></option>
											<?php endforeach; ?>
										</select>	
									</div>
								</div>	
								<div class="form-group">
									<label for="inputEmail1" class="col-lg-2 control-label">Fecha Nacimiento:</label>
									<div class="col-md-2">
										<input type="date" name="pacFechaNacimiento" id="pacFechaNacimiento" class="form-control" placeholder="Fecha de Nacimiento">
									</div>
								</div>	
								<div class="form-group">
									<label class="col-lg-2 control-label">Aseguradora:*</label>
									<div class="col-lg-3">
										<select name="detIdAseguradora" id="detIdAseguradora" class="form-control" required>
											<option value="">-- Seleccione --</option>
											<?php foreach($aseg as $l):?>
												<option  value="<?php echo $l->detIdDetalle; ?>"><?php echo $l->detDescDetalle; ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>		
								<div class="form-group">
									<label class="col-lg-2 control-label">Ocupacion:*</label>
									<div class="col-lg-3">
										<select name="detIdOcupacion" id="detIdOcupacion" class="form-control" required>
											<option value="">-- Seleccione --</option>
											<?php foreach($ocup as $l):?>
												<option  value="<?php echo $l->detIdDetalle; ?>"><?php echo $l->detDescDetalle; ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>									
								<div class="form-group">
									<label for="inputEmail1" class="col-lg-2 control-label"> Contacto:</label>
									<div class="col-md-3">
										<input type="text" name="pacContacto" id="pacContacto" class="form-control" placeholder="Contacto">
									</div>
								</div>								
								<div class="form-group">
									<div class="col-lg-offset-2 col-lg-10">
										<button type="submit" class="btn btn-primary">Agregar Datos</button>
									</div>
								</div>					

						</div>
					</div>			
			<?php
		} else
		{
			?>
			<div class="row">
						<div class="col-md-12">
							<h3>Información Básica del Paciente</h3>
							<form class="form-horizontal" method="post" id="addproduct" action="index.php?view=anadirpersona" role="form">
								<div class="form-group">
									<label class="col-lg-2 control-label">País:*</label>
									<div class="col-lg-3">
										<select name="detIdPais" id="detIdPais" class="form-control" required>
											<option value="">-- Seleccione --</option>
											<?php foreach($pais as $l):?>
												<option  value="<?php echo $l->detIdDetalle; ?>"><?php echo $l->detDescDetalle; ?></option>
											<?php endforeach; ?>
										</select>
									</div>
									<?php 
										$prov = SPDetConceptos::getByCod("21",$pa);
										//echo $pa;
									?>		
								</div>								
								<div class="form-group">
									<label class="col-lg-2 control-label">Provincia:*</label>
									<div class="col-lg-3">
										<select name="detIdProvincia" id="detIdProvincia" class="form-control" required>
											<option value="">-- Seleccione --</option>
											<?php foreach($prov as $l):?>
												<option value="<?php echo $l->detIdDetalle; ?>"><?php echo $l->detDescDetalle; ?></option>
											<?php endforeach; ?>
										</select>
									</div>
									<?php 
										$ca = SPDetConceptos::getByCod("22",$pro);
										//echo $pro;
									 ?>	
								</div>					
								<div class="form-group">
									<label class="col-lg-2 control-label">Cantón:*</label>
									<div class="col-lg-3">
										<select name="detIdCanton" id="detIdCanton" class="form-control" required>
											<option value="">-- Seleccione --</option>
											<?php foreach($can as $l):?>
												<option value="<?php echo $l->detIdDetalle; ?>"><?php echo $l->detDescDetalle; ?></option>
											<?php endforeach; ?>
										</select>
									</div>
									<?php 
										$ca = SPDetConceptos::getByCod("22",$pro);
										//echo $ca;
									 ?>							
								</div>	
								<div class="form-group">
									<div class="col-md-3">
										<input type="hidden" name="detIdParroquia" id="detIdParroquia" class="form-control" placeholder="Ciudad">
									</div>
								</div>		
								<div class="form-group">
									<label for="inputEmail1" class="col-lg-2 control-label"> Apellidos:*</label>
									<div class="col-md-3">
										<input type="text" name="pacApellidos" id="pacApellidos" required class="form-control" placeholder="Apellidos">
									</div>
								</div>
								<div class="form-group">
									<label for="inputEmail1" class="col-lg-2 control-label">Nombres:*</label>
									<div class="col-md-3">
										<input type="text" name="pacNombres" id="pacNombres" required class="form-control" placeholder="Nombres">
									</div>
								</div>
								<div class="form-group">
									<label for="inputEmail1" class="col-lg-2 control-label">Tipo Identificacion:*</label>
									<div class="col-md-2">
										<select name="detIdTipoIdentificacion" id="detIdTipoIdentificacion" class="form-control" required>
											<option value="">-- Seleccione --</option>
											<?php foreach($tipoid as $l):?>
												<option  value="<?php echo $l->detIdDetalle; ?>"><?php echo $l->detDescDetalle; ?></option>
											<?php endforeach; ?>
										</select>									
									</div>
								</div>	
								<div class="form-group">
									<label for="inputEmail1" class="col-lg-2 control-label">Número Identificacion:*</label>
									<div class="col-md-3">
										<input type="text" name="pacIdentificacion" id="pacIdentificacion" class="form-control" placeholder="Número Identificacion">
									</div>
								</div>		
								<div class="form-group">
									<label for="inputEmail1" class="col-lg-2 control-label">Genero:*</label>
									<div class="col-md-3">
										<select name="detIdGenero" id="detIdGenero" class="form-control" required>
											<option value="">-- Seleccione --</option>									
											<?php foreach($genero as $l):?>
												<option  value="<?php echo $l->detIdDetalle; ?>"><?php echo $l->detDescDetalle; ?></option>
											<?php endforeach; ?>
										</select>	
									</div>
								</div>	
								<div class="form-group">
									<label for="inputEmail1" class="col-lg-2 control-label">Estado Civil:*</label>
									<div class="col-md-3">
										<select name="detIdEstadoCivil" id="detIdEstadoCivil" class="form-control" required>
											<option value="">-- Seleccione --</option>									
											<?php foreach($civil as $l):?>
												<option  value="<?php echo $l->detIdDetalle; ?>"><?php echo $l->detDescDetalle; ?></option>
											<?php endforeach; ?>
										</select>	
									</div>
								</div>
								<div class="form-group">
									<label for="inputEmail1" class="col-lg-2 control-label">Fecha Nacimiento:</label>
									<div class="col-md-2">
										<input type="date" name="pacFechaNacimiento" id="pacFechaNacimiento" class="form-control" placeholder="Fecha de Nacimiento">
									</div>
								</div>	
																<div class="form-group">
									<label class="col-lg-2 control-label">Aseguradora:*</label>
									<div class="col-lg-3">
										<select name="detIdAseguradora" id="detIdAseguradora" class="form-control" required>
											<option value="">-- Seleccione --</option>
											<?php foreach($aseg as $l):?>
												<option  value="<?php echo $l->detIdDetalle; ?>"><?php echo $l->detDescDetalle; ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>		
								<div class="form-group">
									<label class="col-lg-2 control-label">Ocupacion:*</label>
									<div class="col-lg-3">
										<select name="detIdOcupacion" id="detIdOcupacion" class="form-control" required>
											<option value="">-- Seleccione --</option>
											<?php foreach($ocup as $l):?>
												<option  value="<?php echo $l->detIdDetalle; ?>"><?php echo $l->detDescDetalle; ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>	
								<div class="form-group">
									<label for="inputEmail1" class="col-lg-2 control-label"> Contacto:</label>
									<div class="col-md-3">
										<input type="text" name="pacContacto" id="pacContacto" class="form-control" placeholder="Contacto">
									</div>
								</div>	
								<div class="form-group">
									<div class="col-lg-offset-2 col-lg-10">
										<button type="submit" class="btn btn-primary">Agregar Datos</button>
									</div>
								</div>					

						</div>
					</div>			
			
			<?php 
		}
		?>
		
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
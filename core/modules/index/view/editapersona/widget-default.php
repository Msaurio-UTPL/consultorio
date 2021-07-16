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
		$natu = SPBasica::getAll();
		$persona = array();
		$persona = SPBasica::getByIdSec($_GET['id']);
		$pais = SPDetConceptos::getByCod("20","20");
		$provactual = 0;
		$pa = SPDetConceptos::getById("20",1);
		$pro = SPDetConceptos::getById("21",$persona->detIdProvincia);
		$ca = SPDetConceptos::getById('22',$persona->detIdCanton);		
		$tipoid = SPDetConceptos::getByCod("4","0");
		$genero = SPDetConceptos::getByCod("7","0");
		$civil = SPDetConceptos::getByCod("8","0");
		$aseg = SPDetConceptos::getByCod("9","0");
		$ocup = SPDetConceptos::getByCod("10","0");			
		View::Error("<b> Alerta, actualizar los datos de LOVs (Provincia,Canton,etc) limpian la informacion anterior de este formulario</b>");		
	?>
		<script language="javascript" src="js/jquery-1.10.2.min.js"></script>
			<script language="javascript">
				$(document).ready(function(){
					$("#detIdPais").change(function ()
					{
						$("#detIdPais option:selected").each(function ()
						{
							detIdDetalle = $(this).val();
							vurl='/consultorio/index.php?view=editapersona&id='+document.getElementById("id").value+'&detIdPais=';
							//alert (detIdDetalle);
							window.location.replace(vurl.concat(detIdDetalle));
						});
					})
					$("#detIdProvincia").change(function ()
					{
						$("#detIdProvincia option:selected").each(function ()
						{
							detIdDetalle = $(this).val();
							vurl='/consultorio/index.php?view=editapersona&id='+document.getElementById("id").value+'&detIdPais='+document.getElementById("detIdPais").value+'&detIdProvincia='+detIdDetalle;
							//alert (vurl);
							window.location.replace(vurl);
						});
					})
					$("#detIdCanton").change(function ()
					{
						$("#detIdCanton option:selected").each(function ()
						{
							detIdDetalle = $(this).val();
							document.getElementById("detIdCiudad").value = detIdDetalle;
							//alert (detIdDetalle);
						});
					})				
				});
			</script>
			<div class="row">
				<div class="col-md-12">
					<h3>Edición de Datos Básicos:</h3>
					<form class="form-horizontal" method="post" id="addproduct" action="index.php?view=actualizapersona" role="form">
						<div class="form-group">
							<div class="col-md-3">
								<input type="hidden" name="id" id="id" value="<?php echo $persona->pacIdPaciente; ?>" class="form-control" placeholder="paciente">
							</div>
						</div>						
						<?php 
							$prov = SPDetConceptos::getByCod("21",1);
							//echo $pa;
						?>							
						<div class="form-group">
							<label class="col-lg-2 control-label">Provincia:*</label>
							<div class="col-lg-3">
								<select name="detIdProvincia" id="detIdProvincia" class="form-control" required>
									<option value="">-- Seleccione --</option>
									<?php foreach($prov as $l):?>
										<option <?php if(isset($persona->detIdProvincia) and $l->detIdDetalle==$persona->detIdProvincia){ echo "selected"; }?> value="<?php echo $l->detIdDetalle; ?>"><?php echo $l->detDescDetalle; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>		
						<?php 
							$can = SPDetConceptos::getByCod("22",$persona->detIdProvincia);
							//echo $ca;
						 ?>		
						<div class="form-group">
							<label class="col-lg-2 control-label">Cantón:*</label>
							<div class="col-lg-3">
								<select name="detIdCanton" id="detIdCanton" class="form-control" required>
									<option value="">-- Seleccione --</option>
									<?php foreach($can as $l):?>
										<option <?php if(isset($persona->detIdCanton) and $l->detIdDetalle==$persona->detIdCanton){ echo "selected"; }?> value="<?php echo $l->detIdDetalle; ?>"><?php echo $l->detDescDetalle; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>	
						<div class="form-group">
							<div class="col-md-3">
								<input type="hidden" name="detIdParroquia" id="detIdParroquia" class="form-control" placeholder="Parroquia">
							</div>
						</div>	
						<div class="form-group">
							<label for="inputEmail1" class="col-lg-2 control-label">Apellidos:*</label>
							<div class="col-md-3">
								<input type="text" name="pacApellidos" id="pacApellidos" value="<?php echo $persona->pacApellidos; ?>" required class="form-control" placeholder="Apellidos">
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail1" class="col-lg-2 control-label">Nombres:*</label>
							<div class="col-md-3">
								<input type="text" name="pacNombres" id="pacNombres" required value="<?php echo $persona->pacNombres; ?>" class="form-control" placeholder="Nombres">
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail1" class="col-lg-2 control-label">Tipo Identificacion:*</label>
							<div class="col-md-2">
								<select name="detIdTipoIdentificacion" id="detIdTipoIdentificacion" class="form-control" required>
									<option value="">-- Seleccione --</option>
									<?php foreach($tipoid as $l):?>
										<option  value="<?php echo $l->detIdDetalle; ?>"<?php if ($l->detIdDetalle == $persona->detIdTipoIdentificacion) echo "selected"; ?>><?php echo $l->detDescDetalle; ?></option>
									<?php endforeach; ?>
								</select>									
							</div>
						</div>		
						<div class="form-group">
							<label for="inputEmail1" class="col-lg-2 control-label">Número Identificacion:*</label>
							<div class="col-md-3">
								<input type="text" name="pacIdentificacion" id="pacIdentificacion" value="<?php echo $persona->pacIdentificacion; ?>" class="form-control" placeholder="Número Identificacion">
							</div>
						</div>							
						<div class="form-group">
							<label for="inputEmail1" class="col-lg-2 control-label">Genero:*</label>
							<div class="col-md-3">
								<select name="detIdGenero" id="detIdGenero" class="form-control" required>
									<option value="">-- Seleccione --</option>									
									<?php foreach($genero as $l):?>
										<option  value="<?php echo $l->detIdDetalle; ?>"<?php if ($l->detIdDetalle == $persona->detIdGenero) echo "selected"; ?>><?php echo $l->detDescDetalle; ?></option>
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
										<option  value="<?php echo $l->detIdDetalle; ?>"<?php if ($l->detIdDetalle == $persona->detIdEstadoCivil) echo "selected"; ?>><?php echo $l->detDescDetalle; ?></option>
									<?php endforeach; ?>
								</select>	
							</div>
						</div>							
						<div class="form-group">
							<label for="inputEmail1" class="col-lg-2 control-label">Fecha Nacimiento:</label>
							<div class="col-md-2">
								<input type="date" name="pacFechaNacimiento" id="pacFechaNacimiento" value="<?php echo $persona->pacFechaNacimiento; ?>" class="form-control" placeholder="Fecha de Nacimiento">
							</div>
						</div>	
						<div class="form-group">
							<label class="col-lg-2 control-label">Aseguradora:*</label>
							<div class="col-lg-3">
								<select name="detIdAseguradora" id="detIdAseguradora" class="form-control" required>
									<option value="">-- Seleccione --</option>
									<?php foreach($aseg as $l):?>
										<option  value="<?php echo $l->detIdDetalle; ?>"<?php if ($l->detIdDetalle == $persona->detIdAseguradora) echo "selected"; ?>><?php echo $l->detDescDetalle; ?></option>
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
										<option  value="<?php echo $l->detIdDetalle; ?>"<?php if ($l->detIdDetalle == $persona->detIdOcupacion) echo "selected"; ?>><?php echo $l->detDescDetalle; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>									
						<div class="form-group">
							<label for="inputEmail1" class="col-lg-2 control-label"> Contacto:</label>
							<div class="col-md-3">
								<input type="text" name="pacContacto" id="pacContacto" value="<?php echo $persona->pacContacto; ?>" class="form-control" placeholder="Contacto">
							</div>
						</div>		
						<div class="form-group">
							<div class="col-lg-offset-2 col-lg-10">
								<button type="submit" class="btn btn-primary">Actualiza Datos</button>
							</div>
						</div>					
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
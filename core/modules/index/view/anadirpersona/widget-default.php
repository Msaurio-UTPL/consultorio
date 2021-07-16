<?php
error_reporting(E_ERROR | E_PARSE);
$u=null;
if(Session::getUID()!="")
{
	$u = SPUser::getById(Session::getUID());
	$user = $u->usuCodUsuario;
	$rol=$u->detIdRol;
	if ($rol=='1' or $rol=='2' or $rol=='3')
	{
		if(count($_POST)>0)
		{
			$controlpersona = SPBasica::getById($_POST["pacIdentificacion"]);
			if (count($controlpersona)>0)
			{
				// Ya existe
				Core::alert("El paciente ya existe. por favor revise...");
				print "<script>window.location='index.php?view=persona';</script>";
			}
			else
			{
				// Es nuevo paciente
				$npersona = new SPBasica();

				$npersona->pacApellidos=$_POST["pacApellidos"];
				$npersona->pacNombres=$_POST["pacNombres"];
				$npersona->conIdTipoIdentificacion=4;
				$npersona->detIdTipoIdentificacion=$_POST["detIdTipoIdentificacion"];
				$npersona->pacIdentificacion=$_POST["pacIdentificacion"];
				$npersona->conIdGenero=7;
				$npersona->detIdGenero=$_POST["detIdGenero"];
				$npersona->conIdEstadoCivil=8;
				$npersona->detIdEstadoCivil=$_POST["detIdEstadoCivil"];
				$npersona->pacFechaNacimiento=$_POST["pacFechaNacimiento"];
				$npersona->conIdProvincia=21;
				$npersona->detIdProvincia=$_POST["detIdProvincia"];
				$npersona->conIdCanton=22;
				$npersona->detIdCanton=$_POST["detIdCanton"];
				$npersona->conIdParroquia=22;
				$npersona->detIdParroquia=$_POST["detIdCanton"];
				$npersona->conIdAseguradora=9;
				$npersona->detIdAseguradora=$_POST["detIdAseguradora"];
				$npersona->conIdOcupacion=10;
				$npersona->detIdOcupacion=$_POST["detIdOcupacion"];
				$npersona->pacContacto=$_POST["pacContacto"];
				
				$npersona->add();
				// Log
				/*
				$milog=new SPLog();
				$milog->codigo=Session::getUID();
				$milog->operacion="Crea Usuario:".$_POST["codigo"];
				$milog->add();
				*/
				Core::alert("Se ha añadido el Paciente exitosamente.");
				print "<script>window.location='index.php?view=persona';</script>";
			}
		}	
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
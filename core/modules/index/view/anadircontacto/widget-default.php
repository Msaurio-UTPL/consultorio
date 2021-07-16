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
			$controlcontacto = SPContacto::getById($_POST["id"],$_POST["tipo"]);
			if (count($controlcontacto)>0)
			{
				// Ya existe
				Core::alert("El contacto ya existe, por favor revise.");
				print "<script>window.location='index.php?view=contacto&id=".$_POST["id"]."';</script>";
			}
			else
			{
				// Es nuevo contacto
				$ncontacto = new SPContacto();	
				$ncontacto->paciente_pacIdPaciente= $_POST["id"];
				$ncontacto->conIdContacto=6;
				$ncontacto->detIdContacto=$_POST["tipo"];
				$ncontacto->conDescripcion1= $_POST["conDescripcion1"];
				$ncontacto->conDescripcion2= $_POST["conDescripcion2"];
				$ncontacto->conDescripcion3= $_POST["conDescripcion3"];
				// Estado de Contacto
				$ncontacto->conIdEstado = 1;
				$ncontacto->detIdEstado = 1;
				$ncontacto->add();
				// Log
				/*
				$milog=new SPLog();
				$milog->codigo=Session::getUID();
				$milog->operacion="Crea Usuario:".$_POST["codigo"];
				$milog->add();
				*/
				Core::alert("Se ha añadido el Contacto exitosamente.");
				$paciente = SPBasica::getInfoByIdSec($_POST["id"]);
				$vpacIdPaciente=$paciente->pacIdentificacion;
				print "<script>window.location='index.php?view=pacientes&q=".$vpacIdPaciente."';</script>";
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
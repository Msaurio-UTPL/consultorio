<?php
error_reporting(E_ERROR | E_PARSE);
$u=null;
if(Session::getUID()!="")
{
	$u = SPUser::getById(Session::getUID());
	$user = $u->usuCodUsuario;
	$rol=$u->detIdRol;
	if ($rol=='1')
	{
		if(count($_POST)>0)
		{
			$controlcentro = SPCentro::getById($_POST["cenIdentificacion"]);
			if (count($controlcentro)>0)
			{
				// Ya existe centro
				Core::alert("El centro ya existe, por favor revise.");
				print "<script>window.location='index.php?view=centro';</script>";
			}
			else
			{
				// Es nuevo centro
				$nuser = new SPCentro();
				
				$nuser->cenDescripcion= $_POST["cenDescripcion"];
				$nuser->cenIdentificacion= $_POST["cenIdentificacion"];
				$nuser->conIdTipo= 3;
				$nuser->detIdTipo= $_POST["detIdTipo"];	
				$nuser->cenSuscripcionInicio= $_POST["cenSuscripcionInicio"];
				$nuser->cenSuscripcionFin= $_POST["cenSuscripcionFin"];
				$nuser->cenDireccion= $_POST["cenDireccion"];
				$nuser->cenTelefonos= $_POST["cenTelefonos"];
				//$nuser->cenLogo = $_POST["cenLogo"];

				$nuser->add();
				// Log
				/*
				$milog=new SPLog();
				$milog->codigo=Session::getUID();
				$milog->operacion="Crea Usuario:".$_POST["codigo"];
				$milog->add();
				*/
				Core::alert("Se ha añadido el Medico exitosamente.");
				print "<script>window.location='index.php?view=centro';</script>";
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
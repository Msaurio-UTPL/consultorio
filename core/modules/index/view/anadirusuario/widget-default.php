<?php
error_reporting(E_ERROR | E_PARSE);
$u=null;
if(Session::getUID()!="")
{
	$u = SPUser::getById(Session::getUID());
	$user = $u->usuCodUsuario;
	$rol=$u->detIdRol;
	if ($rol=='1' or $rol=='2')
	{
		if(count($_POST)>0)
		{
			$controlusuario = SPUser::getById($_POST["codigo"]);
			if (count($controlusuario)>0)
			{
				// Ya existe usuario
				Core::alert("El usuario ya existe, por favor revise.");
				print "<script>window.location='index.php?view=nuevousuario';</script>";
			}
			else
			{
				// Es nuevo usuario
				$nuser = new SPUser();
				$nuser->usuCodUsuario= $_POST["codigo"];
				$nuser->usuNombreUsuario= $_POST["nombre"];
				$nuser->usuClaveUsuario= $_POST["clave"];
				$nuser->usuCorreo= $_POST["mail"];
				// Estado de Usuario
				$nuser->conIdEstado = 2;
				$nuser->detIdEstado = $_POST["activo"];
				// Rol de Usuario
				$nuser->conIdRol = 1;
				$nuser->detIdRol = $_POST["detIdRol"];
				$nuser->centro_cenIdCentro = $_POST["centro_cenIdCentro"];
				$nuser->add();
				// Log
				/*
				$milog=new SPLog();
				$milog->codigo=Session::getUID();
				$milog->operacion="Crea Usuario:".$_POST["codigo"];
				$milog->add();
				*/
				Core::alert("Se ha añadido el Usuario exitosamente.");
				print "<script>window.location='index.php?view=usuarios';</script>";
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
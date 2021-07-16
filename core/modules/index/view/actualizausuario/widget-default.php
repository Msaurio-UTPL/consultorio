<?php
error_reporting(E_ERROR | E_PARSE);
function getRealIP()
    {
    
        if (isset($_SERVER["HTTP_CLIENT_IP"]))
        {
            return $_SERVER["HTTP_CLIENT_IP"];
        }
        elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
        {
            return $_SERVER["HTTP_X_FORWARDED_FOR"];
        }
        elseif (isset($_SERVER["HTTP_X_FORWARDED"]))
        {
            return $_SERVER["HTTP_X_FORWARDED"];
        }
        elseif (isset($_SERVER["HTTP_FORWARDED_FOR"]))
        {
            return $_SERVER["HTTP_FORWARDED_FOR"];
        }
        elseif (isset($_SERVER["HTTP_FORWARDED"]))
        {
            return $_SERVER["HTTP_FORWARDED"];
        }
        else
        {
            return $_SERVER["REMOTE_ADDR"];
        }
    }
$ip=getRealIP();
$u=null;
if(Session::getUID()!="")
{
	$u = SPUser::getById(Session::getUID());
	//$user = $u->usuCodUsuario;
	$rol=$u->detIdRol;
	if ($rol=='1' or $rol=='2')
	{
		if(count($_POST)>0)
		{
			$user = SPUser::getBySec($_POST["usuIdUsuario"]);
			$user->usuCodUsuario = $_POST["usuCodUsuario"];
			$user->usuNombreUsuario = $_POST["usuNombreUsuario"];
			$user->detIdRol = $_POST["detIdRol"];
			$user->detIdEstado = $_POST["detIdEstado"];
			$user->usuClaveUsuario = $_POST["usuClaveUsuario"];
			$user->usuCorreo = $_POST["usuCorreo"];
			$user->usuIdUsuario = $_POST["usuIdUsuario"];

			if ($user->detIdEstado!=$_POST["detIdEstado"] and $_POST["detIdEstado"]=="1")
			{
				$bactivo="Activa Usuarios:";
			}
			if ($user->detIdEstado!=$_POST["detIdEstado"] and $_POST["detIdEstado"]=="2")
			{
				$bactivo="Inactiva Usuarios:";
			}
			$user->detIdEstado = $_POST["detIdEstado"];
			// Log
			$milog=new SPLog();
			$milog->logaCodigo=Session::getUID();
			$milog->logaIp=$ip;
			if ($_POST["usuClaveUsuario"]!=$_POST["claveant"]) 
			{
				$user->updatecompleto();
				//$u->updatecompleto();
				// Cambia clave
				$milog->logaOperacion="Cambia Clave Usuario:".$_POST["usuCodUsuario"];
				$milog->add();
			}
			else
			{	
				//Core::alert("antes de update");
				$user->update();
				// Actualiza
				$milog->logaOperacion="Actualiza Usuario:".$_POST["usuCodUsuario"];
				$milog->add();
			}
			if (isset($bactivo))
			{
				$milog->logaOperacion=$bactivo.$_POST["usuCodUsuario"];
				$milog->add();
			}
			Core::alert("El Usuario ha sido actualizado exitosamente.");
			print "<script>window.location='index.php?view=usuarios';</script>";
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
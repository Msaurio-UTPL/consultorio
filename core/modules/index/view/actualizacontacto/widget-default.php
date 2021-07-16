<?php
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
	$user = $u->usuCodUsuario;
	$rol=$u->detIdRol;
	if ($rol=='1' or $rol=='2' or $rol=='3')
	{
		if(count($_POST)>0)
		{
			//echo "ingresa a bloque 1";
			$contacto = SPContacto::getById($_POST["id"],$_POST["id2"]);
			
			$contacto->conDescripcion1 = $_POST["conDescripcion1"];
			$contacto->conDescripcion2 = $_POST["conDescripcion2"];
			$contacto->conDescripcion3 = $_POST["conDescripcion3"];
			$contacto->detIdEstado = $_POST["detIdEstado"];

			$contacto->update();
			
			// Log
			/*
			$milog=new SPLog();
			$milog->codigo=Session::getUID();
			$milog->ip=$ip;
			*/
			/*			
			if (isset($bactivo))
			{
				$milog->operacion=$bactivo.$_POST["usuario"];
				$milog->add();
			}
			*/
			Core::alert("El contacto ha sido actualizado exitosamente.");
			print "<script>window.location='index.php?view=pacientes';</script>";
		}
	}
	else
	{
		View::Error("<b>Error!!!<br></b>El usuario <b>".$user."</b> no esta autorizado para contactolear esta opción.<br><a href='index.php?view=home'>Inicio</a>");
	}
}
else
{
	View::Error("<b>Error!!!<br></b>No puede contactolear el sistema sin iniciar sesión.<br><a href='index.php'>Inicio</a>");
}
?>
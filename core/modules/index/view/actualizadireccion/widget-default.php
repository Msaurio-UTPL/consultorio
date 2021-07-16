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
	if ($rol=='1' )
	{
		if(count($_POST)>0)
		{
			//echo "ingresa a bloque 1";
			$direccion = SPDireccion::getById($_POST["id"],$_POST["id2"]);
			
			$direccion->dirDescripcion1 = $_POST["dirDescripcion1"];
			$direccion->dirDescripcion2 = $_POST["dirDescripcion2"];
			$direccion->dirDescripcion3 = $_POST["dirDescripcion3"];
			$direccion->detIdEstado = $_POST["detIdEstado"];

			$direccion->update();
			
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
			Core::alert("El direccion ha sido actualizada exitosamente.");
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
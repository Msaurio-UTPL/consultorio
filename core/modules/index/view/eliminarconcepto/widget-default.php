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
	$centro=$u->cenIdCentro;
	$rol=$u->detIdRol;
	if ($rol=='1' or $rol=='2')
	{
			//echo $_GET["id"];
			$vcodigo=$_GET["id"];
			//Se debe validar si existe un concepto con esa descripcion
			$controlconcepto = SPConceptos::delById($centro,$vcodigo);
				// Aqui se registra en Log el nuevo concepto creado
				/*
				$milog=new SPLog();
				$milog->codigo=Session::getUID();
				$milog->operacion="Agrega Concepto:".$user->conIdConcepto;
				$milog->ip=$ip;
				$milog->add();
				*/
				Core::alert("Se ha eliminado el concepto exitosamente.");
				print "<script>window.location='index.php?view=conceptosg';</script>";
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
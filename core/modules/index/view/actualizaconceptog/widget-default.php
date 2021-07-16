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
	if ($rol=='1' or $rol=='2')
	{
		if(count($_POST)>0)
		{
			$vid=$_POST["id"];
			$vdescripcion=$_POST["descconcepto"];
			//Se debe validar si existe un concepto con esa descripcion
			$controlconcepto = SPConceptos::getByDesc($vdescripcion);
			if (count($controlconcepto)>0)
			{
				// Ya existe
				Core::alert("El Concepto ya existe, por favor revise.");
				print "<script>window.location='index.php?view=conceptosg';</script>";
			}
			else
			{
				// Es nuevo Concepto
				// Se debe crear un objeto del tipo SPConceptos y personalizar sus atributos
				$controlconcepto = SPConceptos::update($vid,$vdescripcion);
				// Aqui se registra en Log el nuevo concepto creado
				/*
				$milog=new SPLog();
				$milog->codigo=Session::getUID();
				$milog->operacion="Agrega Concepto:".$user->conIdConcepto;
				$milog->ip=$ip;
				$milog->add();
				*/
				?>
				<?php
				Core::alert("Se ha actualizado exitosamente.");
				print "<script>window.location='index.php?view=conceptosg';</script>";
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
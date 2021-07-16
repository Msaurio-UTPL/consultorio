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
			//echo $_POST["codigo"];
			$proveedor = SPBasica::getInfoByIdSec($_POST["codigo"]);
			//echo "(".count($proveedor).")";
			if (count($proveedor)<1)
			{
				// No existe
				Core::alert("El proveedor no existe");
				print "<script>window.location='index.php?view=operaciones';</script>";
			}
			else
			{
				$vrelacion=$_POST["relacion"];
				$vcritico=$_POST["critico"];
				$vtecno=$_POST["tecno"];
				$vorigen=$_POST["origen"];
				if ($vrelacion=="1")
				{
					$proveedor->proHistorico=1;
					$proveedor->proPrueba=0;
					$proveedor->proRechazado=0;
				}
				if ($vrelacion=="2")
				{
					$proveedor->proHistorico=0;
					$proveedor->proPrueba=1;
					$proveedor->proRechazado=0;
				}
				if ($vrelacion=="3")
				{
					$proveedor->proHistorico=0;
					$proveedor->proPrueba=0;
					$proveedor->proRechazado=1;
				}
				if ($vcritico=="1") $proveedor->proCritico=1; else $proveedor->proCritico=0;
				if ($vtecno=="1") $proveedor->proTecnologico=1; else $proveedor->proTecnologico=0;
				if ($vorigen=="1")
				{
					$proveedor->proNacional=1;
					$proveedor->proExtranjero=0;
				}
				else
				{
					$proveedor->proNacional=0;
					$proveedor->proExtranjero=1;
				}
				$proveedor->UpdatePosicion($_POST["codigo"]);
				// Log
				$milog=new SPLog();
				$milog->logaCodigo=Session::getUID();
				// Deberia grabar en el log la identificacion o la razon social
				$milog->logaOperacion="Posicionamiento:".$_POST["codigo"];
				$milog->logaIp=$ip;
				$milog->add();
				Core::alert("Se ha posicionado exitosamente.");
				$videntificacion=$proveedor->proIdentificacion;
				print "<script>window.location='index.php?view=operaciones&q=".$videntificacion."';</script>";
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
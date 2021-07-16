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
			//echo $_POST["codigo"];
			$proveedor = SPBasica::getInfoByIdSec($_POST["codigo"]);
			//echo "(".count($proveedor).")";
			if (count($proveedor)<1)
			{
				// Ya existe
				Core::alert("El proveedot no existe");
				print "<script>window.location='index.php?view=operaciones';</script>";
			}
			else
			{
				$vrelacion=$_POST["relacion"];
				$vcritico=$_POST["critico"];
				$vtecno=$_POST["tecno"];
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
				$proveedor->UpdatePosicion($_POST["codigo"]);
				// Log
				/*
				$milog=new SPLog();
				$milog->codigo=Session::getUID();
				$milog->operacion="Crea Usuario:".$_POST["codigo"];
				$milog->add();
				*/
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
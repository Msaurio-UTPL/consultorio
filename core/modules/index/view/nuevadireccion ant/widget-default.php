<?php
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
			$controldireccion = SPDireccion::getById($_POST["id"],$_POST["tipo"]);
			if (count($controldireccion)>0)
			{
				// Ya existe
				Core::alert("La Dirweccion ya existe, por favor revise.");
				print "<script>window.location='index.php?view=nuevadireccion';</script>";
			}
			else
			{
				// Es nueva direccion
				$ndireccion = new SPDireccion();	
				$ndireccion->proIdProveedor= $_POST["id"];
				$ndireccion->dirIdDireccion=5;
				$ndireccion->detIdDireccion=$_POST["tipo"];
				$ndireccion->dirDescripcion1= $_POST["dirDescripcion1"];
				$ndireccion->dirDescripcion2= $_POST["dirDescripcion2"];
				$ndireccion->dirDescripcion3= $_POST["dirDescripcion3"];
				// Estado de direccion
				$ndireccion->conIdEstado = 1;
				$ndireccion->detIdEstado = 1;
				$ndireccion->add();
				// Log
				/*
				$milog=new SPLog();
				$milog->codigo=Session::getUID();
				$milog->operacion="Crea Usuario:".$_POST["codigo"];
				$milog->add();
				*/
				Core::alert("Se ha añadido Direccion exitosamente.");
				print "<script>window.location='index.php?view=direccion';</script>";
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
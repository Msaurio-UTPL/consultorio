<?php
error_reporting(E_ERROR | E_PARSE);
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
			$controldireccion = SPDireccion::getById($_POST["id"],$_POST["tipo"]);
			if (count($controldireccion)>0)
			{
				// Ya existe
				Core::alert("La Direccion ya existe, por favor revise.");
				print "<script>window.location='index.php?view=direccion&id=".$_POST["id"]."';</script>";
			}
			else
			{
				// Es nueva direccion
				$ndireccion = new SPDireccion();	
				$ndireccion->paciente_pacIdPaciente= $_POST["id"];
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
				$proveedor = SPBasica::getInfoByIdSec($_POST["id"]);
				$videntificacion=$proveedor->proIdentificacion;
				print "<script>window.location='index.php?view=pacientes&q=".$videntificacion."';</script>";				
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
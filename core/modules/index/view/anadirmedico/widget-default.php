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
			$controlmedico = SPMedico::getById($_POST["medIdentificacion"]);
			if (count($controlmedico)>0)
			{
				// Ya existe medico
				Core::alert("El medico ya existe, por favor revise.");
				print "<script>window.location='index.php?view=nuevomedico';</script>";
			}
			else
			{
				// Es nuevo medico
				$nuser = new SPMedico();
				
				$nuser->medApellidos= $_POST["medApellidos"];
				$nuser->medNombres= $_POST["medNombres"];
				$nuser->conIdTipoIdentificacion= 4;
				$nuser->detIdTipoIdentificacion= $_POST["detIdTipoIdentificacion"];
				$nuser->medIdentificacion= $_POST["medIdentificacion"];
				$nuser->conIdEspecialidad= 11;
				$nuser->detIdEspecialidad= $_POST["detIdEspecialidad"];
				$nuser->conIdDuracion = 13;
				$nuser->detIdDuracion= $_POST["detIdDuracion"];
				$nuser->conIdEstado= 1;
				$nuser->detIdEstado= $_POST["activo"];				
				$nuser->centro_cenIdCentro = $_POST["centro_cenIdCentro"];

				$nuser->add();
				// Log
				/*
				$milog=new SPLog();
				$milog->codigo=Session::getUID();
				$milog->operacion="Crea Usuario:".$_POST["codigo"];
				$milog->add();
				*/
				Core::alert("Se ha añadido el Medico exitosamente.");
				print "<script>window.location='index.php?view=medicos';</script>";
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
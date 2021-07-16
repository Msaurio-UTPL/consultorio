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
	$user = $u->usuCodUsuario;
	$rol=$u->detIdRol;
	if ($rol=='1' or $rol=='2')
	{
		$historia = SPHistoria::getById($_POST["historia"]);
		$med = $historia->medIdMedico;

		if(count($historia)>0)
		{
			//echo "ingresa a bloque 1";
			$his = new SPHistoria();
			
			$his->medIdMedico = $_POST["medico"];
			$his->hisFecha = $_POST["fecha"];
			$his->hisMotivoConsulta = $_POST["hisMotivoConsulta"];
			$his->hisEnfermedad = $_POST["hisEnfermedad"];			
			$his->detIdEstado = 2;
			$his->paciente_pacIdPaciente = $_POST["paciente"];
		
			// Log
			$milog=new SPLog();
			$milog->logaCodigo=Session::getUID();
			$milog->logaIp=$ip;

			$his->update($_POST["historia"]);
			
			$milog->logaOperacion="Actualiza historia:".$_POST["historia"];
			$milog->add();

			Core::alert("La historia ha sido actualizada exitosamente.");
			print "<script>window.location='index.php?view=consultacitas&id=$med';</script>";		
		}
		else 
		{
			$his = new SPHistoria();
			
			$his->medIdMedico = $_POST["medico"];
			$his->hisFecha = $_POST["fecha"];
			$his->hisMotivoConsulta = $_POST["hisMotivoConsulta"];
			$his->hisEnfermedad = $_POST["hisEnfermedad"];			
			$his->detIdEstado = 2;
			$his->paciente_pacIdPaciente = $_POST["paciente"];
			
			// Log
			$milog=new SPLog();
			$milog->logaCodigo=Session::getUID();
			$milog->logaIp=$ip;

			$his->add();
			
			$milog->logaOperacion="Nueva historia:".$_POST["historia"];
			$milog->add();

			Core::alert("La historia ha sido insertada exitosamente.");
			print "<script>window.location='index.php?view=consultacitas&id=$med';</script>";			
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
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
			$cita = new SPCita();
			
			$cita->citIdCita = $_POST["citIdCita"];
			$cita->medIdMedico = $_POST["medIdMedico"];
			$cita->citFecha = $_POST["citFecha"];
			$cita->citHoraInicio = $_POST["citHoraInicio"];
			$cita->detIdEstado = $_POST["detIdEstado"];
			$cita->paciente_pacIdPaciente = $_POST["paciente_pacIdPaciente"];
			$cita->horario_horIdHorario = $_POST["horario_horIdHorario"];

			if ($cita->detIdEstado!=$_POST["detIdEstado"] and $_POST["detIdEstado"]=="1")
			{
				$bactivo="Activa estado:";
			}
			if ($cita->detIdEstado!=$_POST["detIdEstado"] and $_POST["detIdEstado"]=="2")
			{
				$bactivo="Inactiva estado:";
			}
			$cita->detIdEstado = $_POST["detIdEstado"];
			
			// Log
			$milog=new SPLog();
			$milog->logaCodigo=Session::getUID();
			$milog->logaIp=$ip;

			$cita->update();
			
			$milog->logaOperacion="Cambia Datos Cita:".$_POST["citIdCita"];
			$milog->add();
			if (isset($bactivo))
			{
				$milog->logaOperacion=$bactivo.$_POST["medIdMedico"];
				$milog->add();
			}

			Core::alert("La cita ha sido actualizada exitosamente.");
			print "<script>window.location='index.php?view=atencion';</script>";
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
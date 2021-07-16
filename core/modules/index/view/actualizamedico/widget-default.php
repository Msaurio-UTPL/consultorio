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
			//echo "ingresa a bloque 1";
			$med = new SPMedico();
			
			$med->medIdMedico = $_POST["medIdMedico"];
			$med->medApellidos = $_POST["medApellidos"];
			$med->medNombres = $_POST["medNombres"];
			$med->detIdTipoIdentificacion = $_POST["detIdTipoIdentificacion"];
			$med->medIdentificacion = $_POST["medIdentificacion"];
			$med->detIdEspecialidad = $_POST["detIdEspecialidad"];
			$med->detIdDuracion = $_POST["detIdDuracion"];
			$med->detIdEstado = $_POST["detIdEstado"];
			//echo $med->medIdMedico;
			
			if ($med->detIdEstado!=$_POST["detIdEstado"] and $_POST["detIdEstado"]=="1")
			{
				$bactivo="Activa estado:";
			}
			if ($med->detIdEstado!=$_POST["detIdEstado"] and $_POST["detIdEstado"]=="2")
			{
				$bactivo="Inactiva estado:";
			}
			$med->detIdEstado = $_POST["detIdEstado"];
			
			// Log
			$milog=new SPLog();
			$milog->logaCodigo=Session::getUID();
			$milog->logaIp=$ip;

			$med->update($med->medIdMedico);
			
			$milog->logaOperacion="Cambia Datos Medico:".$_POST["medIdMedico"];
			$milog->add();
			if (isset($bactivo))
			{
				$milog->logaOperacion=$bactivo.$_POST["medIdMedico"];
				$milog->add();
			}

			Core::alert("El médico ha sido actualizado exitosamente.");
			print "<script>window.location='index.php?view=medicos';</script>";
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
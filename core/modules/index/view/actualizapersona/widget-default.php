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
	if ($rol=='1' or $rol=='2' or $rol=='3')
	{
		if(count($_POST)>0)
		{
			$paciente = new SPBasica();
			$paciente = SPBasica::getByIdSec($_POST['id']);
			
			//echo $paciente->pacIdPaciente;
			$paciente->detIdProvincia = $_POST["detIdProvincia"];
			$paciente->detIdCanton = $_POST["detIdCanton"];
			$paciente->detIdParroquia = $_POST["detIdParroquia"];
			$paciente->pacApellidos = $_POST["pacApellidos"];
			$paciente->pacNombres = $_POST["pacNombres"];
			$paciente->detIdTipoIdentificacion = $_POST["detIdTipoIdentificacion"];
			$paciente->pacIdentificacion = $_POST["pacIdentificacion"];
			$paciente->detIdGenero = $_POST["detIdGenero"];
			$paciente->detIdEstadoCivil = $_POST["detIdEstadoCivil"];
			$paciente->pacFechaNacimiento = $_POST["pacFechaNacimiento"];
			$paciente->detIdAseguradora = $_POST["detIdAseguradora"];
			$paciente->detIdOcupacion = $_POST["detIdOcupacion"];
			$paciente->pacContacto = $_POST["pacContacto"];
			
			$paciente->updatecompleto();

			Core::alert("Paciente Actualizado exitosamente!");
			print "<script>window.location='index.php?view=pacientes';</script>";
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
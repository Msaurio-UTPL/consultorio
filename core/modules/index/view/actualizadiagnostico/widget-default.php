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
		$diagnostico = SPDiagnostico::getById($_POST["historia"]);
		$pac = $historia->paciente_pacIdPaciente;
		$med = $historia->medIdMedico;
		$fec = $historia->hisFecha;

/*		if(count($diagnostico)>0)
		{
 			//echo "ingresa a bloque 1";
			$diag = new SPDiagnostico();
			
			$diag->diaDiagnostico = $_POST["diaDiagnostico"];
			$diag->detIdCie10 = $_POST["detIdCie10"];
			$diag->detIdTipo = $_POST["detIdTipo"];
		
			// Log
			$milog=new SPLog();
			$milog->logaCodigo=Session::getUID();
			$milog->logaIp=$ip;

			$diag->update();
			
			$milog->logaOperacion="Actualiza diagnostico:".$_POST["historia"];
			$milog->add();

			Core::alert("Diagnostico ha sido actualizado exitosamente.");
			print "<script>window.location='index.php?view=atencioncita&id=$med&id2=$pac&id3=$fec;';</script>";			
		}
		else 
		{ */
			$diag = new SPDiagnostico();
			
			$diag->diaDiagnostico = $_POST["diaDiagnostico"];
			$diag->conIdCie10 = 27;
			$diag->detIdCie10 = $_POST["detIdCie10"];
			$diag->conIdTipo = 28;
			$diag->detIdTipo = $_POST["detIdTipo"];
			$diag->historia_hisIdHistoria = $historia->hisIdHistoria;
			$diag->historia_medIdMedico = $historia->medIdMedico;
			$diag->historia_hisFecha = $historia->hisFecha;
		
			// Log
			$milog=new SPLog();
			$milog->logaCodigo=Session::getUID();
			$milog->logaIp=$ip;

			$diag->add();
			
			$milog->logaOperacion="Nuevo Diagnostico:".$_POST["historia"];
			$milog->add();

			Core::alert("Diagnostico ha sido insertado exitosamente.");
			print "<script>window.location='index.php?view=atencioncita&id=$med&id2=$pac&id3=$fec;';</script>";			
		//}
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
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
		$historia = SPHistoria::getById($_GET["id"]);
		$med = $historia->medIdMedico;
		$pac = $historia->paciente_pacIdPaciente;
		$fec = $historia->hisFecha;	
		$controldetalle = SPExamenes::getByIdDet($_GET["id"],$_POST["detIdTipoExamen"]);		
		//echo count($_POST);
/*		if(count($controldetalle)>0)
		{
			//echo "ingresa a bloque 1";
			$exa = new SPExamenes();
			
			$exa->conIdTipoExamen = $_POST["Examen"];
			$exa->detIdTipoExamen = $_POST["detIdTipoExamen"];
			$exa->exaIndicaciones = $_POST["exaIndicaciones"];
			$exa->exaFechaExamen = $_POST["exaFechaExamen"];
			$exa->historia_hisIdHistoria = $_POST["historia"];
			$exa->historia_medIdMedico = $_POST["medico"];
			$exa->historia_hisFecha = $_POST["fecha"];
			
			// Log
			$milog=new SPLog();
			$milog->logaCodigo=Session::getUID();
			$milog->logaIp=$ip;

			$exa->update($controldetalle->exaIdExamenes);
			
			$milog->logaOperacion="Cambia Datos Examen:".$_POST["historia"];
			$milog->add();

			Core::alert("El examen ha sido actualizado exitosamente.");
			print "<script>window.location='index.php?view=atencioncita&id=$med&id2=$pac&id3=$fec;';</script>";		
		}
		else 
		{	*/
			$exa = new SPExamenes();
			
			$exa->conIdTipoExamen = $_POST["Examen"];
			$exa->detIdTipoExamen = $_POST["detIdTipoExamen"];
			$exa->exaIndicaciones = $_POST["exaIndicaciones"];
			$exa->exaFechaExamen = $_POST["exaFechaExamen"];
			$exa->historia_hisIdHistoria = $_POST["historia"];
			$exa->historia_medIdMedico = $_POST["medico"];
			$exa->historia_hisFecha = $_POST["fecha"];
			
			// Log
			$milog=new SPLog();
			$milog->logaCodigo=Session::getUID();
			$milog->logaIp=$ip;

			$exa->add();
			
			$milog->logaOperacion="Nuevos Datos Examen:".$_POST["historia"];
			$milog->add();

			Core::alert("El examen ha sido insertado exitosamente.");
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
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
		$historia = SPHistoria::getById($_GET["id"]);
		$med = $historia->medIdMedico;
		$pac = $historia->paciente_pacIdPaciente;
		$fec = $historia->hisFecha;	
		$controldetalle = SPMedicinas::getByIdDet($_GET["id"],$_POST["detIdMedicamento"]);		
		//echo "medicinas: ".count($controldetalle);
/*		if(count($controldetalle)>0)
		{
			//echo "ingresa a bloque 1";
			$med = new SPMedicinas();
			
			$med->conIdMedicamento = 33;
			$med->detIdMedicamento = $_POST["detIdMedicamento"];
			$med->conIdTipoPresentacion = 34;
			$med->detIdTipoPresentacion = $_POST["detIdTipoPresentacion"];
			$med->medCantidad = $_POST["medCantidad"];
			$med->historia_hisIdHistoria = $_POST["historia"];
			$med->historia_medIdMedico = $_POST["medico"];
			$med->historia_hisFecha = $_POST["fecha"];
			
			// Log
			$milog=new SPLog();
			$milog->logaCodigo=Session::getUID();
			$milog->logaIp=$ip;

			$med->update($controldetalle->medIdMedicinas);
			
			$milog->logaOperacion="Cambia Datos Medicina:".$_POST["historia"];
			$milog->add();
		}
		else 
		{	*/
			$med = new SPMedicinas();
			
			$med->conIdMedicamento = 33;
			$med->detIdMedicamento = $_POST["detIdMedicamento"];
			$med->conIdTipoPresentacion = 34;
			$med->detIdTipoPresentacion = $_POST["detIdTipoPresentacion"];
			$med->medCantidad = $_POST["medCantidad"];
			$med->historia_hisIdHistoria = $_POST["historia"];
			$med->historia_medIdMedico = $_POST["medico"];
			$med->historia_hisFecha = $_POST["fecha"];
			
			// Log
			$milog=new SPLog();
			$milog->logaCodigo=Session::getUID();
			$milog->logaIp=$ip;

			$med->add();
			
			$milog->logaOperacion="Nuevos Datos Medicina:".$_POST["historia"];
			$milog->add();
		//}
		//echo "tratamiento ".$_GET["id"];
		$controltratamiento = SPTratamiento::getByHis($_GET["id"]);		
		//echo "his:".$med->historia_hisIdHistoria;
		//echo "med:".$med->historia_medIdMedico;
		//echo "fec:".$med->historia_hisFecha;
/*		if(count($controltratamiento)>0)
		{
			$tra = new SPTratamiento();
			$medi = SPMedicinas::getByIdDet($_GET["id"],$_POST["detIdMedicamento"]);
			
			$tra->conIdFrecuencia = 35;
			$tra->detIdFrecuencia = $_POST["detIdFrecuencia"];
			$tra->conIdTiempo = 36;
			$tra->detIdTiempo = $_POST["detIdTiempo"];
			$tra->traCantidad = $_POST["traCantidad"];
			$tra->medicinas_medIdMedicinas = $medi->medIdMedicinas;
			$tra->medicinas_historia_hisIdHistoria = $med->historia_hisIdHistoria;
			$tra->medicinas_historia_medIdMedico = $med->historia_medIdMedico;
			$tra->medicinas_historia_hisFecha = $med->historia_hisFecha;
			
			// Log
			$milog=new SPLog();
			$milog->logaCodigo=Session::getUID();
			$milog->logaIp=$ip;

			$tra->update($controltratamiento->medicinas_medIdMedicinas);
			
			$milog->logaOperacion="Cambia Datos Tratamiento:".$_POST["historia"];
			$milog->add();

			Core::alert("Medicinas y Tratamiento han sido actualizados exitosamente.");
			print "<script>window.location='index.php?view=atencioncita&id=$med&id2=$pac&id3=$fec;';</script>";	
		}
		else 
		{	*/
			$tra = new SPTratamiento();
			$medi = SPMedicinas::getByIdDet($_GET["id"],$_POST["detIdMedicamento"]);
			
			$tra->conIdFrecuencia = 35;
			$tra->detIdFrecuencia = $_POST["detIdFrecuencia"];
			$tra->conIdTiempo = 36;
			$tra->detIdTiempo = $_POST["detIdTiempo"];
			$tra->traCantidad = $_POST["traCantidad"];
			$tra->medicinas_medIdMedicinas = $medi->medIdMedicinas;
			$tra->medicinas_historia_hisIdHistoria = $med->historia_hisIdHistoria;
			$tra->medicinas_historia_medIdMedico = $med->historia_medIdMedico;
			$tra->medicinas_historia_hisFecha = $med->historia_hisFecha;
			
			// Log
			$milog=new SPLog();
			$milog->logaCodigo=Session::getUID();
			$milog->logaIp=$ip;

			$tra->add();
			
			$milog->logaOperacion="Nuevos Datos Tratamiento:".$_POST["historia"];
			$milog->add();

			Core::alert("Medicinas y Tratamiento han sido insertados exitosamente.");
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
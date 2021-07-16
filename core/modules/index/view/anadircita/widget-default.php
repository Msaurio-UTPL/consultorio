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
			$controlcita = SPCita::getByPacHorFec($_POST["paciente"],$_POST["citHoraInicio"],$_POST["citFecha"]);
			$controlfecha = SPCita::getByHoy($_POST["citFecha"]);
			$dia = new SPHorario();
			$dia = SPHorario::getDia($_POST["citFecha"]);
			$horario = SPHorario::getByMed($_POST["medico"],$dia->dia,$_POST["citHoraInicio"]);
			if (count($controlcita)>0)
			{
				// Ya existe cita
				Core::alert("La cita ya existe, por favor revise.");
				print "<script>window.location='index.php?view=pacientes';</script>";
			} else {
				if (count($controlfecha)>0) {
					// Cita dia pasado 
					Core::alert("La cita debe ser actual o futura, por favor revise.");
					print "<script>window.location='index.php?view=pacientes';</script>";
				} else {		
					if (count($horario)>0)
					{
						// Es nueva cita

						$ncita = new SPCita();
						$ncita->medIdMedico= $_POST["medico"];
						$ncita->citFecha= $_POST["citFecha"];
						$ncita->citHoraInicio= $_POST["citHoraInicio"];
						$ncita->conIdEstado = 1;
						$ncita->detIdEstado = $_POST["activo"];
						$ncita->paciente_pacIdPaciente = $_POST["paciente"];
						$ncita->horario_horIdHorario = $dia->horIdHorario;
						
						$ncita->add();
						
						// Registra cita en historia clinica
						
						$nhist = new SPHistoria();
						$nhist->medIdMedico = $ncita->medIdMedico;
						$nhist->hisFecha = $ncita->citFecha;
						$nhist->hisMotivoConsulta = "Pendiente";
						$nhist->hisEnfermedad = "Pendiente";
						$nhist->conIdEstado = 1;
						$nhist->detIdEstado = 1;
						$nhist->paciente_pacIdPaciente = $ncita->paciente_pacIdPaciente;
						
						$nhist->add();
						
						// Log
						/*
						$milog=new SPLog();
						$milog->codigo=Session::getUID();
						$milog->operacion="Crea Usuario:".$_POST["codigo"];
						$milog->add();
						*/
						Core::alert("Se ha añadido la cita exitosamente.");
						print "<script>window.location='index.php?view=pacientes';</script>";
					} else {
						// No hay horario disponible
						Core::alert("La cita no corresponde al horario del medico, por favor revise.");
						print "<script>window.location='index.php?view=pacientes';</script>";	
					}						
				}
			}
		}	
	} else 	{
		View::Error("<b>Error!!!<br></b>El usuario <b>".$user."</b> no esta autorizado para emplear esta opción.<br><a href='index.php?view=home'>Inicio</a>");
	}
} else {
	View::Error("<b>Error!!!<br></b>No puede emplear el sistema sin iniciar sesión.<br><a href='index.php'>Inicio</a>");
}
?>
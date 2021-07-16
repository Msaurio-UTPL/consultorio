<?php
error_reporting(E_ERROR | E_PARSE);
$u=null;
if(Session::getUID()!="")
{
	$u = SPUser::getById(Session::getUID());
	$user = $u->usuCodUsuario;
	$rol = $u->detIdRol;
	if ($rol=='1' or $rol=='2')
	{
		//echo count($_POST);
		if(count($_POST)>0) {
			//echo $_POST["medIdMedico"];
			$controlhorario = SPHorario::getByMedico($_POST["medIdMedico"]);
			$med=$_POST["medIdMedico"];
			if (count($controlhorario)>0)
			{
				// Ya existe datos
				// graba dia 1				
				$nhorario = new SPHorario();
				$nhorario->medico_medIdMedico = $_POST["medIdMedico"];
				$nhorario->horHoraInicio= $_POST["horHoraInicio1"];
				$nhorario->horHoraFin= $_POST["horHoraFin1"];
				$nhorario->detIdDia= $_POST["detIdDia1"];
				if($_POST['detIdEstado1']=="on") {
				$nhorario->detIdEstado= 1;
				} else {
				$nhorario->detIdEstado= 2;	
				}		
				$nhorario->update();

				// graba dia 2				
				$nhorario = new SPHorario();
				$nhorario->medico_medIdMedico = $_POST["medIdMedico"];
				$nhorario->horHoraInicio= $_POST["horHoraInicio2"];
				$nhorario->horHoraFin= $_POST["horHoraFin2"];
				$nhorario->detIdDia= $_POST["detIdDia2"];
				if($_POST['detIdEstado2']=="on") {
				$nhorario->detIdEstado= 1;
				} else {
				$nhorario->detIdEstado= 2;	
				}		
				$nhorario->update();

				// graba dia 3				
				$nhorario = new SPHorario();
				$nhorario->medico_medIdMedico = $_POST["medIdMedico"];
				$nhorario->horHoraInicio= $_POST["horHoraInicio3"];
				$nhorario->horHoraFin= $_POST["horHoraFin3"];
				$nhorario->detIdDia= $_POST["detIdDia3"];
				if($_POST['detIdEstado3']=="on") {
				$nhorario->detIdEstado= 1;
				} else {
				$nhorario->detIdEstado= 2;	
				}			
				$nhorario->update();

				// graba dia 4				
				$nhorario = new SPHorario();
				$nhorario->medico_medIdMedico = $_POST["medIdMedico"];
				$nhorario->horHoraInicio= $_POST["horHoraInicio4"];
				$nhorario->horHoraFin= $_POST["horHoraFin4"];
				$nhorario->detIdDia= $_POST["detIdDia4"];
				if($_POST['detIdEstado4']=="on") {
				$nhorario->detIdEstado= 1;
				} else {
				$nhorario->detIdEstado= 2;	
				}			
				$nhorario->update();

				// graba dia 5				
				$nhorario = new SPHorario();
				$nhorario->medico_medIdMedico = $_POST["medIdMedico"];
				$nhorario->horHoraInicio= $_POST["horHoraInicio5"];
				$nhorario->horHoraFin= $_POST["horHoraFin5"];
				$nhorario->detIdDia= $_POST["detIdDia5"];
				if($_POST['detIdEstado5']=="on") {
				$nhorario->detIdEstado= 1;
				} else {
				$nhorario->detIdEstado= 2;	
				}		
				$nhorario->update();

				// graba dia 6			
				$nhorario = new SPHorario();
				$nhorario->medico_medIdMedico = $_POST["medIdMedico"];
				$nhorario->horHoraInicio= $_POST["horHoraInicio6"];
				$nhorario->horHoraFin= $_POST["horHoraFin6"];
				$nhorario->detIdDia= $_POST["detIdDia6"];
				if($_POST['detIdEstado6']=="on") {
				$nhorario->detIdEstado= 1;
				} else {
				$nhorario->detIdEstado= 2;	
				}			
				$nhorario->update();

				// graba dia 7				
				$nhorario = new SPHorario();
				$nhorario->medico_medIdMedico = $_POST["medIdMedico"];
				$nhorario->horHoraInicio= $_POST["horHoraInicio7"];
				$nhorario->horHoraFin= $_POST["horHoraFin7"];
				$nhorario->detIdDia= $_POST["detIdDia7"];
				if($_POST['detIdEstado7']=="on") {
				$nhorario->detIdEstado= 1;
				} else {
				$nhorario->detIdEstado= 2;	
				}			
				$nhorario->update();

				Core::alert("El Horario fue actualizado...");
				print "<script>window.location='index.php?view=horariomedico&id=$med';</script>";
			}
			else
			{
				// Es nuevo horario
				// graba dia 1				
				$nhorario = new SPHorario();
				$nhorario->conIdDia= 12;
				$nhorario->conIdEstado= 1;
				$nhorario->medico_medIdMedico = $_POST["medIdMedico"];
				$nhorario->detIdDia= $_POST["detIdDetalle1"];
				$nhorario->horDescripcion= $_POST["detDescDetalle1"];
				$nhorario->horHoraInicio= $_POST["horHoraInicio1"];
				$nhorario->horHoraFin= $_POST["horHoraFin1"];
				if(!empty($_POST['detIdEstado1'])) {
				$nhorario->detIdEstado= 1;
				} else {
				$nhorario->detIdEstado= 2;	
				}
				$nhorario->add();
				
				// graba dia 2
				$nhorario = new SPHorario();
				$nhorario->conIdDia= 12;
				$nhorario->conIdEstado= 1;
				$nhorario->medico_medIdMedico = $_POST["medIdMedico"];	
				$nhorario->detIdDia= $_POST["detIdDetalle2"];
				$nhorario->horDescripcion= $_POST["detDescDetalle2"];
				$nhorario->horHoraInicio= $_POST["horHoraInicio2"];
				$nhorario->horHoraFin= $_POST["horHoraFin2"];
				if(!empty($_POST['detIdEstado2'])) {
				$nhorario->detIdEstado= 1;
				} else {
				$nhorario->detIdEstado= 2;	
				}			
				$nhorario->add();

				// graba dia 3
				$nhorario = new SPHorario();
				$nhorario->conIdDia= 12;
				$nhorario->conIdEstado= 1;
				$nhorario->medico_medIdMedico = $_POST["medIdMedico"];				
				$nhorario->detIdDia= $_POST["detIdDetalle3"];
				$nhorario->horDescripcion= $_POST["detDescDetalle3"];
				$nhorario->horHoraInicio= $_POST["horHoraInicio3"];
				$nhorario->horHoraFin= $_POST["horHoraFin3"];
				if(!empty($_POST['detIdEstado3'])) {
				$nhorario->detIdEstado= 1;
				} else {
				$nhorario->detIdEstado= 2;	
				}			
				$nhorario->add();

				// graba dia 4
				$nhorario = new SPHorario();
				$nhorario->conIdDia= 12;
				$nhorario->conIdEstado= 1;
				$nhorario->medico_medIdMedico = $_POST["medIdMedico"];			
				$nhorario->detIdDia= $_POST["detIdDetalle4"];
				$nhorario->horDescripcion= $_POST["detDescDetalle4"];
				$nhorario->horHoraInicio= $_POST["horHoraInicio4"];
				$nhorario->horHoraFin= $_POST["horHoraFin4"];
				if(!empty($_POST['detIdEstado4'])) {
				$nhorario->detIdEstado= 1;
				} else {
				$nhorario->detIdEstado= 2;	
				}		
				$nhorario->add();
				
				// graba dia 5
				$nhorario = new SPHorario();
				$nhorario->conIdDia= 12;
				$nhorario->conIdEstado= 1;
				$nhorario->medico_medIdMedico = $_POST["medIdMedico"];				
				$nhorario->detIdDia= $_POST["detIdDetalle5"];
				$nhorario->horDescripcion= $_POST["detDescDetalle5"];
				$nhorario->horHoraInicio= $_POST["horHoraInicio5"];
				$nhorario->horHoraFin= $_POST["horHoraFin5"];
				if(!empty($_POST['detIdEstado5'])) {
				$nhorario->detIdEstado= 1;
				} else {
				$nhorario->detIdEstado= 2;	
				}			
				$nhorario->add();

				// graba dia 6
				$nhorario = new SPHorario();
				$nhorario->conIdDia= 12;
				$nhorario->conIdEstado= 1;
				$nhorario->medico_medIdMedico = $_POST["medIdMedico"];			
				$nhorario->detIdDia= $_POST["detIdDetalle6"];
				$nhorario->horDescripcion= $_POST["detDescDetalle6"];
				$nhorario->horHoraInicio= $_POST["horHoraInicio6"];
				$nhorario->horHoraFin= $_POST["horHoraFin6"];
				if(!empty($_POST['detIdEstado6'])) {
				$nhorario->detIdEstado= 1;
				} else {
				$nhorario->detIdEstado= 2;	
				}			
				$nhorario->add();				
				
				// graba dia 7
				$nhorario = new SPHorario();
				$nhorario->conIdDia= 12;
				$nhorario->conIdEstado= 1;
				$nhorario->medico_medIdMedico = $_POST["medIdMedico"];			
				$nhorario->detIdDia= $_POST["detIdDetalle7"];
				$nhorario->horDescripcion= $_POST["detDescDetalle7"];
				$nhorario->horHoraInicio= $_POST["horHoraInicio7"];
				$nhorario->horHoraFin= $_POST["horHoraFin7"];
				if(!empty($_POST['detIdEstado7'])) {
				$nhorario->detIdEstado= 1;
				} else {
				$nhorario->detIdEstado= 2;	
				}			
				$nhorario->add();	
				
				// Log
				/*
				$milog=new SPLog();
				$milog->codigo=Session::getUID();
				$milog->operacion="Crea horario:".$_POST["medIdMedico"];
				$milog->add();
				*/
				Core::alert("Se ha añadido el Horario exitosamente.");
				print "<script>window.location='index.php?view=horariomedico&id=$med';</script>";
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
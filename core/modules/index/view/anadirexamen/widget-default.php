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
			$controldetalle = SPDetHistoria::getByHist($_GET["id"],19);
			$historia = SPHistoria::getById($_GET["id"]);
			$med = $historia->medIdMedico;
			$pac = $historia->paciente_pacIdPaciente;
			$fec = $historia->hisFecha;
			$fact = $_POST["fecha"];
			$indice = 19;
			if (count($controldetalle)>0)
			{
				// Ya existe datos, actualiza
				// graba indice 1				
				$ndetalle = new SPDetHistoria();
				$ndetalle->detAntecedente = $_POST["detAntecedente1"];
				$ndetalle->update();

				// graba indice 2				
				$ndetalle = new SPDetHistoria();
				$ndetalle->detAntecedente = $_POST["detAntecedente2"];
				$ndetalle->update();
				
				// graba indice 3			
				$ndetalle = new SPDetHistoria();
				$ndetalle->detAntecedente = $_POST["detAntecedente3"];
				$ndetalle->update();

				// graba indice 4				
				$ndetalle = new SPDetHistoria();
				$ndetalle->detAntecedente = $_POST["detAntecedente4"];
				$ndetalle->update();

				// graba indice 5				
				$ndetalle = new SPDetHistoria();
				$ndetalle->detAntecedente = $_POST["detAntecedente5"];
				$ndetalle->update();

				// graba indice 6			
				$ndetalle = new SPDetHistoria();
				$ndetalle->detAntecedente = $_POST["detAntecedente6"];
				$ndetalle->update();

				// graba indice 7			
				$ndetalle = new SPDetHistoria();
				$ndetalle->detAntecedente = $_POST["detAntecedente7"];
				$ndetalle->update();

				// graba indice 8				
				$ndetalle = new SPDetHistoria();
				$ndetalle->detAntecedente = $_POST["detAntecedente8"];
				$ndetalle->update();

				// graba indice 9				
				$ndetalle = new SPDetHistoria();
				$ndetalle->detAntecedente = $_POST["detAntecedente9"];
				$ndetalle->update();				
				
				// graba indice 10				
				$ndetalle = new SPDetHistoria();
				$ndetalle->detAntecedente = $_POST["detAntecedente10"];
				$ndetalle->update();

				// graba indice 11				
				$ndetalle = new SPDetHistoria();
				$ndetalle->detAntecedente = $_POST["detAntecedente11"];
				$ndetalle->update();

				// graba indice 12				
				$ndetalle = new SPDetHistoria();
				$ndetalle->detAntecedente = $_POST["detAntecedente12"];
				$ndetalle->update();

				// graba indice 13				
				$ndetalle = new SPDetHistoria();
				$ndetalle->detAntecedente = $_POST["detAntecedente13"];
				$ndetalle->update();

				// graba indice 14				
				$ndetalle = new SPDetHistoria();
				$ndetalle->detAntecedente = $_POST["detAntecedente14"];
				$ndetalle->update();
				
				// graba indice 15			
				$ndetalle = new SPDetHistoria();
				$ndetalle->detAntecedente = $_POST["detAntecedente15"];
				$ndetalle->update();				

				// graba indice 16			
				$ndetalle = new SPDetHistoria();
				$ndetalle->detAntecedente = $_POST["detAntecedente16"];
				$ndetalle->update();	

				// graba indice 17			
				$ndetalle = new SPDetHistoria();
				$ndetalle->detAntecedente = $_POST["detAntecedente17"];
				$ndetalle->update();	

				// graba indice 18			
				$ndetalle = new SPDetHistoria();
				$ndetalle->detAntecedente = $_POST["detAntecedente18"];
				$ndetalle->update();	

				// graba indice 19			
				$ndetalle = new SPDetHistoria();
				$ndetalle->detAntecedente = $_POST["detAntecedente19"];
				$ndetalle->update();	

				// graba indice 20			
				$ndetalle = new SPDetHistoria();
				$ndetalle->detAntecedente = $_POST["detAntecedente20"];
				$ndetalle->update();	

				// graba indice 21			
				$ndetalle = new SPDetHistoria();
				$ndetalle->detAntecedente = $_POST["detAntecedente21"];
				$ndetalle->update();	

				// graba indice 22			
				$ndetalle = new SPDetHistoria();
				$ndetalle->detAntecedente = $_POST["detAntecedente22"];
				$ndetalle->update();	

				// graba indice 23			
				$ndetalle = new SPDetHistoria();
				$ndetalle->detAntecedente = $_POST["detAntecedente23"];
				$ndetalle->update();

				// graba indice 24			
				$ndetalle = new SPDetHistoria();
				$ndetalle->detAntecedente = $_POST["detAntecedente24"];
				$ndetalle->update();
				
				Core::alert("El detalle fue actualizado.");
				//print "<script>window.location='index.php?view=atencioncita';</script>";
				print "<script>window.location='index.php?view=atencioncita&id=$med&id2=$pac&id3=$fec;';</script>";
			}
			else
			{
				// Es nuevo, inserta
				// graba indice 1				
				$ndetalle = new SPDetHistoria();
				$ndetalle->conIdAntecedentes= $indice;
				$ndetalle->detIdAntecedentes= $_POST["detIdDetalle1"];
				$ndetalle->detAntecedente = $_POST["detAntecedente1"];
				$ndetalle->historia_hisIdHistoria = $_POST["historia"];
				$ndetalle->historia_medIdMedico = $_POST["medico"];
				$ndetalle->historia_hisFecha = $fact;
				$ndetalle->add();
				
				// graba indice 2
				$ndetalle = new SPDetHistoria();
				$ndetalle->conIdAntecedentes= $indice;
				$ndetalle->detIdAntecedentes= $_POST["detIdDetalle2"];
				$ndetalle->detAntecedente = $_POST["detAntecedente2"];
				$ndetalle->historia_hisIdHistoria = $_POST["historia"];
				$ndetalle->historia_medIdMedico = $_POST["medico"];
				$ndetalle->historia_hisFecha = $fact;
				$ndetalle->add();

				// graba indice 3
				$ndetalle = new SPDetHistoria();
				$ndetalle->conIdAntecedentes= $indice;
				$ndetalle->detIdAntecedentes= $_POST["detIdDetalle3"];
				$ndetalle->detAntecedente = $_POST["detAntecedente3"];
				$ndetalle->historia_hisIdHistoria = $_POST["historia"];
				$ndetalle->historia_medIdMedico = $_POST["medico"];
				$ndetalle->historia_hisFecha = $fact;
				$ndetalle->add();

				// graba indice 4
				$ndetalle = new SPDetHistoria();
				$ndetalle->conIdAntecedentes= $indice;
				$ndetalle->detIdAntecedentes= $_POST["detIdDetalle4"];
				$ndetalle->detAntecedente = $_POST["detAntecedente4"];
				$ndetalle->historia_hisIdHistoria = $_POST["historia"];
				$ndetalle->historia_medIdMedico = $_POST["medico"];
				$ndetalle->historia_hisFecha = $fact;
				$ndetalle->add();
				
				// graba indice 5
				$ndetalle = new SPDetHistoria();
				$ndetalle->conIdAntecedentes= $indice;
				$ndetalle->detIdAntecedentes= $_POST["detIdDetalle5"];
				$ndetalle->detAntecedente = $_POST["detAntecedente5"];
				$ndetalle->historia_hisIdHistoria = $_POST["historia"];
				$ndetalle->historia_medIdMedico = $_POST["medico"];
				$ndetalle->historia_hisFecha = $fact;
				$ndetalle->add();

				// graba indice 6
				$ndetalle = new SPDetHistoria();
				$ndetalle->conIdAntecedentes= $indice;
				$ndetalle->detIdAntecedentes= $_POST["detIdDetalle6"];
				$ndetalle->detAntecedente = $_POST["detAntecedente6"];
				$ndetalle->historia_hisIdHistoria = $_POST["historia"];
				$ndetalle->historia_medIdMedico = $_POST["medico"];
				$ndetalle->historia_hisFecha = $fact;
				$ndetalle->add();				
				
				// graba indice 7
				$ndetalle = new SPDetHistoria();
				$ndetalle->conIdAntecedentes= $indice;
				$ndetalle->detIdAntecedentes= $_POST["detIdDetalle7"];
				$ndetalle->detAntecedente = $_POST["detAntecedente7"];
				$ndetalle->historia_hisIdHistoria = $_POST["historia"];
				$ndetalle->historia_medIdMedico = $_POST["medico"];
				$ndetalle->historia_hisFecha = $fact;
				$ndetalle->add();	

				// graba indice 8
				$ndetalle = new SPDetHistoria();
				$ndetalle->conIdAntecedentes= $indice;
				$ndetalle->detIdAntecedentes= $_POST["detIdDetalle8"];
				$ndetalle->detAntecedente = $_POST["detAntecedente8"];
				$ndetalle->historia_hisIdHistoria = $_POST["historia"];
				$ndetalle->historia_medIdMedico = $_POST["medico"];
				$ndetalle->historia_hisFecha = $fact;
				$ndetalle->add();	

				// graba indice 9
				$ndetalle = new SPDetHistoria();
				$ndetalle->conIdAntecedentes= $indice;
				$ndetalle->detIdAntecedentes= $_POST["detIdDetalle9"];
				$ndetalle->detAntecedente = $_POST["detAntecedente9"];
				$ndetalle->historia_hisIdHistoria = $_POST["historia"];
				$ndetalle->historia_medIdMedico = $_POST["medico"];
				$ndetalle->historia_hisFecha = $fact;
				$ndetalle->add();	

				// graba indice 10
				$ndetalle = new SPDetHistoria();
				$ndetalle->conIdAntecedentes= $indice;
				$ndetalle->detIdAntecedentes= $_POST["detIdDetalle10"];
				$ndetalle->detAntecedente = $_POST["detAntecedente10"];
				$ndetalle->historia_hisIdHistoria = $_POST["historia"];
				$ndetalle->historia_medIdMedico = $_POST["medico"];
				$ndetalle->historia_hisFecha = $fact;
				$ndetalle->add();	

				// graba indice 11
				$ndetalle = new SPDetHistoria();
				$ndetalle->conIdAntecedentes= $indice;
				$ndetalle->detIdAntecedentes= $_POST["detIdDetalle11"];
				$ndetalle->detAntecedente = $_POST["detAntecedente11"];
				$ndetalle->historia_hisIdHistoria = $_POST["historia"];
				$ndetalle->historia_medIdMedico = $_POST["medico"];
				$ndetalle->historia_hisFecha = $fact;
				$ndetalle->add();	

				// graba indice 12
				$ndetalle = new SPDetHistoria();
				$ndetalle->conIdAntecedentes= $indice;
				$ndetalle->detIdAntecedentes= $_POST["detIdDetalle12"];
				$ndetalle->detAntecedente = $_POST["detAntecedente12"];
				$ndetalle->historia_hisIdHistoria = $_POST["historia"];
				$ndetalle->historia_medIdMedico = $_POST["medico"];
				$ndetalle->historia_hisFecha = $fact;
				$ndetalle->add();	

				// graba indice 13
				$ndetalle = new SPDetHistoria();
				$ndetalle->conIdAntecedentes= $indice;
				$ndetalle->detIdAntecedentes= $_POST["detIdDetalle13"];
				$ndetalle->detAntecedente = $_POST["detAntecedente13"];
				$ndetalle->historia_hisIdHistoria = $_POST["historia"];
				$ndetalle->historia_medIdMedico = $_POST["medico"];
				$ndetalle->historia_hisFecha = $fact;
				$ndetalle->add();	

				// graba indice 14
				$ndetalle = new SPDetHistoria();
				$ndetalle->conIdAntecedentes= $indice;
				$ndetalle->detIdAntecedentes= $_POST["detIdDetalle14"];
				$ndetalle->detAntecedente = $_POST["detAntecedente14"];
				$ndetalle->historia_hisIdHistoria = $_POST["historia"];
				$ndetalle->historia_medIdMedico = $_POST["medico"];
				$ndetalle->historia_hisFecha = $fact;
				$ndetalle->add();	

				// graba indice 15
				$ndetalle = new SPDetHistoria();
				$ndetalle->conIdAntecedentes= $indice;
				$ndetalle->detIdAntecedentes= $_POST["detIdDetalle15"];
				$ndetalle->detAntecedente = $_POST["detAntecedente15"];
				$ndetalle->historia_hisIdHistoria = $_POST["historia"];
				$ndetalle->historia_medIdMedico = $_POST["medico"];
				$ndetalle->historia_hisFecha = $fact;
				$ndetalle->add();	

				// graba indice 16
				$ndetalle = new SPDetHistoria();
				$ndetalle->conIdAntecedentes= $indice;
				$ndetalle->detIdAntecedentes= $_POST["detIdDetalle16"];
				$ndetalle->detAntecedente = $_POST["detAntecedente16"];
				$ndetalle->historia_hisIdHistoria = $_POST["historia"];
				$ndetalle->historia_medIdMedico = $_POST["medico"];
				$ndetalle->historia_hisFecha = $fact;
				$ndetalle->add();	
				
				// graba indice 17
				$ndetalle = new SPDetHistoria();
				$ndetalle->conIdAntecedentes= $indice;
				$ndetalle->detIdAntecedentes= $_POST["detIdDetalle17"];
				$ndetalle->detAntecedente = $_POST["detAntecedente17"];
				$ndetalle->historia_hisIdHistoria = $_POST["historia"];
				$ndetalle->historia_medIdMedico = $_POST["medico"];
				$ndetalle->historia_hisFecha = $fact;
				$ndetalle->add();	

				// graba indice 18
				$ndetalle = new SPDetHistoria();
				$ndetalle->conIdAntecedentes= $indice;
				$ndetalle->detIdAntecedentes= $_POST["detIdDetalle18"];
				$ndetalle->detAntecedente = $_POST["detAntecedente18"];
				$ndetalle->historia_hisIdHistoria = $_POST["historia"];
				$ndetalle->historia_medIdMedico = $_POST["medico"];
				$ndetalle->historia_hisFecha = $fact;
				$ndetalle->add();	

				// graba indice 19
				$ndetalle = new SPDetHistoria();
				$ndetalle->conIdAntecedentes= $indice;
				$ndetalle->detIdAntecedentes= $_POST["detIdDetalle19"];
				$ndetalle->detAntecedente = $_POST["detAntecedente19"];
				$ndetalle->historia_hisIdHistoria = $_POST["historia"];
				$ndetalle->historia_medIdMedico = $_POST["medico"];
				$ndetalle->historia_hisFecha = $fact;
				$ndetalle->add();	

				// graba indice 20
				$ndetalle = new SPDetHistoria();
				$ndetalle->conIdAntecedentes= $indice;
				$ndetalle->detIdAntecedentes= $_POST["detIdDetalle20"];
				$ndetalle->detAntecedente = $_POST["detAntecedente20"];
				$ndetalle->historia_hisIdHistoria = $_POST["historia"];
				$ndetalle->historia_medIdMedico = $_POST["medico"];
				$ndetalle->historia_hisFecha = $fact;
				$ndetalle->add();	

				// graba indice 21
				$ndetalle = new SPDetHistoria();
				$ndetalle->conIdAntecedentes= $indice;
				$ndetalle->detIdAntecedentes= $_POST["detIdDetalle21"];
				$ndetalle->detAntecedente = $_POST["detAntecedente21"];
				$ndetalle->historia_hisIdHistoria = $_POST["historia"];
				$ndetalle->historia_medIdMedico = $_POST["medico"];
				$ndetalle->historia_hisFecha = $fact;
				$ndetalle->add();	

				// graba indice 22
				$ndetalle = new SPDetHistoria();
				$ndetalle->conIdAntecedentes= $indice;
				$ndetalle->detIdAntecedentes= $_POST["detIdDetalle22"];
				$ndetalle->detAntecedente = $_POST["detAntecedente22"];
				$ndetalle->historia_hisIdHistoria = $_POST["historia"];
				$ndetalle->historia_medIdMedico = $_POST["medico"];
				$ndetalle->historia_hisFecha = $fact;
				$ndetalle->add();	

				// graba indice 23
				$ndetalle = new SPDetHistoria();
				$ndetalle->conIdAntecedentes= $indice;
				$ndetalle->detIdAntecedentes= $_POST["detIdDetalle23"];
				$ndetalle->detAntecedente = $_POST["detAntecedente23"];
				$ndetalle->historia_hisIdHistoria = $_POST["historia"];
				$ndetalle->historia_medIdMedico = $_POST["medico"];
				$ndetalle->historia_hisFecha = $fact;
				$ndetalle->add();	

				// graba indice 24
				$ndetalle = new SPDetHistoria();
				$ndetalle->conIdAntecedentes= $indice;
				$ndetalle->detIdAntecedentes= $_POST["detIdDetalle24"];
				$ndetalle->detAntecedente = $_POST["detAntecedente24"];
				$ndetalle->historia_hisIdHistoria = $_POST["historia"];
				$ndetalle->historia_medIdMedico = $_POST["medico"];
				$ndetalle->historia_hisFecha = $fact;
				$ndetalle->add();	

				// Log
				/*
				$milog=new SPLog();
				$milog->codigo=Session::getUID();
				$milog->operacion="Crea detalle historia:".$med;
				$milog->add();
				*/
				Core::alert("Se ha añadido el detalle exitosamente.");
				print "<script>window.location='index.php?view=atencioncita&id=$med&id2=$pac&id3=$fec;';</script>";
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
<?php
include "../core/controller/Database.php";
include "../core/controller/Executor.php";
include "../core/controller/Model.php";
include "../core/modules/index/model/SPBasica.php";
include "../core/modules/index/model/SPHistoria.php";
include "../core/modules/index/model/SPExamenes.php";
include "../core/modules/index/model/SPDiagnostico.php";
include "../core/modules/index/model/SPDetConceptos.php";
include "../core/modules/index/model/SPMedico.php";
require('fpdf.php');

class PDF extends FPDF
{
	// Cabecera de p�gina
	function Header()
	{
		// Logo
		$this->Image('logo-gesmed.jpg',5,5,20);
		// Arial bold 12
		$this->SetFont('Arial','B',14);
		// Movernos a la derecha
		$this->Cell(60);
		// T�tulo
		$this->Cell(70,0,'Sistema de Gesti�n de Citas M�dicas GESMED-ECU',0,1,'C');
		$this->Ln(10);
		$this->Cell(60);
		$this->Cell(70,0,'PEDIDO DE EXAMEN',0,1,'C');
		$this->Ln(12);
		$this->SetFont('Times','',10);
		/*
		$this->Cell(50);
		$this->Cell(20,7,'FECHA:',0,0,'C');
		$this->Cell(50,7,'dd-mm-aaaa hh-mm-ss',0,1,'C');
		*/
		//$this->SetLineWidth(1);
		$this->SetDrawColor(0,0,255);
		$this->Line(0,30,297,30);
		//$this->Ln(2);
		//$this->Cell(50,8,'Tipo de Acceso',1,0,'C');
		//$this->Cell(20,8,'Registros',1,0,'C');
		// Salto de l�nea
		$this->Ln(9);
	}

	// Pie de p�gina
	function Footer()
	{
		// Posici�n: a 1,5 cm del final
		$this->SetY(-15);
		// Arial bold 8
		$this->SetFont('Arial','B',8);
		// N�mero de p�gina
		$this->Cell(0,10,'P�gina '.$this->PageNo().'/{nb}',0,0,'C');
	}
}

// Creaci�n del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage('P');
$pdf->SetFont('Times','',8);
$his=$_GET["id"];
//$his=10;
$user= array();
$diag= array();
$exa= array();
$historia= array();
$medico= array();
	$historia = SPHistoria::getById($his);
	$user = SPBasica::getByIdSec($historia->paciente_pacIdPaciente); 
	$diagn = SPDiagnostico::getById($his);
	$exam = SPExamenes::getByHis($his);
	$medico = SPMedico::getByIdSec($historia->medIdMedico);
	
	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(70,8,"INFORMACION DEL PACIENTE",0,1,'L');

	$pdf->Cell(40,8,iconv('UTF-8', 'windows-1252',"Apellidos"),1,0,'L');			
	$pdf->Cell(40,8,iconv('UTF-8', 'windows-1252',"Nombres"),1,0,'L');
	$pdf->Cell(30,8,iconv('UTF-8', 'windows-1252',"Identidficacion"),1,0,'L');	
	$pdf->Cell(20,8,iconv('UTF-8', 'windows-1252',"Genero"),1,0,'C');			
	$pdf->Cell(10,8,iconv('UTF-8', 'windows-1252',"Edad"),1,1,'R');
	
	$pdf->SetFont('Times','',8);
	$pdf->Cell(40,8,iconv('UTF-8', 'windows-1252',$user->pacApellidos),1,0,'L');			
	$pdf->Cell(40,8,iconv('UTF-8', 'windows-1252',$user->pacNombres),1,0,'L');
	$pdf->Cell(30,8,iconv('UTF-8', 'windows-1252',$user->pacIdentificacion),1,0,'L');	
	$gen = SPDetConceptos::getById(7,$user->detIdGenero);
	$pdf->Cell(20,8,iconv('UTF-8', 'windows-1252',$gen->detDescDetalle),1,0,'C');			
	$pdf->Cell(10,8,iconv('UTF-8', 'windows-1252',$user->edad),1,1,'R');		
	
	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(70,8,"DIAGNOSTICO DEL PACIENTE",0,1,'L');

	$pdf->Cell(80,8,iconv('UTF-8', 'windows-1252',"Diagnostico"),1,0,'L');	
	$pdf->Cell(80,8,iconv('UTF-8', 'windows-1252',"CIE-10"),1,0,'L');
	$pdf->Cell(30,8,iconv('UTF-8', 'windows-1252',"Tipo"),1,1,'L');
	
	if(count($diagn)>0)
	{
		$pdf->SetFont('Times','',8);
		foreach($diagn as $diag)
		{
			$pdf->Cell(80,8,iconv('UTF-8', 'windows-1252',$diag->diaDiagnostico),1,0,'L');	
			$cie = SPDetConceptos::getById(27,$diag->detIdCie10);
			$pdf->Cell(80,8,iconv('UTF-8', 'windows-1252',$cie->detNexo." ".$cie->detDescDetalle),1,0,'L');
			$tip = SPDetConceptos::getById(28,$diag->detIdTipo);
			$pdf->Cell(30,8,iconv('UTF-8', 'windows-1252',$tip->detDescDetalle),1,1,'L');	
		}
	}	
	
	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(70,8,"PEDIDO DE EXAMEN",0,1,'L');
	$pdf->Cell(30,8,iconv('UTF-8', 'windows-1252',"Fecha Examen:"),1,0,'L');
	$pdf->Cell(40,8,iconv('UTF-8', 'windows-1252',"Tipo de Servicio"),1,0,'L');	
	$pdf->Cell(50,8,iconv('UTF-8', 'windows-1252',"Nombre de Servicio"),1,0,'L');	
	$pdf->Cell(70,8,iconv('UTF-8', 'windows-1252',"Indicaciones:"),1,1,'L');	
	
	if(count($exam)>0)
	{
		$pdf->SetFont('Times','',8);
		foreach($exam as $exa)
		{
			if ($exa->conIdTipoExamen == 30) {
				$te = 1;
			} else {
				if ($exa->conIdTipoExamen == 31) {
					$te = 2;
				} else {
					$te = 3;
				}
			}			
			$pdf->Cell(30,8,iconv('UTF-8', 'windows-1252',$exa->exaFechaExamen),1,0,'L');
			$ser = SPDetConceptos::getById(29,$te);
			$pdf->Cell(40,8,iconv('UTF-8', 'windows-1252',$ser->detDescDetalle),1,0,'L');	
			$texa = SPDetConceptos::getById($exa->conIdTipoExamen,$exa->detIdTipoExamen);
			$pdf->Cell(50,8,iconv('UTF-8', 'windows-1252',$texa->detDescDetalle),1,0,'L');				
			$pdf->Cell(70,8,iconv('UTF-8', 'windows-1252',$exa->exaIndicaciones),1,1,'L');	
		}
	}	

	$pdf->SetFont('Arial','',10);
	$pdf->Cell(180,8," ",0,1,'L');
	$pdf->Cell(180,8," ",0,1,'L');
	$pdf->Cell(180,8," ",0,1,'L');
	$pdf->Cell(180,8,"Dr(a). ".$medico->medApellidos." ".$medico->medNombres,0,1,'L');	
	
	$pdf->SetFont('Arial','B',12);
	//$pdf->Multicell(0,8,'Total Registros: '.$vtotal);
	$extras= SPBasica::getBySQL("select now() as ahora from dual;");
	$fimpresion=$extras->ahora;
	$pdf->SetTextColor(0,0,255);
	$pdf->SetFont('Arial','',8);
	$pdf->Multicell(0,4,'Fecha de impresi�n: '.$fimpresion);
	$pdf->SetTextColor(0,0,0);
	$pdf->Output("ReportePedidos.pdf","I");
?>
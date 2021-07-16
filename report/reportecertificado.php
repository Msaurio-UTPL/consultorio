<?php
include "../core/controller/Database.php";
include "../core/controller/Executor.php";
include "../core/controller/Model.php";
//include "../core/modules/index/model/UserData.php";
include "../core/modules/index/model/SPBasica.php";
include "../core/modules/index/model/SPHistoria.php";
include "../core/modules/index/model/SPDiagnostico.php";
include "../core/modules/index/model/SPDetConceptos.php";
include "../core/modules/index/model/SPMedico.php";
require('fpdf.php');

class PDF extends FPDF
{
	// Cabecera de página
	function Header()
	{
		// Logo
		$this->Image('logo-gesmed.jpg',5,5,20);
		// Arial bold 12
		$this->SetFont('Arial','B',14);
		// Movernos a la derecha
		$this->Cell(60);
		// Título
		$this->Cell(70,0,'Sistema de Gestión de Citas Médicas GESMED-ECU',0,1,'C');
		$this->Ln(10);
		$this->Cell(60);
		$this->Cell(70,0,'CERTIFICADO MEDICO',0,1,'C');
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
		// Salto de línea
		$this->Ln(9);
	}

	// Pie de página
	function Footer()
	{
		// Posición: a 1,5 cm del final
		$this->SetY(-15);
		// Arial bold 8
		$this->SetFont('Arial','B',8);
		// Número de página
		$this->Cell(0,10,'Página '.$this->PageNo().'/{nb}',0,0,'C');
	}
}

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage('P');
$pdf->SetFont('Times','',8);
$his=$_GET["id"];
$medi= array();
$user= array();
$diag= array();
$histo= array();
	$diagn = SPDiagnostico::getById($his);
	$histo = SPHistoria::getById($his);
	$user = SPBasica::getByIdSec($histo->paciente_pacIdPaciente); 
	$medi = SPMedico::getByIdSec($histo->medIdMedico);
	
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(180,8,"Quito, ".$user->hoy,0,1,'R');
	$pdf->Cell(180,8," ",0,1,'L');
	$pdf->Cell(180,8," ",0,1,'L');
	$pdf->Cell(180,8," ",0,1,'L');
	$pdf->Cell(180,8,"Certifico que el Señor: ".iconv('UTF-8', 'windows-1252',$user->pacApellidos." ".$user->pacNombres)." con cédula de identidad Número: ".$user->pacIdentificacion,0,1,'L');
	$pdf->Cell(180,8,"acude a consulta de UROLOGIA, el dia de hoy ".$user->hoy." por presentar el siguiente antecedente y diagnóstico: ",0,1,'L');	
	
	if(count($diagn)>0)
	{
		foreach($diagn as $diag)
		{
			$pdf->Cell(80,8,iconv('UTF-8', 'windows-1252',$diag->diaDiagnostico),0,0,'L');	
			$cie = SPDetConceptos::getById(27,$diag->detIdCie10);
			$pdf->Cell(80,8,iconv('UTF-8', 'windows-1252',$cie->detNexo." ".$cie->detDescDetalle),0,1,'L');
		}
	}	

	$hasta = SPBasica::getBySQL("select DATE_ADD(date_format(now(), '%Y-%m-%d'),INTERVAL 5 DAY) as hasta from dual;");
	$pdf->Cell(180,8,"El paciente amerita reposo absoluto por 5 (cinco) dias, desde ".$user->hoy." hasta: ".$hasta->hasta,0,1,'L');	
	$pdf->Cell(180,8," ",0,1,'L');
	$pdf->Cell(180,8," ",0,1,'L');
	$pdf->Cell(180,8," ",0,1,'L');
	$pdf->Cell(180,8,"Dr(a). ".$medi->medApellidos." ".$medi->medNombres,0,1,'L');	

	$pdf->SetFont('Arial','B',12);
	//$pdf->Multicell(0,8,'Total Registros: '.$vtotal);
	$extras= SPBasica::getBySQL("select now() as ahora from dual;");
	$fimpresion=$extras->ahora;
	$pdf->SetTextColor(0,0,255);
	$pdf->SetFont('Arial','',8);
	$pdf->Multicell(0,4,'Fecha de impresión: '.$fimpresion);
	$pdf->SetTextColor(0,0,0);
	$pdf->Output("ReporteCertificado.pdf","I");
?>
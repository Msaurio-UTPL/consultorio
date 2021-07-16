<?php
include "../core/controller/Database.php";
include "../core/controller/Executor.php";
include "../core/controller/Model.php";
include "../core/modules/index/model/SPLog.php";
include "../core/modules/index/model/SPDetConceptos.php";
include "../core/modules/index/model/SPCentro.php";

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
		$this->Cell(70,0,'REPORTE DE CENTROS MEDICOS',0,1,'C');
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
		$this->Cell(10,8,'ID.',1,0,'C');
		$this->Cell(40,8,'CENTRO',1,0,'C');
		$this->Cell(20,8,'IDEN.',1,0,'C');
		$this->Cell(30,8,'TIPO PER.',1,0,'C');
		$this->Cell(20,8,'I.SUSCRIP.',1,0,'C');
		$this->Cell(20,8,'F.SUSCRIP.',1,0,'C');
		$this->Cell(100,8,'DIRECCION',1,0,'C');
		$this->Cell(40,8,'CONTACTOS',1,0,'C');
		
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
	$pdf->AddPage('L');
	$pdf->SetFont('Times','',8);
	$users= array();
	$users = SPCentro::getAll();
	if(count($users)>0)
	{
		foreach($users as $user)
		{
			$pdf->Cell(10,8,$user->cenIdCentro,1,0,'C');
			$pdf->Cell(40,8,$user->cenDescripcion,1,0,'L');
			$pdf->Cell(20,8,$user->cenIdentificacion,1,0,'L');
			$tipoper = SPDetConceptos::getById($user->conIdTipo,$user->detIdTipo);
			$pdf->Cell(30,8,iconv('UTF-8', 'windows-1252',$tipoper->detDescDetalle),1,0,'L');
			$pdf->Cell(20,8,iconv('UTF-8', 'windows-1252',$user->cenSuscripcionInicio),1,0,'L');
			$pdf->Cell(20,8,iconv('UTF-8', 'windows-1252',$user->cenSuscripcionFin),1,0,'L');
			$pdf->Cell(100,8,iconv('UTF-8', 'windows-1252',$user->cenDireccion),1,0,'L');
			$pdf->Cell(40,8,iconv('UTF-8', 'windows-1252',$user->cenTelefonos),1,1,'L');
		}
	}
	$pdf->SetFont('Arial','B',12);
	$pdf->Multicell(0,8,'Total Médicos: '.count($users));
	$extras= SPLog::getBySQL("select now() as ahora from dual;");
	$fimpresion=$extras->ahora;
	$pdf->SetTextColor(0,0,255);
	$pdf->SetFont('Arial','',8);
	$pdf->Multicell(0,4,'Fecha de impresión: '.$fimpresion);
	$pdf->SetTextColor(0,0,0);
	$pdf->Output("ReporteCentros.pdf","I");
?>
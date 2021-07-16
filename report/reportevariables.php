<?php
include "../core/controller/Database.php";
include "../core/controller/Executor.php";
include "../core/controller/Model.php";
include "../core/modules/index/model/SPUser.php";
include "../core/modules/index/model/SPVariables.php";
require('fpdf.php');

class PDF extends FPDF
{
	// Cabecera de página
	function Header()
	{
		// Logo
		$this->Image('logoLB.jpg',5,5,20);
		// Arial bold 12
		$this->SetFont('Arial','B',14);
		// Movernos a la derecha
		$this->Cell(60);
		// Título
		$this->Cell(70,0,'Cooperativa de Ahorro y Crédito LA BENÉFICA',0,1,'C');
		$this->Ln(10);
		$this->Cell(60);
		$this->Cell(70,0,'Reporte de Variables',0,1,'C');
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
		$this->Cell(15,8,'CODIGO',1,0,'C');
		//$this->Cell(25,8,'CODIGO',1,0,'C');
		$this->Cell(80,8,'VARIABLE',1,0,'C');
		$this->Cell(20,8,'VALOR',1,0,'C');
		$this->Cell(30,8,'VERIFICABLE',1,0,'C');
		$this->Cell(50,8,'DOCUMENTO',1,0,'C');
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
$users= array();
$vordinal=1;
$users = SPVariables::getAll();
if(count($users)>0)
{
	foreach($users as $user)
	{
		$pdf->Cell(15,8,$vordinal,1,0,'C');
		//$pdf->Cell(25,8,$user->idliga,1,0,'C');			
		$pdf->Cell(80,8,iconv('UTF-8', 'windows-1252',$user->varDescVariable),1,0,'L');
		$pdf->Cell(20,8,'',1,0,'L');
		$pdf->Cell(30,8,'',1,0,'L');
		$pdf->Cell(50,8,'',1,1,'L');
		$vordinal++;
	}
}
$pdf->SetFont('Arial','B',12);
$pdf->Multicell(0,8,'Total Variables: '.count($users));
$extras= SPUser::getBySQL("select now() as ahora from dual;");
$fimpresion=$extras->ahora;
$pdf->SetTextColor(0,0,255);
$pdf->SetFont('Arial','',8);
$pdf->Multicell(0,4,'Fecha de impresión: '.$fimpresion);
$pdf->SetTextColor(0,0,0);
$pdf->Output("FormularioVariables.pdf","I");
?>
<?php
include "../core/controller/Database.php";
include "../core/controller/Executor.php";
include "../core/controller/Model.php";
include "../core/modules/index/model/UserData.php";
include "../core/modules/index/model/SPLiga.php";
include "../core/modules/index/model/SPClub.php";
require('fpdf.php');

class PDF extends FPDF
{
	// Cabecera de p�gina
	function Header()
	{
		// Logo
		$this->Image('logo-01.jpg',5,5,20);
		// Arial bold 12
		$this->SetFont('Arial','B',14);
		// Movernos a la derecha
		$this->Cell(60);
		// T�tulo
		$this->Cell(70,0,'Asociaci�n de Ligas Barriales de Pichincha',0,1,'C');
		$this->Ln(10);
		$this->Cell(60);
		$this->Cell(70,0,'REPORTE DE CLUBES',0,1,'C');
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
		$this->Cell(20,8,'ORDINAL',1,0,'C');
		//$this->Cell(20,8,'CODIGO',1,0,'C');
		$this->Cell(50,8,'LIGA',1,0,'C');
		$this->Cell(100,8,'CLUB',1,0,'C');
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
$users= array();
$ligas= array();
$vordinal=1;
$users = SPClub::getAll();
if(count($users)>0)
{
	foreach($users as $user)
	{
		$pdf->Cell(20,8,$vordinal,1,0,'C');
		//$pdf->Cell(20,8,$user->idclub,1,0,'C');			
		$ligas = SPLiga::getById($user->idliga);
		$pdf->Cell(50,8,iconv('UTF-8', 'windows-1252',$ligas->DesLiga),1,0,'L');
		$pdf->Cell(100,8,iconv('UTF-8', 'windows-1252',$user->DesClub),1,1,'L');
		$vordinal++;
	}
}
$pdf->SetFont('Arial','B',12);
$pdf->Multicell(0,8,'Total Clubes: '.count($users));
$extras= UserData::getBySQL("select now() as ahora from dual;");
$fimpresion=$extras->ahora;
$pdf->SetTextColor(0,0,255);
$pdf->SetFont('Arial','',8);
$pdf->Multicell(0,4,'Fecha de impresi�n: '.$fimpresion);
$pdf->SetTextColor(0,0,0);
$pdf->Output("ReporteClubes.pdf","I");
?>
<?php
include "../core/controller/Database.php";
include "../core/controller/Executor.php";
include "../core/controller/Model.php";
include "../core/modules/index/model/SPUser.php";
include "../core/modules/index/model/SPGrupo.php";
require('fpdf.php');

class PDF extends FPDF
{
	// Cabecera de página
	function Header()
	{
		// Logo
		$this->Image('LogoLB.jpg',5,5,30);
		// Arial bold 12
		$this->SetFont('Arial','B',14);
		// Movernos a la derecha
		$this->Cell(60);
		// Título
		$this->Cell(170,0,'Cooperativa de Ahorro y Crédito LA BENÉFICA',0,1,'C');
		$this->Ln(10);
		$this->Cell(60);
		$this->Cell(170,0,'REPORTE DE GRUPOS',0,1,'C');
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
		$this->Cell(10,8,'ID',1,0,'C');
		$this->Cell(150,8,'DESCRIPCIÓN',1,0,'C');
		$this->Cell(30,8,'PARTICIPACIÓN',1,0,'C');
		$this->Cell(50,8,'ÁMBITO',1,0,'C');
		$this->Cell(17,8,'FECHA',1,0,'C');
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
	$users = SPGrupo::getAll();
	if(count($users)>0)
	{
		foreach($users as $user)
		{
			$pdf->Cell(10,8,$user->gruIdGrupo,1,0,'C');
			//iconv('UTF-8', 'windows-1252',)
			$pdf->Cell(150,8,iconv('UTF-8', 'windows-1252',$user->gruDescGrupo),1,0,'L');			
			$pdf->Cell(30,8,$user->gruPorcParticipacion,1,0,'C');
			$pdf->Cell(50,8,$user->detIdAmbito,1,0,'C');
			$pdf->Cell(17,8,$user->fecha,1,1,'C');
		}
	}
	$pdf->SetFont('Arial','B',12);
	$pdf->Multicell(0,8,'Total Usuarios: '.count($users));
	$extras= SPUser::getBySQL("select now() as ahora from dual;");
	$fimpresion=$extras->ahora;
	$pdf->SetTextColor(0,0,255);
	$pdf->SetFont('Arial','',8);
	$pdf->Multicell(0,4,'Fecha de impresión: '.$fimpresion);
	$pdf->SetTextColor(0,0,0);
	$pdf->Output("ReporteUsuarios.pdf","I");
?>
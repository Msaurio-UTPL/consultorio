<?php
include "../core/controller/Database.php";
include "../core/controller/Executor.php";
include "../core/controller/Model.php";
include "../core/modules/index/model/UserData.php";
include "../core/modules/index/model/SPIdentificacion.php";
include "../core/modules/index/model/SPGenero.php";
include "../core/modules/index/model/SPEtnia.php";
include "../core/modules/index/model/SPLiga.php";
include "../core/modules/index/model/SPClub.php";
include "../core/modules/index/model/SPJugador.php";
require('fpdf.php');

class PDF extends FPDF
{
	// Cabecera de página
	function Header()
	{
		// Logo
		$this->Image('logo-01.jpg',5,5,20);
		// Arial bold 12
		$this->SetFont('Arial','B',14);
		// Movernos a la derecha
		$this->Cell(60);
		// Título
		$this->Cell(70,0,'Asociación de Ligas Barriales de Pichincha',0,1,'C');
		$this->Ln(10);
		$this->Cell(60);
		$this->Cell(70,0,'REPORTE DE JUGADORES',0,1,'C');
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
		$this->Cell(15,8,'TIPO',1,0,'C');
		$this->Cell(24,8,'IDENTIFICACION',1,0,'C');
		$this->Cell(40,8,'NOMBRES',1,0,'C');
		$this->Cell(40,8,'APELLIDOS',1,0,'C');
		$this->Cell(15,8,'NACIMIENTO',1,0,'C');
		$this->Cell(20,8,'LUGAR',1,0,'C');
		$this->Cell(20,8,'GENERO',1,0,'C');
		$this->Cell(20,8,'ETNIA',1,0,'C');
		$this->Cell(50,8,'LIGA',1,0,'C');
		$this->Cell(50,8,'CLUB',1,0,'C');
		$this->Cell(50,8,'OBSERVACION',1,0,'C');
		$this->Cell(15,8,'FICHAJE',1,0,'C');
		$this->Cell(15,8,'ESTADO',1,0,'C');
		
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
	$users = SPJugador::getAll();
	if(count($users)>0)
	{
		foreach($users as $user)
		{
			$pdf->Cell(15,8,$user->codigoJugador,1,0,'R');
			$identificacion = SPIdentificacion::getById($user->idTipo);
			$pdf->Cell(15,8,iconv('UTF-8', 'windows-1252',$identificacion->DesTipo),1,0,'C');
			$pdf->Cell(24,8,$user->identificacion,1,0,'R');
			$pdf->Cell(40,8,iconv('UTF-8', 'windows-1252',$user->nombres),1,0,'L');
			$pdf->Cell(40,8,iconv('UTF-8', 'windows-1252',$user->apellidos),1,0,'L');
			$pdf->Cell(15,8,$user->nacimiento,1,0,'L');
			$pdf->Cell(20,8,iconv('UTF-8', 'windows-1252',$user->lugar),1,0,'C');
			$genero = SPGenero::getById($user->idgenero);
			$pdf->Cell(20,8,iconv('UTF-8', 'windows-1252',$genero->DesGenero),1,0,'C');
			$etnia = SPEtnia::getById($user->idetnia);
			$pdf->Cell(20,8,iconv('UTF-8', 'windows-1252',$etnia->DesEtnia),1,0,'C');
			$liga = SPLiga::getById($user->idliga);
			$pdf->Cell(50,8,iconv('UTF-8', 'windows-1252',$liga->DesLiga),1,0,'C');
			$club = SPClub::getById($user->idclub);
			$pdf->Cell(50,8,iconv('UTF-8', 'windows-1252',$club->DesClub),1,0,'C');
			$pdf->Cell(50,8,iconv('UTF-8', 'windows-1252',$user->observacion),1,0,'L');
			$pdf->Cell(15,8,$user->fichaje,1,0,'L');
			if ($user->activo=='1')
			{
				$v_estado="Activo";
			}
			else
			{
				$v_estado="Inactivo";
			}
			$pdf->Cell(15,8,$v_estado,1,1,'C');
		}
	}
	$pdf->SetFont('Arial','B',12);
	$pdf->Multicell(0,8,'Total Jugadores: '.count($users));
	$extras= UserData::getBySQL("select now() as ahora from dual;");
	$fimpresion=$extras->ahora;
	$pdf->SetTextColor(0,0,255);
	$pdf->SetFont('Arial','',8);
	$pdf->Multicell(0,4,'Fecha de impresión: '.$fimpresion);
	$pdf->SetTextColor(0,0,0);
	$pdf->Output("ReporteJugadores.pdf","I");
?>
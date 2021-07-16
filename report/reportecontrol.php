<?php
include "../core/controller/Database.php";
include "../core/controller/Executor.php";
include "../core/controller/Model.php";
include "../core/modules/index/model/UserData.php";
include "../core/modules/index/model/SPLog.php";
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
		if (isset($_POST["busr"]))
		{
			$this->Cell(70,0,'REPORTE DE OPERACIONES CON USUARIOS',0,1,'C');
		}
		else
		{
			$this->Cell(70,0,'REPORTE DE TRANSFERENCIAS DE JUGADORES',0,1,'C');
		}
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
		if (isset($_POST["busr"]))
		{
			$this->Cell(30,8,'Fecha',1,0,'C');
			$this->Cell(40,8,'Administrador',1,0,'C');
			$this->Cell(30,8,'Operación',1,0,'C');
			$this->Cell(40,8,'Usuario',1,0,'C');
			$this->Cell(50,8,'Nombres y Apellidos',1,0,'C');
		}
		else
		{
			$this->Cell(30,8,'Fecha',1,0,'C');
			$this->Cell(40,8,'Usuario',1,0,'C');
			$this->Cell(30,8,'Código',1,0,'C');
			$this->Cell(60,8,'Nombres y Apellidos',1,0,'C');
			$this->Cell(30,8,'Tipo',1,0,'C');
		}
		
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
$vdesde=$_POST["vdesde"];
$vhasta=$_POST["vhasta"];
if (isset($_POST["busr"]))
{
	$vboton='usuario';
	$reporte='ControlUsuarios';
	$users = SPLog::getDetUsuarios($vdesde,$vhasta);
	$vtotal=0;
	if(count($users)>0)
	{
		foreach($users as $user)
		{
			//iconv('UTF-8', 'windows-1252',)
			$pdf->Cell(30,8,$user->fecha,1,0,'C');
			$pdf->Cell(40,8,iconv('UTF-8', 'windows-1252',$user->administrador),1,0,'C');
			$pdf->Cell(30,8,iconv('UTF-8', 'windows-1252',$user->operacion),1,0,'C');
			$pdf->Cell(40,8,iconv('UTF-8', 'windows-1252',$user->usuario),1,0,'L');
			$pdf->Cell(50,8,iconv('UTF-8', 'windows-1252',$user->nombre),1,1,'L');
			$vtotal+=1;
		}
	}
}
else
{
	$vboton='jugador';
	$reporte='ControlJugadores';
	$users = SPLog::getDetTransferencias($vdesde,$vhasta);
	$vtotal=0;
	if(count($users)>0)
	{
		foreach($users as $user)
		{
			//iconv('UTF-8', 'windows-1252',)
			$pdf->Cell(30,8,$user->fecha,1,0,'C');
			$pdf->Cell(40,8,$user->codigo,1,0,'C');
			$pdf->Cell(30,8,$user->vjugador,1,0,'C');
			$pdf->Cell(60,8,iconv('UTF-8', 'windows-1252',$user->vnombre),1,0,'L');
			$pdf->Cell(30,8,iconv('UTF-8', 'windows-1252',$user->vtipo),1,1,'C');
			$vtotal+=1;
		}
	}
}
	$pdf->SetFont('Arial','B',12);
	$pdf->Multicell(0,8,'Total Registros: '.$vtotal);
	$extras= UserData::getBySQL("select now() as ahora from dual;");
	$fimpresion=$extras->ahora;
	$pdf->SetTextColor(0,0,255);
	$pdf->SetFont('Arial','',8);
	$pdf->Multicell(0,4,'Fecha de impresión: '.$fimpresion);
	$pdf->SetTextColor(0,0,0);
	$pdf->Output($reporte.".pdf","I");
?>
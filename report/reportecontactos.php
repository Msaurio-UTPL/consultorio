<?php
include "../core/controller/Database.php";
include "../core/controller/Executor.php";
include "../core/controller/Model.php";
include "../core/modules/index/model/SPLog.php";
include "../core/modules/index/model/SPDetConceptos.php";
include "../core/modules/index/model/SPContacto.php";
include "../core/modules/index/model/SPBasica.php";

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
		$this->Cell(70,0,'REPORTE DE CONTACTOS PACIENTES',0,1,'C');
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
		$this->Cell(60,8,'PACIENTE',1,0,'C');
		$this->Cell(20,8,'TIPO',1,0,'C');
		$this->Cell(60,8,'PERSONA CONTACTO',1,0,'C');
		$this->Cell(40,8,'NUMERO CONTACTO',1,0,'C');
		$this->Cell(40,8,'REFERENCIA',1,0,'C');
		$this->Cell(20,8,'ESTADO',1,0,'C');
		
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
	$pdf->AddPage('L');
	$pdf->SetFont('Times','',8);
	$users = array();
	$contacto = array();
	$contactos = SPContacto::getAll();
	$users = SPBasica::getAll();
	if(count($users)>0)
	{
		foreach($users as $user)
		{
			$contacto = SPContacto::getBySec($user->pacIdPaciente);
			foreach($contacto as $con)
			{
				$pdf->Cell(60,8,iconv('UTF-8', 'windows-1252',$user->pacApellidos." ".$user->pacNombres),1,0,'L');
				$tipo = SPDetConceptos::getById($con->conIdContacto,$con->detIdContacto);
				$pdf->Cell(20,8,iconv('UTF-8', 'windows-1252',$tipo->detDescDetalle),1,0,'C');
				$pdf->Cell(60,8,iconv('UTF-8', 'windows-1252',$con->conDescripcion1),1,0,'L');
				$pdf->Cell(40,8,iconv('UTF-8', 'windows-1252',$con->conDescripcion2),1,0,'L');
				$pdf->Cell(40,8,iconv('UTF-8', 'windows-1252',$con->conDescripcion3),1,0,'C');
				$estado = SPDetConceptos::getById($con->conIdEstado,$con->detIdEstado);
				$pdf->Cell(20,8,iconv('UTF-8', 'windows-1252',$estado->detDescDetalle),1,1,'C');
			}
		}
	}
	$pdf->SetFont('Arial','B',12);
	$pdf->Multicell(0,8,'Total Contactos: '.count($contactos));
	$extras= SPLog::getBySQL("select now() as ahora from dual;");
	$fimpresion=$extras->ahora;
	$pdf->SetTextColor(0,0,255);
	$pdf->SetFont('Arial','',8);
	$pdf->Multicell(0,4,'Fecha de impresi�n: '.$fimpresion);
	$pdf->SetTextColor(0,0,0);
	$pdf->Output("ReporteContactos.pdf","I");
?>
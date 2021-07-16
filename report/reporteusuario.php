<?php
include "../core/controller/Database.php";
include "../core/controller/Executor.php";
include "../core/controller/Model.php";
include "../core/modules/index/model/SPUser.php";
require('fpdf.php');

class PDF extends FPDF
{
	// Cabecera de página
	function Header()
	{
		// Logo
		$this->Image('logo-gesmed.jpg',5,5,25);
		// Arial bold 12
		$this->SetFont('Arial','B',14);
		// Movernos a la derecha
		$this->Cell(60);
		// Título
		$this->Cell(70,0,'Sistema de Gestión de Citas Médicas GESMED-ECU',0,1,'C');
		$this->Ln(10);
		$this->Cell(60);
		$this->Cell(70,0,'REPORTE DE USUARIOS',0,1,'C');
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
		$this->Cell(25,8,'USUARIO',1,0,'C');
		$this->Cell(80,8,'NOMBRE',1,0,'C');
		$this->Cell(25,8,'ROL',1,0,'C');
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
	$pdf->AddPage('P');
	$pdf->SetFont('Times','',8);
	$users= array();
	$users = SPUser::getAll();
	if(count($users)>0)
	{
		foreach($users as $user)
		{
			$pdf->Cell(25,8,$user->usuCodUsuario,1,0,'C');
			//iconv('UTF-8', 'windows-1252',)
			$pdf->Cell(80,8,iconv('UTF-8', 'windows-1252',$user->usuNombreUsuario),1,0,'L');			
			if ($user->detIdRol=='1')
			{
				$v_perfil="Administrador";
			}
			else
			{
				if ($user->detIdRol=='2')
				{
					$v_perfil="Medico";
				}
				else
				{
				$v_perfil="Asistente";
				}
			}
			$pdf->Cell(25,8,$v_perfil,1,0,'C');
			if ($user->detIdEstado=='1')
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
	$pdf->Multicell(0,8,'Total Usuarios: '.count($users));
	$extras= SPUser::getBySQL("select now() as ahora from dual;");
	$fimpresion=$extras->ahora;
	$pdf->SetTextColor(0,0,255);
	$pdf->SetFont('Arial','',8);
	$pdf->Multicell(0,4,'Fecha de impresión: '.$fimpresion);
	$pdf->SetTextColor(0,0,0);
	$pdf->Output("ReporteUsuarios.pdf","I");
?>
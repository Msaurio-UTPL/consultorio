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
		$this->Image('logoLB.jpg',5,5,30);
		// Arial bold 12
		$this->SetFont('Arial','B',12);
		// Movernos a la derecha
		$this->Cell(60);
		// Título
		$this->Cell(70,0,'FORMULARIO DE COTIZACIÓN',0,0,'C');
		$this->Ln(5);
		$this->Cell(30);
		$this->Cell(55,5,'Detalle de la Adquisición:',0,0,'L');
		$this->Cell(110,15,'',1,1,'L');
		
		$this->Cell(30);
		$this->Cell(15,5,'Fecha:',0,0,'L');
		$this->Cell(18,5,'',1,0,'L');
		$this->Cell(22,5,'Atención:',0,0,'L');
		$this->Cell(65,5,'',1,0,'L');
		$this->Cell(15,5,'Plazo:',0,0,'L');
		$this->Cell(30,5,'',1,1,'L');
		
		$this->Ln(5);
		//$this->SetFont('Times','',10);
		/*
		$this->Cell(50);
		$this->Cell(20,7,'FECHA:',0,0,'C');
		$this->Cell(50,7,'dd-mm-aaaa hh-mm-ss',0,1,'C');
		*/
		//$this->SetLineWidth(1);
		//$this->SetDrawColor(0,0,255);
		//$this->Line(0,30,297,30);
		//$this->Ln(2);
		//$this->Cell(15,8,'CODIGO',1,0,'C');
		//$this->Cell(25,8,'CODIGO',1,0,'C');
		//$this->Cell(80,8,'VARIABLE',1,0,'C');
		//$this->Cell(20,8,'VALOR',1,0,'C');
		//$this->Cell(30,8,'VERIFICABLE',1,0,'C');
		//$this->Cell(50,8,'DOCUMENTO',1,0,'C');
		// Salto de línea
		//$this->Ln(9);
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
$pdf->SetFont('Arial','',8);
$users= array();
$vordinal=1;
$users = SPVariables::getAll();
if(count($users)>0)
{
	$pdf->SetFont('Arial','B',8);
	
	$pdf->SetX(5);
	$pdf->Cell(200,5,'TIPO DE COTIZACIÓN',1,1,'L');
	
	$pdf->SetX(5);
	$pdf->Cell(61,5,'Bien',1,0,'R');
	$pdf->Cell( 5,5,'',1,0,'C');
	$pdf->Cell(61,5,'Servicio',1,0,'R');
	$pdf->Cell( 5,5,'',1,0,'C');
	$pdf->Cell(63,5,'Recurso',1,0,'R');
	$pdf->Cell( 5,5,'',1,1,'C');
	
	$pdf->SetX(5);
	$pdf->Cell(200,5,'CARACTERISTICA DEL PRODUCTO',1,1,'L');
	
	$pdf->SetX(5);
	$pdf->Cell(95,5,'De tipo tecnológico',1,0,'R');
	$pdf->Cell( 5,5,'',1,0,'C');
	$pdf->Cell(95,5,'No tecnológico',1,0,'R');
	$pdf->Cell( 5,5,'',1,1,'C');
	
	$pdf->SetX(5);
	$pdf->Cell(66,5,'Corresponde a un servicio crítico?',1,0,'L');
	$pdf->Cell(61,5,'SI',1,0,'R');
	$pdf->Cell( 5,5,'',1,0,'C');
	$pdf->Cell(63,5,'NO',1,0,'R');
	$pdf->Cell( 5,5,'',1,1,'C');
	
	
	$pdf->SetX(5);
	$pdf->Cell(200,5,'',0,1,'C');
	
	$pdf->SetX(5);
	$pdf->SetFillColor(213,247,172);
	$pdf->Cell(200,5,'1. REQUERIMIENTOS FUNCIONALES',1,1,'C',1);
	
	
	$pdf->SetX(5);
	$pdf->Cell(50,5,'FUNCIONALIDAD',1,0,'C');
	$pdf->Cell(150,5,'DETALLE DE LA FUNCIONALIDAD',1,1,'C');
	
	$pdf->SetX(5);
	$pdf->Cell(50,5,'',1,0,'C');
	$pdf->Cell(150,5,'',1,1,'C');
	
	$pdf->SetX(5);
	$pdf->Cell(50,5,'',1,0,'C');
	$pdf->Cell(150,5,'',1,1,'C');
	
	$pdf->SetX(5);
	$pdf->Cell(50,5,'',1,0,'C');
	$pdf->Cell(150,5,'',1,1,'C');
	
	$pdf->SetX(5);
	$pdf->Cell(50,5,'',1,0,'C');
	$pdf->Cell(150,5,'',1,1,'C');
	
	$pdf->SetX(5);
	$pdf->Cell(50,5,'',1,0,'C');
	$pdf->Cell(150,5,'',1,1,'C');
	
	$pdf->SetX(5);
	$pdf->Cell(50,5,'',1,0,'C');
	$pdf->Cell(150,5,'',1,1,'C');
	
	$pdf->SetX(5);
	$pdf->Cell(50,5,'',1,0,'C');
	$pdf->Cell(150,5,'',1,1,'C');
	
	$pdf->SetX(5);
	$pdf->Cell(50,5,'',1,0,'C');
	$pdf->Cell(150,5,'',1,1,'C');
	
	$pdf->SetX(5);
	$pdf->Cell(50,5,'',1,0,'C');
	$pdf->Cell(150,5,'',1,1,'C');
	
	$pdf->SetX(5);
	$pdf->Cell(50,5,'',1,0,'C');
	$pdf->Cell(150,5,'',1,1,'C');
	
	$pdf->Ln(5);
	
	$pdf->SetX(5);
	$pdf->SetFillColor(213,247,172);
	$pdf->Cell(200,5,'2. REQUERIMIENTOS TÉCNICOS',1,1,'C',1);
	
	$pdf->SetX(5);
	$pdf->Cell(50,5,'TIEMPO DE EJECUCIÓN/ENTREGA',1,0,'C');
	$pdf->Cell(150,5,'',1,1,'C');

	$pdf->SetX(5);
	$pdf->SetFillColor(191,191,191);
	$pdf->Cell(200,5,'PARA BIENES INMUEBLES',1,1,'L',1);
	
	$pdf->SetX(5);
	$pdf->Cell(50,5,'TIEMPO DE CONSTRUCCION',1,0,'C');
	$pdf->Cell(150,5,'',1,1,'C');
	
	$pdf->SetX(5);
	$pdf->Cell(50,5,'AREA TOTAL',1,0,'C');
	$pdf->Cell(150,5,'',1,1,'C');
	
	$pdf->SetX(5);
	$pdf->Cell(50,5,'AREA DE CONSTRUCCION',1,0,'C');
	$pdf->Cell(150,5,'',1,1,'C');
	
	
	$pdf->SetX(5);
	$pdf->SetFillColor(191,191,191);
	$pdf->Cell(200,5,'PARA SERVICIOS (Consultorías / Auditorías).',1,1,'L',1);
	
	$pdf->SetX(5);
	$pdf->Cell(50,5,'MIEMBROS DEL EQUIPO',1,0,'C');
	$pdf->Cell(150,5,'',1,1,'C');
	
	$pdf->SetX(5);
	$pdf->Cell(50,5,'ROL 1',1,0,'C');
	$pdf->Cell(150,5,'',1,1,'C');
	
	$pdf->SetX(5);
	$pdf->Cell(50,5,'FORMACIÓN',1,0,'C');
	$pdf->Cell(150,5,'',1,1,'C');
	
	$pdf->SetX(5);
	$pdf->Cell(50,5,'ROL 2',1,0,'C');
	$pdf->Cell(150,5,'',1,1,'C');
	
	$pdf->SetX(5);
	$pdf->Cell(50,5,'FORMACIÓN',1,0,'C');
	$pdf->Cell(150,5,'',1,1,'C');
	
	$pdf->SetX(5);
	$pdf->Cell(50,5,'ROL 3',1,0,'C');
	$pdf->Cell(150,5,'',1,1,'C');
	
	$pdf->SetX(5);
	$pdf->Cell(50,5,'FORMACIÓN',1,0,'C');
	$pdf->Cell(150,5,'',1,1,'C');
	
	$pdf->SetX(5);
	$pdf->Cell(50,5,'ROL 4',1,0,'C');
	$pdf->Cell(150,5,'',1,1,'C');
		
	$pdf->SetX(5);
	$pdf->Cell(50,5,'FORMACIÓN',1,0,'C');
	$pdf->Cell(150,5,'',1,1,'C');
	
	$pdf->SetX(5);
	$pdf->Cell(50,5,'MODALIDAD DE TRABAJO',1,0,'C');
	$pdf->Cell(150,5,'',1,1,'C');
	
	$pdf->SetX(5);
	$pdf->Cell(50,5,'ENTREGABLES',1,0,'C');
	$pdf->Cell(150,5,'',1,1,'C');
	
	$pdf->SetX(5);
	$pdf->SetFillColor(191,191,191);
	$pdf->Cell(200,5,'PARA HARDWARE, SOFTWARE, COMUNICACIONES Y/O SERVICIOS TECNOLÓGICOS.',1,1,'L',1);
	
	$pdf->SetX(5);
	$pdf->Cell(50,5,'ARQUITECTURA',1,0,'C');
	$pdf->Cell(150,5,'',1,1,'C');
	
	$pdf->SetX(5);
	$pdf->Cell(50,5,'PROCESADORES',1,0,'C');
	$pdf->Cell(150,5,'',1,1,'C');
	
	$pdf->SetX(5);
	$pdf->Cell(50,5,'INTERFACES DE RED',1,0,'C');
	$pdf->Cell(150,5,'',1,1,'C');
	
	$pdf->SetX(5);
	$pdf->Cell(50,5,'VELOCIDAD',1,0,'C');
	$pdf->Cell(150,5,'',1,1,'C');
	
	$pdf->SetX(5);
	$pdf->Cell(50,5,'ANCHO DE BANDA',1,0,'C');
	$pdf->Cell(150,5,'',1,1,'C');
	
	$pdf->SetX(5);
	$pdf->Cell(50,5,'BASE DE DATOS',1,0,'C');
	$pdf->Cell(150,5,'',1,1,'C');
	
	$pdf->SetX(5);
	$pdf->Cell(50,5,'LENGUAJE DE PROGRAMACIÓN',1,0,'C');
	$pdf->Cell(150,5,'',1,1,'C');
	
	$pdf->SetX(5);
	$pdf->Cell(200,5,'MANUALES Y DOCUMENTACIÓN',1,1,'C');
	
	$pdf->SetX(5);
	$pdf->Cell(63,5,'MANUAL DE USUARIO',1,0,'R');
	$pdf->Cell( 5,5,'',1,0,'L');
	$pdf->Cell(61,5,'MANUAL TÉCNICO',1,0,'R');
	$pdf->Cell( 5,5,'',1,0,'L');
	$pdf->Cell(61,5,'DICCIONARIO DE DATOS',1,0,'R');
	$pdf->Cell( 5,5,'',1,1,'L');
	
	$pdf->SetX(5);
	$pdf->Cell(63,5,'MODELO ENTIDAD RELACIÓN',1,0,'R');
	$pdf->Cell( 5,5,'',1,0,'L');
	$pdf->Cell(61,5,'DIAGRAMA DE PROCESOS',1,0,'R');
	$pdf->Cell( 5,5,'',1,0,'L');
	$pdf->Cell(61,5,'CÓDIGO FUENTE',1,0,'R');
	$pdf->Cell( 5,5,'',1,1,'L');

	$pdf->Ln(5);
	
	$pdf->SetX(5);
	$pdf->SetFillColor(213,247,172);
	$pdf->Cell(200,5,'3. OFERTA ECONÓMICA',1,1,'C',1);
	
	$pdf->SetX(5);
	$pdf->Cell(200,5,'MODALIDAD',1,1,'C');
	
	$pdf->SetX(5);
	$pdf->Cell(63,5,'VENTA',1,0,'R');
	$pdf->Cell( 5,5,'',1,0,'L');
	$pdf->Cell(61,5,'ARRENDAMIENTO',1,0,'R');
	$pdf->Cell( 5,5,'',1,0,'L');
	$pdf->Cell(61,5,'SERVICIO',1,0,'R');
	$pdf->Cell( 5,5,'',1,1,'L');
	
	$pdf->SetX(5);
	$pdf->Cell(200,5,'FORMA DE PAGO',1,1,'C');
	
	$pdf->SetX(5);
	$pdf->Cell(35,5,'ANUAL',1,0,'R');
	$pdf->Cell( 5,5,'',1,0,'L');
	$pdf->Cell(35,5,'90 DÍAS',1,0,'R');
	$pdf->Cell( 5,5,'',1,0,'L');
	$pdf->Cell(35,5,'60 DÍAS',1,0,'R');
	$pdf->Cell( 5,5,'',1,0,'L');
	$pdf->Cell(35,5,'INMEDIATO',1,0,'R');
	$pdf->Cell( 5,5,'',1,0,'L');
	$pdf->Cell(35,5,'CONTRA ENTREGA',1,0,'R');
	$pdf->Cell( 5,5,'',1,1,'L');
	
	$pdf->SetX(5);
	$pdf->Cell(50,5,'OTRA FORMA DE PAGO',1,0,'C');
	$pdf->Cell(150,5,'',1,1,'C');
	
	$pdf->SetX(5);
	$pdf->Cell(50,5,'VIGENCIA DE LA OFERTA',1,0,'C');
	$pdf->Cell(150,5,'',1,1,'C');
	
	$pdf->SetX(5);
	$pdf->Cell(50,5,'COSTO',1,0,'C');
	$pdf->Cell(150,5,'',1,1,'C');
	
	$pdf->SetX(5);
	$pdf->Cell(125,5,'OTROS COSTOS',1,0,'C');
	$pdf->Cell(75,5,'DETALLE',1,1,'C');
	
	$pdf->SetX(5);
	$pdf->Cell(60,5,'Servicio de Instalación',1,0,'L');
	$pdf->Cell(10,5,'SI',1,0,'R');
	$pdf->Cell( 5,5,'',1,0,'C');
	$pdf->Cell(10,5,'NO',1,0,'R');
	$pdf->Cell( 5,5,'',1,0,'C');
	$pdf->Cell(15,5,'VALOR',1,0,'R');
	$pdf->Cell(20,5,'',1,0,'C');
	$pdf->Cell(75,5,'',1,1,'C');
	
	$pdf->SetX(5);
	$pdf->Cell(60,5,'Servicio de Configuración',1,0,'L');
	$pdf->Cell(10,5,'SI',1,0,'R');
	$pdf->Cell( 5,5,'',1,0,'C');
	$pdf->Cell(10,5,'NO',1,0,'R');
	$pdf->Cell( 5,5,'',1,0,'C');
	$pdf->Cell(15,5,'VALOR',1,0,'R');
	$pdf->Cell(20,5,'',1,0,'C');
	$pdf->Cell(75,5,'',1,1,'C');
	
	$pdf->SetX(5);
	$pdf->Cell(60,5,'Servicio de Migración',1,0,'L');
	$pdf->Cell(10,5,'SI',1,0,'R');
	$pdf->Cell( 5,5,'',1,0,'C');
	$pdf->Cell(10,5,'NO',1,0,'R');
	$pdf->Cell( 5,5,'',1,0,'C');
	$pdf->Cell(15,5,'VALOR',1,0,'R');
	$pdf->Cell(20,5,'',1,0,'C');
	$pdf->Cell(75,5,'',1,1,'C');
	
	$pdf->SetX(5);
	$pdf->Cell(60,5,'Servicio de Mantenimiento',1,0,'L');
	$pdf->Cell(10,5,'SI',1,0,'R');
	$pdf->Cell( 5,5,'',1,0,'C');
	$pdf->Cell(10,5,'NO',1,0,'R');
	$pdf->Cell( 5,5,'',1,0,'C');
	$pdf->Cell(15,5,'VALOR',1,0,'R');
	$pdf->Cell(20,5,'',1,0,'C');
	$pdf->Cell(75,5,'',1,1,'C');
	
	$pdf->SetX(5);
	$pdf->Cell(60,5,'Servicio de Capacitación',1,0,'L');
	$pdf->Cell(10,5,'SI',1,0,'R');
	$pdf->Cell( 5,5,'',1,0,'C');
	$pdf->Cell(10,5,'NO',1,0,'R');
	$pdf->Cell( 5,5,'',1,0,'C');
	$pdf->Cell(15,5,'VALOR',1,0,'R');
	$pdf->Cell(20,5,'',1,0,'C');
	$pdf->Cell(75,5,'',1,1,'C');
	
	$pdf->SetX(5);
	$pdf->Cell(60,5,'Transferencia de Conocimientos',1,0,'L');
	$pdf->Cell(10,5,'SI',1,0,'R');
	$pdf->Cell( 5,5,'',1,0,'C');
	$pdf->Cell(10,5,'NO',1,0,'R');
	$pdf->Cell( 5,5,'',1,0,'C');
	$pdf->Cell(15,5,'VALOR',1,0,'R');
	$pdf->Cell(20,5,'',1,0,'C');
	$pdf->Cell(75,5,'',1,1,'C');
	
	$pdf->SetX(5);
	$pdf->Cell(60,5,'Servicio de Respaldo',1,0,'L');
	$pdf->Cell(10,5,'SI',1,0,'R');
	$pdf->Cell( 5,5,'',1,0,'C');
	$pdf->Cell(10,5,'NO',1,0,'R');
	$pdf->Cell( 5,5,'',1,0,'C');
	$pdf->Cell(15,5,'VALOR',1,0,'R');
	$pdf->Cell(20,5,'',1,0,'C');
	$pdf->Cell(75,5,'',1,1,'C');
	
	$pdf->SetX(5);
	$pdf->Cell(60,5,'Servicio de Soporte post implementación',1,0,'L');
	$pdf->Cell(10,5,'SI',1,0,'R');
	$pdf->Cell( 5,5,'',1,0,'C');
	$pdf->Cell(10,5,'NO',1,0,'R');
	$pdf->Cell( 5,5,'',1,0,'C');
	$pdf->Cell(15,5,'VALOR',1,0,'R');
	$pdf->Cell(20,5,'',1,0,'C');
	$pdf->Cell(75,5,'',1,1,'C');
	
	$pdf->Ln(5);
	
	$pdf->SetX(5);
	$pdf->SetFillColor(213,247,172);
	$pdf->Cell(200,5,'4. REQUERIMIENTOS LEGALES Y DE CUMPLIMIENTO',1,1,'C',1);
	
	$pdf->SetX(5);
	$pdf->Cell(66,5,'Proveedor Exclusivo o Canal autorizado?',1,0,'L');
	$pdf->Cell(61,5,'SI',1,0,'R');
	$pdf->Cell( 5,5,'',1,0,'C');
	$pdf->Cell(63,5,'NO',1,0,'R');
	$pdf->Cell( 5,5,'',1,1,'C');
	
	$pdf->SetX(5);
	$pdf->Cell(66,5,'Representación técnica del fabricante?',1,0,'L');
	$pdf->Cell(61,5,'SI',1,0,'R');
	$pdf->Cell( 5,5,'',1,0,'C');
	$pdf->Cell(63,5,'NO',1,0,'R');
	$pdf->Cell( 5,5,'',1,1,'C');
	
	$pdf->SetX(5);
	$pdf->Cell(66,5,'Garantía de buen uso del anticipo?',1,0,'L');
	$pdf->Cell(61,5,'SI',1,0,'R');
	$pdf->Cell( 5,5,'',1,0,'C');
	$pdf->Cell(63,5,'NO',1,0,'R');
	$pdf->Cell( 5,5,'',1,1,'C');
	
	$pdf->SetX(5);
	$pdf->Cell(66,5,'Garantía de fiel cumplimiento del contrato?',1,0,'L');
	$pdf->Cell(61,5,'SI',1,0,'R');
	$pdf->Cell( 5,5,'',1,0,'C');
	$pdf->Cell(63,5,'NO',1,0,'R');
	$pdf->Cell( 5,5,'',1,1,'C');
	
	$pdf->SetX(5);
	$pdf->Cell(66,5,'Acuerdo de Confidencialidad?',1,0,'L');
	$pdf->Cell(61,5,'SI',1,0,'R');
	$pdf->Cell( 5,5,'',1,0,'C');
	$pdf->Cell(63,5,'NO',1,0,'R');
	$pdf->Cell( 5,5,'',1,1,'C');
	
	$pdf->SetX(5);
	$pdf->Cell(66,5,'Acuerdo de Nivel de Servicio?',1,0,'L');
	$pdf->Cell(61,5,'SI',1,0,'R');
	$pdf->Cell( 5,5,'',1,0,'C');
	$pdf->Cell(63,5,'NO',1,0,'R');
	$pdf->Cell( 5,5,'',1,1,'C');
	
	$pdf->SetX(5);
	$pdf->Cell(66,5,'Plan de Contingencia?',1,0,'L');
	$pdf->Cell(61,5,'SI',1,0,'R');
	$pdf->Cell( 5,5,'',1,0,'C');
	$pdf->Cell(63,5,'NO',1,0,'R');
	$pdf->Cell( 5,5,'',1,1,'C');
	
	$pdf->SetX(5);
	$pdf->Cell(66,5,'Plan de Continuidad del Negocio?',1,0,'L');
	$pdf->Cell(61,5,'SI',1,0,'R');
	$pdf->Cell( 5,5,'',1,0,'C');
	$pdf->Cell(63,5,'NO',1,0,'R');
	$pdf->Cell( 5,5,'',1,1,'C');
	
	$pdf->Ln(5);
	
	$pdf->SetX(5);
	$pdf->SetFillColor(213,247,172);
	$pdf->Cell(200,5,'5. VALORES AGREGADOS',1,1,'C',1);
	
	$pdf->SetX(5);
	$pdf->Cell(200,5,'',1,1,'C');
	$pdf->SetX(5);
	$pdf->Cell(200,5,'',1,1,'C');
	$pdf->SetX(5);
	$pdf->Cell(200,5,'',1,1,'C');
	$pdf->SetX(5);
	$pdf->Cell(200,5,'',1,1,'C');
	
	$pdf->SetX(5);
	$pdf->Cell(200,5,'*Procure llenar toda la información que caracterice su oferta. Alguna información podría NO APLICAR.',1,1,'L');
	
	$pdf->Ln(5);
	
}
$pdf->SetFont('Arial','B',12);
//$pdf->Multicell(0,8,'Total Variables: '.count($users));
$extras= SPUser::getBySQL("select now() as ahora from dual;");
$fimpresion=$extras->ahora;
$pdf->SetTextColor(0,0,255);
$pdf->SetFont('Arial','',8);
$pdf->Multicell(0,4,'Fecha de impresión: '.$fimpresion);
$pdf->SetTextColor(0,0,0);
$pdf->Output("FormularioCotizacion.pdf","I");
?>
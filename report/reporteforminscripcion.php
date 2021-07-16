<?php
include "../core/controller/Database.php";
include "../core/controller/Executor.php";
include "../core/controller/Model.php";
include "../core/controller/Session.php";
include "../core/controller/View.php";
include "../core/modules/index/model/SPUser.php";
include "../core/modules/index/model/SPVariables.php";
require('fpdf.php');

class PDF extends FPDF
{
	// Cabecera de p�gina
	function Header()
	{
		// Logo
		$this->Image('logoLB.jpg',5,5,30);
		// Arial bold 12
		$this->SetFont('Arial','B',12);
		// Movernos a la derecha
		$this->Cell(60);
		// T�tulo
		$this->Cell(70,0,'FORMULARIO DE INSCRIPCI�N DE PROVEEDORES',0,0,'C');
		$this->Ln(5);
		$this->Cell(30);
		$this->Cell(32,5,'Macroproceso:',1,0,'L');
		$this->Cell(56,5,'',1,0,'L');
		$this->Cell(20,5,'Proceso:',1,0,'L');
		$this->Cell(56,5,'',1,1,'L');
		
		$this->Cell(30);
		$this->Cell(32,5,'Subproceso:',1,0,'L');
		$this->Cell(56,5,'',1,0,'L');
		$this->Cell(20,5,'C�digo:',1,0,'L');
		$this->Cell(56,5,'',1,1,'L');

		$this->Cell(30);
		$this->Cell(164,5,'Tipo de Proveedor:',1,1,'L');
		
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
		// Salto de l�nea
		//$this->Ln(9);
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
$u=null;
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage('P');
$pdf->SetFont('Arial','',8);
/*
if(Session::getUID()!="")
{
*/	
	
	$users= array();
	$vordinal=1;
	$users = SPVariables::getAll();
	if(count($users)>0)
	{
		// Cuadros
		$pdf->SetFont('Arial','B',8);
		
		$pdf->SetX(5);
		$pdf->Cell(15,5,'NUEVO',0,0,'L');
		$pdf->Cell( 5,5,'',1,0,'L');
		$pdf->Cell(30,5,'',0,0,'L');
		
		$pdf->Cell(45,5,'ACTUALIZACI�N DE DATOS',0,0,'L');
		$pdf->Cell( 5,5,'',1,0,'L');
		
		$pdf->Cell(35,5,'REEVALUACI�N ANUAL',0,0,'L');
		$pdf->Cell( 5,5,'',1,0,'L');
		$pdf->Cell(10,5,'',0,0,'L');
		
		$pdf->Cell(15,5,'FECHA',1,0,'L');
		$pdf->Cell(30,5,'',1,1,'L');
		
		$pdf->SetX(5);
		$pdf->Cell(200,5,'',0,1,'C');
		
		$pdf->SetX(5);
		$pdf->SetFillColor(213,247,172);
		$pdf->Cell(200,5,'1. INFORMACI�N B�SICA DEL PROVEEDOR',1,1,'C',1);
		
		//$pdf->Ln(5);
		
		$pdf->SetX(5);
		$pdf->SetFillColor(191,191,191);
		$pdf->Cell(200,5,'PERSONA NATURAL',1,1,'L',1);
		
		$pdf->SetX(5);
		$pdf->Cell(50,5,'PRIMER APELLIDO',1,0,'C');
		$pdf->Cell(50,5,'SEGUNDO APELLIDO',1,0,'C');
		$pdf->Cell(50,5,'PRIMER NOMBRE',1,0,'C');
		$pdf->Cell(50,5,'SEGUNDO NOMBRE',1,1,'C');
		
		$pdf->SetX(5);
		$pdf->Cell(50,5,'',1,0,'C');
		$pdf->Cell(50,5,'',1,0,'C');
		$pdf->Cell(50,5,'',1,0,'C');
		$pdf->Cell(50,5,'',1,1,'C');
		
		$pdf->SetX(5);
		$pdf->Cell(200,5,'IDENTIFICACI�N',1,1,'C');
		
		$pdf->SetX(5);
		$pdf->Cell(63,5,'CI',1,0,'R');
		$pdf->Cell( 5,5,'',1,0,'L');
		$pdf->Cell(61,5,'RUC',1,0,'R');
		$pdf->Cell( 5,5,'',1,0,'L');
		$pdf->Cell(61,5,'PASAPORTE',1,0,'R');
		$pdf->Cell( 5,5,'',1,1,'L');
			
		$pdf->SetX(5);
		$pdf->Cell(66,5,'N�MERO DE IDENTIFICACI�N',1,0,'C');
		$pdf->Cell(66,5,'TEL�FONO FIJO / CELULAR',1,0,'C');
		$pdf->Cell(68,5,'DIRECCI�N',1,1,'C');
		
		$pdf->SetX(5);
		$pdf->Cell(66,5,'',1,0,'C');
		$pdf->Cell(66,5,'',1,0,'C');
		$pdf->Cell(68,5,'',1,1,'C');
		
		$pdf->SetX(5);
		$pdf->Cell(50,5,'CIUDAD',1,0,'C');
		$pdf->Cell(50,5,'CANT�N',1,0,'C');
		$pdf->Cell(50,5,'PROVINCIA',1,0,'C');
		$pdf->Cell(50,5,'PAIS',1,1,'C');
		
		$pdf->SetX(5);
		$pdf->Cell(50,5,'',1,0,'C');
		$pdf->Cell(50,5,'',1,0,'C');
		$pdf->Cell(50,5,'',1,0,'C');
		$pdf->Cell(50,5,'',1,1,'C');
		
		$pdf->SetX(5);
		$pdf->Cell(100,5,'RAMA PROFESIONAL',1,0,'C');
		$pdf->Cell(100,5,'CORREO ELECTR�NICO',1,1,'C');
		
		$pdf->SetX(5);
		$pdf->Cell(100,5,'',1,0,'C');
		$pdf->Cell(100,5,'',1,1,'C');
		
		//$pdf->Ln(5);
		
		$pdf->SetX(5);
		$pdf->Cell(200,5,'PERSONA JURIDICA',1,1,'L',1);
		
		
		$pdf->SetX(5);
		$pdf->Cell(100,5,'RAZ�N SOCIAL',1,0,'C');
		$pdf->Cell(100,5,'RUC',1,1,'C');
		
		$pdf->SetX(5);
		$pdf->Cell(100,5,'',1,0,'C');
		$pdf->Cell(100,5,'',1,1,'C');
		
		$pdf->SetX(5);
		$pdf->Cell(66,5,'TEL�FONO',1,0,'C');
		$pdf->Cell(66,5,'DIRECCI�N',1,0,'C');
		$pdf->Cell(68,5,'PROVINCIA',1,1,'C');
		
		$pdf->SetX(5);
		$pdf->Cell(66,5,'',1,0,'C');
		$pdf->Cell(66,5,'',1,0,'C');
		$pdf->Cell(68,5,'',1,1,'C');
			
		$pdf->SetX(5);
		$pdf->Cell(100,5,'CORREO ELECTR�NICO',1,0,'C');
		$pdf->Cell(100,5,'',1,1,'C');
			
		$pdf->SetX(5);
		$pdf->Cell(200,5,'REPRESENTANTE LEGAL',1,1,'C');
		
		$pdf->SetX(5);
		$pdf->Cell(50,5,'PRIMER APELLIDO',1,0,'C');
		$pdf->Cell(50,5,'SEGUNDO APELLIDO',1,0,'C');
		$pdf->Cell(50,5,'PRIMER NOMBRE',1,0,'C');
		$pdf->Cell(50,5,'SEGUNDO NOMBRE',1,1,'C');
		
		$pdf->SetX(5);
		$pdf->Cell(50,5,'',1,0,'C');
		$pdf->Cell(50,5,'',1,0,'C');
		$pdf->Cell(50,5,'',1,0,'C');
		$pdf->Cell(50,5,'',1,1,'C');
		
		
		$pdf->SetX(5);
		$pdf->Cell(66,5,'N�MERO DE IDENTIFICACI�N',1,0,'C');
		$pdf->Cell(66,5,'TEL�FONO',1,0,'C');
		$pdf->Cell(68,5,'PROVINCIA',1,1,'C');
		
		$pdf->SetX(5);
		$pdf->Cell(66,5,'',1,0,'C');
		$pdf->Cell(66,5,'',1,0,'C');
		$pdf->Cell(68,5,'',1,1,'C');
		
		$pdf->SetX(5);
		$pdf->Cell(100,5,'NOMBRE Y CARGO DE LA PERSONA DE CONTACTO',1,0,'C');
		$pdf->Cell(100,5,'PRODUCTO QUE OFRECE',1,1,'C');
		
		$pdf->SetX(5);
		$pdf->Cell(100,5,'',1,0,'C');
		$pdf->Cell(100,5,'',1,1,'C');
		
		$pdf->Ln(5);
		
		$pdf->SetX(5);
		$pdf->SetFillColor(213,247,172);
		$pdf->Cell(200,5,'2. POSICIONAMIENTO DEL PROVEEDOR',1,1,'C',1);
		
		//$pdf->Ln(5);
		
		$pdf->SetX(5);
		$pdf->SetFillColor(191,191,191);
		$pdf->Cell(200,5,'SEG�N EL PRODUCTO QUE OFRECE',1,1,'L',1);
		
		$pdf->SetX(5);
		$pdf->Cell(61,5,'Bien',1,0,'R');
		$pdf->Cell( 5,5,'',1,0,'C');
		$pdf->Cell(61,5,'Servicio',1,0,'R');
		$pdf->Cell( 5,5,'',1,0,'C');
		$pdf->Cell(63,5,'Recurso',1,0,'R');
		$pdf->Cell( 5,5,'',1,1,'C');
		
		$pdf->SetX(5);
		$pdf->SetFillColor(191,191,191);
		$pdf->Cell(200,5,'SEG�N SU NATURALEZA',1,1,'L',1);
		
		$pdf->SetX(5);
		$pdf->Cell(95,5,'Persona Natural',1,0,'R');
		$pdf->Cell( 5,5,'',1,0,'C');
		$pdf->Cell(95,5,'Persona Jur�dica',1,0,'R');
		$pdf->Cell( 5,5,'',1,1,'C');
			
		$pdf->SetX(5);
		$pdf->SetFillColor(191,191,191);
		$pdf->Cell(200,5,'SEG�N SU RELACI�N CON LA COOPERATIVA',1,1,'L',1);
		
		$pdf->SetX(5);
		$pdf->Cell(61,5,'Hist�rica',1,0,'R');
		$pdf->Cell( 5,5,'',1,0,'C');
		$pdf->Cell(61,5,'A prueba',1,0,'R');
		$pdf->Cell( 5,5,'',1,0,'C');
		$pdf->Cell(63,5,'Rechazado',1,0,'R');
		$pdf->Cell( 5,5,'',1,1,'C');
		
		$pdf->SetX(5);
		$pdf->SetFillColor(191,191,191);
		$pdf->Cell(200,5,'SEG�N SU CRITICIDAD',1,1,'L',1);

		$pdf->SetX(5);
		$pdf->Cell(66,5,'Participa como proveedor de servicios cr�ticos?',1,0,'L');
		$pdf->Cell(61,5,'SI',1,0,'R');
		$pdf->Cell( 5,5,'',1,0,'C');
		$pdf->Cell(63,5,'NO',1,0,'R');
		$pdf->Cell( 5,5,'',1,1,'C');
		
		$pdf->SetX(5);
		$pdf->SetFillColor(191,191,191);
		$pdf->Cell(200,5,'SEG�N LA CARACTERISTICA DEL PRODUCTO',1,1,'L',1);
		
		$pdf->SetX(5);
		$pdf->Cell(95,5,'De tipo tecnol�gico',1,0,'R');
		$pdf->Cell( 5,5,'',1,0,'C');
		$pdf->Cell(95,5,'No tecnol�gico',1,0,'R');
		$pdf->Cell( 5,5,'',1,1,'C');
		
		$pdf->SetX(5);
		$pdf->SetFillColor(191,191,191);
		$pdf->Cell(200,5,'SEG�N EL ORIGEN DE SUS OPERACIONES',1,1,'L',1);
		
		$pdf->SetX(5);
		$pdf->Cell(95,5,'Nacional',1,0,'R');
		$pdf->Cell( 5,5,'',1,0,'C');
		$pdf->Cell(95,5,'Extranjero',1,0,'R');
		$pdf->Cell( 5,5,'',1,1,'C');
		
		$pdf->Ln(35);
		
		$pdf->SetX(5);
		$pdf->SetFillColor(213,247,172);
		$pdf->Cell(200,5,'3. INFORMACI�N FINANCIERA',1,1,'C',1);
		
		//$pdf->Ln(5);
		
		$pdf->SetX(5);
		$pdf->SetFillColor(191,191,191);
		$pdf->Cell(200,5,'BALANCE GENERAL',1,1,'C',1);
		
		$pdf->SetX(5);
		$pdf->Cell(100,5,'ACTIVOS',1,0,'C');
		$pdf->Cell(100,5,'PASIVOS',1,1,'C');
		
		$pdf->SetFont('Arial','',8);
		
		$pdf->SetX(5);
		$pdf->Cell(50,5,'Disponible',1,0,'L',1);
		$pdf->Cell(50,5,'',1,0,'L',1);
		$pdf->Cell(50,5,'    Proveedores',1,0,'L');
		$pdf->Cell(50,5,'',1,1,'L');
		
		$pdf->SetX(5);
		$pdf->Cell(50,5,'    Caja',1,0,'L');
		$pdf->Cell(50,5,'',1,0,'L');
		$pdf->Cell(50,5,'    Cuentas por pagar',1,0,'L');
		$pdf->Cell(50,5,'',1,1,'L');
		
		$pdf->SetX(5);
		$pdf->Cell(50,5,'    Banco',1,0,'L');
		$pdf->Cell(50,5,'',1,0,'L');
		$pdf->SetFont('Arial','B',8);
		$pdf->Cell(50,5,'Pasivo corriente',1,0,'L',1);
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(50,5,'',1,1,'L',1);
		
		$pdf->SetX(5);
		$pdf->Cell(50,5,'    Inversiones temporales',1,0,'L',1);
		$pdf->Cell(50,5,'',1,0,'L',1);
		$pdf->Cell(50,5,'    Pr�stamos y obligaciones financieras',1,0,'L',1);
		$pdf->Cell(50,5,'',1,1,'L',1);
		
		$pdf->SetX(5);
		$pdf->Cell(50,5,'    Deudores CxC Clientes',1,0,'L',1);
		$pdf->Cell(50,5,'',1,0,'L',1);
		$pdf->Cell(50,5,'    Acreedores diversos',1,0,'L');
		$pdf->Cell(50,5,'',1,1,'L');
		
		$pdf->SetX(5);
		$pdf->SetFont('Arial','B',8);
		$pdf->Cell(50,5,'Activo corriente',1,0,'L',1);
		$pdf->Cell(50,5,'',1,0,'L',1);
		$pdf->Cell(50,5,'Pasivos No Corrientes',1,0,'L');
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(50,5,'',1,1,'L');
		
		$pdf->SetX(5);
		$pdf->Cell(50,5,'    Inventarios',1,0,'L',1);
		$pdf->Cell(50,5,'',1,0,'L',1);
		$pdf->SetFont('Arial','B',8);
		$pdf->Cell(100,5,'Total Pasivos',1,1,'L',1);
		$pdf->SetFont('Arial','',8);
		
		$pdf->SetX(5);
		$pdf->Cell(50,5,'Deuda largo plazo',1,0,'L');
		$pdf->Cell(50,5,'',1,0,'L');
		$pdf->SetFont('Arial','B',8);
		$pdf->Cell(100,5,'PATRIMONIO',1,1,'C');
		
		$pdf->SetX(5);
		$pdf->Cell(100,5,'Activos Fijos',1,0,'L');
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(50,5,'Reserva',1,0,'L');
		$pdf->Cell(50,5,'',1,1,'L');
		
		$pdf->SetX(5);
		$pdf->Cell(50,5,'    Depreciacion acumulada',1,0,'L');
		$pdf->Cell(50,5,'',1,0,'L');
		$pdf->Cell(50,5,'Patrimonio social',1,0,'L');
		$pdf->Cell(50,5,'',1,1,'L');
		
		$pdf->SetX(5);
		$pdf->Cell(50,5,'    Otros activos fijos',1,0,'L');
		$pdf->Cell(50,5,'',1,0,'L');
		$pdf->SetFont('Arial','B',8);
		$pdf->Cell(100,5,'Total patrimonio',1,1,'L',1);
		
		$pdf->SetX(5);
		$pdf->Cell(100,5,'Total activos fijos',1,1,'L');

		$pdf->SetX(5);
		$pdf->Cell(100,5,'Total activos',1,0,'L',1);
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(50,5,'Total pasivos + patrimonio',1,0,'L');
		$pdf->Cell(50,5,'',1,1,'L');
		
		$pdf->SetX(5);
		$pdf->Cell(200,5,'*La Informaci�n Financiera ser� verificada en el Balance General que presente el proveedor, en f�sico y en formato PDF.',1,1,'L');
		
		$pdf->Ln(5);
		
		$pdf->SetX(5);
		$pdf->SetFillColor(191,191,191);
		$pdf->Cell(200,5,'ESTADO DE P�RDIDAS Y GANANCIAS',1,1,'C',1);
		
		$pdf->SetFont('Arial','B',8);
		
		$pdf->SetX(5);
		$pdf->Cell(100,5,'INGRESOS',1,0,'C');
		$pdf->Cell(100,5,'GASTOS',1,1,'C');
		
		$pdf->SetFont('Arial','',8);
		
		$pdf->SetX(5);
		$pdf->Cell(60,5,'Ventas',1,0,'L');
		$pdf->Cell(40,5,'',1,0,'C');
		$pdf->Cell(60,5,'Gastos Generales y administrativos',1,0,'L');
		$pdf->Cell(40,5,'',1,1,'C');
		
		$pdf->SetX(5);
		$pdf->Cell(60,5,'Costo de Ventas',1,0,'L');
		$pdf->Cell(40,5,'',1,0,'C');
		$pdf->Cell(60,5,'Gastos por depreciaciones y amortizaciones',1,0,'L');
		$pdf->Cell(40,5,'',1,1,'C');
		
		$pdf->SetFont('Arial','B',8);
		
		$pdf->SetX(5);
		$pdf->Cell(60,5,'Utilidad bruta',1,0,'L');
		$pdf->Cell(40,5,'',1,0,'C');
		$pdf->Cell(60,5,'Total gastos operacionales',1,0,'L');
		$pdf->Cell(40,5,'',1,1,'C');
		
		$pdf->SetX(5);
		$pdf->Cell(100,25,'',1,0,'L',1);
		$pdf->Cell(60,5,'Utilidad operacional',1,0,'L');
		$pdf->Cell(40,5,'',1,1,'C');
		
		$pdf->SetFont('Arial','',8);
		
		$pdf->SetX(105);
		$pdf->Cell(60,5,'Gastos por intereses',1,0,'L');
		$pdf->Cell(40,5,'',1,1,'C');
		
		$pdf->SetFont('Arial','B',8);
		
		$pdf->SetX(105);
		$pdf->Cell(100,5,'Utilidad neta antes de impuestos',1,1,'L');

		$pdf->SetFont('Arial','',8);
		
		$pdf->SetX(105);
		$pdf->Cell(60,5,'Impuestos',1,0,'L');
		$pdf->Cell(40,5,'',1,1,'C');
		
		$pdf->SetFont('Arial','B',8);
		
		$pdf->SetX(105);
		$pdf->Cell(100,5,'Utilidad neta antes de impuestos',1,1,'L');
		$pdf->SetX(5);
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(200,5,'**La Informaci�n Financiera ser� verificada en el Estado de P�rdidas y Ganancias que presente el proveedor, en f�sico y en formato PDF.',1,1,'L');
		
		$pdf->Ln(5);
		
		$pdf->SetX(5);
		$pdf->SetFillColor(213,247,172);
		$pdf->Cell(200,5,'4. INFORMACI�N ADICIONAL',1,1,'C',1);
		
		//$pdf->Ln(5);
		
		$pdf->SetX(5);
		$pdf->Cell( 20,15,'EMPRESA',1,0,'C');
		$pdf->Cell(120,5,'A�OS DE EXPERIENCIA EN EL �MBITO QUE SE DESEA CONTRATAR',1,0,'L');
		$pdf->Cell( 60,5,'',1,1,'L');
		
		$pdf->SetX(25);
		$pdf->Cell(120,5,'N�MERO DE EMPRESAS ATENDIDAS EN EL �MBITO QUE SE DESEA CONTRATAR',1,0,'L');
		$pdf->Cell( 60,5,'',1,1,'L');
		
		$pdf->SetX(25);
		$pdf->Cell(120,5,'N�MERO DE EMPRESAS ATENDIDAS DE LA MISMA NATURALEZA A LA NUESTRA',1,0,'L');
		$pdf->Cell( 60,5,'',1,1,'L');
		
		$pdf->SetX(5);
		$pdf->Cell( 20,10,'PERSONAL',1,0,'C');
		$pdf->Cell(120,5,'A�OS DE EXPERIENCIA EN EL �MBITO QUE SE DESEA CONTRATAR',1,0,'L');
		$pdf->Cell( 60,5,'',1,1,'L');
		
		$pdf->SetX(25);
		$pdf->Cell(120,5,'N�MERO DE EMPRESAS ATENDIDAS EN EL �MBITO QUE SE DESEA CONTRATAR',1,0,'L');
		$pdf->Cell( 60,5,'',1,1,'L');
		
		$pdf->SetX(5);
		$pdf->Cell( 80,5,'CARACTER�STICAS DEL SOPORTE OFERTADO',1,0,'L');
		$pdf->Cell(120,5,'',1,1,'L');
		
		$pdf->SetX(5);
		$pdf->Cell( 80,5,'CARACTER�STICAS DE SU INFRAESTRUCTURA',1,0,'L');
		$pdf->Cell(120,5,'',1,1,'L');
		
		$pdf->SetX(5);
		$pdf->Cell( 80,5,'TIEMPO DEL SERVICIO POSTVENTA',1,0,'L');
		$pdf->Cell(120,5,'',1,1,'L');
		
		$pdf->SetX(5);
		$pdf->Cell( 80,5,'VALOR AGREGADO Y DIFERENCIACI�N',1,0,'L');
		$pdf->Cell(120,5,'',1,1,'L');
		
		$pdf->SetX(5);
		$pdf->Cell( 80,5,'GARANT�A Y CALIDAD DEL PRODUCTO',1,0,'L');
		$pdf->Cell(120,5,'',1,1,'L');
		
		$pdf->SetX(5);
		$pdf->Cell( 80,5,'CALIDAD DEL SERVICIO',1,0,'L');
		$pdf->Cell(120,5,'',1,1,'L');
		
		$pdf->SetX(5);
		$pdf->Cell(140,5,'REPRESENTACI�N T�CNICA, LEGAL, OPERATIVA Y DE CONTINGENCIA',1,0,'L');
		$pdf->Cell( 25,5,'SI',1,0,'R');
		$pdf->Cell(  5,5,'',1,0,'L');
		$pdf->Cell( 25,5,'NO',1,0,'R');
		$pdf->Cell(  5,5,'',1,1,'L');
		
		$pdf->Ln(25);
		
		$pdf->SetX(5);
		$pdf->SetFillColor(213,247,172);
		$pdf->Cell(200,5,'5. DOCUMENTOS QUE ADJUNTA',1,1,'C',1);
		
		$pdf->SetX(5);
		$pdf->Cell(200,75,'',1,0,'C');
		
		$pdf->SetFont('Arial','B',8);
		$pdf->SetX(5);
		$pdf->Cell( 10,5,'Personas Naturales:',0,1,'L');
		
		$pdf->SetFont('Arial','',8);
		
		$pdf->SetX(5);
		$pdf->Cell( 10,5,'1',0,0,'C');
		$pdf->Cell(170,5,'Curriculum Vitae.',0,0,'L');
		$pdf->Cell( 5,5,'',1,1,'L');
		
		$pdf->SetX(5);
		$pdf->Cell( 10,5,'2',0,0,'C');
		$pdf->Cell(170,5,'Copia de RUC.',0,0,'L');
		$pdf->Cell( 5,5,'',1,1,'L');
		
		$pdf->SetX(5);
		$pdf->Cell( 10,5,'3',0,0,'C');
		$pdf->Cell(170,5,'Certificados comerciales.',0,0,'L');
		$pdf->Cell(  5,5,'',1,1,'L');
		
		$pdf->SetX(5);
		$pdf->Cell( 10,5,'4',0,0,'C');
		$pdf->Cell(170,5,'Copia de la c�dula de identidad y papeleta de votaci�n.',0,0,'L');
		$pdf->Cell(  5,5,'',1,1,'L');
		
		$pdf->SetFont('Arial','B',8);
		
		$pdf->SetX(5);
		$pdf->Cell( 10,5,'Personas Jur�dicas:',0,1,'L');
		
		$pdf->SetFont('Arial','',8);
		
		$pdf->SetX(5);
		$pdf->Cell( 10,5,'5',0,0,'C');
		$pdf->Cell(170,5,'Carta de presentaci�n de la empresa.',0,0,'L');
		$pdf->Cell(  5,5,'',1,1,'L');
		
		$pdf->SetX(5);
		$pdf->Cell( 10,5,'6',0,0,'C');
		$pdf->Cell(170,5,'Copia de RUC.',0,0,'L');
		$pdf->Cell(  5,5,'',1,1,'L');
		
		$pdf->SetX(5);
		$pdf->Cell( 10,5,'7',0,0,'C');
		$pdf->Cell(170,5,'Acta de constituci�n de la empresa o certificaci�n emitida por el organismo competente.',0,0,'L');
		$pdf->Cell(  5,5,'',1,1,'L');
		
		$pdf->SetX(5);
		$pdf->Cell( 10,5,'8',0,0,'C');
		$pdf->Cell(170,5,'Nombramiento del Representante Legal.',0,0,'L');
		$pdf->Cell(  5,5,'',1,1,'L');
		
		$pdf->SetX(5);
		$pdf->Cell( 10,5,'9',0,0,'C');
		$pdf->Cell(170,5,'Certificados comerciales.',0,0,'L');
		$pdf->Cell(  5,5,'',1,1,'L');
		
		$pdf->SetX(5);
		$pdf->Cell( 10,5,'10',0,0,'C');
		$pdf->Cell(170,5,'Resoluci�n de calificaci�n de SEPS.',0,0,'L');
		$pdf->Cell(  5,5,'',1,1,'L');
		
		$pdf->SetX(5);
		$pdf->Cell( 10,5,'11',0,0,'C');
		$pdf->Cell(170,5,'�ltima declaraci�n del impuesto a la renta.',0,0,'L');
		$pdf->Cell(  5,5,'',1,1,'L');
		
		$pdf->SetX(5);
		$pdf->Cell( 10,5,'12',0,0,'C');
		$pdf->Cell(170,5,'Estados Financieros al 31 de diciembre del a�o inmediato anterior.',0,1,'L');
		
		$pdf->SetX(5);
		$pdf->Cell(200,5,'***Todo documento ser� verificado, para lo que se tendr� el f�sico y el archivo en formato PDF.',1,1,'L');
		
		$pdf->Ln(5);
		
		$pdf->SetFont('Arial','B',8);
		
		$pdf->SetX(5);
		$pdf->Cell(200,5,'Declaraci�n de Responsabilidad',1,1,'L');
		
		$pdf->SetFont('Arial','',8);
		
		$pdf->SetX(5);
		$pdf->MultiCell(200,5,'Declaro que la informaci�n que consta en el presente formulario de inscripci�n y la documentaci�n que adjunto es veridica y la Cooperativa podr� verificarla en cualquier momento.',1,'L',0);
		
		$pdf->Ln(5);
		
		$pdf->SetX(5);
		$pdf->Cell(100,20,'',1,0,'L');
		$pdf->Cell(100,20,'',1,0,'L');
		
		$pdf->SetX(5);
		$pdf->Cell(100,5,'Nombre del Representante Legal',0,0,'L');
		$pdf->Cell(100,5,'Firma',0,1,'L');
		
		$pdf->Ln(15);
		/*
		foreach($users as $user)
		{
			$pdf->SetX(5);
			$pdf->Cell(15,5,$vordinal,1,0,'C');
			//$pdf->Cell(25,8,$user->idliga,1,0,'C');			
			$pdf->Cell(80,5,iconv('UTF-8', 'windows-1252',$user->varDescVariable),1,0,'L');
			$pdf->Cell(20,5,'',1,0,'L');
			$pdf->Cell(30,5,'',1,0,'L');
			$pdf->Cell(50,5,'',1,1,'L');
			$vordinal++;
		}
		*/
	}
/*
}
else
{
	$pdf->SetFillColor(213,247,172);
	$pdf->Cell(100,5,'ERROR: No puede generar un reporte sin iniciar sesi�n. De clic sobre esta �rea para volver.'.'('.Session::getUID().')',1,1,'C',1,'../index.php');
}
*/
$pdf->SetFont('Arial','B',12);
//$pdf->Multicell(0,8,'Total Variables: '.count($users));
$extras= SPUser::getBySQL("select now() as ahora from dual;");
$fimpresion=$extras->ahora;
$pdf->SetTextColor(0,0,255);
$pdf->SetFont('Arial','',8);
$pdf->Multicell(0,4,'Fecha de impresi�n: '.$fimpresion);
$pdf->SetTextColor(0,0,0);
$pdf->Output("FormularioInscripcion.pdf","I");
?>
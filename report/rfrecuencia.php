<?php
include "../core/controller/Database.php";
include "../core/controller/Executor.php";
include "../core/controller/Model.php";
include "../core/modules/index/model/CPProcesoData.php";
include "../core/modules/index/model/CPProcestadoData.php";
include "../core/modules/index/model/CPOrdenData.php";
include "../core/modules/index/model/CPRutaData.php";
include "../core/modules/index/model/CPFrecuenciaData.php";
include "../core/modules/index/model/CPRutaProcesoData.php";

require('fpdf.php');

class PDF extends FPDF
{
	// Cabecera de página
	function Header()
	{
		$nfrecuencia=$_GET["q"];
		$frecuencia= array();
		$frecuencia = CPFrecuenciaData::getById($nfrecuencia);
		if( isset($frecuencia) )
		{
			$alto=8;
			// Logo
			$this->Image('CodyxoPaper.png',10,8,40);
			$this->SetFont('Arial','B',12);
			$this->SetDrawColor(0,0,255);
			$this->SetY(7);
			$this->SetX(50);
			// Título
			$titulo='FRECUENCIA DE LOGÍSTICA:'.$nfrecuencia;
			$this->Cell(94,6,$titulo,0,1,'L');
			$this->SetX(45);
			$this->Cell(65,6,'Fecha:'.$frecuencia->fecha.' '.$frecuencia->hora,0,0,'C');
			$this->SetY(9);
			$this->SetX(108);
			$this->SetFont('Arial','B',7);
			$this->Cell(45,5,'DESTINO:',0,0,'C');
			$this->Cell(25,5,'MARCA/PLACA:',0,0,'C');
			$this->Cell(30,5,'CONDUCTOR:',0,1,'C');
			$this->SetX(108);
			$this->SetFont('Arial','',5);
			$this->Cell(45,5,$frecuencia->detalle,1,0,'C');
			$this->Cell(25,5,$frecuencia->marca.'-'.$frecuencia->placa,1,0,'C');
			$this->Cell(30,5,$frecuencia->nombre,1,0,'C');
			$this->Ln(12);
			$this->SetFont('Arial','B',7);
			$this->Line(0,21,297,21);
			$this->SetTextColor(0,0,255);
			$this->Cell(18,$alto,'PROCESO',1,0,'C');
			$this->Cell(14,$alto,'ENTREGA',1,0,'C');
			$this->Cell(7,$alto,'DIAS',1,0,'C');
			$this->Cell(80,$alto,'DIRECCION',1,0,'C');
			//$this->Cell(25,$alto,'CREACION',1,0,'C');
			$this->Cell(10,$alto,'CAJAS',1,0,'C');
			$this->Cell(10,$alto,'PAPEL',1,0,'C');
			$this->Cell(10,$alto,'SOBRE',1,0,'C');
			$this->Cell(10,$alto,'TOTAL',1,0,'C');
			$this->Cell(38,$alto,'FIRMA',1,0,'C');
			$this->SetTextColor(0,0,0);
			// Salto de línea
			$this->Ln(9);
		}
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

//Arreglos
$users= array();
$procesos= array();
$datosPCP=array();

$nfrecuencia=$_GET["q"];
$alto=40;
$alto2=3;
$altopie=20;
$control='';
$total=0;
// Subtotales
$scaja=0;
$spapel=0;
$ssobre=0;
// Totales
$tcaja=0;
$tpapel=0;
$tsobre=0;
// Para saltar procesos
$procesoanterior=0;
$numeroprocesos=0;
if( isset($nfrecuencia) )
{
	// Creación del objeto de la clase heredada
	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage('P');
	$pdf->SetFont('Arial','',8);
	$pdf->SetAuthor('Codyxo Paper Cía. Ltda.');
	$pdf->SetCreator('DGB Consultoría, Auditoría y Servicios en TI.');
	$pdf->SetTitle('Frecuencia'.$nfrecuencia);
	$pdf->SetSubject('Reporte SGP');
	$users = CPRutaProcesoData::getByFrecuenciaDestino($nfrecuencia);
	if(count($users)>0)
	{
		// Datos de la Frecuencia
		foreach($users as $user)
		{		
			// Para saltar repetidos
			if ($procesoanterior<>$user->proceso)
			{
				
				// Subtotales
				if ($total>0 and $destinoanterior<>$user->destino)
				{
					$pdf->Multicell(0,4,$destinoanterior);
					$pdf->Multicell(0,4,'Subtotal Cajas :'.$scaja);
					$pdf->Multicell(0,4,'Subtotal Papel :'.$spapel);
					$pdf->Multicell(0,4,'Subtotal Sobres:'.$ssobre);
					$scaja=0;
					$spapel=0;
					$ssobre=0;				
				}
				$pdf->SetFont('Arial','B',12);
				$pdf->Cell(18,$alto,$user->proceso,1,0,'C');
				// Procesos
				$sql = "select s.* from (select @vparametro:='$user->proceso' p) parm , repproceso s limit 1";
				$procesos = CPProcesoData::getBySQL($sql);
				foreach($procesos as $proceso)
				{
					$pdf->SetX(50);
					$posoriy=$pdf->GetY();
					$posy=$pdf->GetY();
					$pdf->SetFont('Arial','B',6);
					//$pdf->Multicell(79,3,$proceso->clieRAZONSOCIAL,0,'L');
					$pdf->Multicell(79,3,iconv('UTF-8', 'windows-1252', $proceso->clieRAZONSOCIAL),0,'L');
					$pdf->SetFont('Arial','',6);
					$pdf->SetX(50);
					//$pdf->Multicell(79,3,$user->destino,0,'L');
					$pdf->Multicell(79,3,iconv('UTF-8', 'windows-1252', $user->destino),0,'L');
					$pdf->SetX(50);
					//$pdf->Multicell(79,3,'Dirección: '.$proceso->clieCALLEP.' '.$proceso->clieCALLES,0,'L');
					$pdf->Multicell(79,3,'Dirección: '.iconv('UTF-8', 'windows-1252', $proceso->clieCALLEP).' '.iconv('UTF-8', 'windows-1252',$proceso->clieCALLES),0,'L');
					$pdf->SetX(50);
					$pdf->Cell(79,$alto2,'Teléfonos: '.$proceso->clieCELULAR.'/'.$proceso->clieFONO1.'-'.$proceso->clieEXT1.'/'.$proceso->clieFONO2.'-'.$proceso->clieEXT2,0,2,'L');
					$pdf->Multicell(79,3,'Horario:     '.$proceso->horario,0,'L');
					$pdf->SetX(50);
					$pdf->Multicell(79,3,'Recibe:      '.$proceso->recibe,0,'L');
					$pdf->SetX(50);
					$pdf->SetFont('Arial','B',6);
					//$pdf->Multicell(79,3,$proceso->observaciones,0,'L');
					$pdf->Multicell(79,3,iconv('UTF-8', 'windows-1252', $proceso->observaciones),0,'L');
					$pdf->SetFont('Arial','',6);
					// Estado días
					$sql = "select fechaentrega,diasentrega,TIMESTAMPDIFF(DAY,fechaentrega,CURDATE()) AS transcurrido from bztencped where idrelacion=$user->proceso";
					$extras= CPProcesoData::getBySQL($sql);
					foreach($extras as $extra)
					{
						$fechaentrega=$extra->fechaentrega;
						$transcurrido=$extra->transcurrido;
					}
				}
				$pdf->SetY($posoriy);
				$pdf->SetX(28);
				$pdf->SetFont('Arial','',6);
				$pdf->Cell(14,$alto,$fechaentrega,1,0,'C');
				if ( $transcurrido<0)
				{
					$control='A Tiempo';
					$pdf->SetTextColor(0,255,0);
					$control='+';
				}
				else
				{
					if ($transcurrido==0)
					{
						$control='Vence hoy';
						$pdf->SetTextColor(0,0,255);
					}
					else
					{
						$control='-';
						$pdf->SetTextColor(255,0,0);
					}
				}
				$pdf->Cell(7,$alto,$control.$transcurrido,1,0,'C');
				$pdf->SetTextColor(0,0,0);
				$pdf->Cell(80,$alto,'',1,0,'C');
				$pdf->Cell(10,$alto,$user->caja,1,0,'C');
				$pdf->Cell(10,$alto,$user->papel,1,0,'C');
				$pdf->Cell(10,$alto,$user->sobre,1,0,'C');
				$scaja=$scaja+$user->caja;
				$spapel=$spapel+$user->papel;
				$ssobre=$ssobre+$user->sobre;
				$total=$user->caja+$user->papel+$user->sobre;
				//Totales
				$tcaja+=$user->caja;
				$tpapel+=$user->papel;
				$tsobre+=$user->sobre;
				
				$pdf->Cell(10,$alto,$total,1,0,'C');
				$pdf->Cell(38,$alto,'',1,1,'C');
				// Cambio
				$destinoanterior=$user->destino;
				$procesoanterior=$user->proceso;
				$numeroprocesos+=1;	
			}
		}
		$pdf->Multicell(0,4,$destinoanterior);
		$pdf->Multicell(0,4,'Subtotal Cajas :'.$scaja);
		$pdf->Multicell(0,4,'Subtotal Papel :'.$spapel);
		$pdf->Multicell(0,4,'Subtotal Sobres:'.$ssobre);
	}
	
	$pdf->SetFont('Arial','B',8);
	$pdf->Multicell(0,4,'TOTAL PROCESOS: '.$numeroprocesos);
	
	$pdf->Multicell(0,4,'Total Cajas :'.$tcaja);
	$pdf->Multicell(0,4,'Total Papel :'.$tpapel);
	$pdf->Multicell(0,4,'Total Sobres:'.$tsobre);
	
	$tmercaderia=$tcaja+$tpapel+$tsobre;
	$pdf->Multicell(0,4,'Total Mercaderia Enviada :'.$tmercaderia);
	
	$sql = "select now() as ahora from dual";
	$extras= CPProcesoData::getBySQL($sql);
	foreach($extras as $extra) { $fimpresion=$extra->ahora;	}
	$pdf->Multicell(0,4,'Fecha de impresión: '.$fimpresion);
	$pdf->SetFont('Arial','B',6);
	//Firmas
	$pdf->Cell(65,5,'Autorización Salida del Producto:',1,0,'C');
	$pdf->Cell(65,5,'Autorización Salida del Embarque:',1,0,'C');
	$pdf->Cell(65,5,'Facturador:',1,1,'C');
	$pdf->Cell(65,$altopie,'',1,0);
	$pdf->Cell(65,$altopie,'',1,0);
	$pdf->Cell(65,$altopie,'',1,1);
	$pdf->Cell(65,-5,'JEFE DE BODEGA.',0,0,'C');
	$pdf->Cell(65,-5,'JEFE DE LOGISTICA.',0,0,'C');
	$pdf->Cell(65,-5,'',0,1,'C');
	$pdf->Ln(10);
	$pdf->Cell(65,5,'Verificador:',1,0,'C');
	$pdf->Cell(65,5,'Aceptación Transportista:',1,0,'C');
	$pdf->Cell(65,5,'Etiquetador:',1,1,'C');
	$pdf->Cell(65,$altopie,'',1,0);
	$pdf->Cell(65,$altopie,'',1,0);
	$pdf->Cell(65,$altopie,'',1,1);
	$pdf->Cell(65,-5,'',0,0,'C');
	$pdf->Cell(65,-5,'',0,0,'C');
	$pdf->Cell(65,-5,'',0,1,'C');

}

$pdf->Output("Frecuencia".$nfrecuencia.".pdf","I");
?>
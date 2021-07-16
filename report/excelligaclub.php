<?php 
require_once 'functions/excel.php';

activeErrorReporting();
noCli();

require_once '/PHPExcel.php';
require_once 'functions/conexion.php';
require_once 'functions/getAllJugadores.php';

$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator("DGB Consultoria Auditoria y Servicios en TI")
               ->setLastModifiedBy("Ing. Daniel Guerron Benalcazar. MGS.")
               ->setTitle("Reporte de Jugadores Excel")
               ->setSubject("Exportacion de Datos - Jugadores")
               ->setDescription("Listado de Jugadores para ASOLIGAS")
               ->setKeywords("Formato Office 2007 openxml php")
               ->setCategory("Reportes SysPlay");
$objPHPExcel->getDefaultStyle()->getFont()->setName('Arial')->setSize(10);             

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'CODIGO')
            ->setCellValue('B1', 'TIPO')
            ->setCellValue('C1', 'IDENTIFICACION')
			->setCellValue('D1', 'NOMBRES')
			->setCellValue('E1', 'APELLIDOS')
			->setCellValue('F1', 'NACIMIENTO')
			->setCellValue('G1', 'LUGAR')
			->setCellValue('H1', 'GENERO')
			->setCellValue('I1', 'ETNIA')
			->setCellValue('J1', 'LIGA')
			->setCellValue('K1', 'CLUB')
			->setCellValue('L1', 'OBSERVACION')
			->setCellValue('M1', 'FICHAJE')
			->setCellValue('N1', 'ACTIVO');
			
$nfrecuencia=$_GET["q"];
if( isset($nfrecuencia) )
{
	$informe = array();
	$row = array();
	$informe = getAllJugadores($nfrecuencia);
	$i = 2;
	$blanco='';
	if (count($informe)>0)
	{
		while($row = $informe->fetch_array(MYSQLI_ASSOC))
		{			
			$vcodi=$row['codigoJugador'];
			$vtipo=$row['DesTipo'];
			$videntificacion=$row['identificacion'];
			$vnombres=$row['nombres'];
			$vapellidos=$row['apellidos'];
			$vnacimiento=$row['nacimiento'];
			$vlugar=$row['lugar'];
			$vgenero=$row['DesGenero'];
			$vetnia=$row['DesEtnia'];
			$vliga=$row['DesLiga'];
			$vclub=$row['DesClub'];
			$vobservacion=$row['observacion'];
			$vfichaje=$row['fichaje'];
			$vactivo=$row['activo'];
			if ($vactivo=='1')
			{
				$vactivo='Activo';
			}
			else
				$vactivo='Inactivo';
			
			$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue("A$i", $vcodi)
				->setCellValue("B$i", $vtipo)
				->setCellValue("C$i", $videntificacion)
				->setCellValue("D$i", $vnombres)
				->setCellValue("E$i", $vapellidos)
				->setCellValue("F$i", $vnacimiento)
				->setCellValue("G$i", $vlugar)
				->setCellValue("H$i", $vgenero)
				->setCellValue("I$i", $vetnia)
				->setCellValue("J$i", $vliga)
				->setCellValue("K$i", $vclub)
				->setCellValue("L$i", $vobservacion)
				->setCellValue("M$i", $vfichaje)
				->setCellValue("N$i", $vactivo);
			$i++;
		}
				
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
	}	
}

$objPHPExcel->getActiveSheet()->setTitle('Listado de Jugadores '.$nfrecuencia);
$objPHPExcel->setActiveSheetIndex(0);
getHeaders($nfrecuencia);
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
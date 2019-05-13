<?php
/**
 * PHPExcel
 *
 * Copyright (C) 2006 - 2014 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2014 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    1.8.0, 2014-03-02
 */

/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('America/Mexico_City');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once dirname(__FILE__) . '/../plugins/excel/PHPExcel.php';

require_once("../common/classGestor.php");
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

$datos= new gestor();
$fecha1=$_POST['fecha1'];
$fecha2=$_POST['fecha2'];

// Set document properties
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");

//combina celdas}
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:I1');
// Add some data
$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A1', 'REPORTE MENSUAL GESTOR DE DOCUMENTOS')//Titulo del reporte
			->setCellValue('A2', 'AREA')//Titulo de columnas
			->setCellValue('B2', 'USUARIO')
			->setCellValue('C2', 'LOGIN')
			->setCellValue('D2', 'MODIFICACION')
			->setCellValue('E2', 'FECHA DE REGISTRO')
			->setCellValue('F2', 'FECHA DE INICIO')
			->setCellValue('G2', 'FECHA DE FIN')
			->setCellValue('H2', 'OBSERVACIONES')
			->setCellValue('I2', 'STATUS');

// Fuente de la primera fila en negrita
$boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));

$objPHPExcel->getActiveSheet()->getStyle('A1:I2')->applyFromArray($boldArray);

//Ancho de las columnas
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(TRUE);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(TRUE);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(TRUE);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(TRUE);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(TRUE);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(TRUE);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(TRUE);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(TRUE);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(TRUE);

			$info=3; //Numero de fila donde se va a empezar a rellenar

			$datos=$datos->getReporte($_POST);

			foreach ($datos->datos as $key => $value){

				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$info, $value['0'])
							->setCellValue('B'.$info, $value['1'])
							->setCellValue('C'.$info, $value['2'])
							->setCellValue('D'.$info, $value['3'])
							->setCellValue('E'.$info, $value['4'])
							->setCellValue('F'.$info, $value['5'])
							->setCellValue('G'.$info, $value['6'])
							->setCellValue('H'.$info, $value['7'])
							->setCellValue('I'.$info, $value['8']);

			$info+=1;
			}

$estiloInformacion = new PHPExcel_Style();
		$estiloInformacion->applyFromArray(
			array(
				'font' => array(
				'name'      => 'Arial',
					'color'     => array(
						'rgb' => '000000'
				)
			),
				'fill' 	=> array(
				'type'		=> PHPExcel_Style_Fill::FILL_SOLID,
				'color'		=> array('argb' => 'FFd9b7f4')
			),
				'borders' => array(
				'left'     => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN ,
					'color' => array(
						'rgb' => '3a2a47'
					)
				)
			)
		));

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Reporte de Avisos');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Reporte.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
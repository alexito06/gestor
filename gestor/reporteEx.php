<?php
require_once ("../plugins/excel/PHPExcel.php");
//require_once("../common/classGestor.php");

//$fecha1=$_POST['fecha1'];
//$fecha2=$_POST['fecha2'];

$_POST['desEx']='hola';

if (isset($_POST['desEx']));
//$gestor = new gestor();
//$datos = $gestor->getReporte($_POST);
$objPHPExcel = new PHPExcel();


$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:I1');
//Se agregan los titulos del reporte
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
//Se agregan los datos de las columnas
		while($rows = $resultado->fetch_assoc(getReporte)){
		
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$fila, $rows['area']);
		$objPHPExcel->getActiveSheet()->setCellValue('B'.$fila, $rows['usuario']);
		$objPHPExcel->getActiveSheet()->setCellValue('C'.$fila, $rows['login']);
		$objPHPExcel->getActiveSheet()->setCellValue('D'.$fila, $rows['modificacion']);
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$fila, $rows['fc_reg']);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$fila, $rows['fc_ini']);
		$objPHPExcel->getActiveSheet()->setCellValue('G'.$fila, $rows['fc_fin']);
		$objPHPExcel->getActiveSheet()->setCellValue('H'.$fila, $rows['observaciones']);
		$objPHPExcel->getActiveSheet()->setCellValue('I'.$fila, $rows['estado']);
		
		$fila++; //Sumamos 1 para pasar a la siguiente fila
	}
			/*$i=3; //Numero de fila donde se va a empezar a rellenar
			if($datos){ //Si hay datos recorremos el arreglo

			foreach($datos as $key=>$val){
				
				}
			//while ($datos = $resultado->fetch_array()){
			$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$i, $datos['area'])
            ->setCellValue('B'.$i, $datos['usuario'])
            ->setCellValue('C'.$i, $datos['login'])
            ->setCellValue('D'.$i, $datos['modificacion'])
			->setCellValue('E'.$i, $datos['fc_reg'])
			->setCellValue('F'.$i, $datos['fc_ini'])
			->setCellValue('G'.$i, $datos['fc_fin'])
			->setCellValue('H'.$i, $datos['observaciones'])
			->setCellValue('I'.$i, $datos['estado']);
			
			$i+=1;
			}*/

//Se agrega el ancho de columna automatico
for($i = 'A'; $i <= 'I'; $i++){
    $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($i)->setAutoSize(TRUE);
}

// Fuente de la primera fila en negrita
$boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));

$objPHPExcel->getActiveSheet()->getStyle('A1:I2')->applyFromArray($boldArray);


			//$rango="A2:$i";
			$styleArray = array('font' => array( 'name' => 'Arial','size' => 10),
			'borders'=>array('allborders'=>array('style'=> PHPExcel_Style_Border::BORDER_THIN,'color'=>array('argb' => 'FFF')))
			);
			//$objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($styleArray);
			// Cambiar el nombre de hoja de cálculo
			$objPHPExcel->getActiveSheet()->setTitle('Reporte Mensual');
			// Establecer índice de hoja activa a la primera hoja , por lo que Excel abre esto como la primera hoja
			$objPHPExcel->setActiveSheetIndex(0);

			// Se manda el archivo al navegador web, con el nombre que se indica (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Reporte_Fechado.xlsx"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;
		

?>
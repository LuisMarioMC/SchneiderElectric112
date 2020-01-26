<!DOCTYPE html>
<html>
<head>
	<title>Leer Archivo Excel</title>
</head>
<body>
<h1>Leer Archivo Excel</h1>
<?php
require_once 'extras/phpexcel-1.8.1/Classes/PHPExcel.php';
$archivo = "subida_reporte_ventas/libro1.xlsx";
$inputFileType = PHPExcel_IOFactory::identify($archivo);
$objReader = PHPExcel_IOFactory::createReader($inputFileType);
$objPHPExcel = $objReader->load($archivo);
$sheet = $objPHPExcel->getSheet(0); 
$highestRow = $sheet->getHighestRow(); 
$highestColumn = $sheet->getHighestColumn();

for ($row = 2; $row <= $highestRow; $row++)
{ 
 $a = $sheet->getCell("A".$row)->getValue();
 $b = $sheet->getCell("B".$row)->getValue();
 $c = $sheet->getCell("C".$row)->getValue();
 echo ''.$a.'-'.$b.'-'.$c.'<br>';
}
?>
</body>
</html>

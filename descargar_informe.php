<?php
 session_start();
 
 if(!isset($_SESSION['acceso']))
 {
  session_destroy();
  header('Location: index.php');
  die;
 }
 
 // Realiza la conexión a la base de datos
 //require_once ('conexion.php');
 require_once ('conexion_sesion.php');
  
 // Mostrar Hora Servidor
 date_default_timezone_set("America/Bogota");
 
 /** Incluir la libreria PHPExcel */
 require_once 'extras/phpexcel-1.8.1/Classes/PHPExcel.php';

 $fecha_inicial = !empty($_GET['fecha_inicial'])? $_GET['fecha_inicial']:0;
 $fecha_final = !empty($_GET['fecha_inicial'])? $_GET['fecha_final']:0;

 $perfil = $_SESSION['perfil'];
 $id_usuario = $_SESSION['usuario'];
 
 // Crea un nuevo objeto PHPExcel
 $objPHPExcel = new PHPExcel();

 // Establecer propiedades
 $objPHPExcel->getProperties()
 ->setCreator("Experience Intel")
 ->setLastModifiedBy("FFH LatOne")
 ->setTitle("Informe")
 ->setSubject("Informe")
 ->setDescription("Informe")
 ->setKeywords("Informe")
 ->setCategory("Informe");
 
  // Agregar Informacion
 $objPHPExcel->getActiveSheet()->getStyle('A1:S1')->getFont()->setBold(true);
 $objPHPExcel->getActiveSheet()->getStyle('A1:S1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
   
 $objPHPExcel->setActiveSheetIndex(0)
 ->setCellValue('A1', 'Factura')
 ->setCellValue('B1', 'Fecha Venta')
 ->setCellValue('C1', 'Producto')
 ->setCellValue('D1', 'Actividad')
 ->setCellValue('E1', 'Linea')
 ->setCellValue('F1', 'Unidades')
 ->setCellValue('G1', 'Precio')
 ->setCellValue('H1', 'TaxID Cliente')
 ->setCellValue('I1', 'Nombre Cliente')
 ->setCellValue('J1', 'Telefono Cliente')
 ->setCellValue('K1', 'Email Cliente')
 ->setCellValue('L1', 'Segmento')
 ->setCellValue('M1', 'Ciudad')
 ->setCellValue('N1', 'Departamento')
 ->setCellValue('O1', 'Zona')
 ->setCellValue('P1', 'Pais')
 ->setCellValue('Q1', 'Distribuidor')
 ->setCellValue('R1', 'Vendedor')
 ->setCellValue('S1', 'E Commerce');
 
 $i = 2;
 
 if($perfil == 'canal')
 {
  $consulta_usuario = mysqli_query($conexion,"select * from usuario where id = $id_usuario");
  $resultado_consulta_usuario = mysqli_fetch_array($consulta_usuario);
  $id_pais = $resultado_consulta_usuario[pais];
  $consulta_venta = mysqli_query($conexion,"select * from detalle_sell_out where date_fecha_venta between '$fecha_inicial' and '$fecha_final' and id_pais = '$id_pais'");
 }
 if($perfil == 'cartera')
 {
  $consulta_venta = mysqli_query($conexion,"select * from detalle_sell_out where date_fecha_venta between '$fecha_inicial' and '$fecha_final'"); 
 }
 if($perfil == 'distribuidor')
 {
  $consulta_venta = mysqli_query($conexion,"select * from detalle_sell_out where date_fecha_venta between '$fecha_inicial' and '$fecha_final' and id_distribuidor = '$id_usuario'"); 
 }
 if($perfil == 'linea')
 {
  $consulta_usuario = mysqli_query($conexion,"select * from usuario where id = $id_usuario");
  $resultado_consulta_usuario = mysqli_fetch_array($consulta_usuario);
  $id_linea = $resultado_consulta_usuario[linea];
  $consulta_venta = mysqli_query($conexion,"select * from detalle_sell_out where date_fecha_venta between '$fecha_inicial' and '$fecha_final' and id_linea = '$id_linea'"); 
 }
 if($perfil == 'vendedor')
 {
  $consulta_venta = mysqli_query($conexion,"select * from detalle_sell_out where date_fecha_venta between '$fecha_inicial' and '$fecha_final' and id_vendedor = '$id_usuario'"); 
 }

 
 // Inserto el Contenido
 while($resultado_consulta_venta = mysqli_fetch_array($consulta_venta))
 { 
  $factura = $resultado_consulta_venta['factura'];
  $fecha_venta = $resultado_consulta_venta['fecha_venta'];
  $producto = $resultado_consulta_venta['producto'];
  
  $id_actividad = $resultado_consulta_venta['id_actividad'];
  $consulta_actividad = mysqli_query($conexion,"select nombre from actividad where id = $id_actividad");
  $resultado_consulta_actividad = mysqli_fetch_array($consulta_actividad);
  $actividad = $resultado_consulta_actividad[nombre];
  
  $id_linea = $resultado_consulta_venta['id_linea'];
  $consulta_linea = mysqli_query($conexion,"select nombre from linea where id = $id_linea");
  $resultado_consulta_linea = mysqli_fetch_array($consulta_linea);
  $linea = $resultado_consulta_linea[nombre];
  
  $unidades = $resultado_consulta_venta['unidades'];
  $precio = $resultado_consulta_venta['precio'];
  $taxid_cliente = $resultado_consulta_venta['taxid_cliente'];
  $nombre_cliente = $resultado_consulta_venta['nombre_cliente'];
  $telefono_cliente = $resultado_consulta_venta['telefono_cliente'];
  $email_cliente = $resultado_consulta_venta['email_cliente'];
  $segmento = $resultado_consulta_venta['segmento'];
  
  $id_ciudad = $resultado_consulta_venta['id_ciudad'];
  $consulta_ciudad = mysqli_query($conexion,"select nombre from ciudad where id = $id_ciudad");
  $resultado_consulta_ciudad = mysqli_fetch_array($consulta_ciudad);
  $ciudad = $resultado_consulta_ciudad[nombre];

  $id_departamento = $resultado_consulta_venta['id_departamento'];
  $consulta_departamento = mysqli_query($conexion,"select nombre from departamento where id = $id_departamento");
  $resultado_consulta_departamento = mysqli_fetch_array($consulta_departamento);
  $departamento = $resultado_consulta_departamento[nombre];
  
  $id_zona = $resultado_consulta_venta['id_zona'];
  $consulta_zona = mysqli_query($conexion,"select nombre from zona where id = $id_zona");
  $resultado_consulta_zona = mysqli_fetch_array($consulta_zona);
  $zona = $resultado_consulta_zona[nombre];
  
  $id_pais = $resultado_consulta_venta['id_pais'];
  $consulta_pais = mysqli_query($conexion,"select nombre from pais where id = $id_pais");
  $resultado_consulta_pais = mysqli_fetch_array($consulta_pais);
  $pais = $resultado_consulta_pais[nombre];
  
  $id_distribuidor = $resultado_consulta_venta['id_distribuidor'];
  $consulta_distribuidor = mysqli_query($conexion,"select nombre from usuario where id = $id_distribuidor");
  $resultado_consulta_distribuidor = mysqli_fetch_array($consulta_distribuidor);
  $distribuidor = $resultado_consulta_distribuidor[nombre];
  
  $id_vendedor = $resultado_consulta_venta['id_vendedor'];
  $consulta_vendedor = mysqli_query($conexion,"select nombre from usuario where id = $id_vendedor");
  $resultado_consulta_vendedor = mysqli_fetch_array($consulta_vendedor);
  $vendedor = $resultado_consulta_vendedor[nombre];

  if($resultado_consulta_venta['e-commerce']=='')
  {
   $e_commerce = 'NO';
  }
  else
  {
   $e_commerce = $resultado_consulta_venta['e-commerce'];
  }
  
  //$objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(250);
   
  $objPHPExcel->getActiveSheet() ->setCellValue('A' . $i, $factura)
                                 ->setCellValue('B' . $i, $fecha_venta)
                                 ->setCellValue('C' . $i, $producto)
                                 ->setCellValue('D' . $i, $actividad)
                                 ->setCellValue('E' . $i, $linea)
                                 ->setCellValue('F' . $i, $unidades)
                                 ->setCellValue('G' . $i, $precio)
                                 ->setCellValue('H' . $i, $taxid_cliente)
                                 ->setCellValue('I' . $i, $nombre_cliente)
								 ->setCellValue('J' . $i, $telefono_cliente)
								 ->setCellValue('K' . $i, $email_cliente)
								 ->setCellValue('L' . $i, $segmento)
								 ->setCellValue('M' . $i, $ciudad)
								 ->setCellValue('N' . $i, $departamento)
								 ->setCellValue('O' . $i, $zona)
								 ->setCellValue('P' . $i, $pais)
								 ->setCellValue('Q' . $i, $distribuidor)							 
								 ->setCellValue('R' . $i, $vendedor)
								 ->setCellValue('S' . $i, $e_commerce);
  $i++;
 }
 
 $objPHPExcel->getActiveSheet()->getStyle('A1:R1000')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
 
 $objPHPExcel->getActiveSheet()->getColumnDimension("A")->setAutoSize(true);
 $objPHPExcel->getActiveSheet()->getColumnDimension("B")->setAutoSize(true);
 //$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(28);	
 $objPHPExcel->getActiveSheet()->getColumnDimension("C")->setAutoSize(true); 
 $objPHPExcel->getActiveSheet()->getColumnDimension("D")->setAutoSize(true);
 $objPHPExcel->getActiveSheet()->getColumnDimension("E")->setAutoSize(true);
 $objPHPExcel->getActiveSheet()->getColumnDimension("F")->setAutoSize(true);
 $objPHPExcel->getActiveSheet()->getColumnDimension("G")->setAutoSize(true);
 $objPHPExcel->getActiveSheet()->getColumnDimension("H")->setAutoSize(true);
 $objPHPExcel->getActiveSheet()->getColumnDimension("I")->setAutoSize(true); 
 $objPHPExcel->getActiveSheet()->getColumnDimension("J")->setAutoSize(true);
 $objPHPExcel->getActiveSheet()->getColumnDimension("K")->setAutoSize(true);
 $objPHPExcel->getActiveSheet()->getColumnDimension("L")->setAutoSize(true);
 $objPHPExcel->getActiveSheet()->getColumnDimension("M")->setAutoSize(true);
 $objPHPExcel->getActiveSheet()->getColumnDimension("N")->setAutoSize(true);
 $objPHPExcel->getActiveSheet()->getColumnDimension("O")->setAutoSize(true);
 $objPHPExcel->getActiveSheet()->getColumnDimension("P")->setAutoSize(true);
 $objPHPExcel->getActiveSheet()->getColumnDimension("Q")->setAutoSize(true);
 $objPHPExcel->getActiveSheet()->getColumnDimension("R")->setAutoSize(true);
 $objPHPExcel->getActiveSheet()->getColumnDimension("S")->setAutoSize(true);

 $objPHPExcel->getActiveSheet()->getStyle('A2:S5000')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

 // Renombrar Hoja
 $objPHPExcel->getActiveSheet()->setTitle('Informe');

 // Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
 $objPHPExcel->setActiveSheetIndex(0);

 header("Content-type: application/vnd.ms-excel"); 
 // Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
 header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

 $titulo_componente = 'Informe Ventas';
 $fecha = date('Y-m-j H:i:s');
 header("Content-Disposition: attachment;filename=\"".$titulo_componente." ".$fecha_inicial." - ".$fecha_final." (".$fecha.").xlsx\";");
 header('Cache-Control: max-age=0');
 $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
 $objWriter->save('php://output');
 exit;
 
?>
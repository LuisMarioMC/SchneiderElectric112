<?php
 
 // Realiza la conexión a la base de datos
 require_once ('conexion_sesion.php');

 $perfil = $_SESSION['perfil'];
 
 if($perfil != 'admin_schneider' && $perfil != 'super_schneider')
 {
  $mensaje = 666;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }

 $id_anio = 0;
 $id_periodo = 0;
 $id_mes = 0;
 $id_distribuidor = 0;
 $id_linea = 0;
 $id_actividad = 0;
 $id_pais = 0;   
 $id_zona = 0;
 $id_segmento = 0;
 
 $id_anio = !empty($_GET['id_anio'])? $_GET['id_anio']:0;
 $id_periodo = !empty($_GET['id_periodo'])? $_GET['id_periodo']:0;
 $id_mes = !empty($_GET['id_mes'])? $_GET['id_mes']:0;
 $id_distribuidor = !empty($_GET['id_distribuidor'])? $_GET['id_distribuidor']:0;
 $id_linea = !empty($_GET['id_linea'])? $_GET['id_linea']:0;
 $id_actividad = !empty($_GET['id_actividad'])? $_GET['id_actividad']:0;
 $id_pais = !empty($_GET['id_pais'])? $_GET['id_pais']:0;
 $id_zona = !empty($_GET['id_zona'])? $_GET['id_zona']:0;
 $id_segmento = !empty($_GET['id_segmento'])? $_GET['id_segmento']:0;

 $registros = 0;
 $filtros = 'FILTROS = ';
 
 // Mostrar Hora Servidor
 date_default_timezone_set("America/Bogota");
 
 /** Incluir la libreria PHPExcel */
 require_once 'extras/phpexcel-1.8.1/Classes/PHPExcel.php';
 
 // Crea un nuevo objeto PHPExcel
 $objPHPExcel = new PHPExcel();

 // Establecer propiedades
 $objPHPExcel->getProperties()
 ->setCreator("Schneider Electric")
 ->setLastModifiedBy("Schneider Electric")
 ->setTitle("Informe Schneider Electric")
 ->setSubject("Informe Schneider Electric")
 ->setDescription("Informe Schneider Electric")
 ->setKeywords("Informe Schneider Electric")
 ->setCategory("Informe Schneider Electric");

 if($id_anio != 0)
 {
  // Agregar Informacion
  $objPHPExcel->getActiveSheet()->getStyle('A1:V2')->getFont()->setBold(true);
  $objPHPExcel->getActiveSheet()->getStyle('A2:V2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

  $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:V1');
  $objPHPExcel->getActiveSheet()->getStyle('A1:V1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
  
  $objPHPExcel->setActiveSheetIndex(0)
  ->setCellValue('A1', $filtros)
  ->setCellValue('A2', 'Distribuidor')
  ->setCellValue('B2', 'Anio')
  ->setCellValue('C2', 'Periodo')
  ->setCellValue('D2', 'Mes')
  ->setCellValue('E2', 'Factura')
  ->setCellValue('F2', 'Fecha Venta')
  ->setCellValue('G2', 'Producto')
  ->setCellValue('H2', 'Linea')
  ->setCellValue('I2', 'Actividad')
  ->setCellValue('J2', 'Unidades')
  ->setCellValue('K2', 'Precio')
  ->setCellValue('L2', 'Tax ID')
  ->setCellValue('M2', 'Nombre Cliente')
  ->setCellValue('N2', 'Telefono Cliente')
  ->setCellValue('O2', 'Email Cliente')
  ->setCellValue('P2', 'Segmento Cliente')
  ->setCellValue('Q2', 'Pais')
  ->setCellValue('R2', 'Zona')
  ->setCellValue('S2', 'Departamento')
  ->setCellValue('T2', 'Ciudad')
  ->setCellValue('U2', 'Id Vendedor')
  ->setCellValue('V2', 'E-Commerce');
  
  $i = 3;
   
  $consulta = '';
	   		        
  $consulta = 'select * from detalle_sell_out where id_anio = '.$id_anio.' and estado = "1" ';

  $consulta_anio = mysqli_query($conexion,"select * from anio where id = '$id_anio'");
  $resultado_consulta_anio = mysqli_fetch_array($consulta_anio);
  $nombre_anio = $resultado_consulta_anio[nombre];
  $filtros .= 'Anio: '.$nombre_anio.' ';
  
  if($id_distribuidor != 0)
  {
   $consulta .= 'and id_distribuidor = '.$id_distribuidor.' ';
  
   $consulta_distribuidor = mysqli_query($conexion,"select * from usuario where id = '$id_distribuidor'");
   $resultado_consulta_distribuidor = mysqli_fetch_array($consulta_distribuidor);
   $nombre_distribuidor = $resultado_consulta_distribuidor[nombre];	  
   $filtros .= '- Distribuidor: '.$nombre_distribuidor.' ';
  }
  
  if($id_linea != 0)
  {
   $consulta .= 'and id_linea = '.$id_linea.' ';

   $consulta_linea = mysqli_query($conexion,"select * from linea where id = '$id_linea'");
   $resultado_consulta_linea = mysqli_fetch_array($consulta_linea);
   $nombre_linea = $resultado_consulta_linea[nombre];
   $filtros .= '- Linea: '.$nombre_linea.' ';
  }

  if($id_actividad != 0)
  {
   $consulta .= 'and id_actividad = '.$id_actividad.' ';

   $consulta_actividad = mysqli_query($conexion,"select * from actividad where id = '$id_actividad'");
   $resultado_consulta_actividad = mysqli_fetch_array($consulta_actividad);
   $nombre_actividad = $resultado_consulta_actividad[nombre];	  
   $filtros .= '- Actividad: '.$nombre_actividad.' ';
  }
	
  if($id_periodo != 0)	
  {
   if($id_periodo == 1) { $nombre_periodo = 'Q1'; }
   if($id_periodo == 2) { $nombre_periodo = 'Q2'; }
   if($id_periodo == 3) { $nombre_periodo = 'Q3'; }
   if($id_periodo == 4) { $nombre_periodo = 'Q4'; }
   
   $filtros .= '- Periodo: '.$nombre_periodo.' ';	  
   if($id_periodo == 1)
   {
	$consulta_q = mysqli_query($conexion,"select * from q where anio = '$id_anio' and nombre = 'Q1'");
   }
   if($id_periodo == 2)
   {
	$consulta_q = mysqli_query($conexion,"select * from q where anio = '$id_anio' and nombre = 'Q2'");
   }
   if($id_periodo == 3)
   {
	$consulta_q = mysqli_query($conexion,"select * from q where anio = '$id_anio' and nombre = 'Q3'");
   }
   if($id_periodo == 4)
   {
	$consulta_q = mysqli_query($conexion,"select * from q where anio = '$id_anio' and nombre = 'Q4'");
   }
   $resultado_consulta_q = mysqli_fetch_array($consulta_q);
   $id_q = $resultado_consulta_q['id'];

   $consulta .= 'and id_q = '.$id_q.' '; 
  } 
	 	 
  if($id_mes != 0)
  {
   $consulta_mes = mysqli_query($conexion,"select * from mes where mes = '$id_mes'");
   $resultado_consulta_mes = mysqli_fetch_array($consulta_mes);
   $nombre_mes = $resultado_consulta_mes[nombre];
   $filtros .= '- Mes: '.$nombre_mes.' ';
	  	  
   $consulta_mes = mysqli_query($conexion,"select * from mes where anio = '$id_anio' and q = '$id_q' and mes = '$id_mes'");
   $resultado_consulta_mes = mysqli_fetch_array($consulta_mes);
   $id_mes_f = $resultado_consulta_mes['id'];

   $consulta .= 'and id_mes = '.$id_mes_f.' ';   
  }
	 
  if($id_pais != 0)
  {
   $consulta .= 'and id_pais = '.$id_pais.' ';
   
   $consulta_pais = mysqli_query($conexion,"select * from pais where id = '$id_pais'");
   $resultado_consulta_pais = mysqli_fetch_array($consulta_pais);
   $nombre_pais = $resultado_consulta_pais[nombre];	  
   $filtros .= '- Pais: '.$nombre_pais.' ';
  }
	
  if($id_zona != 0)
  {
   $consulta .= 'and id_zona = '.$id_zona.' ';
  
   $consulta_zona = mysqli_query($conexion,"select * from zona where id = '$id_zona'");
   $resultado_consulta_zona = mysqli_fetch_array($consulta_zona);
   $nombre_zona = $resultado_consulta_zona[nombre];	  
   $filtros .= '- Zona: '.$nombre_zona.' ';
  }
	 
  if($id_segmento != 0)
  {
   $consulta .= 'and id_segmento = '.$id_segmento.' ';
   
   $consulta_segmento = mysqli_query($conexion,"select * from segmento where id = '$id_segmento'");
   $resultado_consulta_segmento = mysqli_fetch_array($consulta_segmento);
   $nombre_segmento = $resultado_consulta_segmento[nombre];
   $filtros .= '- Segmento: '.$nombre_segmento.' ';
  }

  //$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', $consulta);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', $filtros);
 
  $consulta_sell_out = mysqli_query($conexion,$consulta);	   	   
  
  while($resultado_consulta_sell_out = mysqli_fetch_array($consulta_sell_out))
  {
   $id_distribuidor = $resultado_consulta_sell_out[id_distribuidor];
   $consulta_distribuidor = mysqli_query($conexion,"select nombre from usuario where id = '$id_distribuidor'");
   $resultado_consulta_distribuidor = mysqli_fetch_array($consulta_distribuidor);
   $distribuidor = $resultado_consulta_distribuidor[nombre];
   
   $id_anio = $resultado_consulta_sell_out[id_anio];
   $consulta_anio = mysqli_query($conexion,"select nombre from anio where id = '$id_anio'");
   $resultado_consulta_anio = mysqli_fetch_array($consulta_anio);
   $anio = $resultado_consulta_anio[nombre];
   
   $id_periodo = $resultado_consulta_sell_out[id_q];
   $consulta_periodo = mysqli_query($conexion,"select nombre from q where id = '$id_periodo'");
   $resultado_consulta_periodo = mysqli_fetch_array($consulta_periodo);
   $periodo = $resultado_consulta_periodo[nombre];
   
   $id_mes = $resultado_consulta_sell_out[id_mes];
   $consulta_mes = mysqli_query($conexion,"select nombre from mes where id = '$id_mes'");
   $resultado_consulta_mes = mysqli_fetch_array($consulta_mes);
   $mes = $resultado_consulta_mes[nombre];

   $factura = $resultado_consulta_sell_out[factura];
   $fecha_venta = $resultado_consulta_sell_out[fecha_venta];
   $producto = $resultado_consulta_sell_out[producto];
   
   $id_linea = $resultado_consulta_sell_out[id_linea];
   $consulta_linea = mysqli_query($conexion,"select nombre from linea where id = '$id_linea'");
   $resultado_consulta_linea = mysqli_fetch_array($consulta_linea);
   $linea = $resultado_consulta_linea[nombre];
   
   $id_actividad = $resultado_consulta_sell_out[id_actividad];
   $consulta_actividad = mysqli_query($conexion,"select nombre from actividad where id = '$id_actividad'");
   $resultado_consulta_actividad = mysqli_fetch_array($consulta_actividad);
   $actividad = $resultado_consulta_actividad[nombre];
   
   $unidades = $resultado_consulta_sell_out[unidades];
   $precio = $resultado_consulta_sell_out[precio];
   $taxid = $resultado_consulta_sell_out[taxid_cliente];
   $nombre_cliente = $resultado_consulta_sell_out[nombre_cliente];
   $telefono_cliente = $resultado_consulta_sell_out[telefono_cliente];
   $email_cliente = $resultado_consulta_sell_out[email_cliente];
   $segmento = $resultado_consulta_sell_out[segmento];
   
   $id_pais = $resultado_consulta_sell_out[id_pais];
   $consulta_pais = mysqli_query($conexion,"select nombre from pais where id = '$id_pais'");
   $resultado_consulta_pais = mysqli_fetch_array($consulta_pais);
   $pais = $resultado_consulta_pais[nombre];
      
   $id_zona = $resultado_consulta_sell_out[id_zona];
   $consulta_zona = mysqli_query($conexion,"select nombre from zona where id = '$id_zona'");
   $resultado_consulta_zona = mysqli_fetch_array($consulta_zona);
   $zona = $resultado_consulta_zona[nombre];

   $id_departamento = $resultado_consulta_sell_out[id_departamento];
   $consulta_departamento = mysqli_query($conexion,"select nombre from departamento where id = '$id_departamento'");
   $resultado_consulta_departamento = mysqli_fetch_array($consulta_departamento);
   $departamento = $resultado_consulta_departamento[nombre];
      
   $ciudad = $resultado_consulta_sell_out[ciudad];

   $vendedor = $resultado_consulta_sell_out[vendedor];
   $e_commerce = $resultado_consulta_sell_out[e_commerce];
      
   $objPHPExcel->getActiveSheet() ->setCellValue('A' . $i, $distribuidor)
                                  ->setCellValue('B' . $i, $anio)
                                  ->setCellValue('C' . $i, $periodo)
								  ->setCellValue('D' . $i, $mes)
								  ->setCellValue('E' . $i, $factura)
								  ->setCellValue('F' . $i, $fecha_venta)
								  ->setCellValue('G' . $i, $producto)
								  ->setCellValue('H' . $i, $linea)
								  ->setCellValue('I' . $i, $actividad)
								  ->setCellValue('J' . $i, $unidades)
								  ->setCellValue('K' . $i, $precio)
								  ->setCellValue('L' . $i, $taxid)
								  ->setCellValue('M' . $i, $nombre_cliente)
								  ->setCellValue('N' . $i, $telefono_cliente)
								  ->setCellValue('O' . $i, $email_cliente)
								  ->setCellValue('P' . $i, $segmento)
								  ->setCellValue('Q' . $i, $pais)
								  ->setCellValue('R' . $i, $zona)
								  ->setCellValue('S' . $i, $departamento)
								  ->setCellValue('T' . $i, $ciudad)
								  ->setCellValue('U' . $i, $vendedor)
								  ->setCellValue('V' . $i, $e_commerce);
   $i++;
  }
 
 }
 
 $objPHPExcel->getActiveSheet()->getStyle('A1:V10000')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

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
 $objPHPExcel->getActiveSheet()->getColumnDimension("T")->setAutoSize(true);
 $objPHPExcel->getActiveSheet()->getColumnDimension("U")->setAutoSize(true);
 $objPHPExcel->getActiveSheet()->getColumnDimension("V")->setAutoSize(true);
 
 
 $objPHPExcel->getActiveSheet()->getStyle('A2:I10000')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
 $objPHPExcel->getActiveSheet()->getStyle('J2:K2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
 $objPHPExcel->getActiveSheet()->getStyle('J3:K10000')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
 $objPHPExcel->getActiveSheet()->getStyle('L2:V10000')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
 
 // Renombrar Hoja
 $objPHPExcel->getActiveSheet()->setTitle('Schneider Electric');

 // Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
 $objPHPExcel->setActiveSheetIndex(0);

 header("Content-type: application/vnd.ms-excel"); 
 // Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
 header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

 $titulo_componente = 'Informe Detallado Schneider Electric';
 $fecha = date('Y-m-j H:i:s');
 header("Content-Disposition: attachment;filename=\"".$titulo_componente." (".$fecha.").xlsx\";");
 header('Cache-Control: max-age=0');
 $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
 $objWriter->save('php://output');
 exit;
 
?>
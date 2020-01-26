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
 $filtros = 'FILTROS = ';
  
 $id_anio = !empty($_GET['id_anio'])? $_GET['id_anio']:0;
 $id_periodo = !empty($_GET['id_periodo'])? $_GET['id_periodo']:0;
 $id_mes = !empty($_GET['id_mes'])? $_GET['id_mes']:0;
 $id_distribuidor = !empty($_GET['id_distribuidor'])? $_GET['id_distribuidor']:0;
 $id_linea = !empty($_GET['id_linea'])? $_GET['id_linea']:0;
 $id_actividad = !empty($_GET['id_actividad'])? $_GET['id_actividad']:0;
 $id_pais = !empty($_GET['id_pais'])? $_GET['id_pais']:0;
 $id_zona = !empty($_GET['id_zona'])? $_GET['id_zona']:0;
 $id_segmento = !empty($_GET['id_segmento'])? $_GET['id_segmento']:0;
 
 $consulta_anio = mysqli_query($conexion,"select * from anio where id = '$id_anio'");
 $resultado_consulta_anio = mysqli_fetch_array($consulta_anio);
 $nombre_anio = $resultado_consulta_anio[nombre];
 $filtros .= 'Anio: '.$nombre_anio.' ';
  
 if($id_distribuidor != 0)
 {
  $consulta_distribuidor = mysqli_query($conexion,"select * from usuario where id = '$id_distribuidor'");
  $resultado_consulta_distribuidor = mysqli_fetch_array($consulta_distribuidor);
  $nombre_distribuidor = $resultado_consulta_distribuidor[nombre];	  
  $filtros .= '- Distribuidor: '.$nombre_distribuidor.' ';
 }
  
 if($id_linea != 0)
 {
  $consulta_linea = mysqli_query($conexion,"select * from linea where id = '$id_linea'");
  $resultado_consulta_linea = mysqli_fetch_array($consulta_linea);
  $nombre_linea = $resultado_consulta_linea[nombre];
  $filtros .= '- Linea: '.$nombre_linea.' ';
 }

 if($id_actividad != 0)
 {
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
 } 
	 	 
 if($id_mes != 0)
 {
  $consulta_mes = mysqli_query($conexion,"select * from mes where mes = '$id_mes'");
  $resultado_consulta_mes = mysqli_fetch_array($consulta_mes);
  $nombre_mes = $resultado_consulta_mes[nombre];
  $filtros .= '- Mes: '.$nombre_mes.' ';
 }
	 
 if($id_pais != 0)
 {
  $consulta_pais = mysqli_query($conexion,"select * from pais where id = '$id_pais'");
  $resultado_consulta_pais = mysqli_fetch_array($consulta_pais);
  $nombre_pais = $resultado_consulta_pais[nombre];	  
  $filtros .= '- Pais: '.$nombre_pais.' ';
 }
	
 if($id_zona != 0)
 {
  $consulta_zona = mysqli_query($conexion,"select * from zona where id = '$id_zona'");
  $resultado_consulta_zona = mysqli_fetch_array($consulta_zona);
  $nombre_zona = $resultado_consulta_zona[nombre];	  
  $filtros .= '- Zona: '.$nombre_zona.' ';
 }
	 
 if($id_segmento != 0)
 {
  $consulta_segmento = mysqli_query($conexion,"select * from segmento where id = '$id_segmento'");
  $resultado_consulta_segmento = mysqli_fetch_array($consulta_segmento);
  $nombre_segmento = $resultado_consulta_segmento[nombre];
  $filtros .= '- Segmento: '.$nombre_segmento.' ';
 }
  
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

 $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:D1');
 $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', $filtros);
  
 if($id_anio != 0 && $id_distribuidor == 0)
 {
  // Agregar Informacion
  $objPHPExcel->getActiveSheet()->getStyle('A1:D2')->getFont()->setBold(true);
  $objPHPExcel->getActiveSheet()->getStyle('A1:D1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
  $objPHPExcel->getActiveSheet()->getStyle('A2:D2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  
  $objPHPExcel->setActiveSheetIndex(0)
  ->setCellValue('A2', 'Distribuidor')
  ->setCellValue('B2', 'Pais')
  ->setCellValue('C2', 'Ventas');
 
  $pais_anterior = '';
  $i_contador = 1;
  $sumatoria_pais = 0;
  $i = 3;
   
  if($id_pais == 0)
  {
   $consulta_distribuidor = mysqli_query($conexion,"select * from usuario where perfil = 'distribuidor' order by pais,nombre ASC");
  }
  else
  {
   $consulta_distribuidor = mysqli_query($conexion,"select * from usuario where perfil = 'distribuidor' and pais = $id_pais order by nombre ASC");
  }

  $total_distribuidores = mysqli_num_rows($consulta_distribuidor);

  while($resultado_consulta_distribuidor = mysqli_fetch_array($consulta_distribuidor))
  {
   $consulta = '';
	   
   $distribuidor_id = $resultado_consulta_distribuidor['id'];
   $pais_id = $resultado_consulta_distribuidor['pais'];
    
   if($i_contador == 1)
   {
	$pais_anterior = $pais_id;
   }
	
   if($pais_anterior != $pais_id)
   {
	$sumatoria_pais_formato = number_format($sumatoria_pais, 2, ',', '.'); 

    $objPHPExcel->getActiveSheet()->getStyle('A'.$i.':C'.$i.'')->getFont()->setBold(true);	
	$objPHPExcel->getActiveSheet() ->setCellValue('A' . $i, '')
                                   ->setCellValue('B' . $i, 'SubTotal')
                                   ->setCellValue('C' . $i, $sumatoria_pais_formato);
    $i++;
    $sumatoria_pais = 0;
   }

   $pais_anterior = $pais_id;
		        
   $consulta = 'select SUM(float_precio*int_unidades) as venta from detalle_sell_out where id_distribuidor = '.$distribuidor_id.' and estado = "1"';
		 
   $consulta .= 'and id_anio = '.$id_anio.' ';
	
   if($id_linea != 0)
   {
    $consulta .= 'and id_linea = '.$id_linea.' ';
   }

   if($id_actividad != 0)
   {
    $consulta .= 'and id_actividad = '.$id_actividad.' ';
   }
	
   if($id_periodo != 0)	
   {
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
	$consulta_mes = mysqli_query($conexion,"select * from mes where anio = '$id_anio' and q = '$id_q' and mes = '$id_mes'");
	$resultado_consulta_mes = mysqli_fetch_array($consulta_mes);
    $id_mes_f = $resultado_consulta_mes['id'];

    $consulta .= 'and id_mes = '.$id_mes_f.' ';	  
   }
	 
   if($id_pais != 0)
   {
    $consulta .= 'and id_pais = '.$id_pais.' ';
   }
	
   if($id_zona != 0)
   {
    $consulta .= 'and id_zona = '.$id_zona.' ';
   }
	 
   if($id_segmento != 0)
   {
    $consulta .= 'and id_segmento = '.$id_segmento.' ';
   }
	 
   $consulta_sell_out = mysqli_query($conexion,$consulta);	   	   
   $resultado_consulta_sell_out = mysqli_fetch_array($consulta_sell_out);
   
   $nombre_distribuidor = $resultado_consulta_distribuidor['nombre'];

   $consulta_pais = mysqli_query($conexion,"select * from pais where id = '$pais_id'");
   $resultado_consulta_pais = mysqli_fetch_array($consulta_pais);
   $nombre_pais = $resultado_consulta_pais['nombre'];
     
   $venta = $resultado_consulta_sell_out['venta'];
   $venta_formato = number_format($venta, 2, ',', '.');
   
   $objPHPExcel->getActiveSheet() ->setCellValue('A' . $i, $nombre_distribuidor)
                                  ->setCellValue('B' . $i, $nombre_pais)
                                  ->setCellValue('C' . $i, $venta_formato);
   $i++;
   
   $sumatoria_pais = $sumatoria_pais + $venta;
	
   if($i_contador == $total_distribuidores)
   {
	$sumatoria_pais_formato = number_format($sumatoria_pais, 2, ',', '.'); 

    $objPHPExcel->getActiveSheet()->getStyle('A'.$i.':C'.$i.'')->getFont()->setBold(true);
	
	$objPHPExcel->getActiveSheet() ->setCellValue('A' . $i, '')
                                   ->setCellValue('B' . $i, 'SubTotal')
                                   ->setCellValue('C' . $i, $sumatoria_pais_formato);
    $i++;
    $sumatoria_pais = 0;
   }
	
   $i_contador++; 
  }
 }
 
 if($id_anio != 0 && $id_distribuidor != 0)
 {
  if($id_actividad == 0)
  {
   // Agregar Informacion
   $objPHPExcel->getActiveSheet()->getStyle('A1:C2')->getFont()->setBold(true);
   $objPHPExcel->getActiveSheet()->getStyle('A1:D1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
   $objPHPExcel->getActiveSheet()->getStyle('A2:D2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
   
   $objPHPExcel->setActiveSheetIndex(0)
   ->setCellValue('A2', 'Linea')
   ->setCellValue('B2', 'Actividad')
   ->setCellValue('C2', 'Ventas');
   
   $i = 3;
   
   if($id_linea == 0)
   {
    $consulta_linea = mysqli_query($conexion,"select * from linea order by nombre ASC");
   }
   else
   {
    $consulta_linea = mysqli_query($conexion,"select * from linea where id = $id_linea");		
   }
			
   $total_linea = mysqli_num_rows($consulta_linea);
   while($resultado_consulta_linea = mysqli_fetch_array($consulta_linea))
   {	
	$linea_id = $resultado_consulta_linea['id'];
			 
	$consulta = 'select SUM(float_precio*int_unidades) as venta from detalle_sell_out where id_distribuidor = '.$id_distribuidor.' and id_linea = '.$linea_id.' and estado = "1"';
		 
    $consulta .= 'and id_anio = '.$id_anio.' ';
	 		
	if($id_periodo != 0)	
	{
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
	 $consulta_mes = mysqli_query($conexion,"select * from mes where anio = '$id_anio' and q = '$id_q' and mes = '$id_mes'");
	 $resultado_consulta_mes = mysqli_fetch_array($consulta_mes);
     $id_mes_f = $resultado_consulta_mes['id'];

     $consulta .= 'and id_mes = '.$id_mes_f.' ';	  
	}
	 
	if($id_pais != 0)
    {
     $consulta .= 'and id_pais = '.$id_pais.' ';
	}
	
	if($id_zona != 0)
    {
     $consulta .= 'and id_zona = '.$id_zona.' ';
	}
	 
	if($id_segmento != 0)
    {
     $consulta .= 'and id_segmento = '.$id_segmento.' ';
	}
	 
	$consulta_sell_out = mysqli_query($conexion,$consulta);
    $resultado_consulta_sell_out = mysqli_fetch_array($consulta_sell_out);
    $venta = $resultado_consulta_sell_out['venta'];

	$venta_formato = number_format($venta, 2, ',', '.');
	
	$nombre_linea = $resultado_consulta_linea['nombre'];
		
    $objPHPExcel->getActiveSheet() ->setCellValue('A' . $i, $nombre_linea.' (Total)')
                                   ->setCellValue('B' . $i, '')
                                   ->setCellValue('C' . $i, $venta_formato);
    $i++;
	
	$consulta_actividad = mysqli_query($conexion,"select * from actividad where linea = $linea_id order by nombre ASC");
    $total_actividad = mysqli_num_rows($consulta_actividad);
    while($resultado_consulta_actividad = mysqli_fetch_array($consulta_actividad))
    {
 	 $actividad_id = $resultado_consulta_actividad['id'];	  
     $consulta_con_actividad = $consulta.'and id_actividad = '.$actividad_id.' ';
	 
	 $nombre_actividad = $resultado_consulta_actividad['nombre'];
	 
	 $consulta_sell_out = mysqli_query($conexion,$consulta_con_actividad);
     $resultado_consulta_sell_out = mysqli_fetch_array($consulta_sell_out);
     $venta = $resultado_consulta_sell_out['venta'];
	 $venta_formato = number_format($venta, 2, ',', '.');
	 
     $objPHPExcel->getActiveSheet() ->setCellValue('A' . $i, '')
                                    ->setCellValue('B' . $i, $nombre_actividad)
                                    ->setCellValue('C' . $i, $venta_formato);
     $i++;
	}
	 
   }

  }
  else
  {
   // Agregar Informacion
   $objPHPExcel->getActiveSheet()->getStyle('A1:D2')->getFont()->setBold(true);
   $objPHPExcel->getActiveSheet()->getStyle('A1:D1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
   $objPHPExcel->getActiveSheet()->getStyle('A2:D2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
   
   $objPHPExcel->setActiveSheetIndex(0)
   ->setCellValue('A2', 'Producto')
   ->setCellValue('B2', 'Codigo')
   ->setCellValue('C2', 'Unidades')
   ->setCellValue('D2', 'Ventas');
   
   $i = 3;
  
   $consulta = "select * from producto where actividad = ".$id_actividad." and U".$nombre_anio." = '1' order by nombre ASC";
   $consulta_producto = mysqli_query($conexion,$consulta);  
   $total_producto = mysqli_num_rows($consulta_producto);
   while($resultado_consulta_producto = mysqli_fetch_array($consulta_producto))
   {
 	$id_producto = $resultado_consulta_producto['id'];
	 
	$consulta = 'select SUM(float_precio*int_unidades) as venta, SUM(int_unidades) as unidades from detalle_sell_out where id_distribuidor = '.$id_distribuidor.' and id_linea = '.$id_linea.' and id_actividad = '.$id_actividad.' and id_producto = '.$id_producto.' and estado = "1"';
		 
    $consulta .= 'and id_anio = '.$id_anio.' ';
		
	if($id_periodo != 0)	
	{
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
	 $consulta_mes = mysqli_query($conexion,"select * from mes where anio = '$id_anio' and q = '$id_q' and mes = '$id_mes'");
	 $resultado_consulta_mes = mysqli_fetch_array($consulta_mes);
     $id_mes_f = $resultado_consulta_mes['id'];

     $consulta .= 'and id_mes = '.$id_mes_f.' ';	  
	}
	 
	if($id_pais != 0)
    {
     $consulta .= 'and id_pais = '.$id_pais.' ';
	}
	
	if($id_zona != 0)
    {
     $consulta .= 'and id_zona = '.$id_zona.' ';
	}
	 
	if($id_segmento != 0)
    {
     $consulta .= 'and id_segmento = '.$id_segmento.' ';
	}
	  	  
	$consulta_sell_out = mysqli_query($conexion,$consulta);
    $resultado_consulta_sell_out = mysqli_fetch_array($consulta_sell_out);
    $venta = $resultado_consulta_sell_out['venta'];
	$unidades = $resultado_consulta_sell_out['unidades'];
    
    $nombre_producto = $resultado_consulta_producto['nombre'];
	$referencia_producto = $resultado_consulta_producto['referencia'];
	
	$unidades_formato = number_format($unidades, 0, ',', '.');
	$venta_formato = number_format($venta, 2, ',', '.');
	
	if($venta > 0)
	{
     $objPHPExcel->getActiveSheet() ->setCellValue('A' . $i, $nombre_producto)
                                    ->setCellValue('B' . $i, $referencia_producto)
                                    ->setCellValue('C' . $i, $unidades_formato)
									->setCellValue('D' . $i, $venta_formato);
     $i++;
	}
	 
   }
	
  }
  
 }
  
 $objPHPExcel->getActiveSheet()->getStyle('A1:R1000')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
 
 $objPHPExcel->getActiveSheet()->getColumnDimension("A")->setAutoSize(true);
 $objPHPExcel->getActiveSheet()->getColumnDimension("B")->setAutoSize(true);
 //$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(28);	
 $objPHPExcel->getActiveSheet()->getColumnDimension("C")->setAutoSize(true); 
 $objPHPExcel->getActiveSheet()->getColumnDimension("D")->setAutoSize(true);
 
 $objPHPExcel->getActiveSheet()->getStyle('A2:B5000')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
 $objPHPExcel->getActiveSheet()->getStyle('C2:D5000')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
 
 // Renombrar Hoja
 $objPHPExcel->getActiveSheet()->setTitle('Schneider Electric');

 // Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
 $objPHPExcel->setActiveSheetIndex(0);

 header("Content-type: application/vnd.ms-excel"); 
 // Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
 header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

 $titulo_componente = 'Informe Schneider Electric';
 $fecha = date('Y-m-j H:i:s');
 header("Content-Disposition: attachment;filename=\"".$titulo_componente." (".$fecha.").xlsx\";");
 header('Cache-Control: max-age=0');
 $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
 $objWriter->save('php://output');
 exit;
 
?>
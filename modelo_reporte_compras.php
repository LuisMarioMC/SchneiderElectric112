<?php
  
 if($_SESSION['perfil'] != 'admin')
 {
  $mensaje = 666;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
 
 $consulta_mes = mysqli_query($conexion,"select * from mes where id = $id_mes");
 $resultado_consulta_mes = mysqli_fetch_array($consulta_mes);
 $nombre_mes = $resultado_consulta_mes['nombre'];
 
 if($error == 0) 
 {
  $cortar = explode(".", $documento_reporte_compras);
  $extension = end($cortar);
  $aleatorio = rand(1000000, 9999999);
  $encriptado = md5($aleatorio);
  $documento_reporte_compras = ''.$encriptado.'.'.$extension.'';
  $directorio_reporte_compras = "reporte_compras/";
  $destino_reporte_compras = $directorio_reporte_compras.$documento_reporte_compras;
  
  $subir_reporte_compras = move_uploaded_file($_FILES["reporte_compras"]["tmp_name"], $destino_reporte_compras);
 }

 
 if($error == 0)
 {
  $fecha = date('Y-m-d');
  $hora = date('H:i:s');
  $crear = mysqli_query($conexion,"insert into reporte_compras (estado,mes,fecha,hora,archivo) values ('0','$id_mes','$fecha','$hora','$documento_reporte_compras')");
  $id_reporte_compras = mysqli_insert_id($conexion);
  
  echo mysqli_error($conexion);
  
  $consulta_mes = mysqli_query($conexion,"select * from mes where id = $id_mes"); 
  $resultado_consulta_mes = mysqli_fetch_array($consulta_mes);
  $id_anio = $resultado_consulta_mes[anio];
  $id_q = $resultado_consulta_mes[q];
  
  if($crear)
  {
   require_once 'extras/phpexcel-1.8.1/Classes/PHPExcel.php';
   //$archivo = "subida_reporte_ventas/libro1.xlsx";
   $archivo = $destino_reporte_compras;
   $inputFileType = PHPExcel_IOFactory::identify($archivo);
   $objReader = PHPExcel_IOFactory::createReader($inputFileType);
   $objPHPExcel = $objReader->load($archivo);
   $sheet = $objPHPExcel->getSheet(0); 
   $highestRow = $sheet->getHighestRow(); 
   $highestColumn = $sheet->getHighestColumn();

   for ($row = 2; $row <= $highestRow; $row++)
   { 
	$nombre_distribuidor = $sheet->getCell("A".$row)->getValue();
	$producto = $sheet->getCell("B".$row)->getValue();    
	$unidades = $sheet->getCell("C".$row)->getValue();
    $precio = $sheet->getCell("D".$row)->getValue();
    $fecha_compra = $sheet->getCell("E".$row)->getValue();
    $factura = $sheet->getCell("F".$row)->getValue();
    	
    $crear = mysqli_query($conexion,"insert into detalle_sell_in (estado,reporte_compras,id_anio,id_mes,id_q,nombre_distribuidor,producto,unidades,precio,fecha_compra,factura) values ('0','$id_reporte_compras','$id_anio','$id_mes','$id_q','$nombre_distribuidor','$producto','$unidades','$precio','$fecha_compra','$factura')");
   }
  }
  
 }
  
  
 $i = 1; 
 $consulta_reporte = mysqli_query($conexion,"select * from reporte_compras order by id desc"); 
 while ($resultado_consulta_reporte = mysqli_fetch_array($consulta_reporte))
 {
  // Id
  $reporte[$i]['id'] = $resultado_consulta_reporte['id'];

  // Estado
  $reporte[$i]['estado'] = $resultado_consulta_reporte['estado'];

  // Mes
  $consulta_mes = mysqli_query($conexion,"select * from mes where id = $resultado_consulta_reporte[mes]");
  $resultado_consulta_mes = mysqli_fetch_array($consulta_mes);
  $consulta_anio = mysqli_query($conexion,"select * from anio where id = $resultado_consulta_mes[anio]");
  $resultado_consulta_anio = mysqli_fetch_array($consulta_anio);
  $reporte[$i]['mes'] = ''.$resultado_consulta_mes['nombre'].' ('.$resultado_consulta_anio['nombre'].')';
    
  // Fecha
  $reporte[$i]['fecha'] = $resultado_consulta_reporte['fecha'];
  
  // Hora
  $reporte[$i]['hora'] = $resultado_consulta_reporte['hora'];
  
  // Registros Error
  $reporte[$i]['registros_error'] = $resultado_consulta_reporte['registros_error'];

  if($resultado_consulta_reporte['estado'] == 0)
  {
   $reporte[$i]['nombre_estado'] = 'SUBIDO';
  }  
  if($resultado_consulta_reporte['estado'] == 1)
  {
   $reporte[$i]['nombre_estado'] = 'EN REVISION ('.$resultado_consulta_reporte['registros'].'/'.$resultado_consulta_reporte['registros_error'].')';
  }
  if($resultado_consulta_reporte['estado'] == 2)
  {
   $reporte[$i]['nombre_estado'] = 'FINALIZADO ('.$resultado_consulta_reporte['registros'].'/'.$resultado_consulta_reporte['registros_error'].')';
  }
  
  $i++;
 }
 
 $cantidad_mes = 1;
 $consulta_mes = mysqli_query($conexion,"select * from mes where estado = 1 order by id ASC ");
 while($resultado_consulta_mes = mysqli_fetch_array($consulta_mes))
 {
  $meses[$cantidad_mes]['id'] = $resultado_consulta_mes['id'];
  $consulta_anio = mysqli_query($conexion,"select * from anio where id = $resultado_consulta_mes[anio]");
  $resultado_consulta_anio = mysqli_fetch_array($consulta_anio);
  
  $meses[$cantidad_mes]['nombre'] = ''.$resultado_consulta_mes[nombre].' ('.$resultado_consulta_anio[nombre].')';
  $cantidad_mes++;
 }

?>
<?php
  
 if($_SESSION['perfil'] != 'admin')
 {
  $mensaje = 666;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }

 if($error == 0) 
 { 
  $consulta_reporte_ventas = mysqli_query($conexion,"select * from reporte_ventas where distribuidor = $id_distribuidor and mes = $id_mes");
  if(mysqli_num_rows($consulta_reporte_ventas) > 0)
  {
   $error_reporte_ventas = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Ya Existe en Reporte Cargado para esa Fecha.</div>';
   $error = 1;
  }
 }
 
 $consulta_mes = mysqli_query($conexion,"select * from mes where id = $id_mes");
 $resultado_consulta_mes = mysqli_fetch_array($consulta_mes);
 $nombre_mes = $resultado_consulta_mes['nombre'];
 
 if($error == 0) 
 {
  $cortar = explode(".", $documento_reporte_ventas);
  $extension = end($cortar);
  $aleatorio = rand(1000000, 9999999);
  $encriptado = md5($aleatorio);
  $documento_reporte_ventas = ''.$encriptado.'.'.$extension.'';
  $directorio_reporte_ventas = "reporte_ventas2/";
  $destino_reporte_ventas = $directorio_reporte_ventas.$documento_reporte_ventas;
  
  $subir_reporte_ventas = move_uploaded_file($_FILES["reporte_ventas"]["tmp_name"], $destino_reporte_ventas);
 }

 
 if($error == 0)
 {
  $fecha = date('Y-m-d');
  $hora = date('H:i:s');
  $crear = @mysqli_query($conexion,"insert into reporte_ventas (estado,mes,fecha,hora,distribuidor,archivo) values ('0','$id_mes','$fecha','$hora','$id_distribuidor','$documento_reporte_ventas')");

  $id_reporte_ventas = mysqli_insert_id($conexion);

  $consulta_distribuidor = mysqli_query($conexion,"select * from usuario where id = $id_distribuidor"); 
  $resultado_consulta_distribuidor = mysqli_fetch_array($consulta_distribuidor);
  $id_pais_distribuidor = $resultado_consulta_distribuidor[pais];
  
  $consulta_mes = mysqli_query($conexion,"select * from mes where id = $id_mes"); 
  $resultado_consulta_mes = mysqli_fetch_array($consulta_mes);
  $id_anio = $resultado_consulta_mes[anio];
  $id_q = $resultado_consulta_mes[q];

  if($crear)
  {


    require_once 'extras/phpexcel-1.8.1/Classes/PHPExcel.php';
    //$archivo = "subida_reporte_ventas/libro1.xlsx";
    $archivo = $destino_reporte_ventas;
    $inputFileType = PHPExcel_IOFactory::identify($archivo);
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    $objPHPExcel = $objReader->load($archivo);
    $sheet = $objPHPExcel->getSheet(0); 
    $highestRow = $sheet->getHighestRow(); 
    $highestColumn = $sheet->getHighestColumn();
 
   
   for ($row = 2; $row <= $highestRow; $row++)
   { 
	$factura = $sheet->getCell("A".$row)->getValue();
	$fecha_venta = $sheet->getCell("B".$row)->getValue();    
	$producto = $sheet->getCell("C".$row)->getValue();
    $unidades = $sheet->getCell("D".$row)->getValue();
    $precio = $sheet->getCell("E".$row)->getValue();
    $taxid_cliente = $sheet->getCell("F".$row)->getValue();
    $nombre_cliente = $sheet->getCell("G".$row)->getValue();
	$nombre_cliente = str_replace("'","",$nombre_cliente);
    $telefono_cliente = $sheet->getCell("H".$row)->getValue();
    $email_cliente = $sheet->getCell("I".$row)->getValue();
	$email_cliente = str_replace(";","",$email_cliente);
    $segmento = $sheet->getCell("J".$row)->getValue();
    $ciudad = $sheet->getCell("K".$row)->getValue();
    $vendedor = $sheet->getCell("L".$row)->getValue();
    $e_commerce = $sheet->getCell("M".$row)->getValue();
    $direccion = $sheet->getCell("N".$row)->getValue();	
    $tipo_cliente = $sheet->getCell("O".$row)->getValue();	

    $crear = mysqli_query($conexion,"insert into detalle_sell_out (reporte_ventas,id_distribuidor,id_pais_distribuidor,id_anio,id_mes,id_q,factura,fecha_venta,producto,unidades,precio,taxid_cliente,nombre_cliente,telefono_cliente,email_cliente,segmento,ciudad,vendedor,e_commerce,direccion, tipo_cliente) values ('$id_reporte_ventas','$id_distribuidor','$id_pais_distribuidor','$id_anio','$id_mes','$id_q','$factura','$fecha_venta','$producto','$unidades','$precio','$taxid_cliente','$nombre_cliente','$telefono_cliente','$email_cliente','$segmento','$ciudad','$vendedor','$e_commerce','$direccion', '$tipo_cliente')");
   
}



  }
 }
  
 $i = 1; 
 $consulta_reporte = mysqli_query($conexion,"select * from reporte_ventas order by id desc"); 
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
  
  // Distribuidor
  $consulta_distribuidor = mysqli_query($conexion,"select * from usuario where id = $resultado_consulta_reporte[distribuidor]");
  $resultado_consulta_distribuidor = mysqli_fetch_array($consulta_distribuidor);
  $reporte[$i]['distribuidor'] = $resultado_consulta_distribuidor['nombre'];
  
  // Fecha
  $reporte[$i]['fecha'] = $resultado_consulta_reporte['fecha'];
  
  // Hora
  $reporte[$i]['hora'] = $resultado_consulta_reporte['hora'];
  
  // Registros Error
  $reporte[$i]['registros_error'] = $resultado_consulta_reporte['registros_error'];

  if($resultado_consulta_reporte['estado'] == 0)
  {
   if($resultado_consulta_reporte['registros_error'] == -1)
   {
    $reporte[$i]['nombre_estado'] = 'SUBIDO';
   }
   elseif($resultado_consulta_reporte['registros_error'] == 0)
   {
    $reporte[$i]['nombre_estado'] = 'SIN ERRORES ('.$resultado_consulta_reporte['registros'].'/'.$resultado_consulta_reporte['registros_error'].')';
   }
   elseif($resultado_consulta_reporte['registros_error'] > 0)
   {
    $reporte[$i]['nombre_estado'] = 'EN REVISION ('.$resultado_consulta_reporte['registros'].'/'.$resultado_consulta_reporte['registros_error'].')';
   }
  }
  if($resultado_consulta_reporte['estado'] == 1)
  {
   $reporte[$i]['nombre_estado'] = 'FINALIZADO ('.$resultado_consulta_reporte['registros'].'/'.$resultado_consulta_reporte['registros_error'].')';
  }
  
  $i++;
 }
 
 $cantidad_mes = 1;
 $consulta_mes = mysqli_query($conexion,"select * from mes where estado = 1 order by id ASC ");
 while($resultado_consulta_mes = mysqli_fetch_array($consulta_mes))
 {
  //$consulta_reporte = mysqli_query($conexion,"select * from reporte where distribuidor = $id_distribuidor and mes = $resultado_consulta_mes[id] and estado = 0");
  //if(mysqli_num_rows($consulta_reporte) == 0)
  //{
   $meses[$cantidad_mes]['id'] = $resultado_consulta_mes['id'];
   $consulta_anio = mysqli_query($conexion,"select * from anio where id = $resultado_consulta_mes[anio]");
   $resultado_consulta_anio = mysqli_fetch_array($consulta_anio);
  
   $meses[$cantidad_mes]['nombre'] = ''.$resultado_consulta_mes[nombre].' ('.$resultado_consulta_anio[nombre].')';
   $cantidad_mes++;
  //}
 }
 
 $cantidad_distribuidor = 1;
 $consulta_distribuidor = mysqli_query($conexion,"select * from usuario where perfil = 'distribuidor' and estado = 1 order by nombre ASC ");
 while($resultado_consulta_distribuidor = mysqli_fetch_array($consulta_distribuidor))
 {
  $distribuidores[$cantidad_distribuidor]['id'] = $resultado_consulta_distribuidor['id'];  
  $distribuidores[$cantidad_distribuidor]['nombre'] = $resultado_consulta_distribuidor[nombre];
  $cantidad_distribuidor++;
 }

?>
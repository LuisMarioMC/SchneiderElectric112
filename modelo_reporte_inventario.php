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
  $cortar = explode(".", $documento_reporte_inventario);
  $extension = end($cortar);
  $aleatorio = rand(1000000, 9999999);
  $encriptado = md5($aleatorio);
  $documento_reporte_inventario = ''.$encriptado.'.'.$extension.'';
  $directorio_reporte_inventario = "reporte_inventario2/";
  $destino_reporte_inventario = $directorio_reporte_inventario.$documento_reporte_inventario;
  
  $subir_reporte_inventario = move_uploaded_file($_FILES["reporte_inventario"]["tmp_name"], $destino_reporte_inventario);
 }

 
 if($error == 0)
 {
  $fecha = date('Y-m-d');
  $hora = date('H:i:s');
  $crear = @mysqli_query($conexion,"insert into reporte_inventario (estado,mes,fecha,hora,distribuidor,archivo) values ('0','$id_mes','$fecha','$hora','$id_distribuidor','$documento_reporte_inventario')");
  $id_reporte_inventario = mysqli_insert_id($conexion);

  if($crear)
  {
   require_once 'extras/phpexcel-1.8.1/Classes/PHPExcel.php';
   //$archivo = "subida_reporte_inventario/libro1.xlsx";
   $archivo = $destino_reporte_inventario;
   $inputFileType = PHPExcel_IOFactory::identify($archivo);
   $objReader = PHPExcel_IOFactory::createReader($inputFileType);
   $objPHPExcel = $objReader->load($archivo);
   $sheet = $objPHPExcel->getSheet(0); 
   $highestRow = $sheet->getHighestRow(); 
   $highestColumn = $sheet->getHighestColumn();

   for ($row = 2; $row <= $highestRow; $row++)
   { 
	$producto = $sheet->getCell("A".$row)->getValue();
    $unidades = $sheet->getCell("B".$row)->getValue();
    $sucursal = $sheet->getCell("C".$row)->getValue();
    $m1 = $sheet->getCell("D".$row)->getValue();
    $m2 = $sheet->getCell("E".$row)->getValue();
    $m3 = $sheet->getCell("F".$row)->getValue();
    	
    $crear = @mysqli_query($conexion,"insert into detalle_inventario (reporte_inventario,distribuidor,producto,unidades,sucursal,m1,m2,m3) values ('$id_reporte_inventario','$id_distribuidor','$producto','$unidades','$sucursal','$m1','$m2','$m3')");
   }

  }
 }
  
  
 $i = 1; 
 $consulta_reporte = mysqli_query($conexion,"select * from reporte_inventario order by id desc"); 
 while ($resultado_consulta_reporte = mysqli_fetch_array($consulta_reporte))
 {
  // Id
  $reporte[$i]['id'] = $resultado_consulta_reporte['id'];

  // Estado
  if($resultado_consulta_reporte['estado'] == 0)
  {
   $reporte[$i]['estado'] = 'SUBIDO';
  }

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
  
  // Reporte Ventas
  $reporte[$i]['reporte_inventario'] = $resultado_consulta_reporte['reporte_inventario'];

  // Reporte Inventario
  $reporte[$i]['reporte_inventario'] = $resultado_consulta_reporte['reporte_inventario'];
    
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
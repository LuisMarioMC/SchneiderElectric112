<?php
 require_once ('conexion_sesion.php');
 
 if($_SESSION['perfil'] != 'admin' && $_SESSION['perfil'] != 'admin_schneider' && $_SESSION['perfil'] != 'super_schneider')
 {
  $mensaje = 666;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
 
 $fecha = date("Y-m-d H:i:s");
 $fecha = 'INVENTARIO '.$fecha;
 
 $nombre_archivo = "reportes/".$fecha.".csv";
 //$nombre_archivo = "reportes/prueba.csv";
 if($archivo = fopen($nombre_archivo, "a"))
 {
  $variable = "";

  $consulta = " 
   SELECT
	`detalle_inventario`.`id` as Id,
	`mes`.`nombre` as Mes,
	`q`.`nombre` as Q,
	`anio`.`nombre` as Anio,
	`usuario`.`nombre` as Distribuidor,
	`detalle_inventario`.`producto` as Producto,
  `detalle_inventario`.`unidades` as Unidades,
  `detalle_inventario`.`sucursal` as Sucursal,
  `detalle_inventario`.`m1` as M1,
  `detalle_inventario`.`m2` as M2,
  `detalle_inventario`.`m3` as M3
   FROM reporte_inventario, detalle_inventario, usuario, mes, q, anio
   WHERE 
	`detalle_inventario`.`distribuidor` = `usuario`.`id` AND
	`detalle_inventario`.`reporte_inventario` = `reporte_inventario`.`id` AND  
	`reporte_inventario`.`mes` = `mes`.`id` AND
	`mes`.`q` = `q`.`id` AND
	`mes`.`anio` = `anio`.`id`
   ORDER BY `id`  ASC";
 
 
  $consulta_backup = mysqli_query($conexion, $consulta);
  while ($resultado_consulta_backup = mysqli_fetch_array($consulta_backup))
  {
    
   $variable = '"'.$resultado_consulta_backup[Id].'","'.$resultado_consulta_backup[Mes].'","'.$resultado_consulta_backup[Q].'","'.$resultado_consulta_backup[Anio].'","'.$resultado_consulta_backup[Distribuidor].'","'.$resultado_consulta_backup[Producto].'","'.$resultado_consulta_backup[Unidades].'","'.$resultado_consulta_backup[Sucursal].'","'.$resultado_consulta_backup[M1].'","'.$resultado_consulta_backup[M2].'","'.$resultado_consulta_backup[M3].'"';
   
   fwrite($archivo,$variable."\n");  
  }
  
  if(file_exists($nombre_archivo)) 
  {
   $crear = mysqli_query($conexion,"insert into descargar_reporte (nombre,tipo) values ('$fecha','2')");
   
   $mensaje = 21;
  }
  else
  {
   $mensaje = 22;
  }
  fclose($archivo);
 }
 else
 {
  $mensaje = 22;	 
 }


 echo '<script language="JavaScript" type="text/javascript">document.location.href="listar_descargar_reporte.php?m='.$mensaje.'"</script>';

?>
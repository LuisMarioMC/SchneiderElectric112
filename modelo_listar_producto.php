<?php

 require_once ('conexion_sesion.php');
  
 if($_SESSION['perfil'] != 'admin')
 {
  $mensaje = 666;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
 
 $i = 1;

 if($referencia != '' && $nombre == '')
 {
  $consulta_producto = mysqli_query($conexion,"select * from producto where referencia LIKE '%$referencia%' order by id desc");
 }
 if($referencia == '' && $nombre != '')
 {
  $consulta_producto = mysqli_query($conexion,"select * from producto where nombre LIKE '%$nombre%' order by id desc");
 }
 if($referencia != '' && $nombre != '')
 {
  $consulta_producto = mysqli_query($conexion,"select * from producto where nombre LIKE '%$nombre%' and referencia LIKE '%$referencia%' order by id desc");
 }
 
 while ($resultado_consulta_producto = mysqli_fetch_array($consulta_producto))
 {
  // Id
  $producto[$i]['id'] = $resultado_consulta_producto['id'];

  // Estado
  $producto[$i]['estado'] = $resultado_consulta_producto['estado'];
  
  // Referencia
  $producto[$i]['referencia'] = $resultado_consulta_producto['referencia'];

  // Nombre
  $producto[$i]['nombre'] = $resultado_consulta_producto['nombre'];
  
  // Actividad
  $consulta_actividad = mysqli_query($conexion,"select * from actividad where id = $resultado_consulta_producto[actividad]");
  $resultado_consulta_actividad = mysqli_fetch_array($consulta_actividad);
  $producto[$i]['actividad'] = $resultado_consulta_actividad['nombre'];

  // Cantidad Indivisible
  $producto[$i]['cant_indi'] = $resultado_consulta_producto['cant_indi'];  
  
  $i++;
 }

?>
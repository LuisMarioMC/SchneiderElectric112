<?php

 require_once ('conexion_sesion.php');
  
 if($_SESSION['perfil'] != 'admin')
 {
  $mensaje = 666;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
 
 $i = 1;

 $consulta_actividad = mysqli_query($conexion,"select * from actividad order by id desc");
 
 while ($resultado_consulta_actividad = mysqli_fetch_array($consulta_actividad))
 {
  // Id
  $actividad[$i]['id'] = $resultado_consulta_actividad['id'];

  // Estado
  $actividad[$i]['estado'] = $resultado_consulta_actividad['estado'];
  
  // Nombre
  $actividad[$i]['nombre'] = $resultado_consulta_actividad['nombre'];
  
  // Línea
  $consulta_linea = mysqli_query($conexion,"select * from linea where id = $resultado_consulta_actividad[linea]");
  $resultado_consulta_linea = mysqli_fetch_array($consulta_linea);
  $actividad[$i]['linea'] = $resultado_consulta_linea['nombre'];

  // Sell Out
  $actividad[$i]['sell_out'] = $resultado_consulta_actividad['sell_out'];  
  
  $i++;
 }

?>
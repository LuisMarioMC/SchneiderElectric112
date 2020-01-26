<?php

 require_once ('conexion_sesion.php');
  
 if($_SESSION['perfil'] != 'admin')
 {
  $mensaje = 666;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
 
 $i = 1;

 $consulta_mes = mysqli_query($conexion,"select * from mes order by id asc");
 
 while ($resultado_consulta_mes = mysqli_fetch_array($consulta_mes))
 {
  // Id
  $mes[$i]['id'] = $resultado_consulta_mes['id'];

  // Estado
  $mes[$i]['estado'] = $resultado_consulta_mes['estado'];
  
  // Nombre
  $mes[$i]['nombre'] = $resultado_consulta_mes['nombre'];

  // Anio
  $consulta_anio = mysqli_query($conexion,"select * from anio where id = $resultado_consulta_mes[anio]");
  $resultado_consulta_anio = mysqli_fetch_array($consulta_anio);
  $mes[$i]['anio'] = $resultado_consulta_anio['nombre'];
 
  $i++;
 }

?>
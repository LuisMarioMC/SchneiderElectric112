<?php

 require_once ('conexion_sesion.php');
  
 if($_SESSION['perfil'] != 'admin')
 {
  $mensaje = 666;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
 
 $i = 1;

 $consulta_q = mysqli_query($conexion,"select * from q order by id asc");
 
 while ($resultado_consulta_q = mysqli_fetch_array($consulta_q))
 {
  // Id
  $q[$i]['id'] = $resultado_consulta_q['id'];

  // Estado
  $q[$i]['estado'] = $resultado_consulta_q['estado'];
  
  // Nombre
  $q[$i]['nombre'] = $resultado_consulta_q['nombre'];

  // Anio
  $consulta_anio = mysqli_query($conexion,"select * from anio where id = $resultado_consulta_q[anio]");
  $resultado_consulta_anio = mysqli_fetch_array($consulta_anio);
  $q[$i]['anio'] = $resultado_consulta_anio['nombre'];
 
  $i++;
 }

?>
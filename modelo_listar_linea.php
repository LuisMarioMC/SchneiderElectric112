<?php

 require_once ('conexion_sesion.php');
  
 if($_SESSION['perfil'] != 'admin')
 {
  $mensaje = 666;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
 
 $i = 1;

 $consulta_linea = mysqli_query($conexion,"select * from linea order by id desc");
 
 while ($resultado_consulta_linea = mysqli_fetch_array($consulta_linea))
 {
  // Id
  $linea[$i]['id'] = $resultado_consulta_linea['id'];

  // Estado
  $linea[$i]['estado'] = $resultado_consulta_linea['estado'];
  
  // Nombre
  $linea[$i]['nombre'] = $resultado_consulta_linea['nombre'];
   
  $i++;
 }

?>
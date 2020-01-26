<?php

 require_once ('conexion_sesion.php');
  
 if($_SESSION['perfil'] != 'admin')
 {
  $mensaje = 666;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
 
 $i = 1;

 $consulta_anio = mysqli_query($conexion,"select * from anio order by id desc");
 
 while ($resultado_consulta_anio = mysqli_fetch_array($consulta_anio))
 {
  // Id
  $anio[$i]['id'] = $resultado_consulta_anio['id'];

  // Estado
  $anio[$i]['estado'] = $resultado_consulta_anio['estado'];
  
  // Nombre
  $anio[$i]['nombre'] = $resultado_consulta_anio['nombre'];
   
  $i++;
 }

?>
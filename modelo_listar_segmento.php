<?php

 require_once ('conexion_sesion.php');
  
 if($_SESSION['perfil'] != 'admin')
 {
  $mensaje = 666;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
 
 $i = 1;

 $consulta_segmento = mysqli_query($conexion,"select * from segmento order by id desc");
 
 while ($resultado_consulta_segmento = mysqli_fetch_array($consulta_segmento))
 {
  // Id
  $segmento[$i]['id'] = $resultado_consulta_segmento['id'];

  // Estado
  $segmento[$i]['estado'] = $resultado_consulta_segmento['estado'];
  
  // Nombre
  $segmento[$i]['nombre'] = $resultado_consulta_segmento['nombre'];
   
  $i++;
 }

?>
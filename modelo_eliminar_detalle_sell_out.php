<?php

 require_once ('conexion_sesion.php');
 
 if($_SESSION['perfil'] != 'admin')
 {
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
 
 $consulta_detalle_sell_out = mysqli_query($conexion,"select * from detalle_sell_out where id = '$id_eliminar'");
 if(mysqli_num_rows($consulta_detalle_sell_out)==1)
 {
  $resultado_consulta_detalle_sell_out = mysqli_fetch_array($consulta_detalle_sell_out);
  $reporte_ventas = $resultado_consulta_detalle_sell_out[reporte_ventas];
  // Elimino el registro
  $eliminar = mysqli_query($conexion,"delete from detalle_sell_out where id = '$id_eliminar'");
 }
 else
 {
  $error = 1;
 }
 
?>
<?php

 require_once ('conexion_sesion.php');
 
 $perfil = $_SESSION['perfil'];
 
 if($perfil != 'admin')
 {
  $mensaje = 666;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
 
 $consulta_reporte_compras = mysqli_query($conexion,"select * from reporte_compras where id='$id_eliminar'");
 if(mysqli_num_rows($consulta_reporte_compras)==1)
 {
  // Elimino el registro
  $eliminar = mysqli_query($conexion,"delete from reporte_compras where id = $id_eliminar");
  
  $consulta_detalle_sell_in = mysqli_query($conexion,"select * from detalle_sell_in where reporte_compras = '$id_eliminar'");
  if(mysqli_num_rows($consulta_detalle_sell_in) > 0)
  {
   $eliminar = mysqli_query($conexion,"delete from detalle_sell_in where reporte_compras = $id_eliminar");
  }
  
 }
 else
 {
  $error = 1;
 }
 
?>
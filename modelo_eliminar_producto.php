<?php

 require_once ('conexion_sesion.php');
 
 if($_SESSION['perfil'] != 'admin')
 {
  $mensaje = 666;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
 
 $consulta_producto = mysqli_query($conexion,"select * from producto where id='$id_eliminar'");
 if(@mysqli_num_rows($consulta_producto)==1)
 {  
  $consulta_detalle_sell_out = mysqli_query($conexion,"select * from detalle_sell_out where id_producto='$id_eliminar'");
  if(@mysqli_num_rows($consulta_detalle_sell_out)==0)
  {
   // Elimino el registro
   $eliminar = @mysqli_query($conexion,"delete from producto where id = $id_eliminar");
   $eliminar = @mysqli_query($conexion,"delete from producto_pais where producto = $id_eliminar");
  }
  else
  {
   $error = 2;
  }
 }
 else
 {
  $error = 1;
 }
 
?>
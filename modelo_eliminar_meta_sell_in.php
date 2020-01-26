<?php

 require_once ('conexion_sesion.php');
 
 if($_SESSION['perfil'] != 'admin')
 {
  $mensaje = 666;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
 
 $consulta_meta_sell_in = mysqli_query($conexion,"select * from meta_sell_in where id='$id_eliminar'");
 if(@mysqli_num_rows($consulta_meta_sell_in)==1)
 {  
  // Elimino el registro
  $eliminar = @mysqli_query($conexion,"delete from meta_sell_in where id=$id_eliminar");
  $eliminar = @mysqli_query($conexion,"delete from meta_q_sell_in where meta_sell_in = $id_eliminar");  
 }
 else
 {
  $error = 1;
 }
 
?>
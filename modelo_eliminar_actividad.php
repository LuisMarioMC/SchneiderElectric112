<?php

 require_once ('conexion_sesion.php');
 
 if($_SESSION['perfil'] != 'admin')
 {
  $mensaje = 666;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
 
 $consulta_actividad = mysqli_query($conexion,"select * from actividad where id='$id_eliminar'");
 if(@mysqli_num_rows($consulta_actividad)==1)
 {  
  $consulta_producto = mysqli_query($conexion,"select * from producto where actividad='$id_eliminar'");
  if(@mysqli_num_rows($consulta_producto)==0)
  {
   // Elimino el registro
   $eliminar = @mysqli_query($conexion,"delete from actividad where id=$id_eliminar");
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
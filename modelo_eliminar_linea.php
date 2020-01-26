<?php

 require_once ('conexion_sesion.php');
 
 if($_SESSION['perfil'] != 'admin')
 {
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
 
 $consulta_linea = mysqli_query($conexion,"select * from linea where id='$id_eliminar'");
 if(@mysqli_num_rows($consulta_linea)==1)
 {  
  $consulta_ciudad = mysqli_query($conexion,"select * from actividad where linea='$id_eliminar'");
  if(@mysqli_num_rows($consulta_ciudad)==0)
  {
   // Elimino el registro
   $eliminar = @mysqli_query($conexion,"delete from linea where id=$id_eliminar");
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
<?php

 require_once ('conexion_sesion.php');
 
 if($_SESSION['perfil'] != 'admin')
 {
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
 
 $consulta_moneda = mysqli_query($conexion,"select * from moneda where id='$id_eliminar'");
 if(@mysqli_num_rows($consulta_moneda)==1)
 {  
  $consulta_pais = mysqli_query($conexion,"select * from pais where moneda='$id_eliminar'");
  if(@mysqli_num_rows($consulta_pais)==0)
  {
   // Elimino el registro
   $eliminar = @mysqli_query($conexion,"delete from moneda where id=$id_eliminar");
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
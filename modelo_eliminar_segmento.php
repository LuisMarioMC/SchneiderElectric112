<?php

 require_once ('conexion_sesion.php');
 
 if($_SESSION['perfil'] != 'admin')
 {
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
 
 $consulta_segmento = mysqli_query($conexion,"select * from segmento where id='$id_eliminar'");
 if(@mysqli_num_rows($consulta_segmento)==1)
 {  
  $consulta_cliente = mysqli_query($conexion,"select * from cliente where segmento='$id_eliminar'");
  if(@mysqli_num_rows($consulta_cliente)==0)
  {
   // Elimino el registro
   $eliminar = @mysqli_query($conexion,"delete from segmento where id=$id_eliminar");
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
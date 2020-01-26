<?php
 
 if($_SESSION['perfil'] != 'admin')
 {
  $mensaje = 666;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
 
 $consulta_ciudad = mysqli_query($conexion,"select * from ciudad where id='$id_eliminar'");
 if(@mysqli_num_rows($consulta_ciudad)==1)
 {  
  $consulta_detalle_sell_out = mysqli_query($conexion,"select * from detalle_sell_out where id_ciudad='$id_eliminar'");
  if(@mysqli_num_rows($consulta_detalle_sell_out)==0)
  {
   // Elimino el registro
   $eliminar = @mysqli_query($conexion,"delete from ciudad where id=$id_eliminar");
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
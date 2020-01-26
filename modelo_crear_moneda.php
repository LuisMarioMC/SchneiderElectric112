<?php
  
 if($_SESSION['perfil'] != 'admin')
 {
  $mensaje = 666;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
     
 if($error == 0)
 {
  $consulta_moneda = @mysqli_query($conexion,"select * from moneda where nombre='$nombre'");
  if(mysqli_num_rows($consulta_moneda) == 1)
  {
   $error_nombre = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>El Nombre de la Moneda ya existe.</div>';
   $error = 1;
  } 
 }
 
 if($error == 0)
 {
  $consulta_sigla = @mysqli_query($conexion,"select * from moneda where sigla='$sigla'");
  if(mysqli_num_rows($consulta_sigla) == 1)
  {
   $error_sigla = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>La Sigla de la Moneda ya existe.</div>';
   $error = 1;
  } 
 }
 
 if($error == 0)
 {
  $crear = @mysqli_query($conexion,"insert into moneda (nombre,sigla,estado) values ('$nombre','$sigla','0')");
 }
 
?>
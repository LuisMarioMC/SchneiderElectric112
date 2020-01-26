<?php
  
 if($_SESSION['perfil'] != 'admin')
 {
  $mensaje = 666;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
     
 if($error == 0)
 {
  $consulta_segmento = @mysqli_query($conexion,"select * from segmento where nombre='$nombre'");
  if(mysqli_num_rows($consulta_segmento) == 1)
  {
   $error_nombre = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>La Segmento ya existe.</div>';
   $error = 1;
  } 
 }
 
 if($error == 0)
 {
  $crear = @mysqli_query($conexion,"insert into segmento (nombre,estado) values ('$nombre','0')");
 }
 
?>
<?php
 
 if($_SESSION['perfil'] != 'admin')
 {
  $mensaje = 666;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
 
 $consulta_departamento = mysqli_query($conexion,"select * from departamento where id='$id_eliminar'");
 if(@mysqli_num_rows($consulta_departamento)==1)
 {  
  $consulta_ciudad = mysqli_query($conexion,"select * from ciudad where departamento='$id_eliminar'");
  if(@mysqli_num_rows($consulta_ciudad)==0)
  {
   // Elimino el registro
   $eliminar = @mysqli_query($conexion,"delete from departamento where id=$id_eliminar");
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
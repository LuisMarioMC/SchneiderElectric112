<?php
 
 $id_modificar = !empty($_GET['id'])? $_GET['id']:0; 
 
 if($_SESSION['perfil'] != 'admin')
 {
  $mensaje = 666; 
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }

 $consulta_linea = @mysqli_query($conexion,"select * from linea where id='$id_modificar'");
 $resultado_consulta_linea = mysqli_fetch_array($consulta_linea);
 if($nombre == '')
 {
  $nombre = $resultado_consulta_linea['nombre'];
 }
 else
 {
  $nombre2 = $resultado_consulta_linea['nombre'];
 }
  
 if($error == 0)
 {
  $consulta_linea = @mysqli_query($conexion,"select * from linea where nombre='$nombre'");
  $resultado_consulta_linea = mysqli_fetch_array($consulta_linea);
  $id = $resultado_consulta_linea['id'];
 
  if($id != $id_modificar && mysqli_num_rows($consulta_linea) == 1)
  {
   $error_nombre = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>El Nombre ya existe.</div>';
   $error = 1;
  }
 }
  
 if($error == 0)
 {
  $modificar = @mysqli_query($conexion,"update linea set nombre = '$nombre' where id = '$id_modificar'");
 }
 
?>
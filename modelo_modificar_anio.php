<?php
 
 $id_modificar = !empty($_GET['id'])? $_GET['id']:0; 
 
 if($_SESSION['perfil'] != 'admin')
 {
  $mensaje = 666; 
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }

 $consulta_anio = @mysqli_query($conexion,"select * from anio where id='$id_modificar'");
 $resultado_consulta_anio = mysqli_fetch_array($consulta_anio);
 if($nombre == '')
 {
  $nombre = $resultado_consulta_anio['nombre'];
 }
 else
 {
  $nombre2 = $resultado_consulta_anio['nombre'];
 }
  
 if($error == 0)
 {
  $consulta_anio = @mysqli_query($conexion,"select * from anio where nombre='$nombre'");
  $resultado_consulta_anio = mysqli_fetch_array($consulta_anio);
  $id = $resultado_consulta_anio['id'];
 
  if($id != $id_modificar && mysqli_num_rows($consulta_anio) == 1)
  {
   $error_nombre = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>El A&ntilde;o ya existe.</div>';
   $error = 1;
  }
 }
  
 if($error == 0)
 {
  $modificar = @mysqli_query($conexion,"update anio set nombre = '$nombre' where id = '$id_modificar'");
 }
 
?>
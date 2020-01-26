<?php
 
 $id_modificar = !empty($_GET['id'])? $_GET['id']:0; 
 
 if($_SESSION['perfil'] != 'admin')
 {
  $mensaje = 666; 
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }

 $consulta_segmento = @mysqli_query($conexion,"select * from segmento where id='$id_modificar'");
 $resultado_consulta_segmento = mysqli_fetch_array($consulta_segmento);
 if($nombre == '')
 {
  $nombre = $resultado_consulta_segmento['nombre'];
 }
 else
 {
  $nombre2 = $resultado_consulta_segmento['nombre'];
 }
  
 if($error == 0)
 {
  $consulta_segmento = @mysqli_query($conexion,"select * from segmento where nombre='$nombre'");
  $resultado_consulta_segmento = mysqli_fetch_array($consulta_segmento);
  $id = $resultado_consulta_segmento['id'];
 
  if($id != $id_modificar && mysqli_num_rows($consulta_segmento) == 1)
  {
   $error_nombre = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>El Nombre ya existe.</div>';
   $error = 1;
  }
 }
  
 if($error == 0)
 {
  $modificar = @mysqli_query($conexion,"update segmento set nombre = '$nombre' where id = '$id_modificar'");
 }
 
?>
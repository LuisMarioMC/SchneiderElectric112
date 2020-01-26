<?php
 
 $id_modificar = !empty($_GET['id'])? $_GET['id']:0; 
 
 if($_SESSION['perfil'] != 'admin')
 {
  $mensaje = 666; 
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }

 $cantidad_linea = 1;
 $consulta_linea = mysqli_query($conexion,"select * from linea  where estado = 1 order by nombre ASC ");
 while($resultado_consulta_linea = mysqli_fetch_array($consulta_linea))
 {
  $lineas[$cantidad_linea]['id'] = $resultado_consulta_linea['id'];
  $lineas[$cantidad_linea]['nombre'] = $resultado_consulta_linea['nombre'];
  $cantidad_linea++; 
 }
 
 $consulta_actividad = @mysqli_query($conexion,"select * from actividad where id='$id_modificar'");
 $resultado_consulta_actividad = mysqli_fetch_array($consulta_actividad);
 if($nombre == '')
 {
  $nombre = $resultado_consulta_actividad['nombre'];
  $id_linea = $resultado_consulta_actividad['linea'];
  $sell_out = $resultado_consulta_actividad['sell_out'];
 }
 else
 {
  $nombre2 = $resultado_consulta_actividad['nombre'];
  $id_linea2 = $resultado_consulta_actividad['linea'];
  $sell_out2 = $resultado_consulta_actividad['sell_out'];
 }
  
 if($error == 0)
 {
  $consulta_actividad = @mysqli_query($conexion,"select * from actividad where nombre='$nombre'");
  $resultado_consulta_actividad = mysqli_fetch_array($consulta_actividad);
  $id = $resultado_consulta_actividad['id'];
 
  if($id != $id_modificar && mysqli_num_rows($consulta_actividad) == 1)
  {
   $error_nombre = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>El Nombre ya existe.</div>';
   $error = 1;
  }
 }
  
 if($error == 0)
 {
  $modificar = @mysqli_query($conexion,"update actividad set nombre = '$nombre', linea = '$id_linea', sell_out = '$sell_out' where id = '$id_modificar'");
 }
 
?>
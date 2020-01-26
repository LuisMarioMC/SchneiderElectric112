<?php
  
 if($_SESSION['perfil'] != 'admin')
 {
  $mensaje = 666;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
 
 $cantidad_linea = 1;
 $consulta_linea = mysqli_query($conexion,"select * from linea where estado = 1 order by nombre ASC ");
 while($resultado_consulta_linea = mysqli_fetch_array($consulta_linea))
 {
  $lineas[$cantidad_linea]['id'] = $resultado_consulta_linea['id'];
  $lineas[$cantidad_linea]['nombre'] = $resultado_consulta_linea['nombre'];
  $cantidad_linea++; 
 }
  
 if($error == 0)
 {
  $consulta_actividad = mysqli_query($conexion,"select * from actividad where nombre='$nombre'");
  if(mysqli_num_rows($consulta_actividad) == 1)
  {
   $error_nombre = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>La Actividad ya existe.</div>';
   $error = 1;
  }
 }
 
 if($error == 0)
 {
  $crear = mysqli_query($conexion,"insert into actividad (nombre,linea,sell_out,estado) values ('$nombre','$id_linea','$sell_out','0')"); 
 }
 
?>
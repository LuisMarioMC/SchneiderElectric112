<?php
 
 $id_modificar = !empty($_GET['id'])? $_GET['id']:0; 
 
 if($_SESSION['perfil'] != 'distribuidor')
 {
  $mensaje = 666; 
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
  
 $consulta_usuario = @mysqli_query($conexion,"select * from usuario where id='$id_modificar'");
 $resultado_consulta_usuario = mysqli_fetch_array($consulta_usuario);
 if($nombre == '')
 {
  $nombre = $resultado_consulta_usuario['nombre'];
  $correo_electronico = $resultado_consulta_usuario['correo_electronico'];
  $celular = $resultado_consulta_usuario['celular'];
 }
 else
 {
  $nombre2 = $resultado_consulta_usuario['nombre'];
  $correo_electronico2 = $resultado_consulta_usuario['correo_electronico'];
  $celular2 = $resultado_consulta_usuario['celular'];
 }
  
 /*
 if($error == 0)
 {
  $consulta_usuario = @mysqli_query($conexion,"select * from usuario where nombre='$nombre'");
  $resultado_consulta_usuario = mysqli_fetch_array($consulta_usuario);
  $id = $resultado_consulta_usuario['id'];
 
  if($id != $id_modificar && mysqli_num_rows($consulta_usuario) == 1)
  {
   $error_nombre = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>El Nombre ya existe.</div>';
   $error = 1;
  }
 }
 */ 
 
 if($error == 0)
 {
  $modificar = mysqli_query($conexion,"update usuario set nombre = '$nombre', correo_electronico = '$correo_electronico', celular = '$celular' where id = '$id_modificar'");
  echo mysqli_error($conexion);
 }
 
?>
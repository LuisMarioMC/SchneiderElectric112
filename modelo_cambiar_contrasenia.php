<?php
 $id_usuario = $_SESSION['usuario'];
   
 if($error == 0)
 {
  $contrasenia1_encriptada = md5($contrasenia1);

  $consulta_contrasenia1 = mysqli_query($conexion,"select * from usuario where id='$id_usuario' ");
  $resultado_consulta_contrasenia1 = mysqli_fetch_array($consulta_contrasenia1);
  if($resultado_consulta_contrasenia1['contrasenia'] != $contrasenia1_encriptada)
  {
   $error_contrasenia1 = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>La contrase&ntilde;a actual no es correcta.</div>';
   $error = 1; 
  }
 }
 
 if($error == 0)
 {
  $contrasenia2_encriptada = md5($contrasenia2);
  $modificar = mysqli_query($conexion,"update usuario set contrasenia = '$contrasenia2_encriptada', restablecer = '0' where id = '$id_usuario'");  
 }
 
 echo mysqli_error($conexion);
 
?>
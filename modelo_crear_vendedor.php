<?php
 
 if($_SESSION['perfil'] != 'distribuidor')
 {
  $mensaje = 666;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
 
 $id_distribuidor = 0;
 $id_distribuidor = $_SESSION['usuario'];
 if($id_distribuidor == 0)
 {
  $mensaje = 666;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
    
 if($error == 0)
 {
  $consulta_correo_electronico = @mysqli_query($conexion,"select * from usuario where correo_electronico='$correo_electronico'");
  if(mysqli_num_rows($consulta_correo_electronico) == 1)
  {
   $error_correo_electronico = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>El Correo Electr&oacute;nico ya esta registrado.</div>';
   $error = 1;
  }
 }
 
 if($error == 0)
 {
  if($contrasenia_automatica == 1)
  {
   $contrasenia = rand(100000, 999999);
  }
  $contrasenia_encriptada = md5($contrasenia);
  $perfil = 'vendedor';
  $restablecer = 1;
  
  $crear = @mysqli_query($conexion,"insert into usuario (nombre,correo_electronico,celular,perfil,contrasenia,distribuidor,restablecer) values ('$nombre','$correo_electronico','$celular','$perfil','$contrasenia_encriptada','$id_distribuidor','$restablecer')");
  echo mysqli_error($conexion);
 }
 
 if($crear)
 {
  $header = 'cabecera.jpg';
  $footer = 'pie_de_pagina.jpg';
 }
  
?>
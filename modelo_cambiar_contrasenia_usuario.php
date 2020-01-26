<?php
 
 $id_usuario = !empty($_GET['id'])? $_GET['id']:0;
 $id_usuario = mysqli_real_escape_string($conexion,$id_usuario);;
 
 if($error == 0)
 {
  $contrasenia2_encriptada = md5($contrasenia2);
  $modificar = mysqli_query($conexion,"update usuario set contrasenia = '$contrasenia2_encriptada' where id = '$id_usuario'");  
 }
 
 echo mysqli_error($conexion);
 
?>
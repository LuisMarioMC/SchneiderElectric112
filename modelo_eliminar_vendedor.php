<?php

 require_once ('conexion_sesion.php');
 
 if($_SESSION['perfil'] != 'distribuidor')
 {
  $mensaje = 666;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
 
 $consulta_usuario = mysqli_query($conexion,"select * from usuario where id='$id_eliminar'");
 if(@mysqli_num_rows($consulta_usuario)==1)
 {  
  //$consulta_departamento = mysqli_query($conexion,"select * from departamento where pais='$id_eliminar'");
  //if(@mysqli_num_rows($consulta_departamento)==0)
  //{
  // Elimino el registro
  $eliminar = @mysqli_query($conexion,"delete from usuario where id=$id_eliminar");
  //}
  //else
  //{
  // $error = 2;
  //}
 }
 else
 {
  $error = 1;
 }
 
?>
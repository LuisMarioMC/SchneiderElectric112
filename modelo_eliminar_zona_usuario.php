<?php

 require_once ('conexion_sesion.php');
 
 if($_SESSION['perfil'] != 'admin')
 {
  $mensaje = 666;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
 
 $consulta_zona_usuario = mysqli_query($conexion,"select * from zona_usuario where id='$id_eliminar'");
 if(@mysqli_num_rows($consulta_zona_usuario)==1)
 {
  $resultado_consulta_zona_usuario = mysqli_fetch_array($consulta_zona_usuario);
  $id_usuario = $resultado_consulta_zona_usuario['usuario'];
  //$consulta_departamento = mysqli_query($conexion,"select * from departamento where pais='$id_eliminar'");
  //if(@mysqli_num_rows($consulta_departamento)==0)
  //{
  // Elimino el registro
  $eliminar = @mysqli_query($conexion,"delete from zona_usuario where id=$id_eliminar");
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
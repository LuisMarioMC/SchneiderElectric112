<?php 
  
 if($_SESSION['perfil'] != 'admin')
 {
  $mensaje = 666;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
 
 $consulta_usuario = mysqli_query($conexion,"select * from usuario where id = $id_estado");
 if(@mysqli_num_rows($consulta_usuario)==1)
 {
  $resultado_consulta_usuario = mysqli_fetch_array($consulta_usuario);
  $estado = $resultado_consulta_usuario['estado'];
 
  //$consulta_departamento = mysqli_query($conexion,"select * from departamento where pais = $id_estado and estado = 1");
 
  if($estado == 0)
  {
   $activar = mysqli_query($conexion,"update usuario set estado = 1 where id = $id_estado");
  }
  elseif($estado == 1)
  {
   //if(@mysqli_num_rows($consulta_departamento)==0)
   //{
    $inactivar = mysqli_query($conexion,"update usuario set estado = 0 where id = $id_estado");
   //}
   //else
   //{
   // $error = 1;   
   // $error2 = 1;   
   //}  
  }
  else
  {
   $error = 1;
   $error1 = 1;
  }
 }
 else
 {
  $error = 1;
  $error1 = 1;
 }
  
?>
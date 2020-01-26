<?php 
 
 require_once ('conexion_sesion.php');
 
 if($_SESSION['perfil'] != 'admin')
 {
  $mensaje = 666;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
 
 $consulta_producto = mysqli_query($conexion,"select * from producto where id = $id_estado");
 if(@mysqli_num_rows($consulta_producto)==1)
 {
  $resultado_consulta_producto = mysqli_fetch_array($consulta_producto);
  $estado = $resultado_consulta_producto['estado'];
 
  if($estado == 0)
  {
   $activar = mysqli_query($conexion,"update producto set estado = 1 where id = $id_estado");
  }
  elseif($estado == 1)
  {
   $inactivar = mysqli_query($conexion,"update producto set estado = 0 where id = $id_estado");
  }
  else
  {
   $error = 1;  
  }
 }
 else
 {
  $error = 1;
 }
  
?>
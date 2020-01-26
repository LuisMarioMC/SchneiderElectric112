<?php
  
 if($_SESSION['perfil'] != 'admin')
 {
  $mensaje = 666;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
 
 $consulta_ciudad = mysqli_query($conexion,"select * from ciudad where id = $id_estado");
 if(@mysqli_num_rows($consulta_ciudad)==1)
 {
  $resultado_consulta_ciudad = mysqli_fetch_array($consulta_ciudad);
  $departamento = $resultado_consulta_ciudad['departamento'];
  $estado_ciudad = $resultado_consulta_ciudad['estado'];
  
  $consulta_departamento = mysqli_query($conexion,"select * from departamento where id = $departamento");
  $resultado_consulta_departamento = mysqli_fetch_array($consulta_departamento);
  $estado_departamento = $resultado_consulta_departamento['estado'];
  
  if($estado_ciudad == 0)
  {
   if($estado_departamento == 1)
   {
    $activar = mysqli_query($conexion,"update ciudad set estado = 1 where id = $id_estado");
   }
   else
   {
    $error = 1;   
    $error3 = 1;
   }
  }
  elseif($estado_ciudad == 1)
  {
   $inactivar = mysqli_query($conexion,"update ciudad set estado = 0 where id = $id_estado");
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
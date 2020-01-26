<?php
  
 if($_SESSION['perfil'] != 'admin')
 {
  $mensaje = 666;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
 
 $consulta_departamento = mysqli_query($conexion,"select * from departamento where id = $id_estado");
 if(@mysqli_num_rows($consulta_departamento)==1)
 {
  $resultado_consulta_departamento = mysqli_fetch_array($consulta_departamento);
  $pais = $resultado_consulta_departamento['pais'];
  $estado_departamento = $resultado_consulta_departamento['estado'];
  
  $consulta_pais = mysqli_query($conexion,"select * from pais where id = $pais");
  $resultado_consulta_pais = mysqli_fetch_array($consulta_pais);
  $estado_pais = $resultado_consulta_pais['estado'];

  $consulta_ciudad = mysqli_query($conexion,"select * from ciudad where departamento = $id_estado and estado = 1");
  
  if($estado_departamento == 0)
  {
   if($estado_pais == 1)
   {
    $activar = mysqli_query($conexion,"update departamento set estado = 1 where id = $id_estado");
   }
   else
   {
    $error = 1;   
    $error3 = 1;
   }
  }
  elseif($estado_departamento == 1)
  {
   if(@mysqli_num_rows($consulta_ciudad)==0)
   {
    $inactivar = mysqli_query($conexion,"update departamento set estado = 0 where id = $id_estado");
   }
   else
   {
    $error = 1;   
    $error2 = 1;   
   }
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
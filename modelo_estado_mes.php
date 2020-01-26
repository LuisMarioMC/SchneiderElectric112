<?php
 
 require_once ('conexion_sesion.php');
 
 if($_SESSION['perfil'] != 'admin')
 {
  $mensaje = 666;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
 
 $consulta_mes = mysqli_query($conexion,"select * from mes where id = $id_estado");
 if(@mysqli_num_rows($consulta_mes)==1)
 {
  $resultado_consulta_mes = mysqli_fetch_array($consulta_mes);
  $q = $resultado_consulta_mes['q'];
  $estado_mes = $resultado_consulta_mes['estado'];
  
  $consulta_q = mysqli_query($conexion,"select * from q where id = $q");
  $resultado_consulta_q = mysqli_fetch_array($consulta_q);
  $estado_q = $resultado_consulta_q['estado'];

  if($estado_mes == 0)
  {
   if($estado_q == 1)
   {
    $activar = mysqli_query($conexion,"update mes set estado = 1 where id = $id_estado");
   }
   else
   {
    $error = 1;   
    $error2 = 1;
   }
  }
  elseif($estado_mes == 1)
  {
   $inactivar = mysqli_query($conexion,"update mes set estado = 0 where id = $id_estado");
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
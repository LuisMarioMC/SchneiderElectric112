<?php
  
 if($_SESSION['perfil'] != 'admin')
 {
  $mensaje = 666;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
 
 $consulta_reporte_ventas = mysqli_query($conexion,"select * from reporte_ventas where id = $id_estado");
 if(@mysqli_num_rows($consulta_reporte_ventas)==1)
 {
  $resultado_consulta_reporte_ventas = mysqli_fetch_array($consulta_reporte_ventas);
  $estado_reporte_ventas = $resultado_consulta_reporte_ventas['estado'];
  $distribuidor_reporte_ventas = $resultado_consulta_reporte_ventas['distribuidor'];
  $mes_reporte_ventas = $resultado_consulta_reporte_ventas['mes'];
   
  if($estado_reporte_ventas == 0)
  {
   $activar = mysqli_query($conexion,"update reporte_ventas set estado = 1 where id = $id_estado");
   $activar = mysqli_query($conexion,"update reporte set estado = 3 where mes = $mes_reporte_ventas and distribuidor = $distribuidor_reporte_ventas and estado = 1");
  }
  elseif($estado_reporte_ventas == 1)
  {
   $inactivar = mysqli_query($conexion,"update reporte_ventas set estado = 0 where id = $id_estado");
   $inactivar = mysqli_query($conexion,"update reporte set estado = 1 where mes = $mes_reporte_ventas and distribuidor = $distribuidor_reporte_ventas and estado = 3");
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
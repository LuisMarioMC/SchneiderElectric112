<?php
 
 $perfil = $_SESSION['perfil'];
 $id_usuario = $_SESSION['usuario'];
 
 if($error == 0)
 {
  if($perfil == 'canal')
  {
   $consulta_usuario = mysqli_query($conexion,"select * from usuario where id = $id_usuario");
   $resultado_consulta_usuario = mysqli_fetch_array($consulta_usuario);
   $id_pais = $resultado_consulta_usuario[pais];
   $consulta_informe = mysqli_query($conexion,"select * from detalle_sell_out where date_fecha_venta between '$fecha_inicial' and '$fecha_final' and id_pais = '$id_pais'");
  }
  if($perfil == 'cartera')
  {
   $consulta_informe = mysqli_query($conexion,"select * from detalle_sell_out where date_fecha_venta between '$fecha_inicial' and '$fecha_final'"); 
  }
  if($perfil == 'distribuidor')
  {
   $consulta_informe = mysqli_query($conexion,"select * from detalle_sell_out where date_fecha_venta between '$fecha_inicial' and '$fecha_final' and id_distribuidor = '$id_usuario'"); 
  }
  if($perfil == 'linea')
  {
   $consulta_usuario = mysqli_query($conexion,"select * from usuario where id = $id_usuario");
   $resultado_consulta_usuario = mysqli_fetch_array($consulta_usuario);
   $id_linea = $resultado_consulta_usuario[linea];
   $consulta_informe = mysqli_query($conexion,"select * from detalle_sell_out where date_fecha_venta between '$fecha_inicial' and '$fecha_final' and id_linea = '$id_linea'"); 
  }
  if($perfil == 'vendedor')
  {
   $consulta_informe = mysqli_query($conexion,"select * from detalle_sell_out where date_fecha_venta between '$fecha_inicial' and '$fecha_final' and id_vendedor = '$id_usuario'"); 
  }
  	
  $cantidad_registros = mysqli_num_rows($consulta_informe);
 }
 
?>
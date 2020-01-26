<?php
 
 $id_modificar = !empty($_GET['id'])? $_GET['id']:0;
 
 if($_SESSION['perfil'] != 'admin')
 {
  $mensaje = 666; 
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }

 $consulta_detalle_sell_in = mysqli_query($conexion,"select * from detalle_sell_in where id='$id_modificar'");
 $resultado_consulta_detalle_sell_in = mysqli_fetch_array($consulta_detalle_sell_in);
 $id_reporte_compras = $resultado_consulta_detalle_sell_in['reporte_compras'];

 if($factura == '' || $fecha_compra == '' || $producto == '')
 {
  $nombre_distribuidor = $resultado_consulta_detalle_sell_in['nombre_distribuidor'];
  $factura = $resultado_consulta_detalle_sell_in['factura'];
  $fecha_compra = $resultado_consulta_detalle_sell_in['fecha_compra'];
  $producto = $resultado_consulta_detalle_sell_in['producto'];
  $unidades = $resultado_consulta_detalle_sell_in['unidades'];
  $precio = $resultado_consulta_detalle_sell_in['precio'];
 }
 else
 {
  $nombre_distribuidor2 = $resultado_consulta_detalle_sell_in['nombre_distribuidor'];
  $factura2 = $resultado_consulta_detalle_sell_in['factura'];
  $fecha_compra2 = $resultado_consulta_detalle_sell_in['fecha_compra'];
  $producto2 = $resultado_consulta_detalle_sell_in['producto'];
  $unidades2 = $resultado_consulta_detalle_sell_in['unidades'];
  $precio2 = $resultado_consulta_detalle_sell_in['precio'];
 }
  
 if($error == 0)
 {
  $modificar = mysqli_query($conexion,"update detalle_sell_in set estado = '0', factura = '$factura', fecha_compra = '$fecha_compra', date_fecha_compra = '0001-01-01', producto = '$producto', id_producto = '0', id_actividad = '0', id_linea = '0', unidades = '$unidades', int_unidades = 0, precio = '$precio', float_precio = 0, nombre_distribuidor = '$nombre_distribuidor', id_distribuidor = '0', id_pais_distribuidor = '0'  where id = '$id_modificar'");
 }
  
?>
<?php
 
 $id_modificar = !empty($_GET['id'])? $_GET['id']:0; 
 
 if($_SESSION['perfil'] != 'admin')
 {
  $mensaje = 666; 
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }

 $consulta_detalle_sell_out = @mysqli_query($conexion,"select * from detalle_sell_out where id='$id_modificar'");
 $resultado_consulta_detalle_sell_out = mysqli_fetch_array($consulta_detalle_sell_out);
 $id_reporte_ventas = $resultado_consulta_detalle_sell_out['reporte_ventas'];
 
 if($factura == '' || $fecha_venta == '' || $producto == '')
 {
  $factura = $resultado_consulta_detalle_sell_out['factura'];
  $fecha_venta = $resultado_consulta_detalle_sell_out['fecha_venta'];
  $producto = $resultado_consulta_detalle_sell_out['producto'];
  $unidades = $resultado_consulta_detalle_sell_out['unidades'];
  $precio = $resultado_consulta_detalle_sell_out['precio'];
  $taxid_cliente = $resultado_consulta_detalle_sell_out['taxid_cliente'];
  $nombre_cliente = $resultado_consulta_detalle_sell_out['nombre_cliente'];
  $telefono_cliente = $resultado_consulta_detalle_sell_out['telefono_cliente'];
  $email_cliente = $resultado_consulta_detalle_sell_out['email_cliente'];
  $segmento = $resultado_consulta_detalle_sell_out['segmento'];
  $ciudad = $resultado_consulta_detalle_sell_out['ciudad'];
  $vendedor = $resultado_consulta_detalle_sell_out['vendedor'];
  $e_commerce = $resultado_consulta_detalle_sell_out['e_commerce'];
  $direccion = $resultado_consulta_detalle_sell_out['direccion'];
  $tipo_cliente = $resultado_consulta_detalle_sell_out['tipo_cliente'];
 }
 else
 {
  $factura2 = $resultado_consulta_detalle_sell_out['factura'];
  $fecha_venta2 = $resultado_consulta_detalle_sell_out['fecha_venta'];
  $producto2 = $resultado_consulta_detalle_sell_out['producto'];
  $unidades2 = $resultado_consulta_detalle_sell_out['unidades'];
  $precio2 = $resultado_consulta_detalle_sell_out['precio'];
  $taxid_cliente2 = $resultado_consulta_detalle_sell_out['taxid_cliente'];
  $nombre_cliente2 = $resultado_consulta_detalle_sell_out['nombre_cliente'];
  $telefono_cliente2 = $resultado_consulta_detalle_sell_out['telefono_cliente'];
  $email_cliente2 = $resultado_consulta_detalle_sell_out['email_cliente'];
  $segmento2 = $resultado_consulta_detalle_sell_out['segmento'];
  $ciudad2 = $resultado_consulta_detalle_sell_out['ciudad'];
  $vendedor2 = $resultado_consulta_detalle_sell_out['vendedor'];
  $e_commerce2 = $resultado_consulta_detalle_sell_out['e_commerce'];
  $direccion2 = $resultado_consulta_detalle_sell_out['direccion'];
  $tipo_cliente2 = $resultado_consulta_detalle_sell_out['tipo_cliente'];
 }
  
 
  if($error == 0) {
    $modificar = @mysqli_query($conexion,"update detalle_sell_out set factura = '$factura', fecha_venta = '$fecha_venta', date_fecha_venta = '0001-01-01', producto = '$producto', id_producto = '0', id_actividad = '0', id_linea = '0', unidades = '$unidades', int_unidades = 0, precio = '$precio', float_precio = 0, taxid_cliente = '$taxid_cliente', id_cliente = '0', nombre_cliente = '$nombre_cliente', telefono_cliente = '$telefono_cliente', email_cliente = '$email_cliente', segmento = '$segmento', id_segmento = '0', ciudad = '$ciudad', id_ciudad = '0', id_departamento = '0', id_zona = '0', id_pais = '0', vendedor = '$vendedor', id_vendedor = '0', e_commerce = '$e_commerce', direccion = '$direccion', tipo_cliente = '$tipo_cliente' where id = '$id_modificar'");
  }
  
?>
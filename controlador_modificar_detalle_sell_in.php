<?php
  
 $error = 0;
 $modificar = 0;
 
 $nombre_distribuidor = '';
 $producto = '';
 $unidades = '';
 $precio = '';
 $factura = '';
 $fecha_compra = '';
   
 require_once ('conexion_sesion.php'); 
  
 if($_POST)
 {
  $nombre_distribuidor = trim(mysqli_real_escape_string($conexion,$_POST['nombre_distribuidor']));
  $producto = trim(mysqli_real_escape_string($conexion,$_POST['producto']));
  $unidades = trim(mysqli_real_escape_string($conexion,$_POST['unidades']));
  $precio = trim(mysqli_real_escape_string($conexion,$_POST['precio']));
  $factura = trim(mysqli_real_escape_string($conexion,$_POST['factura']));
  $fecha_compra = trim(mysqli_real_escape_string($conexion,$_POST['fecha_compra']));
  
  $error_nombre_distribuidor = '';
  $error_producto = '';
  $error_unidades = '';
  $error_precio = '';
  $error_factura = '';
  $error_fecha_compra = '';
 
  if($nombre_distribuidor == '')
  {
   $error_nombre_distribuidor = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Escribir Nombre Distribuidor.</div>';
   $error = 1;
  }
  if($producto == '')
  {
   $error_producto = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Escribir Producto.</div>';
   $error = 1;
  }
  if($unidades == '')
  {
   $error_unidades = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Escribir Unidades.</div>';
   $error = 1;
  }
  if($precio == '')
  {
   $error_precio = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Escribir Precio.</div>';
   $error = 1;
  }
  if($factura == '')
  {
   $error_factura = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Escribir Factura.</div>';
   $error = 1;
  }
  if($fecha_compra == '')
  {
   $error_fecha_compra = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Escribir Fecha Compra.</div>';
   $error = 1;
  }

 
  require_once ('modelo_modificar_detalle_sell_in.php');
    
  if($modificar)
  { 
   $modulo = 2;
   $accion = 'MODIFICAR';
   $id_afectado = $id_modificar;
   $descripcion = 'Modificar linea '.$nombre.'';
   auditoria($modulo,$accion,$id_afectado,$descripcion);
   $mensaje = 31;
   echo '<script language="JavaScript" type="text/javascript">document.location.href="listar_detalle_sell_in.php?id='.$id_reporte_compras.'&m='.$mensaje.'"</script>';
  }
  else
  {
   $mensaje = 32; 
  }
  require_once ('mensajes_detalle_sell_in.php');
 }
 else
 {
  $error = 1;
  require_once ('modelo_modificar_detalle_sell_in.php');
 }
 
?>
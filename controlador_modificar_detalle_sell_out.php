<?php
  
 $error = 0;
 $modificar = 0;
 
 $factura = '';
 $fecha_venta = '';
 $producto = '';
 $unidades = '';
 $precio = '';
 $taxid_cliente = '';
 $nombre_cliente = '';
 $telefono_cliente = '';
 $email_cliente = '';
 $segmento = '';
 $ciudad = '';
 $vendedor = '';
 $e_commerce = '';
 $direccion = '';
 $tipo_cliente = '';

 // Options for Client Type in Sell OUT view
 
  
 require_once ('conexion_sesion.php'); 


  // Create all options for type of client 

  $getTypeOfClients = mysqli_query($conexion, "select *  from tipo_cliente");
  $typeOfClients = [];
  while($row = mysqli_fetch_array($getTypeOfClients)) {
    $typeOfClients[] = $row;
  }

 if($_POST)
 {
  $factura = trim(mysqli_real_escape_string($conexion,$_POST['factura']));
  $fecha_venta = trim(mysqli_real_escape_string($conexion,$_POST['fecha_venta']));
  $producto = trim(mysqli_real_escape_string($conexion,$_POST['producto']));
  $unidades = trim(mysqli_real_escape_string($conexion,$_POST['unidades']));
  $precio = trim(mysqli_real_escape_string($conexion,$_POST['precio']));
  $taxid_cliente = trim(mysqli_real_escape_string($conexion,$_POST['taxid_cliente']));
  $nombre_cliente = trim(mysqli_real_escape_string($conexion,$_POST['nombre_cliente']));
  $telefono_cliente = trim(mysqli_real_escape_string($conexion,$_POST['telefono_cliente']));
  $email_cliente = trim(mysqli_real_escape_string($conexion,$_POST['email_cliente']));
  $segmento = trim(mysqli_real_escape_string($conexion,$_POST['segmento']));
  $ciudad = trim(mysqli_real_escape_string($conexion,$_POST['ciudad']));
  $vendedor = trim(mysqli_real_escape_string($conexion,$_POST['vendedor']));
  $e_commerce = trim(mysqli_real_escape_string($conexion,$_POST['e_commerce']));
  $direccion = trim(mysqli_real_escape_string($conexion,$_POST['direccion']));
  $tipo_cliente = trim(mysqli_real_escape_string($conexion,$_POST['tipo_cliente']));

  $error_factura = '';
  $error_fecha_venta = '';
  $error_producto = '';
  $error_unidades = '';
  $error_precio = '';
  $error_taxid_cliente = '';
  $error_nombre_cliente = '';
  $error_telefono_cliente = '';
  $error_email_cliente = '';
  $error_segmento = '';
  $error_ciudad = '';
  $error_vendedor = '';
  $error_e_commerce = '';
  $error_tipo_cliente = '';

  if($factura == '')
  {
   $error_factura = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Escribir Factura.</div>';
   $error = 1;
  }
  if($fecha_venta == '')
  {
   $error_fecha_venta = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Escribir Fecha Venta.</div>';
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
  if($taxid_cliente == '')
  {
   $error_taxid_cliente = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Escribir Tax ID Cliente.</div>';
   $error = 1;
  }
  if($ciudad == '')
  {
   $error_ciudad = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Escribir Ciudad.</div>';
   $error = 1;
  }
  if($vendedor == '')
  {
   $error_vendedor = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Escribir Vendedor.</div>';
   $error = 1;
  }
  if ($tipo_cliente == '') {
    
    $error_tipo_cliente = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Escribir tipo de cliente.</div>';
    $error = 1;
  }
  
  require_once ('modelo_modificar_detalle_sell_out.php');
    
  if($modificar)
  { 
   $modulo = 2;
   $accion = 'MODIFICAR';
   $id_afectado = $id_modificar;
   $descripcion = 'Modificar linea '.$nombre.'';
   auditoria($modulo,$accion,$id_afectado,$descripcion);
   $mensaje = 31;
   echo '<script language="JavaScript" type="text/javascript">document.location.href="listar_detalle_sell_out.php?id='.$id_reporte_ventas.'&m='.$mensaje.'"</script>';
  }
  else
  {
    
   $mensaje = 32; 
  }
  require_once ('mensajes_detalle_sell_out.php');
 }
 else
 {
  $error = 1;
  
  require_once ('modelo_modificar_detalle_sell_out.php');
 }
 
?>
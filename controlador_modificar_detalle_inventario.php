<?php
  
 $error = 0;
 $modificar = 0;
 
 $producto = '';
 $unidades = '';
 $sucursal = '';
 $m1 = '';
 $m2 = '';
 $m3 = '';
  
 require_once ('conexion_sesion.php'); 
  
 if($_POST)
 {
  $producto = trim(mysqli_real_escape_string($conexion,$_POST['producto']));
  $unidades = trim(mysqli_real_escape_string($conexion,$_POST['unidades']));
  $sucursal = trim(mysqli_real_escape_string($conexion,$_POST['sucursal']));
  $m1 = trim(mysqli_real_escape_string($conexion,$_POST['m1']));
  $m2 = trim(mysqli_real_escape_string($conexion,$_POST['m2']));
  $m3 = trim(mysqli_real_escape_string($conexion,$_POST['m3']));
    
  $error_producto = '';
  $error_unidades = '';
  $error_sucursal = '';
  $error_m1 = '';
  $error_m2 = '';
  $error_m3 = '';
 
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
 
  require_once ('modelo_modificar_detalle_inventario.php');
    
  if($modificar)
  { 
   $modulo = 2;
   $accion = 'MODIFICAR';
   $id_afectado = $id_modificar;
   $descripcion = 'Modificar linea '.$nombre.'';
   auditoria($modulo,$accion,$id_afectado,$descripcion);
   $mensaje = 31;
   echo '<script language="JavaScript" type="text/javascript">document.location.href="listar_detalle_inventario.php?id='.$id_reporte_inventario.'&m='.$mensaje.'"</script>';
  }
  else
  {
   $mensaje = 32; 
  }
  require_once ('mensajes_detalle_inventario.php');
 }
 else
 {
  $error = 1;
  require_once ('modelo_modificar_detalle_inventario.php');
 }
 
?>
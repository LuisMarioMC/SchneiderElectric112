<?php
 
 $id_modificar = !empty($_GET['id'])? $_GET['id']:0; 
 
 if($_SESSION['perfil'] != 'admin')
 {
  $mensaje = 666; 
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }

 $consulta_detalle_inventario = @mysqli_query($conexion,"select * from detalle_inventario where id='$id_modificar'");
 $resultado_consulta_detalle_inventario = mysqli_fetch_array($consulta_detalle_inventario);
 $id_reporte_inventario = $resultado_consulta_detalle_inventario['reporte_inventario'];

 if($producto == '' || $unidades == '')
 {
  $producto = $resultado_consulta_detalle_inventario['producto'];
  $unidades = $resultado_consulta_detalle_inventario['unidades'];
  $sucursal = $resultado_consulta_detalle_inventario['sucursal'];
  $m1 = $resultado_consulta_detalle_inventario['m1'];
  $m2 = $resultado_consulta_detalle_inventario['m2'];
  $m3 = $resultado_consulta_detalle_inventario['m3'];
 }
 else
 {
  $producto2 = $resultado_consulta_detalle_inventario['producto'];
  $unidades2 = $resultado_consulta_detalle_inventario['unidades'];
  $sucursal2 = $resultado_consulta_detalle_inventario['sucursal'];
  $m12 = $resultado_consulta_detalle_inventario['m1'];
  $m22 = $resultado_consulta_detalle_inventario['m2'];
  $m32 = $resultado_consulta_detalle_inventario['m3'];
 }
  
 if($error == 0)
 {
  $modificar = @mysqli_query($conexion,"update detalle_inventario set producto = '$producto', unidades = '$unidades', m1 ='$m1', m2 = '$m2', m3 = '$m3', sucursal = '$sucursal' where id = '$id_modificar'");
 }
  
?>
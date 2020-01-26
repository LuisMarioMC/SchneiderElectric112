<?php
 require_once ('conexion_sesion.php');

 $id_evento = !empty($_GET['id'])? $_GET['id']:0;
 
 if($_SESSION['perfil'] != 'admin')
 {
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
 
 $cantidad_inventarios = 0;

 $consulta_inventario = mysqli_query($conexion,"select * from material"); 
 
 while ($resultado_consulta_inventario = mysqli_fetch_array($consulta_inventario))
 {
  // Id
  $inventario[$cantidad_inventarios]['id'] = $resultado_consulta_inventario['id'];

  // Estado
  $inventario[$cantidad_inventarios]['estado'] = $resultado_consulta_inventario['estado'];

  // Material
  $inventario[$cantidad_inventarios]['material'] = $resultado_consulta_inventario['nombre'];

  $inventario[$cantidad_inventarios]['existencia'] = 200;
  $inventario[$cantidad_inventarios]['existencia_mts'] = 300; 
  
  $cantidad_inventarios++;
 }
 
 if($id_evento != 0)
 {
  $consulta_evento = mysqli_query($conexion,"select * from sucursal where id = $id_evento");
  $resultado_consulta_evento = mysqli_fetch_array($consulta_evento);  
  $nombre_evento = $resultado_consulta_evento['sucursal'];
 }
 
?>
<?php

 require_once ('conexion_sesion.php');
 
 if($_SESSION['perfil'] != 'admin')
 {
  $mensaje = 666;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
 
 $consulta_reporte_inventario = mysqli_query($conexion,"select * from reporte_inventario where id='$id_eliminar'");
 if(@mysqli_num_rows($consulta_reporte_inventario)==1)
 {
  // Elimino el registro
  $eliminar = @mysqli_query($conexion,"delete from reporte_inventario where id = $id_eliminar");
  $eliminar = @mysqli_query($conexion,"delete from detalle_inventario where reporte_inventario = $id_eliminar");
 }
 else
 {
  $error = 1;
 }
 
?>
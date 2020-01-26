<?php
 
 $id_modificar = !empty($_GET['id'])? $_GET['id']:0; 
 
 if($_SESSION['perfil'] != 'admin')
 {
  $mensaje = 666; 
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }

 $cantidad_moneda = 1;
 $consulta_moneda = mysqli_query($conexion,"select * from moneda where estado = 1 order by nombre ASC");
 while($resultado_consulta_moneda = mysqli_fetch_array($consulta_moneda))
 {
  $monedas[$cantidad_moneda]['id'] = $resultado_consulta_moneda['id'];
  $monedas[$cantidad_moneda]['nombre'] = $resultado_consulta_moneda['nombre'];
  $cantidad_moneda++; 
 }
 
 $consulta_pais = @mysqli_query($conexion,"select * from pais where id='$id_modificar'");
 $resultado_consulta_pais = mysqli_fetch_array($consulta_pais);
 if($nombre == '')
 {
  $nombre = $resultado_consulta_pais['nombre'];
  $id_moneda = $resultado_consulta_pais['moneda'];
 }
 else
 {
  $nombre2 = $resultado_consulta_pais['nombre'];
  $id_moneda2 = $resultado_consulta_pais['moneda'];
 }
  
 if($error == 0)
 {
  $consulta_pais = @mysqli_query($conexion,"select * from pais where nombre='$nombre'");
  $resultado_consulta_pais = mysqli_fetch_array($consulta_pais);
  $id = $resultado_consulta_pais['id'];
 
  if($id != $id_modificar && mysqli_num_rows($consulta_pais) == 1)
  {
   $error_nombre = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>El Nombre ya existe.</div>';
   $error = 1;
  }
 }
  
 if($error == 0)
 {
  $modificar = @mysqli_query($conexion,"update pais set nombre = '$nombre', moneda = '$id_moneda' where id = '$id_modificar'");
 }
 
?>
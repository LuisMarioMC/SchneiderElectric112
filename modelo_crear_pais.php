<?php
  
 if($_SESSION['perfil'] != 'admin')
 {
  $mensaje = 666;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
 
 $cantidad_moneda = 1;
 $consulta_moneda = mysqli_query($conexion,"select * from moneda where estado = 1 order by nombre ASC ");
 while($resultado_consulta_moneda = mysqli_fetch_array($consulta_moneda))
 {
  $monedas[$cantidad_moneda]['id'] = $resultado_consulta_moneda['id'];
  $monedas[$cantidad_moneda]['nombre'] = $resultado_consulta_moneda['nombre'];
  $cantidad_moneda++; 
 }
  
 if($error == 0)
 {
  $consulta_pais = mysqli_query($conexion,"select * from pais where nombre='$nombre'");
  if(mysqli_num_rows($consulta_pais) == 1)
  {
   $error_nombre = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>La Pa&iacute;s ya existe.</div>';
   $error = 1;
  }
 }
 
 if($error == 0)
 {
  $crear = mysqli_query($conexion,"insert into pais (nombre,moneda,estado) values ('$nombre','$id_moneda','0')"); 
 }
 
?>
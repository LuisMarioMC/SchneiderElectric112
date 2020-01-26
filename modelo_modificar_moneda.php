<?php
 
 $id_modificar = !empty($_GET['id'])? $_GET['id']:0; 
 
 if($_SESSION['perfil'] != 'admin')
 {
  $mensaje = 666; 
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }

 $consulta_moneda = @mysqli_query($conexion,"select * from moneda where id='$id_modificar'");
 $resultado_consulta_moneda = mysqli_fetch_array($consulta_moneda);
 if($nombre == '')
 {
  $nombre = $resultado_consulta_moneda['nombre'];
  $sigla = $resultado_consulta_moneda['sigla'];
 }
 else
 {
  $nombre2 = $resultado_consulta_moneda['nombre'];
  $sigla2 = $resultado_consulta_moneda['sigla'];  
 }
  
 if($error == 0)
 {
  $consulta_moneda = @mysqli_query($conexion,"select * from moneda where nombre='$nombre'");
  $resultado_consulta_moneda = mysqli_fetch_array($consulta_moneda);
  $id = $resultado_consulta_moneda['id'];
 
  if($id != $id_modificar && mysqli_num_rows($consulta_moneda) == 1)
  {
   $error_nombre = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>El Nombre ya existe.</div>';
   $error = 1;
  }
 }
 
 if($error == 0)
 {
  $consulta_moneda = @mysqli_query($conexion,"select * from moneda where sigla='$sigla'");
  $resultado_consulta_moneda = mysqli_fetch_array($consulta_moneda);
  $id = $resultado_consulta_moneda['id'];
 
  if($id != $id_modificar && mysqli_num_rows($consulta_moneda) == 1)
  {
   $error_sigla = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>La Sigla ya existe.</div>';
   $error = 1;
  }
 }
  
 if($error == 0)
 {
  $modificar = @mysqli_query($conexion,"update moneda set nombre = '$nombre', sigla = '$sigla' where id = '$id_modificar'");
 }
 
?>
<?php
 
 $id_modificar = !empty($_GET['id'])? $_GET['id']:0; 
 
 if($_SESSION['perfil'] != 'admin')
 {
  $mensaje = 666; 
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }

 $cantidad_pais = 1;
 $consulta_pais = mysqli_query($conexion,"select * from pais where estado = 1 order by nombre ASC ");
 while($resultado_consulta_pais = mysqli_fetch_array($consulta_pais))
 {
  $paises[$cantidad_pais]['id'] = $resultado_consulta_pais['id'];
  $paises[$cantidad_pais]['nombre'] = $resultado_consulta_pais['nombre'];
  $cantidad_pais++; 
 }
 
 $consulta_zona = @mysqli_query($conexion,"select * from zona where id='$id_modificar'");
 $resultado_consulta_zona = mysqli_fetch_array($consulta_zona);
 if($nombre == '')
 {
  $nombre = $resultado_consulta_zona['nombre'];
  $id_pais = $resultado_consulta_zona['pais'];
 }
 else
 {
  $nombre2 = $resultado_consulta_zona['nombre'];
  $id_pais2 = $resultado_consulta_zona['pais'];
 }
  
 if($error == 0)
 {
  $consulta_zona = @mysqli_query($conexion,"select * from zona where nombre='$nombre' and pais='$id_pais'");
  $resultado_consulta_zona = mysqli_fetch_array($consulta_zona);
  $id = $resultado_consulta_zona['id'];
 
  if($id != $id_modificar && mysqli_num_rows($consulta_zona) == 1)
  {
   $error_nombre = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>La Zona ya existe.</div>';
   $error = 1;
  }
 }
  
 if($error == 0)
 {
  $modificar = @mysqli_query($conexion,"update zona set nombre = '$nombre', pais = '$id_pais' where id = '$id_modificar'");
 }
 
?>
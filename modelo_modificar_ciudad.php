<?php
 
 $id_modificar = !empty($_GET['id'])? $_GET['id']:0;
 $id_modificar = mysqli_real_escape_string($conexion,$id_modificar);
 
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
 
 $consulta_ciudad = @mysqli_query($conexion,"select * from ciudad where id='$id_modificar'");
 $resultado_consulta_ciudad = mysqli_fetch_array($consulta_ciudad);
 if($nombre == '')
 {
  $nombre = $resultado_consulta_ciudad['nombre'];
  $id_pais = $resultado_consulta_ciudad['pais'];
  $id_departamento = $resultado_consulta_ciudad['departamento']; 
 }
 else
 {
  $nombre2 = $resultado_consulta_ciudad['nombre'];
  $id_pais2 = $resultado_consulta_ciudad['pais'];
  $id_departamento2 = $resultado_consulta_ciudad['departamento'];
 }
  
 if($error == 0)
 {
  $consulta_ciudad = @mysqli_query($conexion,"select * from ciudad where nombre='$nombre'");
  $resultado_consulta_ciudad = mysqli_fetch_array($consulta_ciudad);
  $id = $resultado_consulta_ciudad['id'];
 
  if($id != $id_modificar && mysqli_num_rows($consulta_ciudad) == 1)
  {
   $error_nombre = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>La Ciudad ya existe.</div>';
   $error = 1;
  }
 }
  
 if($error == 0)
 {
  $modificar = @mysqli_query($conexion,"update ciudad set nombre = '$nombre', pais = '$id_pais', departamento = '$id_departamento' where id = '$id_modificar'");
 }
 
?>
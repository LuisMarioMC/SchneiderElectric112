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
 
 $consulta_departamento = @mysqli_query($conexion,"select * from departamento where id='$id_modificar'");
 $resultado_consulta_departamento = mysqli_fetch_array($consulta_departamento);
 if($nombre == '')
 {
  $nombre = $resultado_consulta_departamento['nombre'];
  $id_pais = $resultado_consulta_departamento['pais'];
  $id_zona = $resultado_consulta_departamento['zona']; 
 }
 else
 {
  $nombre2 = $resultado_consulta_departamento['nombre'];
  $id_pais2 = $resultado_consulta_departamento['pais'];
  $id_zona2 = $resultado_consulta_departamento['zona'];
 }
  
 if($error == 0)
 {
  $consulta_departamento = @mysqli_query($conexion,"select * from departamento where nombre='$nombre' and pais='$id_pais'");
  $resultado_consulta_departamento = mysqli_fetch_array($consulta_departamento);
  $id = $resultado_consulta_departamento['id'];
 
  if($id != $id_modificar && mysqli_num_rows($consulta_departamento) == 1)
  {
   $error_nombre = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>El Departamento ya existe.</div>';
   $error = 1;
  }
 }
  
 if($error == 0)
 {
  $modificar = @mysqli_query($conexion,"update departamento set nombre = '$nombre', pais = '$id_pais', zona = '$id_zona' where id = '$id_modificar'");
 }
 
?>
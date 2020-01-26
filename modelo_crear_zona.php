<?php
  
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
  
 if($error == 0)
 {
  $consulta_zona = mysqli_query($conexion,"select * from zona where nombre='$nombre' and pais='$id_pais'");
  if(mysqli_num_rows($consulta_zona) == 1)
  {
   $error_nombre = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>La zona ya existe.</div>';
   $error = 1;
  }
 }
 
 if($error == 0)
 {
  $crear = mysqli_query($conexion,"insert into zona (nombre,pais,estado) values ('$nombre','$id_pais','0')"); 
 }
 
?>
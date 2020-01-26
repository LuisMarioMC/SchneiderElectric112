<?php

 require_once ('conexion_sesion.php');
  
 if($_SESSION['perfil'] != 'admin')
 {
  $mensaje = 666;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
 
 $i = 1;

 $consulta_zona = mysqli_query($conexion,"select * from zona order by id desc");
 
 while ($resultado_consulta_zona = mysqli_fetch_array($consulta_zona))
 {
  // Id
  $zona[$i]['id'] = $resultado_consulta_zona['id'];

  // Estado
  $zona[$i]['estado'] = $resultado_consulta_zona['estado'];
  
  // Nombre
  $zona[$i]['nombre'] = $resultado_consulta_zona['nombre'];
  
  // País
  $consulta_pais = mysqli_query($conexion,"select * from pais where id = $resultado_consulta_zona[pais]");
  $resultado_consulta_pais = mysqli_fetch_array($consulta_pais);
  $zona[$i]['pais'] = $resultado_consulta_pais['nombre'];

  $i++;
 }

?>
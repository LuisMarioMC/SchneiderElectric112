<?php

 require_once ('conexion_sesion.php');
  
 if($_SESSION['perfil'] != 'admin')
 {
  $mensaje = 666;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
 
 $i = 1;

 $consulta_pais = mysqli_query($conexion,"select * from pais order by id desc");
 
 while ($resultado_consulta_pais = mysqli_fetch_array($consulta_pais))
 {
  // Id
  $pais[$i]['id'] = $resultado_consulta_pais['id'];

  // Estado
  $pais[$i]['estado'] = $resultado_consulta_pais['estado'];
  
  // Nombre
  $pais[$i]['nombre'] = $resultado_consulta_pais['nombre'];
  
  // Moneda
  $consulta_moneda = mysqli_query($conexion,"select * from moneda where id = $resultado_consulta_pais[moneda]");
  $resultado_consulta_moneda = mysqli_fetch_array($consulta_moneda);
  $pais[$i]['moneda'] = $resultado_consulta_moneda['nombre'];
  
  $i++;
 }

?>
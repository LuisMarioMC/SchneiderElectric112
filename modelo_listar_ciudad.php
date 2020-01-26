<?php

 require_once ('conexion_sesion.php');
  
 if($_SESSION['perfil'] != 'admin')
 {
  $mensaje = 666;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
 
 $i = 1;

 $consulta_ciudad = mysqli_query($conexion,"select * from ciudad order by id desc");
 
 while ($resultado_consulta_ciudad = mysqli_fetch_array($consulta_ciudad))
 {
  // Id
  $ciudad[$i]['id'] = $resultado_consulta_ciudad['id'];

  // Estado
  $ciudad[$i]['estado'] = $resultado_consulta_ciudad['estado'];
  
  // Nombre
  $ciudad[$i]['nombre'] = $resultado_consulta_ciudad['nombre'];
  
  // País
  $consulta_pais = mysqli_query($conexion,"select * from pais where id = $resultado_consulta_ciudad[pais]");
  $resultado_consulta_pais = mysqli_fetch_array($consulta_pais);
  $ciudad[$i]['pais'] = $resultado_consulta_pais['nombre'];

  // Departamento
  $consulta_departamento = mysqli_query($conexion,"select * from departamento where id = $resultado_consulta_ciudad[departamento]");
  $resultado_consulta_departamento = mysqli_fetch_array($consulta_departamento);
  $ciudad[$i]['departamento'] = $resultado_consulta_departamento['nombre'];

  $i++;
 }

?>
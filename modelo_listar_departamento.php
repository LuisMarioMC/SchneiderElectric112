<?php

 require_once ('conexion_sesion.php');
  
 if($_SESSION['perfil'] != 'admin')
 {
  $mensaje = 666;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
 
 $i = 1;

 $consulta_departamento = mysqli_query($conexion,"select * from departamento order by id desc");
 
 while ($resultado_consulta_departamento = mysqli_fetch_array($consulta_departamento))
 {
  // Id
  $departamento[$i]['id'] = $resultado_consulta_departamento['id'];

  // Estado
  $departamento[$i]['estado'] = $resultado_consulta_departamento['estado'];
  
  // Nombre
  $departamento[$i]['nombre'] = $resultado_consulta_departamento['nombre'];
  
  // País
  $consulta_pais = mysqli_query($conexion,"select * from pais where id = $resultado_consulta_departamento[pais]");
  $resultado_consulta_pais = mysqli_fetch_array($consulta_pais);
  $departamento[$i]['pais'] = $resultado_consulta_pais['nombre'];

  // Zona
  $consulta_zona = mysqli_query($conexion,"select * from zona where id = $resultado_consulta_departamento[zona]");
  $resultado_consulta_zona = mysqli_fetch_array($consulta_zona);
  $departamento[$i]['zona'] = $resultado_consulta_zona['nombre'];

  $i++;
 }

?>
<?php
 require_once ('conexion_sesion.php');
 
 if($_SESSION['perfil'] != 'admin' && $_SESSION['perfil'] != 'admin_schneider' && $_SESSION['perfil'] != 'super_schneider')
 {
  $mensaje = 666;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
 
 $cantidad_usuarios = 0;

 if($_SESSION['perfil'] == 'admin')
 {
  $consulta_usuario = mysqli_query($conexion,"select * from usuario order by id desc");
 }
 
 if($_SESSION['perfil'] == 'admin_schneider' || $_SESSION['perfil'] == 'super_schneider')
 {
  $consulta_usuario = mysqli_query($conexion,"select * from usuario where perfil = 'distribuidor' or perfil = 'vendedor' order by id desc");
 }
 
 while ($resultado_consulta_usuario = mysqli_fetch_array($consulta_usuario))
 {
  // Id
  $usuario[$cantidad_usuarios]['id'] = $resultado_consulta_usuario['id'];

  // Estado
  $usuario[$cantidad_usuarios]['estado'] = $resultado_consulta_usuario['estado'];

  // Nombre
  $usuario[$cantidad_usuarios]['nombre'] = $resultado_consulta_usuario['nombre'];
  
  // Correo Electrónico
  $usuario[$cantidad_usuarios]['correo_electronico'] = $resultado_consulta_usuario['correo_electronico'];

  // Celular
  $usuario[$cantidad_usuarios]['celular'] = $resultado_consulta_usuario['celular'];
  
  // Perfil
  $usuario[$cantidad_usuarios]['perfil'] = $resultado_consulta_usuario['perfil'];
  
  // Canal
  if ($usuario[$cantidad_usuarios]['perfil'] == 'canal')
  {
   $consulta_pais = mysqli_query($conexion,"select * from pais where id = $resultado_consulta_usuario[pais]");
   $resultado_consulta_pais = mysqli_fetch_array($consulta_pais);  
   $usuario[$cantidad_usuarios]['opcion'] = $resultado_consulta_pais['nombre'];
  } // Linea
  elseif ($usuario[$cantidad_usuarios]['perfil'] == 'linea')
  {
   $consulta_linea = mysqli_query($conexion,"select * from linea where id = $resultado_consulta_usuario[linea]");
   $resultado_consulta_linea = mysqli_fetch_array($consulta_linea);  
   $usuario[$cantidad_usuarios]['opcion'] = $resultado_consulta_linea['nombre'];
  } // Distribuidor
  elseif ($usuario[$cantidad_usuarios]['perfil'] == 'distribuidor')
  {
   $consulta_pais = mysqli_query($conexion,"select * from pais where id = $resultado_consulta_usuario[pais]");
   $resultado_consulta_pais = mysqli_fetch_array($consulta_pais);
   
   $consulta_zona = mysqli_query($conexion,"select * from zona where id = $resultado_consulta_usuario[zona]");
   $resultado_consulta_zona = mysqli_fetch_array($consulta_zona);
   $usuario[$cantidad_usuarios]['opcion'] = $resultado_consulta_pais['nombre'].' ('.$resultado_consulta_zona['nombre'].')';
  } // Vendedor
  elseif ($usuario[$cantidad_usuarios]['perfil'] == 'vendedor')
  {
   $consulta_distribuidor = mysqli_query($conexion,"select * from usuario where id = $resultado_consulta_usuario[distribuidor]");
   $resultado_consulta_distribuidor = mysqli_fetch_array($consulta_distribuidor);
   $usuario[$cantidad_usuarios]['opcion'] = $resultado_consulta_distribuidor['nombre'];
  } // Distribuidor
  else
  {
   $usuario[$cantidad_usuarios]['opcion'] = '';
  }
  
  
  
  
  $cantidad_usuarios++;
 }
  
?>
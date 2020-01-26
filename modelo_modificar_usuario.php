<?php
 
 $id_modificar = !empty($_GET['id'])? $_GET['id']:0; 
 
 if($_SESSION['perfil'] != 'admin')
 {
  $mensaje = 666; 
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
 
 $cantidad_pais = 1;
 $consulta_pais = @mysqli_query($conexion,"select * from pais where estado = 1 order by nombre ASC");
 while($resultado_consulta_pais = @mysqli_fetch_array($consulta_pais))
 {
  $paises[$cantidad_pais]['id'] = $resultado_consulta_pais['id'];
  $paises[$cantidad_pais]['nombre'] = $resultado_consulta_pais['nombre'];
  $cantidad_pais++;
 }
 
 $cantidad_linea = 1;
 $consulta_linea = @mysqli_query($conexion,"select * from linea where estado = 1 order by nombre ASC");
 while($resultado_consulta_linea = @mysqli_fetch_array($consulta_linea))
 {
  $lineas[$cantidad_linea]['id'] = $resultado_consulta_linea['id'];
  $lineas[$cantidad_linea]['nombre'] = $resultado_consulta_linea['nombre'];
  $cantidad_linea++;
 }

 $cantidad_actividad = 1;
 $consulta_actividad = @mysqli_query($conexion,"select * from actividad where estado = 1 order by nombre ASC");
 while($resultado_consulta_actividad = @mysqli_fetch_array($consulta_actividad))
 {
  $actividades[$cantidad_actividad]['id'] = $resultado_consulta_actividad['id'];
  $actividades[$cantidad_actividad]['nombre'] = $resultado_consulta_actividad['nombre'];
  $cantidad_actividad++;
 }
 
 $cantidad_zona = 1;
 $consulta_zona = @mysqli_query($conexion,"select * from zona where estado = 1 order by nombre ASC");
 while($resultado_consulta_zona = @mysqli_fetch_array($consulta_zona))
 {
  $zonas[$cantidad_zona]['id'] = $resultado_consulta_zona['id'];
  $zonas[$cantidad_zona]['nombre'] = $resultado_consulta_zona['nombre'];
  $cantidad_zona++;
 }
   
 $consulta_usuario = @mysqli_query($conexion,"select * from usuario where id='$id_modificar'");
 $resultado_consulta_usuario = mysqli_fetch_array($consulta_usuario);
 if($nombre == '')
 {
  $nombre = $resultado_consulta_usuario['nombre'];
  $correo_electronico = $resultado_consulta_usuario['correo_electronico'];
  $celular = $resultado_consulta_usuario['celular'];
  $perfil =  $resultado_consulta_usuario['perfil'];
 }
 else
 {
  $nombre2 = $resultado_consulta_usuario['nombre'];
  $correo_electronico2 = $resultado_consulta_usuario['correo_electronico'];
  $celular2 = $resultado_consulta_usuario['celular'];
  $perfil2 =  $resultado_consulta_usuario['perfil'];
 }
 
 if($perfil == 'segmento')
 {
  $cantidad_segmento_usuarios = 0;

  $consulta_segmento_usuario = mysqli_query($conexion,"select * from segmento_usuario where usuario = $id_modificar order by id desc");
  while ($resultado_consulta_segmento_usuario = mysqli_fetch_array($consulta_segmento_usuario))
  {
   // Id
   $segmento_usuario[$cantidad_segmento_usuarios]['id'] = $resultado_consulta_segmento_usuario['id'];

   // País
   $consulta_pais = mysqli_query($conexion,"select * from pais where id = $resultado_consulta_segmento_usuario[pais]");
   $resultado_consulta_pais = mysqli_fetch_array($consulta_pais);
   $segmento_usuario[$cantidad_segmento_usuarios]['pais'] = $resultado_consulta_pais['nombre'];

   // Segmento
   $consulta_segmento = mysqli_query($conexion,"select * from segmento where id = $resultado_consulta_segmento_usuario[segmento]");
   $resultado_consulta_segmento = mysqli_fetch_array($consulta_segmento);
   $segmento_usuario[$cantidad_segmento_usuarios]['segmento'] = $resultado_consulta_segmento['nombre'];
    
   $cantidad_segmento_usuarios++;
  }

 }
 
 if($perfil == 'zona')
 {
  $cantidad_zona_usuarios = 0;

  $consulta_zona_usuario = mysqli_query($conexion,"select * from zona_usuario where usuario = $id_modificar order by id desc");
  while ($resultado_consulta_zona_usuario = mysqli_fetch_array($consulta_zona_usuario))
  {
   // Id
   $zona_usuario[$cantidad_zona_usuarios]['id'] = $resultado_consulta_zona_usuario['id'];

   // País
   $consulta_pais = mysqli_query($conexion,"select * from pais where id = $resultado_consulta_zona_usuario[pais]");
   $resultado_consulta_pais = mysqli_fetch_array($consulta_pais);
   $zona_usuario[$cantidad_zona_usuarios]['pais'] = $resultado_consulta_pais['nombre'];

   // Zona   
   $consulta_zona = mysqli_query($conexion,"select * from zona where id = $resultado_consulta_zona_usuario[zona]");
   $resultado_consulta_zona = mysqli_fetch_array($consulta_zona);
   $zona_usuario[$cantidad_zona_usuarios]['zona'] = $resultado_consulta_zona['nombre'];
    
   $cantidad_zona_usuarios++;
  }

 }
 
 /*
 if($error == 0)
 {
  $consulta_usuario = @mysqli_query($conexion,"select * from usuario where nombre='$nombre'");
  $resultado_consulta_usuario = mysqli_fetch_array($consulta_usuario);
  $id = $resultado_consulta_usuario['id'];
 
  if($id != $id_modificar && mysqli_num_rows($consulta_usuario) == 1)
  {
   $error_nombre = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>El Nombre ya existe.</div>';
   $error = 1;
  }
 }
 */ 
 
 if($error == 0)
 {
  $modificar = mysqli_query($conexion,"update usuario set nombre = '$nombre', correo_electronico = '$correo_electronico', celular = '$celular' where id = '$id_modificar'");
  echo mysqli_error($conexion);
 }
 
?>
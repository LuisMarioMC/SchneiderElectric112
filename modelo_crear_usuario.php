<?php
 
 if($_SESSION['perfil'] != 'admin' && $_SESSION['perfil']!='admin_schneider')
 {
  $mensaje = 665;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
  
 if($error == 0)
 {
  $consulta_correo_electronico = @mysqli_query($conexion,"select * from usuario where correo_electronico='$correo_electronico'");
  if(mysqli_num_rows($consulta_correo_electronico) == 1)
  {
   $error_correo_electronico = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>El Correo Electr&oacute;nico ya esta registrado.</div>';
   $error = 1;
  }
 }
 
 if($error == 0)
 {
  if($perfil == 'admin' || $perfil == 'super_schneider'  || $perfil == 'admin_schneider' || $perfil == 'cartera' || $perfil == 'actividad' || $perfil == 'segmento' || $perfil == 'zona')
  {
   $pais = 0;
   $linea = 0;
   $zona = 0;
   $distribuidor = 0;
  }
  if($perfil == 'canal')
  {
   $linea = 0;
   $zona = 0;
   $distribuidor = 0;
  }
  if($perfil == 'linea')
  {
   $pais = 0;
   $zona = 0;
   $distribuidor = 0;
  }
  
  if($perfil == 'distribuidor')
  {
   $consulta_pais = mysqli_query($conexion,"select * from pais where id = $pais");
   $resultado_consulta_pais = mysqli_fetch_array($consulta_pais);
   $nombre_pais = $resultado_consulta_pais['nombre'];

   $consulta_zona = mysqli_query($conexion,"select * from zona where id = $zona");
   $resultado_consulta_zona = mysqli_fetch_array($consulta_zona);
   $nombre_zona = $resultado_consulta_zona['nombre'];
  
   $linea = 0;
   $distribuidor = 0;
  }
  
  if($perfil == 'vendedor')
  {
   $consulta_distribuidor = mysqli_query($conexion,"select * from usuario where id = $distribuidor");
   $resultado_consulta_distribuidor = mysqli_fetch_array($consulta_distribuidor);
   $nombre_distribuidor = $resultado_consulta_distribuidor['nombre'];
   $correo_electronico_distribuidor = $resultado_consulta_distribuidor['correo_electronico'];

   $linea = 0;
   $zona = 0;
  }
	
  if($contrasenia_automatica == 1)
  {
   $contrasenia = rand(100000, 999999);
  }
  $contrasenia_encriptada = md5($contrasenia);
  $restablecer = 1;
  
  $crear = @mysqli_query($conexion,"insert into usuario (nombre,correo_electronico,celular,perfil,contrasenia,pais,linea,zona,distribuidor,restablecer) values ('$nombre','$correo_electronico','$celular','$perfil','$contrasenia_encriptada','$pais','$linea','$zona','$distribuidor','$restablecer')");
  echo mysqli_error($conexion);
 }
  
?>
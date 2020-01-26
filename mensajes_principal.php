<?php 

 if($mensaje == 0)
 {
  // Leo el id enviado por GET de la Sección
  $mensaje = !empty($_GET['m'])? $_GET['m']:0;
 }
 
 $listar_mensaje = '';
 
 if ($mensaje != 0)
 {
  $listar_mensaje .= '<script language="JavaScript" type="text/javascript">';
  
  // Cambiar Contraseña
  // Cambio de forma correcta.
  if ($mensaje == 21)
  {  
   $listar_mensaje .= ' window.onload = MensajeCambiarContrasenia';
  }
  // Se presento un error al cambiar.
  if ($mensaje == 22)
  {
   $listar_mensaje .= ' window.onload = MensajeErrorCambiarContrasenia1';
  }
  
  // Restablecer
  // Fue restablecer de forma correcta.
  if ($mensaje == 31)
  {  
   $listar_mensaje .= ' window.onload = MensajeRestablecerContrasenia';
  }
  // Se presento un error al restablecer.
  if ($mensaje == 32)
  {
   $listar_mensaje .= ' window.onload = MensajeErrorRestablecerContrasenia1';
  }
 
  $listar_mensaje .= '</script>';
 }
 
?>
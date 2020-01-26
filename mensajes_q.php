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
  
  // Activar
  // Fue activado de forma correcta.
  if ($mensaje == 41)
  {  
   $listar_mensaje .= ' window.onload = MensajeActivarQ';
  }
  // Se presento un error al activar.
  if ($mensaje == 42)
  {
   $listar_mensaje .= ' window.onload = MensajeErrorActivarQ1';
  }
  // Error 2.
  if ($mensaje == 43)
  {
   $listar_mensaje .= ' window.onload = MensajeErrorActivarQ2';
  }
  
  // Inactivar
  // Fue inactivado de forma correcta.
  if ($mensaje == 51)
  {  
   $listar_mensaje .= ' window.onload = MensajeInactivarQ';
  }
  // Se presento un error al inactivar
  if ($mensaje == 52)
  {  
   $listar_mensaje .= ' window.onload = MensajeErrorInactivarQ1';
  }
  // Error 2
  if ($mensaje == 53)
  {
   $listar_mensaje .= ' window.onload = MensajeErrorInactivarQ2';
  }
  
  $listar_mensaje .= '</script>';
 }
 
?>
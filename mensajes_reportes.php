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
  
  // Crear
  // Fue creado de forma correcta.
  if ($mensaje == 21)
  {  
   $listar_mensaje .= ' window.onload = MensajeCrearReporte';
  }
  // Se presento un error al crear.
  if ($mensaje == 22)
  {
   $listar_mensaje .= ' window.onload = MensajeErrorCrearReporte1';
  }
  
  // Rechazar
  // Fue rechazado de forma correcta.
  if ($mensaje == 31)
  {  
   $listar_mensaje .= ' window.onload = MensajeRechazarReporte';
  }
  // Se presento un error al rechazar.
  if ($mensaje == 32)
  {
   $listar_mensaje .= ' window.onload = MensajeErrorRechazarReporte1';
  }
  
  
  $listar_mensaje .= '</script>';
 }
 
?>
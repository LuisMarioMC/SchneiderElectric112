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
  
  // Eliminar
  // Fue eliminado de forma correcta.
  if ($mensaje == 11)
  {
   $listar_mensaje .= ' window.onload = MensajeEliminarReporte';
  }
  // Se presento un error al eliminar.
  if ($mensaje == 12)
  {  
   $listar_mensaje .= ' window.onload = MensajeErrorEliminarReporte1';
  }
  // No puede ser eliminado debido que ......
  if ($mensaje == 13)
  {  
   $listar_mensaje .= ' window.onload = MensajeErrorEliminarReporte2';
  }
  
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
  
  $listar_mensaje .= '</script>';
 }
 
?>
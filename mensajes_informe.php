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
  
  // Informe
  // El informe se obtuvo de forma correcta.
  if ($mensaje == 11)
  {  
   $listar_mensaje .= ' window.onload = MensajeInforme';
  }
  // Se presento un error al obtener el informe.
  if ($mensaje == 12)
  {  
   $listar_mensaje .= ' window.onload = MensajeErrorInforme';
  }

  $listar_mensaje .= '</script>';
 }
 
?>
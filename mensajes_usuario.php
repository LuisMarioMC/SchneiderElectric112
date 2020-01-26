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
  
  // Eliminar Usuario
  // Fue eliminado de forma correcta.
  if ($mensaje == 11)
  {  
   $listar_mensaje .= ' window.onload = MensajeEliminarUsuario';
  }
  // Se presento un error al eliminar.
  if ($mensaje == 12)
  {  
   $listar_mensaje .= ' window.onload = MensajeErrorEliminarUsuario1';
  }
  // No puede ser eliminado debido a que existen Demos que la utilizan.
  if ($mensaje == 13)
  {  
   $listar_mensaje .= ' window.onload = MensajeErrorEliminarUsuario2';
  }

  // Eliminar Zona Usuario
  // Fue eliminado de forma correcta.
  if ($mensaje == 14)
  {  
   $listar_mensaje .= ' window.onload = MensajeEliminarZonaUsuario';
  }
  // Se presento un error al eliminar.
  if ($mensaje == 15)
  {
   $listar_mensaje .= ' window.onload = MensajeErrorEliminarZonaUsuario1';
  }
  
  // Eliminar Segmento Usuario
  // Fue eliminado de forma correcta.
  if ($mensaje == 16)
  {  
   $listar_mensaje .= ' window.onload = MensajeEliminarSegmentoUsuario';
  }
  // Se presento un error al eliminar.
  if ($mensaje == 17)
  {
   $listar_mensaje .= ' window.onload = MensajeErrorEliminarSegmentoUsuario1';
  }
  
  // Crear
  // Fue creado de forma correcta.
  if ($mensaje == 21)
  {  
   $listar_mensaje .= ' window.onload = MensajeCrearUsuario';
  }
  // Se presento un error al crear.
  if ($mensaje == 22)
  {
   $listar_mensaje .= ' window.onload = MensajeErrorCrearUsuario1';
  }
  
  // Zona Usuario
  // Fue creado de forma correcta la Zona del Usuario.
  if ($mensaje == 23)
  {  
   $listar_mensaje .= ' window.onload = MensajeCrearZonaUsuario';
  }
  // Se presento un error al crear la Zona Usuario.
  if ($mensaje == 24)
  {
   $listar_mensaje .= ' window.onload = MensajeErrorCrearZonaUsuario1';
  }
  
  // Segmento Usuario
  // Fue creado de forma correcta el Segmento del Usuario.
  if ($mensaje == 25)
  {  
   $listar_mensaje .= ' window.onload = MensajeCrearSegmentoUsuario';
  }
  // Se presento un error al crear el Segmento del Usuario.
  if ($mensaje == 26)
  {
   $listar_mensaje .= ' window.onload = MensajeErrorCrearSegmentoUsuario1';
  }
  
  // Modificar
  // Fue modificado de forma correcta.
  if ($mensaje == 31)
  {
   $listar_mensaje .= ' window.onload = MensajeModificarUsuario';
  }
  // Se presento un error al modificar.
  if ($mensaje == 32)
  {
   $listar_mensaje .= ' window.onload = MensajeErrorModificarUsuario1';
  }
  
  // Activar
  // Fue activado de forma correcta.
  if ($mensaje == 41)
  {  
   $listar_mensaje .= ' window.onload = MensajeActivarUsuario';
  }
  // Se presento un error al activar.
  if ($mensaje == 42)
  {
   $listar_mensaje .= ' window.onload = MensajeErrorActivarUsuario1';
  }
  
  // Inactivar
  // Fue inactivado de forma correcta.
  if ($mensaje == 51)
  {  
   $listar_mensaje .= ' window.onload = MensajeInactivarUsuario';
  }
  // Fue inactivado de forma correcta.
  if ($mensaje == 52)
  {  
   $listar_mensaje .= ' window.onload = MensajeErrorInactivarUsuario1';
  }
  
  $listar_mensaje .= '</script>';
 }
 
?>
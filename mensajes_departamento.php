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
   $listar_mensaje .= ' window.onload = MensajeEliminarDepartamento';
  }
  // Se presento un error al eliminar.
  if ($mensaje == 12)
  {  
   $listar_mensaje .= ' window.onload = MensajeErrorEliminarDepartamento1';
  }
  // No puede ser eliminado debido a que existen Demos que la utilizan.
  if ($mensaje == 13)
  {  
   $listar_mensaje .= ' window.onload = MensajeErrorEliminarDepartamento2';
  }

  // Crear
  // Fue creado de forma correcta.
  if ($mensaje == 21)
  {  
   $listar_mensaje .= ' window.onload = MensajeCrearDepartamento';
  }
  // Se presento un error al crear.
  if ($mensaje == 22)
  {
   $listar_mensaje .= ' window.onload = MensajeErrorCrearDepartamento1';
  }

  // Modificar
  // Fue modificado de forma correcta.
  if ($mensaje == 31)
  {
   $listar_mensaje .= ' window.onload = MensajeModificarDepartamento';
  }
  // Se presento un error al modificar.
  if ($mensaje == 32)
  {
   $listar_mensaje .= ' window.onload = MensajeErrorModificarDepartamento1';
  }
  
  // Activar
  // Fue activado de forma correcta.
  if ($mensaje == 41)
  {  
   $listar_mensaje .= ' window.onload = MensajeActivarDepartamento';
  }
  // Se presento un error al activar.
  if ($mensaje == 42)
  {
   $listar_mensaje .= ' window.onload = MensajeErrorActivarDepartamento1';
  }
  if ($mensaje == 43)
  {
   $listar_mensaje .= ' window.onload = MensajeErrorActivarDepartamento2';
  }
  
  // Inactivar
  // Fue inactivado de forma correcta.
  if ($mensaje == 51)
  {  
   $listar_mensaje .= ' window.onload = MensajeInactivarDepartamento';
  }
  // Fue inactivado de forma correcta.
  if ($mensaje == 52)
  {  
   $listar_mensaje .= ' window.onload = MensajeErrorInactivarDepartamento1';
  }
  if ($mensaje == 53)
  {
   $listar_mensaje .= ' window.onload = MensajeErrorInactivarDepartamento2';
  }
  
  $listar_mensaje .= '</script>';
 }
 
?>
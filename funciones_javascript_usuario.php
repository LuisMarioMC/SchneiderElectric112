 <script language="JavaScript" type="text/javascript">
 
  //Eliminar Usuario
  function CajaConfirmacionEliminarUsuario(id_usuario)
  {
   if(confirm('En realidad desea eliminar el Usuario?'))
   {
    document.location.href='controlador_eliminar_usuario.php?id='+id_usuario;
   }
  }
  function MensajeEliminarUsuario()
  {
   alertify.success("El Usuario fue eliminado de forma correcta.");
  }
  function MensajeErrorEliminarUsuario1()
  {
   alertify.error("Se presento un error al eliminar el Usuario.");
  }
  function MensajeErrorEliminarUsuario2()
  {
   alertify.error("El Usuario no puede ser eliminado debido a que existen Inscripciones creadas por el.");
  }

  //Eliminar Zona Usuario
  function CajaConfirmacionEliminarZonaUsuario(id_zona_usuario)
  {
   if(confirm('En realidad desea eliminar la Zona?'))
   {
    document.location.href='controlador_eliminar_zona_usuario.php?id='+id_zona_usuario;
   }
  }
  function MensajeEliminarZonaUsuario()
  {
   alertify.success("La Zona fue eliminada de forma correcta.");
  }
  function MensajeErrorEliminarZonaUsuario1()
  {
   alertify.error("Se presento un error al eliminar la Zona.");
  }
  
  //Eliminar Segmento Usuario
  function CajaConfirmacionEliminarSegmentoUsuario(id_segmento_usuario)
  {
   if(confirm('En realidad desea eliminar el Segmento?'))
   {
    document.location.href='controlador_eliminar_segmento_usuario.php?id='+id_segmento_usuario;
   }
  }
  function MensajeEliminarSegmentoUsuario()
  {
   alertify.success("El Segmento fue eliminado de forma correcta.");
  }
  function MensajeErrorEliminarSegmentoUsuario1()
  {
   alertify.error("Se presento un error al eliminar el Segmento.");
  }
  
  // Crear Usuario
  function MensajeCrearUsuario()
  {
   alertify.success("El Usuario fue creado de forma correcta.");
  }
  function MensajeErrorCrearUsuario1()
  {
   alertify.error("Se presento un error al crear el Usuario.");
  }
  
  // Crear Zona Usuario
  function MensajeCrearZonaUsuario()
  {
   alertify.success("La Zona fue creada de forma correcta.");
  }
  function MensajeErrorCrearZonaUsuario1()
  {
   alertify.error("La Zona ya esta registrada.");
  }
   
  // Crear Segmento Usuario
  function MensajeCrearSegmentoUsuario()
  {
   alertify.success("El Segmento fue creado de forma correcta.");
  }
  function MensajeErrorCrearSegmentoUsuario1()
  {
   alertify.error("El Segmento ya esta registrado.");
  }
   
  // Modificar
  function MensajeModificarUsuario()
  {
   alertify.success("El Usuario fue modificado de forma correcta.");
  }
  function MensajeErrorModificarUsuario1()
  {
   alertify.error("Se presento un error al modificar el Usuario.");
  }
  
  // Activar
  function MensajeActivarUsuario()
  {
   alertify.success("El Usuario fue activado de forma correcta.");
  }
  function MensajeErrorActivarUsuario1()
  {
   alertify.error("Se presento un error al activar el Usuario.");
  }

  // Inactivar
  function MensajeInactivarUsuario()
  {
   alertify.success("El Usuario fue inactivado de forma correcta.");
  }
  function MensajeErrorInactivarUsuario1()
  {
   alertify.error("Se presento un error al inactivar el Usuario.");
  }
  
 </script>
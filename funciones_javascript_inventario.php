 <script language="JavaScript" type="text/javascript">
 
  //Eliminar
  function CajaConfirmacionEliminarUsuario(id_inventario)
  {
   if(confirm('En realidad desea eliminar el Usuario?'))
   {
    document.location.href='controlador_eliminar_inventario.php?id='+id_inventario;
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

  // Crear
  function MensajeCrearUsuario()
  {
   alertify.success("El Usuario fue creado de forma correcta.");
  }
  function MensajeErrorCrearUsuario1()
  {
   alertify.error("Se presento un error al crear el Usuario.");
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
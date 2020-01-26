 <script language="JavaScript" type="text/javascript">
 
  //Eliminar
  function CajaConfirmacionEliminarActividad(id_actividad)
  {
   if(confirm('En realidad desea eliminar la Actividad?'))
   {
    document.location.href='controlador_eliminar_actividad.php?id='+id_actividad;
   }
  }
  function MensajeEliminarActividad()
  {
   alertify.success("La Actividad fue eliminada de forma correcta.");
  }
  function MensajeErrorEliminarActividad1()
  {
   alertify.error("Se presento un error al eliminar la Actividad.");
  }
  function MensajeErrorEliminarActividad2()
  {
   alertify.error("La Actividad no puede ser eliminada debido a que existen Productos que lo utilizan.");
  }

  // Crear
  function MensajeCrearActividad()
  {
   alertify.success("La Actividad fue creada de forma correcta.");
  }
  function MensajeErrorCrearActividad1()
  {
   alertify.error("Se presento un error al crear la Actividad.");
  }
    
  // Modificar
  function MensajeModificarActividad()
  {
   alertify.success("La Actividad fue modificada de forma correcta.");
  }
  function MensajeErrorModificarActividad1()
  {
   alertify.error("Se presento un error al modificar la Actividad.");
  }
  
  // Activar
  function MensajeActivarActividad()
  {
   alertify.success("La Actividad fue activada de forma correcta.");
  }
  function MensajeErrorActivarActividad1()
  {
   alertify.error("Se presento un error al activar la Actividad.");
  }

  // Inactivar
  function MensajeInactivarActividad()
  {
   alertify.success("La Actividad fue inactivada de forma correcta.");
  }
  function MensajeErrorInactivarActividad1()
  {
   alertify.error("Se presento un error al inactivar la Actividad.");
  }
  
 </script>
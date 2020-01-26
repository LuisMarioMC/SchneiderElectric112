 <script language="JavaScript" type="text/javascript">
 
  //Eliminar
  function CajaConfirmacionEliminarSegmento(id_segmento)
  {
   if(confirm('En realidad desea eliminar el Segmento?'))
   {
    document.location.href='controlador_eliminar_segmento.php?id='+id_segmento;
   }
  }
  function MensajeEliminarSegmento()
  {
   alertify.success("El Segmento fue eliminado de forma correcta.");
  }
  function MensajeErrorEliminarSegmento1()
  {
   alertify.error("Se presento un error al eliminar el Segmento.");
  }
  function MensajeErrorEliminarSegmento2()
  {
   alertify.error("El Segmento no puede ser eliminado debido a que existen Usuarios que lo utilizan.");
  }

  // Crear
  function MensajeCrearSegmento()
  {
   alertify.success("El Segmento fue creado de forma correcta.");
  }
  function MensajeErrorCrearSegmento1()
  {
   alertify.error("Se presento un error al crear el Segmento.");
  }
    
  // Modificar
  function MensajeModificarSegmento()
  {
   alertify.success("El Segmento fue modificado de forma correcta.");
  }
  function MensajeErrorModificarSegmento1()
  {
   alertify.error("Se presento un error al modificar el Segmento.");
  }
  
  // Activar
  function MensajeActivarSegmento()
  {
   alertify.success("El Segmento fue activado de forma correcta.");
  }
  function MensajeErrorActivarSegmento1()
  {
   alertify.error("Se presento un error al activar el Segmento.");
  }

  // Inactivar
  function MensajeInactivarSegmento()
  {
   alertify.success("El Segmento fue inactivada de forma correcta.");
  }
  function MensajeErrorInactivarSegmento1()
  {
   alertify.error("Se presento un error al inactivar el Segmento.");
  }
  
 </script>
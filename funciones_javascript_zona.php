 <script language="JavaScript" type="text/javascript">
 
  //Eliminar
  function CajaConfirmacionEliminarZona(id_zona)
  {
   if(confirm('En realidad desea eliminar la Zona?'))
   {
    document.location.href='controlador_eliminar_zona.php?id='+id_zona;
   }
  }
  function MensajeEliminarZona()
  {
   alertify.success("La Zona fue eliminada de forma correcta.");
  }
  function MensajeErrorEliminarZona1()
  {
   alertify.error("Se presento un error al eliminar la Zona.");
  }
  function MensajeErrorEliminarZona2()
  {
   alertify.error("La Zona no puede ser eliminada debido a que existen Productos que lo utilizan.");
  }

  // Crear
  function MensajeCrearZona()
  {
   alertify.success("La Zona fue creada de forma correcta.");
  }
  function MensajeErrorCrearZona1()
  {
   alertify.error("Se presento un error al crear la Zona.");
  }
    
  // Modificar
  function MensajeModificarZona()
  {
   alertify.success("La Zona fue modificada de forma correcta.");
  }
  function MensajeErrorModificarZona1()
  {
   alertify.error("Se presento un error al modificar la Zona.");
  }
  
  // Activar
  function MensajeActivarZona()
  {
   alertify.success("La Zona fue activada de forma correcta.");
  }
  function MensajeErrorActivarZona1()
  {
   alertify.error("Se presento un error al activar la Zona.");
  }

  // Inactivar
  function MensajeInactivarZona()
  {
   alertify.success("La Zona fue inactivada de forma correcta.");
  }
  function MensajeErrorInactivarZona1()
  {
   alertify.error("Se presento un error al inactivar la Zona.");
  }
  
 </script>
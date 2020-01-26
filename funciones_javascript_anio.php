 <script language="JavaScript" type="text/javascript">
 
  //Eliminar
  function CajaConfirmacionEliminarAnio(id_anio)
  {
   if(confirm('En realidad desea eliminar el Anio?'))
   {
    document.location.href='controlador_eliminar_anio.php?id='+id_anio;
   }
  }
  function MensajeEliminarAnio()
  {
   alertify.success("El A&ntilde;o fue eliminado de forma correcta.");
  }
  function MensajeErrorEliminarAnio1()
  {
   alertify.error("Se presento un error al eliminar el A&ntilde;o.");
  }
  function MensajeErrorEliminarAnio2()
  {
   alertify.error("El A&ntilde;o no puede ser eliminado debido a que existen Metas Sell In que lo utilizan.");
  }

  // Crear
  function MensajeCrearAnio()
  {
   alertify.success("El A&ntilde;o fue creado de forma correcta.");
  }
  function MensajeErrorCrearAnio1()
  {
   alertify.error("Se presento un error al crear el A&ntilde;o.");
  }
    
  // Modificar
  function MensajeModificarAnio()
  {
   alertify.success("El A&ntilde;o fue modificado de forma correcta.");
  }
  function MensajeErrorModificarAnio1()
  {
   alertify.error("Se presento un error al modificar el A&ntilde;o.");
  }
  
  // Activar
  function MensajeActivarAnio()
  {
   alertify.success("El A&ntilde;o fue activado de forma correcta.");
  }
  function MensajeErrorActivarAnio1()
  {
   alertify.error("Se presento un error al activar el A&ntilde;o.");
  }

  // Inactivar
  function MensajeInactivarAnio()
  {
   alertify.success("El A&ntilde;o fue inactivado de forma correcta.");
  }
  function MensajeErrorInactivarAnio1()
  {
   alertify.error("Se presento un error al inactivar el A&ntilde;o.");
  }
  function MensajeErrorInactivarAnio2()
  {
   alertify.error("El A&ntilde;o no puede ser Inactivado, debido a que tiene Q activos.");
  }
  
 </script>
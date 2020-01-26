 <script language="JavaScript" type="text/javascript">
 
  //Eliminar
  function CajaConfirmacionEliminarLinea(id_linea)
  {
   if(confirm('En realidad desea eliminar la Linea?'))
   {
    document.location.href='controlador_eliminar_linea.php?id='+id_linea;
   }
  }
  function MensajeEliminarLinea()
  {
   alertify.success("La L&iacute;nea fue eliminada de forma correcta.");
  }
  function MensajeErrorEliminarLinea1()
  {
   alertify.error("Se presento un error al eliminar la L&iacute;nea.");
  }
  function MensajeErrorEliminarLinea2()
  {
   alertify.error("La L&iacute;nea no puede ser eliminado debido a que existen Actividades que lo utilizan.");
  }

  // Crear
  function MensajeCrearLinea()
  {
   alertify.success("La L&iacute;nea fue creada de forma correcta.");
  }
  function MensajeErrorCrearLinea1()
  {
   alertify.error("Se presento un error al crear la L&iacute;nea.");
  }
    
  // Modificar
  function MensajeModificarLinea()
  {
   alertify.success("La L&iacute;nea fue modificada de forma correcta.");
  }
  function MensajeErrorModificarLinea1()
  {
   alertify.error("Se presento un error al modificar la L&iacute;nea.");
  }
  
  // Activar
  function MensajeActivarLinea()
  {
   alertify.success("La L&iacute;nea fue activada de forma correcta.");
  }
  function MensajeErrorActivarLinea1()
  {
   alertify.error("Se presento un error al activar la L&iacute;nea.");
  }

  // Inactivar
  function MensajeInactivarLinea()
  {
   alertify.success("La L&iacute;nea fue inactivada de forma correcta.");
  }
  function MensajeErrorInactivarLinea1()
  {
   alertify.error("Se presento un error al inactivar la L&iacute;nea.");
  }
  
 </script>
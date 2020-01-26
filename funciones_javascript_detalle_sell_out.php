 <script language="JavaScript" type="text/javascript">
 
  //Eliminar
  function CajaConfirmacionEliminarDetalleSellOut(id_detalle_sell_out)
  {
   if(confirm('En realidad desea eliminar el Detalle de SellOut?'))
   {
    document.location.href='controlador_eliminar_detalle_sell_out.php?id='+id_detalle_sell_out;
   }
  }
  function MensajeEliminarDetalleSellOut()
  {
   alertify.success("El Detalle de SellOut fue eliminado de forma correcta.");
  }
  function MensajeErrorEliminarDetalleSellOut1()
  {
   alertify.error("Se presento un error al eliminar el Detalle de SellOut.");
  }
  function MensajeErrorEliminarDetalleSellOut2()
  {
   alertify.error("El Detalle de SellOut no puede ser eliminado debido a que existen ...... que lo utilizan.");
  }

  // Crear
  function MensajeCrearDetalleSellOut()
  {
   alertify.success("La L&iacute;nea fue creada de forma correcta.");
  }
  function MensajeErrorCrearDetalleSellOut1()
  {
   alertify.error("Se presento un error al crear la L&iacute;nea.");
  }
    
  // Modificar
  function MensajeModificarDetalleSellOut()
  {
   alertify.success("El Detalle de SellOut fue modificado de forma correcta.");
  }
  function MensajeErrorModificarDetalleSellOut1()
  {
   alertify.error("Se presento un error al modificar el Detalle de SellOut.");
  }
  
  // Activar
  function MensajeActivarDetalleSellOut()
  {
   alertify.success("La L&iacute;nea fue activada de forma correcta.");
  }
  function MensajeErrorActivarDetalleSellOut1()
  {
   alertify.error("Se presento un error al activar la L&iacute;nea.");
  }

  // Inactivar
  function MensajeInactivarDetalleSellOut()
  {
   alertify.success("La L&iacute;nea fue inactivada de forma correcta.");
  }
  function MensajeErrorInactivarDetalleSellOut1()
  {
   alertify.error("Se presento un error al inactivar la L&iacute;nea.");
  }
  
 </script>
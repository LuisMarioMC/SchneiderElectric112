 <script language="JavaScript" type="text/javascript">
 
  //Eliminar
  function CajaConfirmacionEliminarMetaSellOut(id_meta_sell_out)
  {
   if(confirm('En realidad desea eliminar la Meta Sell Out?'))
   {
    document.location.href='controlador_eliminar_meta_sell_out.php?id='+id_meta_sell_out;
   }
  }
  function MensajeEliminarMetaSellOut()
  {
   alertify.success("La Meta Sell Out fue eliminada de forma correcta.");
  }
  function MensajeErrorEliminarMetaSellOut1()
  {
   alertify.error("Se presento un error al eliminar la Meta Sell Out.");
  }
  function MensajeErrorEliminarMetaSellOut2()
  {
   alertify.error("La Meta Sell Out no puede ser eliminada debido a que existen Reportes que lo utilizan.");
  }

  // Crear
  function MensajeCrearMetaSellOut()
  {
   alertify.success("La Meta Sell Out fue creada de forma correcta.");
  }
  function MensajeErrorCrearMetaSellOut1()
  {
   alertify.error("Se presento un error al crear la Meta Sell Out.");
  }
    
  // Modificar
  function MensajeModificarMetaSellOut()
  {
   alertify.success("La Meta Sell Out fue modificada de forma correcta.");
  }
  function MensajeErrorModificarMetaSellOut1()
  {
   alertify.error("Se presento un error al modificar la Meta Sell Out.");
  }
  
  // Activar
  function MensajeActivarMetaSellOut()
  {
   alertify.success("La Meta Sell Out fue activada de forma correcta.");
  }
  function MensajeErrorActivarMetaSellOut1()
  {
   alertify.error("Se presento un error al activar la Meta Sell Out.");
  }

  // Inactivar
  function MensajeInactivarMetaSellOut()
  {
   alertify.success("La Meta Sell Out fue inactivada de forma correcta.");
  }
  function MensajeErrorInactivarMetaSellOut1()
  {
   alertify.error("Se presento un error al inactivar la Meta Sell Out.");
  }
  
 </script>
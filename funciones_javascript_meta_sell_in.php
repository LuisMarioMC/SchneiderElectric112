 <script language="JavaScript" type="text/javascript">
 
  //Eliminar
  function CajaConfirmacionEliminarMetaSellIn(id_meta_sell_in)
  {
   if(confirm('En realidad desea eliminar la Meta Sell In?'))
   {
    document.location.href='controlador_eliminar_meta_sell_in.php?id='+id_meta_sell_in;
   }
  }
  function MensajeEliminarMetaSellIn()
  {
   alertify.success("La Meta Sell In fue eliminada de forma correcta.");
  }
  function MensajeErrorEliminarMetaSellIn1()
  {
   alertify.error("Se presento un error al eliminar la Meta Sell In.");
  }
  function MensajeErrorEliminarMetaSellIn2()
  {
   alertify.error("La Meta Sell In no puede ser eliminada debido a que existen Reportes que lo utilizan.");
  }

  // Crear
  function MensajeCrearMetaSellIn()
  {
   alertify.success("La Meta Sell In fue creada de forma correcta.");
  }
  function MensajeErrorCrearMetaSellIn1()
  {
   alertify.error("Se presento un error al crear la Meta Sell In.");
  }
    
  // Modificar
  function MensajeModificarMetaSellIn()
  {
   alertify.success("La Meta Sell In fue modificada de forma correcta.");
  }
  function MensajeErrorModificarMetaSellIn1()
  {
   alertify.error("Se presento un error al modificar la Meta Sell In.");
  }
  
  // Activar
  function MensajeActivarMetaSellIn()
  {
   alertify.success("La Meta Sell In fue activada de forma correcta.");
  }
  function MensajeErrorActivarMetaSellIn1()
  {
   alertify.error("Se presento un error al activar la Meta Sell In.");
  }

  // Inactivar
  function MensajeInactivarMetaSellIn()
  {
   alertify.success("La Meta Sell In fue inactivada de forma correcta.");
  }
  function MensajeErrorInactivarMetaSellIn1()
  {
   alertify.error("Se presento un error al inactivar la Meta Sell In.");
  }
  
 </script>
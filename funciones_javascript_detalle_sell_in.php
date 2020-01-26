 <script language="JavaScript" type="text/javascript">
 
  //Eliminar
  function CajaConfirmacionEliminarDetalleSellIn(id_detalle_sell_in)
  {
   if(confirm('En realidad desea eliminar el Detalle de Sell In?'))
   {
    document.location.href='controlador_eliminar_detalle_sell_in.php?id='+id_detalle_sell_in;
   }
  }
  function MensajeEliminarDetalleSellIn()
  {
   alertify.success("El Detalle de SellIn fue eliminado de forma correcta.");
  }
  function MensajeErrorEliminarDetalleSellIn1()
  {
   alertify.error("Se presento un error al eliminar el Detalle de SellIn.");
  }
  function MensajeErrorEliminarDetalleSellIn2()
  {
   alertify.error("El Detalle de SellIn no puede ser eliminado debido a que existen ...... que lo utilizan.");
  }

  // Modificar
  function MensajeModificarDetalleSellIn()
  {
   alertify.success("El Detalle de SellIn fue modificado de forma correcta.");
  }
  function MensajeErrorModificarDetalleSellIn1()
  {
   alertify.error("Se presento un error al modificar el Detalle de SellIn.");
  }
  
 </script>
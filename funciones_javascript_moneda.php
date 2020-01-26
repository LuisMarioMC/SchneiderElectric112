 <script language="JavaScript" type="text/javascript">
 
  //Eliminar
  function CajaConfirmacionEliminarMoneda(id_moneda)
  {
   if(confirm('En realidad desea eliminar la Moneda?'))
   {
    document.location.href='controlador_eliminar_moneda.php?id='+id_moneda;
   }
  }
  function MensajeEliminarMoneda()
  {
   alertify.success("La Moneda fue eliminada de forma correcta.");
  }
  function MensajeErrorEliminarMoneda1()
  {
   alertify.error("Se presento un error al eliminar la Moneda.");
  }
  function MensajeErrorEliminarMoneda2()
  {
   alertify.error("La Moneda no puede ser eliminada debido a que existen Paises que lo utilizan.");
  }

  // Crear
  function MensajeCrearMoneda()
  {
   alertify.success("La Moneda fue creada de forma correcta.");
  }
  function MensajeErrorCrearMoneda1()
  {
   alertify.error("Se presento un error al crear la Moneda.");
  }
    
  // Modificar
  function MensajeModificarMoneda()
  {
   alertify.success("La Moneda fue modificada de forma correcta.");
  }
  function MensajeErrorModificarMoneda1()
  {
   alertify.error("Se presento un error al modificar la Moneda.");
  }
  
  // Activar
  function MensajeActivarMoneda()
  {
   alertify.success("La Moneda fue activada de forma correcta.");
  }
  function MensajeErrorActivarMoneda1()
  {
   alertify.error("Se presento un error al activar la Moneda.");
  }

  // Inactivar
  function MensajeInactivarMoneda()
  {
   alertify.success("La Moneda fue inactivada de forma correcta.");
  }
  function MensajeErrorInactivarMoneda1()
  {
   alertify.error("Se presento un error al inactivar la Moneda.");
  }
  
 </script>
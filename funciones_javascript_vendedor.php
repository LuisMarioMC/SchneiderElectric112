 <script language="JavaScript" type="text/javascript">
 
  //Eliminar
  function CajaConfirmacionEliminarVendedor(id_vendedor)
  {
   if(confirm('En realidad desea eliminar el Vendedor?'))
   {
    document.location.href='controlador_eliminar_vendedor.php?id='+id_vendedor;
   }
  }
  function MensajeEliminarVendedor()
  {
   alertify.success("El Vendedor fue eliminado de forma correcta.");
  }
  function MensajeErrorEliminarVendedor1()
  {
   alertify.error("Se presento un error al eliminar el Vendedor.");
  }
  function MensajeErrorEliminarVendedor2()
  {
   alertify.error("El Vendedor no puede ser eliminado debido a que existen registros.");
  }

  // Crear
  function MensajeCrearVendedor()
  {
   alertify.success("El Vendedor fue creado de forma correcta.");
  }
  function MensajeErrorCrearVendedor1()
  {
   alertify.error("Se presento un error al crear el Vendedor.");
  }
    
  // Modificar
  function MensajeModificarVendedor()
  {
   alertify.success("El Vendedor fue modificado de forma correcta.");
  }
  function MensajeErrorModificarVendedor1()
  {
   alertify.error("Se presento un error al modificar el Vendedor.");
  }
  
  // Activar
  function MensajeActivarVendedor()
  {
   alertify.success("El Vendedor fue activado de forma correcta.");
  }
  function MensajeErrorActivarVendedor1()
  {
   alertify.error("Se presento un error al activar el Vendedor.");
  }

  // Inactivar
  function MensajeInactivarVendedor()
  {
   alertify.success("El Vendedor fue inactivado de forma correcta.");
  }
  function MensajeErrorInactivarVendedor1()
  {
   alertify.error("Se presento un error al inactivar el Vendedor.");
  }
  
 </script>
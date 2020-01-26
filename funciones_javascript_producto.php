 <script language="JavaScript" type="text/javascript">
 
  //Eliminar
  function CajaConfirmacionEliminarProducto(id_producto)
  {
   if(confirm('En realidad desea eliminar el Producto?'))
   {
    document.location.href='controlador_eliminar_producto.php?id='+id_producto;
   }
  }
  function MensajeEliminarProducto()
  {
   alertify.success("El Producto fue eliminado de forma correcta.");
  }
  function MensajeErrorEliminarProducto1()
  {
   alertify.error("Se presento un error al eliminar el Producto.");
  }
  function MensajeErrorEliminarProducto2()
  {
   alertify.error("El Producto no puede ser eliminado debido a que existen registros asociados.");
  }

  // Crear
  function MensajeCrearProducto()
  {
   alertify.success("El Producto fue creado de forma correcta.");
  }
  function MensajeErrorCrearProducto1()
  {
   alertify.error("Se presento un error al crear el Producto.");
  }
    
  // Modificar
  function MensajeModificarProducto()
  {
   alertify.success("El Producto fue modificado de forma correcta.");
  }
  function MensajeErrorModificarProducto1()
  {
   alertify.error("Se presento un error al modificar el Producto.");
  }
  
  // Activar
  function MensajeActivarProducto()
  {
   alertify.success("El Producto fue activado de forma correcta.");
  }
  function MensajeErrorActivarProducto1()
  {
   alertify.error("Se presento un error al activar el Producto.");
  }

  // Inactivar
  function MensajeInactivarProducto()
  {
   alertify.success("La Producto fue inactivado de forma correcta.");
  }
  function MensajeErrorInactivarProducto1()
  {
   alertify.error("Se presento un error al inactivar el Producto.");
  }
  
 </script>
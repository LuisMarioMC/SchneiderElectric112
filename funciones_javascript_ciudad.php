 <script language="JavaScript" type="text/javascript">
 
  //Eliminar
  function CajaConfirmacionEliminarCiudad(id_ciudad)
  {
   if(confirm('En realidad desea eliminar la Ciudad?'))
   {
    document.location.href='controlador_eliminar_ciudad.php?id='+id_ciudad;
   }
  }
  function MensajeEliminarCiudad()
  {
   alertify.success("La Ciudad fue eliminada de forma correcta.");
  }
  function MensajeErrorEliminarCiudad1()
  {
   alertify.error("Se presento un error al eliminar la Ciudad.");
  }
  function MensajeErrorEliminarCiudad2()
  {
   alertify.error("La Ciudad no puede ser eliminada debido a que existen registros que la utilizan.");
  }

  // Crear
  function MensajeCrearCiudad()
  {
   alertify.success("La Ciudad fue creada de forma correcta.");
  }
  function MensajeErrorCrearCiudad1()
  {
   alertify.error("Se presento un error al crear la Ciudad.");
  }
    
  // Modificar
  function MensajeModificarCiudad()
  {
   alertify.success("La Ciudad fue modificada de forma correcta.");
  }
  function MensajeErrorModificarCiudad1()
  {
   alertify.error("Se presento un error al modificar la Ciudad.");
  }
  
  // Activar
  function MensajeActivarCiudad()
  {
   alertify.success("La Ciudad fue activada de forma correcta.");
  }
  function MensajeErrorActivarCiudad1()
  {
   alertify.error("Se presento un error al activar la Ciudad.");
  }
  function MensajeErrorActivarCiudad2()
  {
   alertify.error("El Ciudad no puede ser activada, debido a que el Departamento esta inactivo.");
  }

  // Inactivar
  function MensajeInactivarCiudad()
  {
   alertify.success("El Ciudad fue inactivada de forma correcta.");
  }
  function MensajeErrorInactivarCiudad1()
  {
   alertify.error("Se presento un error al inactivar la Ciudad.");
  }
  
 </script>
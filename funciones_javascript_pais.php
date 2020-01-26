 <script language="JavaScript" type="text/javascript">
 
  //Eliminar
  function CajaConfirmacionEliminarPais(id_pais)
  {
   if(confirm('En realidad desea eliminar el Pais?'))
   {
    document.location.href='controlador_eliminar_pais.php?id='+id_pais;
   }
  }
  function MensajeEliminarPais()
  {
   alertify.success("El Pa&iacute;s fue eliminado de forma correcta.");
  }
  function MensajeErrorEliminarPais1()
  {
   alertify.error("Se presento un error al eliminar el Pa&iacute;s.");
  }
  function MensajeErrorEliminarPais2()
  {
   alertify.error("El Pa&iacute;s no puede ser eliminado debido a que existen Departamentos que lo utilizan.");
  }

  // Crear
  function MensajeCrearPais()
  {
   alertify.success("El Pa&iacute;s fue creado de forma correcta.");
  }
  function MensajeErrorCrearPais1()
  {
   alertify.error("Se presento un error al crear el Pa&iacute;s.");
  }
    
  // Modificar
  function MensajeModificarPais()
  {
   alertify.success("El Pa&iacute;s fue modificado de forma correcta.");
  }
  function MensajeErrorModificarPais1()
  {
   alertify.error("Se presento un error al modificar el Pa&iacute;s.");
  }
  
  // Activar
  function MensajeActivarPais()
  {
   alertify.success("El Pa&iacute;s fue activado de forma correcta.");
  }
  function MensajeErrorActivarPais1()
  {
   alertify.error("Se presento un error al activar el Pa&iacute;s.");
  }

  // Inactivar
  function MensajeInactivarPais()
  {
   alertify.success("El Pa&iacute;s fue inactivado de forma correcta.");
  }
  function MensajeErrorInactivarPais1()
  {
   alertify.error("Se presento un error al inactivar el Pa&iacute;s.");
  }
  function MensajeErrorInactivarPais2()
  {
   alertify.error("El Pais no puede ser inactivado, debido a que tiene Departamentos activos.");
  }

 </script>
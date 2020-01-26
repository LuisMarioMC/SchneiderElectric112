 <script language="JavaScript" type="text/javascript">
 
  //Eliminar
  function CajaConfirmacionEliminarDepartamento(id_departamento)
  {
   if(confirm('En realidad desea eliminar el Departamento?'))
   {
    document.location.href='controlador_eliminar_departamento.php?id='+id_departamento;
   }
  }
  function MensajeEliminarDepartamento()
  {
   alertify.success("El Departamento fue eliminado de forma correcta.");
  }
  function MensajeErrorEliminarDepartamento1()
  {
   alertify.error("Se presento un error al eliminar el Departamento.");
  }
  function MensajeErrorEliminarDepartamento2()
  {
   alertify.error("El Departamento no puede ser eliminado debido a que existen Ciudades que lo utilizan.");
  }

  // Crear
  function MensajeCrearDepartamento()
  {
   alertify.success("El Departamento fue creado de forma correcta.");
  }
  function MensajeErrorCrearDepartamento1()
  {
   alertify.error("Se presento un error al crear el Departamento.");
  }
    
  // Modificar
  function MensajeModificarDepartamento()
  {
   alertify.success("El Departamento fue modificado de forma correcta.");
  }
  function MensajeErrorModificarDepartamento1()
  {
   alertify.error("Se presento un error al modificar el Departamento.");
  }
  
  // Activar
  function MensajeActivarDepartamento()
  {
   alertify.success("El Departamento fue activado de forma correcta.");
  }
  function MensajeErrorActivarDepartamento1()
  {
   alertify.error("Se presento un error al activar el Departamento.");
  }
  function MensajeErrorActivarDepartamento2()
  {
   alertify.error("El Departamento no puede ser activado, debido a que el Pais esta inactivo.");
  }

  // Inactivar
  function MensajeInactivarDepartamento()
  {
   alertify.success("El Departamento fue inactivado de forma correcta.");
  }
  function MensajeErrorInactivarDepartamento1()
  {
   alertify.error("Se presento un error al inactivar el Departamento.");
  }
  function MensajeErrorInactivarDepartamento2()
  {
   alertify.error("El Departamento no puede ser inactivado, debido a que tiene Ciudades activas.");
  }
  
 </script>
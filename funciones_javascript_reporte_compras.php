 <script language="JavaScript" type="text/javascript">
  //Eliminar
  function CajaConfirmacionEliminarReporte(id_reporte)
  {
   if(confirm('En realidad desea eliminar el Reporte de Compras?'))
   {
    document.location.href='controlador_eliminar_reporte_compras.php?id='+id_reporte;
   }
  }
  function MensajeEliminarReporte()
  {
   alertify.success("El Reporte de Compras fue eliminado de forma correcta.");
  }
  function MensajeErrorEliminarReporte1()
  {
   alertify.error("Se presento un error al eliminar el Reporte de Compras.");
  }
 
  // Crear
  function MensajeCrearReporte()
  {
   alertify.success("El Reporte fue creado de forma correcta.");
  }
  function MensajeErrorCrearReporte1()
  {
   alertify.error("Se presento un error al crear el Reporte.");
  }
  
 </script>
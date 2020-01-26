<?php
 require_once ('controlador_listar_aprobar.php');
?>

<!DOCTYPE html>
<html lang="es">
 <head>
 
 <?php
  require_once ('metadatos.php');
  echo ' <title>Listar Aprobaci&oacute;n</title>'; 
  require_once ('librerias_css.php');
  require_once ('funciones_javascript_aprobar.php');
 ?>
  
 </head>
 
 <body>
  <div id="wrapper">

   <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <?php require_once ('menu_superior.php'); require_once ('menu_lateral.php');?>
   </nav>
  
   <div id="page-wrapper">
	<br> 
	<div class="row">
     <div class="col-lg-12">
      <div class="panel panel-default">
       <div class="panel-heading">
        Listar Aprobaci&oacute;n <?php echo $nombre_q .' ('.$nombre_anio.').'?>
       </div>
	   
       <div class="panel-body">
	   
	    <ol class="breadcrumb">
		 <?php echo $miga_pan ?>
		</ol>

        <?php echo $mensaje_alerta ?> 		
	   
	    <form class="form-horizontal" role="form" name="formulario" action="listar_aprobar.php" autocomplete="off" method="post" enctype="multipart/form-data">  

         <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover" id="aprobar">
           <thead>
            <tr>
		     <th></th>
		     <th>Distribuidor</th>
		     <th>Pa&iacute;s</th>			
		     <th>L&iacute;nea</th>
		     <th>Actividad</th>
		     <th>Venta</th>	
		     <th>Meta</th>
			 <th>Bonificaci&oacute;n</th>
			 <th></th>
		    </tr>
           </thead>
		   <tfoot>
            <tr>
		     <th></th>
		     <th>Distribuidor</th>
		     <th>Pa&iacute;s</th>			
		     <th>L&iacute;nea</th>
		     <th>Actividad</th>			
		     <th>Venta</th>	
		     <th>Meta</th>
			 <th>Bonificaci&oacute;n</th>
			 <th></th>           
		    </tr>
           </tfoot>
           <tbody>
            <?php echo $listar.$listar_mensaje ?>
		   </tbody>
          </table>
		 		 
         </div>
         <!-- /.table-responsive -->
       	
		 <br>
		
		 <div align="right">
		  <?php echo $boton_aprobar ?>
		 </div>

		</form>
		
	   </div>
       <!-- /.panel-body -->
      </div>
      <!-- /.panel -->
     </div>
     <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
			
   </div>
  </div>

  <?php
   require_once ('librerias_javascript.php');
  ?>
  
  <script>
   $(document).ready(function() {
    $('#aprobar').dataTable({
	 <!-- Ordenar por la columna 0 //-->
	 "order": [[ 2, "asc"]],
	 <!-- Guardar el estado de la Tabla //-->
	 <!--stateSave: true,-->
     <!-- Tipo de Páginación: Botones de Primero, Anterior, Siguiente, Ultimo y Numero de Página //-->
	 "pagingType" : "simple_numbers",
	 
     <!-- Configuración de Páginación //-->
	 "lengthMenu" : [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
	 	 
	 columnDefs: [ {
	  targets: [ 2 ],
	  <!-- Ordenar por la columna 0, luego la 1 //-->
      orderData: [ 2, 1 ] 
	 }
	 ]
    });
   });
  </script>
 </body>
</html>
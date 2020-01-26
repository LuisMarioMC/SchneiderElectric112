<?php
 require_once ('controlador_reporte_inventario.php');
?>

<!DOCTYPE html>
<html lang="es">
 <head>
 
 <?php
  require_once ('metadatos.php');
  echo ' <title>Reporte Inventario</title>'; 
  require_once ('librerias_css.php');
  require_once ('funciones_javascript_reporte_inventario.php');
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
        Reporte Inventario
       </div>
	   
       <div class="panel-body">
	   
	    <ol class="breadcrumb">
		 <?php echo $miga_pan ?>
		</ol>
	
	    <?php
				
		 echo '<div class="row">';
         echo ' <div class="col-lg-12">';		 
		 echo '  <form class="form-horizontal" role="form" name="formulario" action="reporte_inventario.php" autocomplete="off" method="post" enctype="multipart/form-data">';
	
		 echo '   <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">';
 		 echo '	   <div class="form-group">';
		 echo '	    <label>Reporte Inventario</label>';
         echo '     <input class="file" id="reporte_inventario" name="reporte_inventario" type="file" data-show-upload="false" data-show-caption="true" placeholder="Reporte Inventario" required/>';
		 echo '	   </div>';
		 echo '   </div>';
		   
		 echo '   <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">';
 		 echo '	   <div class="form-group">';
		 echo '	    <label>Mes</label>';
         echo $menu_mes;
		 echo '	   </div>';
		 echo '   </div>';
		 
		 echo '   <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">';
 		 echo '	   <div class="form-group">';
		 echo '	    <label>Distribuidor</label>';
         echo $menu_distribuidor;
		 echo '	   </div>';
		 echo '   </div>';
		 
		 echo '   <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">';
 		 echo '	   <div class="form-group">';
            
		 echo $error_reporte_inventario;
		 echo $error_mes;
		 echo $error_distribuidor;
		 
 		 echo '	   </div>';
		 echo '   </div>';
				
		 echo $listar_mensaje;
		     
         echo '   <div align="right" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">';
         echo '    <button type="submit" class="btn btn-default">Crear</button>';
		 echo '   </div>';
		
		 echo '  </form>';
			
		 echo ' </div>';
         echo '</div>';
         
		 echo '<br><br>';
		 
		?>
		
        <div class="table-responsive">
         <table class="table table-striped table-bordered table-hover" id="reporte">
          <thead>
           <tr>
		    <th></th>
		    <th>Estado</th>
		    <th>Mes</th>
		    <th>Distribuidor</th>			
		    <th>Fecha</th>
		    <th>Hora</th>
			<th></th>
			<th></th>
		   </tr>
          </thead>
		  <tfoot>
           <tr>
		    <th></th>
		    <th>Estado</th>
		    <th>Mes</th>
		    <th>Distribuidor</th>			
		    <th>Fecha</th>
		    <th>Hora</th>
			<th></th>
			<th></th>
  		   </tr>
          </tfoot>
          <tbody>
           <?php echo $listar.$listar_mensaje?>
		  </tbody>
         </table>
        </div>
        <!-- /.table-responsive -->
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
    $('#reporte').dataTable({
	 <!-- Ordenar por la columna 0 //-->
	 "order": [[ 0, "asc"]],
	 <!-- Guardar el estado de la Tabla //-->
	 <!--stateSave: true,-->
     <!-- Tipo de Páginación: Botones de Primero, Anterior, Siguiente, Ultimo y Numero de Página //-->
	 "pagingType" : "simple_numbers",
	 
     <!-- Configuración de Páginación //-->
	 "lengthMenu" : [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
	 	 
	 columnDefs: [ {
	  targets: [ 0 ],
	  <!-- Ordenar por la columna 0, luego la 1 //-->
      orderData: [ 0, 1 ] 
	 }
	 ]
    });
   });

   $('#reporte_inventario').fileinput({
    language: 'es',
    allowedFileExtensions : ['xls','xlsx'],
   });
  </script>
  
 </body>
</html>
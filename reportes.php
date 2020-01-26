<?php
 require_once ('controlador_reportes.php');
?>

<!DOCTYPE html>
<html lang="es">
 <head>
 
 <?php
  require_once ('metadatos.php');
  echo ' <title>Reportes</title>'; 
  require_once ('librerias_css.php');
  require_once ('funciones_javascript_reportes.php');
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
        Reportes
       </div>
	   
       <div class="panel-body">
	   
	    <ol class="breadcrumb">
		 <?php echo $miga_pan ?>
		</ol>
	
	    <?php
		
		 if($_SESSION['perfil']=='distribuidor')
		 {
		
		  echo '<div class="row">';
          echo ' <div class="col-lg-12">';
		  
		  echo '  <div align="right"><a href="formatosBase/Maestro de Productos.xlsx" download="Maestro de Productos.xlsx" target="_blank">Descargar Maestro de Productos</a></div><br><br>';
		  
		  echo '  <form class="form-horizontal" role="form" name="formulario" action="reportes.php" autocomplete="off" method="post" enctype="multipart/form-data">';
	
		  echo '   <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">';
 		  echo '	<div class="form-group">';
		  echo '	 <label>Reporte de Ventas</label>';
          echo '     <input class="file" id="reporte_ventas" name="reporte_ventas" type="file" data-show-upload="false" data-show-caption="true" placeholder="Reporte Ventas" required/>';
		  echo '	 <br>';
		  echo '	 <a href="formatosBase/Formato Reporte Ventas.xlsx" target="_blank">Descargar modelo de reporte</a>';
		  //download="Formato Reporte Ventas.xlsx"
		  echo '	</div>';
		  echo '   </div>';
		   		
		  echo '   <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">';
 		  echo '	<div class="form-group">';
		  echo '	 <label>Reporte de Inventario</label>';
          echo '     <input class="file" id="reporte_inventario" name="reporte_inventario" type="file" data-show-upload="false" data-show-caption="true" placeholder="Reporte Inventario" required/>';
		  echo '	 <br>';
		  echo '	 <a href="formatosBase/Formato Reporte Inventario.xlsx" target="_blank">Descargar modelo de reporte</a>';
		  echo '	</div>';
		  echo '   </div>';
		   
		  echo '   <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">';
 		  echo '	<div class="form-group">';
		  echo '	 <label>Mes</label>';
          echo $menu_mes;
		  echo '	</div>';
		  echo '   </div>';
		 
		  echo '   <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">';
 		  echo '	<div class="form-group">';
            
		  echo $error_reporte_ventas;
		  echo $error_reporte_inventario;
		  echo $error_mes;
			 
 		  echo '	</div>';
		  echo '   </div>';
				
		  echo $listar_mensaje;
		     
          echo '   <div align="right" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">';
          echo '    <input type="submit" name="subir_reporte" id="subir_reporte" class="btn btn-default" value="Crear">';
		  echo '   </div>';
		
		  echo '  </form>';
			
		  echo ' </div>';
          echo '</div>';
         
		  echo '<br><br>';
		 }
		?>
		
        <div class="table-responsive">
         <table class="table table-striped table-bordered table-hover" id="reporte">
          <thead>
           <tr>
		    <th></th>
		    <th>Estado</th>
		    <th></th>
		    <th>Mes</th>
		    <th>Distribuidor</th>			
			<th>V.</th>
		    <th>Fecha</th>
		    <th>Hora</th>
			<th></th>
		   </tr>
          </thead>
		  <tfoot>
           <tr>
		    <th></th>
		    <th>Estado</th>
		    <th></th>			
		    <th>Mes</th>
		    <th>Distribuidor</th>			
			<th>V.</th>
		    <th>Fecha</th>
		    <th>Hora</th>
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
     <!-- Tipo de P�ginaci�n: Botones de Primero, Anterior, Siguiente, Ultimo y Numero de P�gina //-->
	 "pagingType" : "simple_numbers",
	 
     <!-- Configuraci�n de P�ginaci�n //-->
	 "lengthMenu" : [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
	 	 
	 columnDefs: [ {
	  targets: [ 0 ],
	  <!-- Ordenar por la columna 0, luego la 1 //-->
      orderData: [ 0, 1 ] 
	 }
	 ]
    });
   });

   $('#reporte_ventas').fileinput({
    language: 'es',
    allowedFileExtensions : ['xls','xlsx'],
   });
   $('#reporte_inventario').fileinput({
    language: 'es',
    allowedFileExtensions : ['xls','xlsx'],
   });
   
   // Tooltip
   $('.tooltip-reportes').tooltip({
    selector: "[data-toggle=tooltip]",
    container: "body"
   });
      
  </script>
  
 </body>
</html>